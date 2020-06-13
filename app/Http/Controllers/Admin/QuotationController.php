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
use App\Events\SendOfferCompleteNotification;
use App\Events\DeleteSendOfferCompleteNotification;
use DB;
use Exception;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;

class QuotationController extends Controller
{
    use \App\Http\Controllers\Traits\TraitUpload;
    use \App\Http\Controllers\Traits\TraitMessage;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $items = Quotation::filter($request)->where('creator_id', $user)->orderBy('updated_at','desc')->paginate(10);

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

        $quotation = Quotation::create([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'file' => $nama_file,
            'price' => $request->price,
            'customer_id' => $request->customer_id,
            'creator_id' => Auth::user()->id
        ]);

        $cust = User::find($request->customer_id);

        $chat = Chat::firstOrCreate([
            'customer_id' => $request->customer_id,
            'vendor_id' => Auth::user()->id
        ]);

        ChatMessage::create([
            'user_id' => auth()->user()->id,
            'chat_id' => $chat->id,
            'message' => 'Hai '.$cust->name.', kami memiliki penawaran yang cocok buat kamu! <br> kamu bisa cek link dibawah ini ya. <br><br> <a target="__blank" href="'.url('customer/quotation/'.$quotation->id).'">'.$request->package_name.'</a>'
        ]);

        event(new SendOfferCompleteNotification($request->customer_id, $quotation));
        
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
        DB::beginTransaction();

        try {
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

            $cust = User::find($request->customer_id);

            $item->update($data);

            $chat = Chat::firstOrCreate([
                'customer_id' => $request->customer_id,
                'vendor_id' => Auth::user()->id
            ]);

            event(new DeleteSendOfferCompleteNotification($id));
            // event(new SendOfferCompleteNotification($request->customer_id, $item));

            ChatMessage::create([
                'user_id' => auth()->user()->id,
                'chat_id' => $chat->id,
                'message' => 'Hai '.$cust->name.', kami baru saja memperbarui penawaran kami hanya untukmu! <br> kamu bisa cek link dibawah ini ya. <br><br> <a target="__blank" href="'.url('customer/quotation/'.$id).'">'.$request->package_name.'</a>'
            ]);

            DB::commit();

            $this->message('Sukses mengubah penawaran');
        } catch (Exception $e) {
            throw $e;
        }

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
        DB::beginTransaction();

        try {
            $data = Quotation::findOrFail($id);

            event(new DeleteSendOfferCompleteNotification($id));

            $this->deletePhoto('quotation', $data->file);
            $data->delete();
            DB::commit();

            $this->message('Berhaisl menghapus penawaran');
        } catch (Exception $e) {
            throw $e;
        }

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
