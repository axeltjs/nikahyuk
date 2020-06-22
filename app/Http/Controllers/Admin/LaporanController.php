<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

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
}
