<?php
namespace App\Http\Controllers\Traits;

trait TraitDate
{
    /**
     * Range date to seperated Sql Date 
     * 
     * @return Array
     */

    public function rangeToSql($date)
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

    public function convertToRange($date_start, $date_end)
    {
        $date1 = date('d/m/Y', strtotime($date_start));
        $date2 = date('d/m/Y', strtotime($date_end));

        return $date1." - ".$date2;
    }
}
