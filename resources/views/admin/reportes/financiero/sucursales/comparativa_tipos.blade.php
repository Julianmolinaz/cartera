@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Tipo de créditos por sucursales para el año {{$year}}
        <div style="float: right;">
            <span class="label label-danger">0 - 1 Pago</span>
            <span class="label label-warning">Promedio</span>
            <span class="label label-success">Ideal</span>
        </div>
      </div> 

        <div class="panel-body">

          @foreach($quarts as $quart)
          <div class="col-md-3">

                <div style="font-size:10px;">
                  Empresa: [{{ 'cant cred:' . $quart['empresa']['num_creditos'] }}]
                </div>
                
                <div class="progress">
                
                  <div class="progress-bar progress-bar-danger" 
                      style="width: {{ $quart['empresa']['porcien_0_1_pago'] }}%">
                    <span class="sr-only"></span>{{ $quart['empresa']['porcien_0_1_pago'] }}
                  </div>
                
                  <div class="progress-bar progress-bar-warning progress-bar-striped" 
                    style="width: {{ $quart['empresa']['porcien_promedio'] }}%">
                    <span class="sr-only"></span>{{ $quart['empresa']['porcien_promedio'] }}
                  </div>

                  <div class="progress-bar progress-bar-success" 
                    style="width:  {{ $quart['empresa']['porcien_ideales'] }}%">
                    <span class="sr-only"></span>{{ $quart['empresa']['porcien_ideales'] }}
                  </div>
                </div> 

                
              @foreach($quart['data'] as $sucursal)

                <div style="font-size:10px;">
                  {{ $sucursal['sucursal']['nombre'] }} [{{ 'cant cred:' . $sucursal['info']['num_creditos'] }}][{{ '% cred trim: '. 
                  number_format($sucursal['info']['num_creditos'] * 100 / $quart['total_creditos'],1,',',',')}}]
                </div>
                
                <div class="progress">
                
                  <div class="progress-bar progress-bar-danger" style="width: {{ $sucursal['info']['porcien_0_1_pago'] }}%">
                    <span class="sr-only"></span>{{ $sucursal['info']['porcien_0_1_pago'] }}
                  </div>
                
                  <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{ $sucursal['info']['porcien_promedio'] }}%">
                    <span class="sr-only"></span>{{ $sucursal['info']['porcien_promedio'] }}
                  </div>

                  <div class="progress-bar progress-bar-success" style="width:  {{ $sucursal['info']['porcien_ideales'] }}%">
                    <span class="sr-only"></span>{{ $sucursal['info']['porcien_ideales'] }}
                  </div>
                </div>       

              @endforeach
            </div>
          @endforeach  

    
     </div>   
    </div>
  </div>
</div> 
</div>  

@endsection
@include('templates.main2')


