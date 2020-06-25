<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use Auth;
use App\Http\Requests\SurveyCustomerRequest;
use DB;
use App\Models\Company;
use App\Models\User;
use Exception;
use App\Models\SelectedVendor;
use App\Events\SendOfferNotification;
use App\Events\DeleteSendOfferNotification;
use Illuminate\Http\Request;
class SurveyController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitDate;
    use \App\Http\Controllers\Traits\TraitUpload;

    public function __construct(Survey $survey,
                                Company $company,
                                User $user)
    {
        $this->survey = $survey;
        $this->company = $company;
        $this->user = $user;
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

        $has_survey = $this->survey->where('user_id', Auth::user()->id)->first();
        if($has_survey){
            $item_acara_cust = DB::table('event_item')->where([
                'model_id' => $has_survey->id,
                'model_type' => get_class($this->survey)
            ])->pluck('name');
            
            $has_survey->toArray();
            $has_survey = collect($has_survey)->union(['item_acara' => $item_acara_cust->toArray()]);
            session()->flash('_old_input', $has_survey);
        }
        return view('admin.survey.index', compact('tema','item_acara','has_survey'));
    }

    public function show($id)
    {
        $survey = $this->survey->findOrFail($id);

        if($survey){
            $item_acara_cust = DB::table('event_item')->where([
                'model_id' => $survey->id,
                'model_type' => get_class($this->survey)
            ])->pluck('name');

            $user = $survey->user->toArray();
            
            $survey->toArray();
            $survey = collect($survey)->union([
                'item_acara' => $item_acara_cust->toArray(),
                'user' => $user
            ]);
        }

        return view('admin.survey.show', compact('survey'));
    }

    public function updateSurvey(SurveyCustomerRequest $request)
    {
        DB::beginTransaction();

        try {
            $company = $this->company->where(function ($query) use ($request) {
                // Penyesuaian Budget
                $query->where('budget_max', '>=', $request->budget)
                        ->where('budget_min', '<=', $request->budget);
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Kota

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'city_id')
                        ->where('value', $request->city_id);
                });
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Tema

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'theme')
                        ->where('value', $request->theme);
                });
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Item Acara

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'item_acara')
                        ->whereIn('value', $request->item_acara);
                });
            })
            ->withCount(['vendorSetup as item_acara_count' => function ($query) use ($request) {
                $query->where('name', 'item_acara')
                        ->whereIn('value', $request->item_acara);
            }])
            ->where('approved', 1)
            ->orderBy('item_acara_count', 'desc');

            $company = $company->get();

            $user = Auth::user();

            $ktp = $this->photoUploaded($request->ktp_user, 'user', 0);
            $selfie = $this->photoUploaded($request->ktp_selfie, 'user', 0);
            $sk = $this->photoUploaded($request->sk_photo, 'user', 0);

             if($ktp == null){
                $ktp = $user->ktp_user;
             }

             if($selfie == null){
                $selfie = $user->ktp_selfie;
             }

             if($sk == null){
                $sk = $user->sk_photo;
             }

             User::find($user->id)->update([
                 'ktp_user' => $ktp,
                 'ktp_selfie' => $selfie,
                 'sk_photo' => $sk
             ]);
             
            if ($company->isNotEmpty()) {
                $user->selectedClient()->saveMany(
                    $company->map(function ($item) {
                        return new SelectedVendor([
                            'vendor_id' => $item->user_id
                        ]);
                    })
                );
            }

            $date = $this->rangeToSql($request->get('event_date_range'));
            // Update or Create the survey (1 person 1 survey)
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
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'model_type' => Survey::class
                ];
            }

            // Delete the event item if exist
            DB::table('event_item')->where([
                'model_id' => $survey->id,
                'model_type' => Survey::class
            ])->delete();

            // Insert again
            DB::table('event_item')->insert($array_item_acara);
            
            event(new DeleteSendOfferNotification($user));

            if ($company->isNotEmpty()) {
                event(new SendOfferNotification($user, $company));
            }

            DB::commit();

            $this->message('Sukses menyimpan survey');
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }      

        return redirect('home');
    }

    public function searchVendor(Request $request) 
    {
        try {
            $company = $this->company->with('user')->where(function ($query) use ($request) {
                // Penyesuaian Budget
                $query->where('budget_max', '>=', $request->budget)
                        ->where('budget_min', '<=', $request->budget);
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Kota

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'city_id')
                        ->where('value', $request->city_id);
                });
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Tema

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'theme')
                        ->where('value', $request->theme);
                });
            })
            ->where(function ($query) use ($request) {
                // Penyesuaian Item Acara

                $query->whereHas('vendorSetup', function ($query) use ($request) {
                    $query->where('name', 'item_acara')
                        ->whereIn('value', $request->item_acara);
                });
            })
            ->withCount(['vendorSetup as item_acara_count' => function ($query) use ($request) {
                $query->where('name', 'item_acara')
                        ->whereIn('value', $request->item_acara);
            }])
            ->orderBy('item_acara_count', 'desc')
            ->get();

            $view = view('admin.survey.search_vendor', [
                'company' => $company
            ])->render();

            $is_available = true;

        } catch (Exception $e) {
            
        }

        return [
            'is_available' => $is_available ?? false,
            'view' => $view ?? null
        ];
    }
}
