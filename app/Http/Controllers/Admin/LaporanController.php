<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EventItem;
use App\Models\Transaction;
use PDF;
use DB;

class LaporanController extends Controller
{
    public function user(Request $request)
    {
        $user = User::role('Customer')->filter($request)->paginate(15);
        $data = [
            'users' => $user
        ];

        return view('admin.laporan.user')->with($data);
    }

    public function userCetak($id)
    {
        $user = User::findOrFail($id);

        $pdf = PDF::loadView('admin.laporan.user-cetak', compact('user'));
        return $pdf->download('laporan_user_'.date("dmYHis").'.pdf');
    }

    public function vendor(Request $request)
    {
        $vendor = User::role('Vendor')->filter($request)->paginate(15);
        $data = [
            'vendors' => $vendor
        ];

        return view('admin.laporan.vendor')->with($data);
    }

    public function vendorCetak($id)
    {
        $user = User::findOrFail($id);

        $pdf = PDF::loadView('admin.laporan.vendor-cetak', compact('user'));
        return $pdf->download('laporan_vendor_'.date("dmYHis").'.pdf');
    }

    public function itemAcara(Request $request)
    {
        $date = $this->convertDate($request->get('date'));

        $item = EventItem::select('name', DB::raw('count(*) as jumlah'))
            ->filter($request, $date['date'], $date['date_end'])
            ->groupBy('name')
            ->get();

        $data = [
            'items' => $item
        ];

        return view('admin.laporan.event_item')->with($data);
    }

    public function itemAcaraCetak(Request $request)
    {
        $date = $this->convertDate($request->get('date'));

        $items = EventItem::select('name', DB::raw('count(*) as jumlah'))
        ->filter($request, $date['date'], $date['date_end'])
        ->groupBy('name')
        ->get();

        $pdf = PDF::loadView('admin.laporan.event_item_cetak', compact('items', 'date'));
        return $pdf->download('laporan_item_'.date("dmYHis").'.pdf');
    }
    /**
     * 
     * TODO: 
     * 1. Scope Transaksi
     * 2. Blade Transaksi Rekap
     * 3. Arahkan Laporan Transaksi Detail ke yang sudah ada
     * done 
     */
    public function transaksi(Request $request)
    {
        $date = $this->convertDate($request->get('date'));

        $item = Transaction::filter($request, $date)->paginate(15);

        $data = [
            'items' => $item
        ];

        return view('admin.laporan.transaksi')->with($data);
    }

    public function cetakTransaksi(Request $request)
    {
        $date = $this->convertDate($request->get('date'));

        $items = Transaction::filter($request, $date)->get();

        $pdf = PDF::loadView('admin.laporan.transaksi-cetak', compact('items', 'date'));
        return $pdf->download('laporan_transaksi_'.date("dmYHis").'.pdf');
    }

    public function cetakTransaksiTunggal($id)
    {
        $item = Transaction::findOrFail($id);

        $pdf = PDF::loadView('admin.laporan.transaksi-cetak-tunggal', compact('item'));
        return $pdf->download('laporan_transaksi_tunggal_'.date("dmYHis").'.pdf');
    }
    
    public function convertDate($date)
    {
        if($date){
            $dateArray = explode(' - ', $date);

            $date = date('Y-m-d',strtotime($dateArray[0]));
            $date_end = date('Y-m-d', strtotime($dateArray[1]));
            
            if($date == $date_end){
                return null;
            }
            
            $data = [
                'date' => $date,
                'date_end' => $date_end,
            ];

            return $data;
        }

        return null;
    }
}
