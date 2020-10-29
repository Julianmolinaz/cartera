<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App as _;
use Auth;
use DB;

class AcuerdoController extends Controller
{

    protected function acuerdosPorCredito($credito_id)
    {
        $acuerdos = _\Acuerdo::where('credito_id', $credito_id)->get();
        $acuerdos->map(function($acuerdo){
            $acuerdo->creator;
            $acuerdo->updator;
        });

        return $acuerdos;
    }

    public function listAcuerdos($credito_id)
    {
        $acuerdos = $this->acuerdosPorCredito($credito_id);

        return response()->json($acuerdos);
    }

    public function store(Request $request)
    {
        $acuerdo = new _\Acuerdo();
        $acuerdo->fill($request->all());
        $acuerdo->created_by = Auth::user()->id;
        $acuerdo->save();

        $acuerdos = $this->acuerdosPorCredito($acuerdo->credito_id);

        return res(true,$acuerdos, 'Se creó el acuerdo exitosamente !!!');

    }

    public function update(Request $request, $acuerdo_id)
    {
        $acuerdo = _\Acuerdo::find($acuerdo_id);
        $acuerdo->fill($request->all());

        if (!$acuerdo->isDirty()){
            return res(false, '', 'No se realizaron cambios en el acuerdo');
        }

        $acuerdo->updated_by = Auth::user()->id;
        $acuerdo->save();

        $acuerdos = $this->acuerdosPorCredito($acuerdo->credito_id);

        return res(true,$acuerdos,'');

    }
}
