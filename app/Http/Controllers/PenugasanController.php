<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Periode;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function index()
    {
        $data    = Penugasan::all();
        $periode = Periode::join('penugasans', 'periodes.id', '=', 'penugasans.periode_id')
            ->where('semester', 1)
            ->get();
        return view('penugasan.index', compact('data', 'periode'));
    }

}
