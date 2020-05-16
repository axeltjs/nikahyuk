<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuotationRequest;
use App\Models\Quotation;
use App\Models\SelectedVendor;
use App\Models\Survey;
use Auth;
use PDF;

class QuotationController extends Controller
{
    use \App\Http\Controllers\Traits\TraitUpload;
    use \App\Http\Controllers\Traits\TraitMessage;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $items = Quotation::where('creator_id', $user)->orderBy('updated_at','desc')->paginate(10);

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
                return $item->get()->map(function($cust){
                    return $cust->client;
                })->pluck('name','id');
            });
            $user = $user[0];
        }

        return view('admin.quotation.create_edit', compact('method', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationRequest $request)
    {
        $nama_file = $this->photoUploaded($request->file, 'quotation', 0);

        Quotation::create([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'file' => $nama_file,
            'price' => $request->price,
            'customer_id' => $request->customer_id,
            'creator_id' => Auth::user()->id
        ]);
        
        $this->message('Sukses mengirim penawaran');

        return redirect('vendor/quotation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Quotation::find($id);

        if($data->file){
            return response()->download(storage_path("app/public/quotation/{$data->file}"));
        }
        $pdf = PDF::loadView('admin.quotation.pdf', compact('data'));
        
        return $pdf->download('quotation_'.date("dmYHis").'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $data = Quotation::find($id);
        $method = "edit";
        $user = SelectedVendor::where('vendor_id', $user_id);
        
        if($user->first()){
            $user = $user->get()->map(function($item){
                return $item->get()->map(function($cust){
                    return $cust->client;
                })->pluck('name','id');
            });
            $user = $user[0];
        }

        return view('admin.quotation.create_edit', compact('method', 'user', 'data'));
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
        $item = Quotation::findOrFail($id);
        $nama_file = $this->photoUploaded($request->file, 'quotation', 0, $item->file);

        $data = [
            'package_name' => $request->package_name,
            'description' => $request->description,
            'file' => $nama_file,
            'price' => $request->price,
            'customer_id' => $request->customer_id,
            'creator_id' => Auth::user()->id
        ];

        if (isset($nama_file)) {
            $data['file'] = $nama_file;
        }

        $item = $item->update($data);

        $this->message('Sukses mengubah penawaran');

        return redirect('vendor/quotation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Quotation::findOrFail($id);
        $this->deletePhoto('quotation', $data->file);
        $data = $data->delete();

        $this->message('Berhaisl menghapus penawaran');

        return redirect()->back();
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
