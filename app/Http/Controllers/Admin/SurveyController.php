<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function index()
    {
        $tema = ['Nasional', 'Adat Bali',' Adat Jawa', 'Adat Bugis', 'Adat Dayak', 'Lainnya'];
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
            'Dokumentasi Elektone',
            'Elektone',
            'Band',
            'MC',
        ];

        return view('admin.survey.index', compact('tema','item_acara'));
    }
}
