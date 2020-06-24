<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorSetup;
use App\Models\Company;
use Auth;
use App\Models\User;
use App\Http\Requests\VendorSetupRequest;
use DB;
use Exception;

class SetupController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitDate;
    use \App\Http\Controllers\Traits\TraitUpload;

    public function __construct(VendorSetup $setup, Company $company)
    {
        $this->setup = $setup;
        $this->company = $company;
    }

    public function index()
    {
        $tema = [
            'Nasional' => 'Nasional',
            'Adat Bali' => 'Adat Bali',
            'Adat Jawa' => 'Adat Jawa',
            'Adat Bugis' => 'Adat Bugis',
            'Adat Dayak' => 'Adat Dayak',
            'Lainnya' => 'Lainnya'
        ];

        $item_acara = [
            'Mahar',
            'Gaun Pengantin',
            'Seragam kedua orang tua',
            'Make up',
            'Gedung',
            'Dekorasi',
            'Katering',
            'Dokumentasi Foto',
            'Dokumentasi Video',
            'Elektone',
            'Band',
            'MC',
        ];

        $has_company = $this->company->with(['vendorSetup'])->where('user_id', Auth::user()->id)->first();

        if($has_company){
            $sk = User::find(Auth::user()->id)->toArray()['sk_photo'];

            $citys = $has_company->vendorSetup->map(function($item){
                return $item->where('name', 'city_id')->pluck('value');
            })->first();

            $themes = $has_company->vendorSetup->map(function($item){
                return $item->where('name', 'theme')->pluck('value');
            })->first();

            $event_items = $has_company->vendorSetup->map(function($item){
                return $item->where('name', 'item_acara')->pluck('value');
            })->first();

            $has_company->toArray();
            $has_company = collect($has_company)->union(['city_id' => $citys, 'theme' => $themes, 'item_acara' => $event_items->toArray(), 'sk' => $sk]);
            session()->flash('_old_input', $has_company);
        }
        return view('admin.vendor-setup.index', compact('tema','item_acara','has_company'));
    }

    public function updateSetup(VendorSetupRequest $request)
    {
        $setupClass = get_class($this->setup);
        if(!$this->checkTheUpload($request)){
            $this->message('Harap upload KTP, Foto tempat usaha, Scan Syarat & Ketentuan, dan NPWP Anda!', 'danger');
            return redirect()->back();
        }
        
        $ktp = $this->photoUploaded($request->identity_card, 'company', 0);
        $photo = $this->photoUploaded($request->photo, 'company', 0);
        $izin = $this->photoUploaded($request->business_permit, 'company', 0);
        $npwp = $this->photoUploaded($request->npwp, 'company', 0);
        $sk_photo = $this->photoUploaded($request->sk_photo, 'user', 0);

        $currentUser = $this->company->where(['user_id' => Auth::user()->id])->first();
        
        if(isset($currentUser)){
            if($ktp == null){
                $ktp = $currentUser->identity_card;
            }
            if($npwp == null){
                $npwp = $currentUser->npwp;
            }
            if($izin == null){
                $izin = $currentUser->nidentity_cardpwp;
            }
            if($photo == null){
                $photo = $currentUser->photo;
            }
        }
        

        $company = $this->company->updateOrCreate(
        ['user_id' => Auth::user()->id],
        [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'budget_min' => $request->get('budget_min'),
            'budget_max' => $request->get('budget_max'),
            'identity_card' => $ktp,
            'npwp' => $npwp,
            'business_permit' => $izin,
            'photo' => $photo
        ]);

        if($sk_photo){
            User::find(Auth::user()->id)->update(['sk_photo' => $sk_photo]);
        }
        
        $vendorSetup = [];
        foreach($request->get('city_id') as $item){
            $vendorSetup[] = [
                'company_id' => $company->id,
                'name' => 'city_id',
                'value' => $item,
            ];
        }

        foreach($request->get('theme') as $item){
            $vendorSetup[] = [
                'company_id' => $company->id,
                'name' => 'theme',
                'value' => $item,
            ];
        }

        foreach($request->get('item_acara') as $item){
            $vendorSetup[] = [
                'company_id' => $company->id,
                'name' => 'item_acara',
                'value' => $item,
            ];
        }
        $this->setup->where('company_id', $company->id)->delete();
        $this->setup->insert($vendorSetup);

        $this->message('Sukses menyimpan konfigurasi usaha');

        return redirect('home');
    }

    public function checkTheUpload($request)
    {
        $checkCompany = $this->company->where(['user_id' => Auth::user()->id])->first();
        
        if($checkCompany == null){
            if($request->identity_card == null || $request->photo == null || $request->npwp == null || $request->sk_photo ==
            null){
                return false;
            }
        }

        return true;
    }
}
