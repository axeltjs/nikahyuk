<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->getRoleNames()[0] === 'Customer' && $user->survey === null){
            return redirect()->route('customer.survey');
        }

        return view('admin.home');
    }
}
