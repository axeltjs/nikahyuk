<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoice;
class InvoiceController extends Controller
{
    public function show($id)
    {
        $invoice = Invoice::where('transaction_id', $id)->get();

        return view('admin.invoice.show', compact($invoice));
    }
}
