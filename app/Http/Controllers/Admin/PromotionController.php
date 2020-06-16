<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use App\Events\PromotionVendorNotifEvent;

class PromotionController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company_id = auth()->user()->company->id;

        $data = Promotion::where('company_id', $company_id)->filter($request)->paginate(10);
        $view = [
            'items' => $data,
        ];

        return view('admin.promotion.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = [
            'method' => 'create',
        ];

        return view('admin.promotion.create_edit')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        $image = $this->photoUploaded($request->gambar, 'promotion');
        
        $promo = Promotion::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $image,
            'company_id' => auth()->user()->company->id,
        ]);

        event(new PromotionVendorNotifEvent('vendor', 1, auth()->user()->id, $promo->id));

        $this->message('Artikel berhasil dibuat!');

        return redirect('vendor/promotion');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Promotion::findOrFail($id);

        return view('admin.promotion.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $view = [
            'method' => 'edit',
            'item' => $promotion,
        ];

        $old = $promotion;
        $old = $old->toArray();
        session()->flash('_old_input', $old);

        return view('admin.promotion.create_edit')->with($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionRequest $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $data = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'approved' => 0,
        ];

        if (isset($request->gambar)) {
            $image = $this->photoUploaded($request->gambar, 'promotion', 1, $promotion->image ?? null);
            $data['image'] = $image;
        }

        event(new PromotionVendorNotifEvent('vendor', 1, auth()->user()->id, $promotion->id));

        $promotion->update($data);

        $this->message('Artikel berhasil diubah!');

        return redirect('vendor/promotion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Promotion::findOrFail($id);

        $this->deletePhoto('promotion', $data->image);
        $data = $data->delete();

        $this->message('Artikel berhasil dihapus!');

        return redirect()->back();
    }

    /**
     * 
     * Admin
     * 
     */

    public function approvalList(Request $request)
    {
        $data = Promotion::filter($request)->orderBy('approved')->paginate(10);
     
        $view = [
            'items' => $data,
        ];

        return view('admin.promotion.index')->with($view);
    }

    public function approval(Request $request)
    {
        // dd($request->all());
        $id = $request->get('promotion_id');
        $status = $request->get('status');

        $data = Promotion::findOrFail($id);

        event(new PromotionVendorNotifEvent('admin', auth()->user()->id, $data->company->user->id, $id));

        $data = $data->update(['approved' => $status]);

        // notif
        if($data){
            $this->message('Artikel berhasil diupdate!');

            return redirect()->back();
        }

        $this->message('Artikel gagal diupdate!','danger');

        return redirect()->back();
        
    }
}
