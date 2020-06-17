<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Promotion;

class BannerController extends Controller
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
        $data = Banner::filter($request)->paginate(10);
        $view = [
            'items' => $data,
        ];

        return view('admin.banner.index')->with($view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = [null => 'Tidak terikat dengan promosi manapun'];
        $promo = Promotion::pluck('title','id');

        foreach($promo as $title => $id){
            $promotions[$title] = $id;
        }

        $view = [
            'method' => 'create',
            'promotions' => $promotions
        ];

        return view('admin.banner.create_edit')->with($view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $image = $this->photoUploaded($request->gambar, 'banner');
        
        $promo = Banner::create([
            'image' => $image,
            'name' => $request->get('name'),
            'placeholder' => $request->get('placeholder'),
            'type' => 'banner',
            'promotion_id' => $request->get('promotion_id'), 
        ]);

        $this->message('Banner berhasil dibuat!');

        return redirect('admin/banner');
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
        $banner = Banner::findOrFail($id);
        
        $promotions = [null => 'Tidak terikat dengan promosi manapun'];
        $promo = Promotion::pluck('title','id');

        foreach($promo as $title => $id){
            $promotions[$title] = $id;
        }
        
        $view = [
            'method' => 'edit',
            'item' => $banner,
            'promotions' => $promotions
        ];

        $old = $banner;
        $old = $old->toArray();
        session()->flash('_old_input', $old);

        return view('admin.banner.create_edit')->with($view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $data = [
            'name' => $request->get('name'),
            'placeholder' => $request->get('placeholder'),
            'type' => 'banner',
            'promotion_id' => $request->get('promotion_id'), 
        ];

        if (isset($request->gambar)) {
            $image = $this->photoUploaded($request->gambar, 'banner', 1, $banner->image ?? null);
            $data['image'] = $image;
        }

        $banner->update($data);

        $this->message('Banner berhasil diubah!');

        return redirect('admin/banner');
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
        $data = Banner::findOrFail($id);

        $this->deletePhoto('banner', $data->image);
        $data = $data->delete();

        $this->message('Banner berhasil dihapus!');

        return redirect()->back();
    }

}
