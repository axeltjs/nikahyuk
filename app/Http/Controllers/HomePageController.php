<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Rating;
use App\Models\Company;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Transaction;

class HomePageController extends Controller
{
    public function index()
    {
        $banner = Banner::get();
        $rating = Rating::where('score', '>=', 4)->limit(10)->get();
        $promo = Promotion::where('approved', 1)->get();
        $vendor = Company::where('approved', 1);

        $numbers = [
            'client' => User::whereHas("roles", function($q){ $q->where("name", "Customer"); })->count(),
            'transaksi' => Transaction::where('status', '!=', 2)->count(),
            'vendor' => $vendor->count()
        ];

        $data = [
            'banners' => $banner,
            'promos' => $promo,
            'ratings' => $rating,
            'vendors' => $vendor->get(),
            'numbers' => $numbers
        ];
        return view('home')->with($data);
    }

    public function promo($id)
    {
        $promo = Promotion::findOrFail($id);
        $banner = Banner::get();

        $data = [
            'banners' => $banner,
            'promo' => $promo,
        ];

        return view('promo')->with($data);
    }

}
