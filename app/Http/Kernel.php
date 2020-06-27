<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [

        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,

        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin' =>\App\Http\Middleware\AdminMiddleware::class,
        'asesor' =>\App\Http\Middleware\AsesorMiddleware::class,
        'recaudador' => \App\Http\Middleware\RecaudadorMiddleware::class,
        'call' => \App\Http\Middleware\CallMiddleware::class,
        'callvip' => \App\Http\Middleware\CallVipMiddleware::class,
        'simulador' => \App\Http\Middleware\SimuladorMiddleware::class,

        // //CLIENTES

        // 'clientes_listar'   => \App\Http\Middleware\Clientes_listarMiddleware::class,
        // 'clientes_crear'    => \App\Http\Middleware\Clientes_crearMiddleware::class,
        // 'clientes_guardar'  => \App\Http\Middleware\Clientes_guardarMiddleware::class,
        // 'clientes_ver'      => \App\Http\Middleware\Clientes_verMiddleware::class,
        // 'clientes_actualizar'=> \App\Http\Middleware\Clientes_actualizarMiddleware::class,
        // 'clientes_editar'   => \App\Http\Middleware\Clientes_editarMiddleware::class,
        // 'clientes_borrar'   => \App\Http\Middleware\Clientes_borrarMiddleware::class,


        // //ESTUDIOS

        // 'estudios_crear'    => \App\Http\Middleware\Estudios_crearMiddleware::class,
        // 'estudios_guardar'  => \App\Http\Middleware\Estudios_guardarMiddleware::class,
        // 'estudios_actualizar'=> \App\Http\Middleware\Estudios_actualizarMiddleware::class,        

        // //CREDITOS

        // 'creditos_listar'   => \App\Http\Middleware\Creditos_listarMiddleware::class,
        // 'creditos_editar'   => \App\Http\Middleware\Creditos_editarMiddleware::class,
        // 'creditos_crear'    => \App\Http\Middleware\Creditos_crearMiddleware::class,
        // 'creditos_actualizar'=> \App\Http\Middleware\Creditos_actualizarMiddleware::class,

        // //FACTURAS

        // 'facturas_listar'   => \App\Http\Middleware\Facturas_listarMiddleware::class,
        // 'facturas_ver'      => \App\Http\Middleware\Facturas_verMiddleware::class,
        // 'facturas_crear'    => \App\Http\Middleware\Facturas_crearMiddleware::class,
        // 'facturas_guardar'  => \App\Http\Middleware\Facturas_guardarMiddleware::class,

        // //CALLCENTER

        // 'call_crear'        => \App\Http\Middleware\Call_crearMiddleware::class,   

        // //PAGOS

        // 'pagos_listar'      =>  \App\Http\Middleware\Pagos_listarMiddleware::class,   

        // //PRECREDITOS

        // 'precreditos_listar'=>  \App\Http\Middleware\Precreditos_listarMiddleware::class,
        // 'precreditos_ver'   =>  \App\Http\Middleware\Precreditos_verMiddleware::class,
        // 'precreditos_editar'=>  \App\Http\Middleware\Precreditos_editarMiddleware::class, 
        // 'precreditos_crear'=>  \App\Http\Middleware\Precreditos_crearMiddleware::class,         

        // //OTROS INGRESOS

        // 'otros_ingresos_listar'=> \App\Http\Middleware\OtrosIngresos_listarMiddleware::class,
        // 'otros_ingresos_crear' => \App\Http\Middleware\OtrosIngresos_crearMiddleware::class, 

        // //EGRESOS

        // 'egresos_listar'        => \App\Http\Middleware\Egresos_listarMiddleware::class,         
        // 'egresos_crear'         => \App\Http\Middleware\Egresos_crearMiddleware::class,
        // 'egresos_editar'        => \App\Http\Middleware\Egresos_editarMiddleware::class,
        // 'egresos_eliminar'      => \App\Http\Middleware\Egresos_eliminarMiddleware::class,

        // //REPORTES

        // 'reporte_listar'        => \App\Http\Middleware\ReporteListMiddleware::class,
        // 'reporte_generate'      => \App\Http\Middleware\ReporteGenerateMiddleware::class,

        // //REFINANCIACION

        // 'refinanciacion'        => \App\Http\Middleware\RefinanciacionMiddleware::class
    ];
}
