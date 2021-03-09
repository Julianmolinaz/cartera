<?php

namespace App\Repositories\Contabilidad;

class ReporteContableRepository
{
   public function getStruct() 
    {
        $arr = [];

        $header = [
            'fecha',
            'documento',
            'referencia',
            'monto',
            'entidad'
        ];

        $datos_prueba = [
            '2020-09-15',
            '9860668',
            '425689',
            '45000',
            'apostar'
        ];
       
        $arr[] = $header;
        $arr[] = $datos_prueba; 

        Excel::create('reporte_contable'.strtotime(Carbon::now()),function($excel) use ($arr){
            
            $excel->sheet('Sheetname',function($sheet) use ($arr){       
                
            $sheet->fromArray($arr,null,'A1',false,false);
            });
        })->download('xls');
    }
}