<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use Auth;
use App\Http\Requests\SurveyCustomerRequest;
use DB;

class SurveyController extends Controller
{
    use \App\Http\Controllers\Traits\TraitMessage;
    use \App\Http\Controllers\Traits\TraitDate;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
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

    public function updateSurvey(SurveyCustomerRequest $request)
    {
        $surveyClass = get_class($this->survey);
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

        $this->message('Sukses menyimpan survey');

        return redirect('home');
    }
}
