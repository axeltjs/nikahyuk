<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorSetup;
use App\Models\Company;
use Auth;
use App\Http\Requests\VendorSetupRequest;
use DB;

class SetupController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitDate;

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

        $has_company = $this->company->with(['eventItem','vendorSetup'])->where('user_id', Auth::user()->id)->first();
        if($has_company){
            // $item_acara_vend = DB::table('event_item')->where([
            //     'model_id' => $has_company->id,
            //     'model_type' => get_class($this->company)
            // ])->pluck('name');

            // $has_company->toArray();
            // $has_company = collect($has_company)->union(['item_acara' => $item_acara_vend->toArray()]);

            session()->flash('_old_input', $has_company);
        }
        
        return view('admin.vendor-setup.index', compact('tema','item_acara','has_company'));
    }

    public function updateSurvey(VendorSetupRequest $request)
    {
        $surveyClass = get_class($this->survey);
        $date = $this->rangeToSql($request->get('event_date_range'));
        
        $survey = $this->survey->updateOrCreate(
        ['user_id' => Auth::user()->id],
        [
            'budget' => $request->get('budget'),
            'event_date' => $date['start'],
            'event_date_end' => $date['end'],
            'city_id' => $request->get('city_id'),
            'province_id' => $request->get('province_id'),
            'invitation_qty' => $request->get('invitation_qty'),
            'theme' => $request->get('theme'),
        ]
        );

        $item_acara = $request->get('item_acara');
        $array_item_acara = [];
        foreach($item_acara as $item){
            $array_item_acara[] = [
                'model_id' => $survey->id,
                'name' => $item,
                'model_type' => $surveyClass
            ];
        }

        // Delete the event item if exist
        DB::table('event_item')->where([
            'model_id' => $survey->id,
            'model_type' => $surveyClass
        ])->delete();

        // Insert again
        DB::table('event_item')->insert($array_item_acara);

        $this->message('Sukses menyimpan konfigurasi usaha');

        return redirect('home');
    }
}
