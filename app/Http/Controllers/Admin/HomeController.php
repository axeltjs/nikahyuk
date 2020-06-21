<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Survey;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('Customer') && $user->survey === null){
            return redirect()->route('customer.survey');
        }

        if($user->hasRole('Customer'))
        {
            $has_survey = Survey::where('user_id', Auth::user()->id)->first();
            return view('admin.home', compact('has_survey'));
        }

        if($user->hasRole('Vendor')){
            $transModel = new Transaction;
            $counted = [
                'transaction' => $transModel->where('vendor_id', $user->id)->count()
            ];

            $transaksi = $transModel->where('vendor_id', $user->id)->get();
            $paymentMethod = $transaksi->countBy(function ($item) {
                return $item->payment_method_format;
            });

            $transactionChart = json_encode($this->getTransactionPerMonth());
            
            return view('admin.home', compact('transactionChart', 'paymentMethod', 'counted'));
        }

        if($user->hasRole('Admin'))
        {
            $transactionChart = json_encode($this->getTransactionPerMonth());
            $transModel = new Transaction;
            $counted = [
                'customer' => User::whereHas("roles", function($q){ $q->where("name", "Customer"); })->count(),
                'vendor' => User::whereHas("roles", function($q){ $q->where("name", "Vendor"); })->count(),
                'transaction' => $transModel->count()
            ];

            $transaksi = $transModel->get();
            $paymentMethod = $transaksi->countBy(function ($item) {
                return $item->payment_method_format;
            });

            return view('admin.home', compact('transactionChart', 'paymentMethod', 'counted'));
        }

        return view('admin.home');
    }

    private function getTransactionPerMonth()
    {
        $transactionChart = DB::table('transactions')
        ->get()
        ->groupBy(function ($item) {
        return Carbon::parse($item->created_at)->format('F Y');
        })
        ->map(function ($group) {
        $group = $group->toArray();
        $summed = [];

        $columns = array_keys((array) $group[0]);
        array_shift($columns);

        foreach ($columns as $column) {
        $summed[$column] = array_sum(array_column($group, $column));
        }

        return $summed;
        });

        return $transactionChart;
    }
}
