<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $invoices = Invoice::where('transaction_id', $id)->get();
        $transaction_num = $invoices->first()->transaction->number;

        return view('admin.invoice.show', compact('invoices', 'transaction_num'));
    }
}
