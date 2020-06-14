<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use PDF;
use App\Http\Requests\UploadPembayaranInvoiceRequest;

class InvoiceController extends Controller
{
    use \App\Http\Controllers\Traits\TraitUpload;
    use \App\Http\Controllers\Traits\TraitMessage;

    public function show($id)
    {
        $invoices = Invoice::where('transaction_id', $id)->get();
        $transaction_num = $invoices->first()->transaction->number;

        return view('admin.invoice.show', compact('invoices', 'transaction_num'));
    }

    public function cetakInvoice($id)
    {
        $item = Invoice::findOrFail($id);

        $pdf = PDF::loadView('admin.invoice.pdf', compact('item'));
        return $pdf->download('invoice_'.date("dmYHis").'.pdf');
        // return view('admin.invoice.pdf', compact('item'));
    }

    public function uploadPembayaran(UploadPembayaranInvoiceRequest $request)
    {
        $id = $request->get('invoice_id');

        $invoice = Invoice::findOrFail($id);
        $photo = $this->photoUploaded($request->bukti_pembayaran, 'invoice', 1);

        $invoice->update([
            'bukti_bayar' => $photo,
            'status' => 2,
        ]);

        $this->message('Berhasil upload bukti pembayaran!');

        return redirect()->back();
    }
}
