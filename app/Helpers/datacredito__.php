<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\FechaCobro;
use App\OtrosPagos;
use App\Variable;
use App\Factura;
use App\Credito;
use App\Llamada;
use App\Cliente;
use App\Cartera;
use App\Sancion;
use App\Egreso;
use App\Punto;
use App\Extra;
use App\User;
use App\Pago;

use Carbon\Carbon;
use Excel;
use Auth;
use DB;

