<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\VendorValidationRequest;

class VendorValidationController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;

    public function index()
    {
        $items = Company::orderBy('approved','asc')->paginate(10);

        return view('admin.vendor_validation.index', compact('items'));
    }

    public function show($id)
    {
        $item = Company::findOrFail($id);

        return view('admin.vendor_validation.show', compact('item'));
    }

    public function update($id, VendorValidationRequest $request)
    {
        $item = Company::findOrFail($id);

        $item->update([
            'approved' => $request->get('approved'),
            'reject_reason' => $request->get('reject_reason') ?? '-'
        ]);

        $this->message('Berhasil update status vendor!');

        return redirect()->back();
    }
}
