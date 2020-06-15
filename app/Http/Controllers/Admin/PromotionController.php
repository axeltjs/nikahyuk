<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promotion;

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
        $data = Promotion::filter($request)->paginate(10);
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
        
        $user = Promotion::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $image,
            'company_id' => auth()->user()->company->id,
        ]);

        $this->message('Artikel berhasil dibuat!');

        return redirect('admin/promotion');
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
        ];

        if ($request->get('gambar') != null ) {
            $image = $this->photoUploaded($request->gambar, 'promotion', 1, $promotion->image ?? null);
            $data['image'] = $image;
        }

        $promotion->update($data);

        $this->message('Artikel berhasil diubah!');

        return redirect('admin/promotion');
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
        $data = $data->delete();

        $this->message('Artikel berhasil dihapus!');

        return redirect()->back();
    }
}
