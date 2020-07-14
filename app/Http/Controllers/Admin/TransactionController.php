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
        
        // if(is_numeric($request->get('payment_method'))){
        //     if(Carbon::parse(Auth::user()->survey->event_date)->subDays(14) <= Carbon::now()){
        //         $this->message('Transaksi gagal dibuat! Khusus kredit, tanggal acara harus lebih dari 2 minggu (14 Hari)', 'danger');
        //         return redirect()->back();
        //     }
        // }

        $transaksi = Transaction::create([
            'number' => $number,
            'customer_id' => Auth::user()->id,
            'vendor_id' => $request->get('vendor_id'),
            'amount' => $request->get('amount'),
            'status' => 0,
            'payment_method' => $request->get('payment_method'),
            'quotation_id' => $request->get('quotation_id'),
        ]);

        event(new SendCreateTransactionNotificationEvent('customer', $request->get('vendor_id'), Auth::user()->id, $transaksi));

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
            $invoice = new Invoice;
            $tglAcara = $transaction->customer->survey->event_date;
            $amount = $transaction->amount;

            if($status){ // jika true alias setuju
                if(is_numeric($transaction->payment_method)){
                    // jika user mencicil atau kredit
                    if($transaction->payment_method == 2){
                        $dp = $amount * 0.1;

                        // $date = Carbon::now()->addMonths($i);
                        $date1 = Carbon::now()->addDays(3);
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 0, $date1),
                            'amount' => $dp,
                            'jatuh_tempo' => $date1,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];
                        
                        $tenor1 = $amount * 0.4;
                        $date2 = Carbon::parse($tglAcara)->subDays(14);

                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 1, $date2),
                            'amount' => $tenor1,
                            'jatuh_tempo' => $date2,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];

                        $tenor2 = $amount * 0.5;
                        
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 2, $date2),
                            'amount' => $tenor2,
                            'jatuh_tempo' => $date2,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];
                    }else{ //3
                        $dp = $amount * 0.05;

                        // $date = Carbon::now()->addMonths($i);
                        $date1 = Carbon::now()->addDays(3);
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 0, $date1),
                            'amount' => $dp,
                            'jatuh_tempo' => $date1,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];
                        
                        $tenor1 = $amount * 0.15;
                        $date2 = Carbon::parse($tglAcara)->subDays(14);

                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 1, $date2),
                            'amount' => $tenor1,
                            'jatuh_tempo' => $date2,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];

                        $tenor2 = $amount * 0.5;
                        
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 2, $date2),
                            'amount' => $tenor2,
                            'jatuh_tempo' => $date2,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];

                        $tenor3 = $amount * 0.3;
                        
                        $newInvoices[] = [
                            'number' => $this->getInvoiceCode($transaction, 3, $date2),
                            'amount' => $tenor3,
                            'jatuh_tempo' => $date2,
                            'status' => 0,
                            'transaction_id' => $transaction_id
                        ];

                    }
                    $invoice->insert($newInvoices);

                }else{
                    // by default if payment method is cash
                    $date = Carbon::now();
    
                    $tenor1 = $amount * 0.3;
                    $date1 = Carbon::parse($tglAcara)->subDays(14);

                    $newInvoices[] = ([
                        'number' => $this->getInvoiceCode($transaction, 0, $date1),
                        'amount' => $tenor1,
                        'jatuh_tempo' => $date1,
                        'status' => 0,
                        'transaction_id' => $transaction_id
                    ]);

                    $tenor2 = $amount * 0.7;
                    $newInvoices[] = ([
                        'number' => $this->getInvoiceCode($transaction, 1, $date1),
                        'amount' => $tenor2,
                        'jatuh_tempo' => $date1,
                        'status' => 0,
                        'transaction_id' => $transaction_id
                    ]);

                    $invoice->insert($newInvoices);
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
