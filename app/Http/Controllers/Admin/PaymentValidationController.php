<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentValidationController extends Controller
{
    public function index(Request $request)
    {
        $items = Invoice::filter($request)->orderBy('status','desc')->paginate(10);

        return view('admin.payment_confirmation',compact('items'));
    }
}
