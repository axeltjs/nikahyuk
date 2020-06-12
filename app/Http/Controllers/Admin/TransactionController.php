<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Events\SendCreateTransactionNotification;
use Auth;

class TransactionController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitCode;

    public function dealTransaction(Request $request)
    {
        $number = $this->getTransactionCode(Auth::user()->id, $request->get('vendor_id'));

        $transaksi = Transaction::create([
            'number' => $number,
            'customer_id' => Auth::user()->id,
            'vendor_id' => $request->get('vendor_id'),
            'amount' => $request->get('amount'),
            'status' => 0,
            'payment_method' => $request->get('payment_method')
        ]);

        event(new SendCreateTransactionNotification(Auth::user()->id, $request->get('vendor_id'), $transaksi));

        $this->message('Transaksi berhasil dibuat!');

        return redirect('transaction');
    }

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
            'items' => $data,
        ];

        return view('admin.transaction.show')->with($view);   
    }
}
