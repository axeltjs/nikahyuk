<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\SelectedVendor;
use App\Models\Survey;
use Auth;

class QuotationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $items = Quotation::where('creator_id', $user)->paginate(10);

        return view('admin.quotation.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $method = "create";
        $user = SelectedVendor::where('vendor_id', $id);
        if($user->first()){
            $user = $user->get()->map(function($item){
                return $item->client;
            })->pluck('name','id');
        }

        return view('admin.quotation.create_edit', compact('method', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getClientBudget(Request $request)
    {
        if($request->ajax()){
            $budget = Survey::where('user_id', $request->get('id'))->first()->budget;
            // return response()->json($budget);
            return response()->json(number_format($budget));
        }
    }
}
