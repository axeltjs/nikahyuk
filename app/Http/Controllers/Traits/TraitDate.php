<?php
namespace App\Http\Controllers\Traits;

trait TraitDate
{
    /**
     * Range date to seperated Sql Date 
     * 
     * @return Array
     */

    private function rangeToSql($date)
    {
        $getDate = explode(' - ', $date);
        $start = explode('/', $getDate[0]);
        $end = explode('/', $getDate[1]);

        $result = [
            'start' => $start[2]."-".$start[1]."-".$start[0],
            'end' => $end[2]."-".$end[1]."-".$end[0]
        ];

        return $result;
    }
}
