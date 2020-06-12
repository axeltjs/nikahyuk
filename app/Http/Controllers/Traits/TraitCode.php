<?php
namespace App\Http\Controllers\Traits;
use App\Models\Transaction;

trait TraitCode
{
    /**
     * Range date to seperated Sql Date 
     * @param integer customer id
     * @param integer vendor id
     * 
     * @return Array
     */

    public function getTransactionCode($cust_id, $vend_id)
    {
        $transaksi = new Transaction;
        $nomor = $transaksi->count() ?? 1;
        $date = date('dmY');
        $time = date('His');

        $code = 'NY-'.$date.'/0'.$cust_id.'0'.$vend_id.'/'.$nomor.'/'.$time;
        return $code;
    }

    
}
