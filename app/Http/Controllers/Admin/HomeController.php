<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Survey;

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

        return view('admin.home');
    }
}
