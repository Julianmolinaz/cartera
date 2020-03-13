@section('title','Solicitud')

@section('contenido')


<div class="row" id="obligacion">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <span v-if="estado=='creacion'" v-text="'Crear Solicitud de Crédito'"></span>
        <span v-if="estado=='edicion_solicitud'" v-text="'Editar Solicitud de Crédito' + solicitud.id"></span>
        <span v-if="estado=='edicion_credito'" v-text="'Editar Crédito '+credito.id"></span>
        <small>-- {{$cliente->nombre.' -- '.$cliente->num_doc}}</small>
        <a href="{{ route('start.precreditos.edit',$precredito->id) }}" class="btn btn-default btn-sm" style="float:right; margin-top:-4px;">Refrescar</a>
      </div>
      <div class="panel-body">
        <form class="form-horizontal form-label-left" v-on:submit.prevent="onSubmit()">

          <div class="row">

            <!-- INFORMACION INICIAL Y DE PRODUCTOS -->

            <div class="col-md-6">
              @include('start.precreditos.componentes.info_inicial')
            </div>

            <!-- CONDICIONES DEL NEGOCIO  -->

            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  @include('start.precreditos.componentes.condiciones')
                </div>
                <div class="col-md-12" v-if="estado=='edicion_credito'">
                  @include('start.precreditos.componentes.info_credito')
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6 col-md-offset-3">

                <center>
                <a href="javascript:window.history.back();"><button type="button" class="btn btn-default">Volver</button></a>

                  <button type="submit" class="btn btn-primary">
                    Guardar Solicitud
                  </button>

                </center>

              </div>
            </div>

          </div>

        </form>
      </div>
      </div>  
  </div>
</div>

@include('start.precreditos.componentes.create_js')

@endsection

@include('templates.main2')
