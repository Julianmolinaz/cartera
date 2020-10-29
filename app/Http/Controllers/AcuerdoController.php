<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App as _;
use Auth;
use DB;

class AcuerdoController extends Controller
{
    public function store(Request $request)
    {

        \Log::info($request->all());

        $acuerdo = new _\Acuerdo();
        $acuerdo->fill($request->all());
        $acuerdo->created_by = Auth::user()->id;
        $acuerdo->save();

        $credito = _\Acuerdo::where('credito_id', $request->credito_id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return res(true,$credito, 'Se creó el acuerdo exitosamente !!!');

    }
}
