<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class PaymentValidationController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    
    public function index(Request $request)
    {
        $items = Invoice::filter($request)->orderBy('status','desc')->orderBy('jatuh_tempo')->paginate(10);

        return view('admin.payment_confirmation.index',compact('items'));
    }

    public function confirm(Request $request)
    {
        
        $this->message('Berhasil konfirmasi pembayaran!');

        return redirect()->back();
    }
}
