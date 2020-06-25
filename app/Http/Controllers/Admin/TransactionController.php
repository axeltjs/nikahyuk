<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Events\SendCreateTransactionNotificationEvent;
use Auth;
use Carbon\Carbon;
use Exception;
use DB;

class TransactionController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitCode;

    public function index(Request $request)
    {
        if(auth()->user()->hasRole('Customer')){
            $data = Transaction::where('customer_id', auth()->user()->id)->orderBy('status')->paginate(10);
        }elseif(auth()->user()->hasRole('Vendor')){
            $data = Transaction::where('vendor_id', auth()->user()->id)->orderBy('status')->paginate(10);
        }else{
            $data = Transaction::orderBy('status')->paginate(10);
        }

        $view = [
            'items' => $data,
        ];

        return view('admin.transaction.index')->with($view);
    }

    public function show($id)
    {
        $data = Transaction::with('invoice')->find($id);

        $view = [
            'item' => $data,
        ];

        return view('admin.transaction.show')->with($view);   
    }

    /**
     * Deal from customer side
     * @param Request
     * 
     * @return redirect
     */
    public function dealTransaction(Request $request)
    {
        $number = $this->getTransactionCode(Auth::user()->id, $request->get('vendor_id'));

        $transaksi = Transaction::create([
            'number' => $number,
            'customer_id' => Auth::user()->id,
            'vendor_id' => $request->get('vendor_id'),
            'amount' => $request->get('amount'),
            'status' => 0,
            'payment_method' => $request->get('payment_method'),
            'quotation_id' => $request->get('quotation_id'),
        ]);

        event(new SendCreateTransactionNotificationEvent('customer', Auth::user()->id, $request->get('vendor_id'), $transaksi));

        $this->message('Transaksi berhasil dibuat!');

        return redirect('transaction');
    }

    /**
     * Crosscheck from vendor 
     * @param Request
     * 
     * @return redirect
     */
    public function dealFromVendor(Request $request)
    {
        $transaction_id = $request->get('transaction_id');
        $status = $request->get('status');

        $transaction = Transaction::find($transaction_id);

        DB::beginTransaction();

        try {
            if($status){ // jika true alias setuju
            
                // membuat invoice atau tagihan
                $invoice = new Invoice;
                
                if(is_numeric($transaction->payment_method)){
                    // jika user mencicil atau kredit
                    $newInvoices = [];
                    $amount = $transaction->amount / $transaction->payment_method;
    
                    for ($i=1; $i <= $transaction->payment_method; $i++) { 
                        $date = Carbon::now()->addMonths($i);
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, $i, $date),
                            'amount' => $amount,
                            'jatuh_tempo' => $date,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];
                    }

                    $invoice->insert($newInvoices);

                }else{
                    // by default if payment method is cash
                    $amount = $transaction->amount;
                    $date = Carbon::now()->addMonths($i);
    
                    $invoice->create([
                        'number' => $this->getInvoiceCode($transaction, 0, $date),
                        'amount' => $amount,
                        'jatuh_tempo' => null,
                        'status' => 0,
                        'transaction_id' => $transaction_id
                    ]);
                }
    
                $transaction->update(['status' => 1]);
            }else{ // vendor menolak
                $transaction->update(['status' => 2]);
            }
        
            event(new SendCreateTransactionNotificationEvent('vendor', $transaction->customer_id, Auth::user()->id, $transaction));

            DB::commit();

        }catch(Exception $e){
            throw $e;
            $this->message($e->getMessage(), 'danger');
        
            return redirect()->back();
        }

        $this->message('Transaksi berhasil diperbarui!');

        return redirect()->back();
    }
}
