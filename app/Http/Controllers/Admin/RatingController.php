<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Company;

class RatingController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
 
    public function postReview(Request $request)
    {
        $vendor_id = $request->get('vendor_id');
        $company = Company::where('user_id', $vendor_id)->first();

        Rating::updateOrCreate(
            ['company_id' => $company->id, 'customer_id' => auth()->user()->id],
            [
                'score' => $request->get('score'),
                'review' => $request->get('review'),
            ]
        );

        $this->message('Berhasil memberikan penilaian!');

        return redirect()->back();
    }
}
