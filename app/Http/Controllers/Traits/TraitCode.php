<?php
namespace App\Http\Controllers\Traits;
use App\Models\Transaction;
use App\Models\Invoice;

trait TraitCode
{
    /**
     *  
     * @param integer customer id
     * @param integer vendor id
     * 
     * @return string
     */

    public function getTransactionCode($cust_id, $vend_id)
    {
        $transaksi = new Transaction;
        $nomor = $transaksi->count() ?? 1;
        $date = date('dmYHis');

        $code = 'NY-'.$date.'/0'.$cust_id.'0'.$vend_id.'/'.$nomor;
        return $code;
    }

    /**
     * @param model transaction
     * @param string date
     * 
     * @return string
     */

    public function getInvoiceCode($transaction, $nomor, $date)
    {
        if($nomor == 0){
            $invoice = new Invoice;
            $nomor = $invoice->count() ?? 1;
        }
        
        $date = date('dmYHis',strtotime($date));

        $cust_id = $transaction->customer_id;
        $vend_id = $transaction->vendor_id;
        $id = $transaction->id;

        $code = 'INV-'.$date.'/0'.$cust_id.'0'.$vend_id.'/'.$nomor.'/'.$id;
        return $code;
    }
    
}
