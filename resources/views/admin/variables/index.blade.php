@section('title','variables')

@section('contenido')

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Variables del Sistema</div>
        <div class="panel-body">
          <p>
            @include('templates.error')
            @include('flash::message')
          </p>

          <form class="form-horizontal form-label-left" action="{{route('admin.variables.update', $variables)}}" method="POST" style="font-size:12px">        
           <input type="hidden" name="_method" value="PUT">

           <!-- NOMBRE**************************************************************************-->
           <h4 class for="">Rango de Meses</h4>
           <div class="form-group">

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Mínimo :</label>
              <input type="number" class="form-control" placeholder="cantidad mín de meses" id="meses_min" name="meses_min"  value="{{$variables->meses_min}}">
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Máximo : </label>
              <input type="number" class="form-control" placeholder="cantidad máx de meses" id="meses_max" name="meses_max" value="{{$variables->meses_max}}">

            </div>
          </div>  
          <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for=""><small>Valor día de mora : </small></label>
              <input type="number" class="form-control" placeholder="$ día mora" id="vlr_dia_sancion" name="vlr_dia_sancion" value="{{$variables->vlr_dia_sancion}}">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for=""><small>Vlr estudio típico : </small></label>
              <input type="number" class="form-control" placeholder="$" id="vlr_estudio_tipico" name="vlr_estudio_tipico" value="{{$variables->vlr_estudio_tipico}}">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for=""><small>Vlr estudio domicilio :</small> </label>
              <input type="number" class="form-control" placeholder="$" id="vlr_estudio_domicilio" name="vlr_estudio_domicilio" value="{{$variables->vlr_estudio_domicilio}}">
            </div>            

          </div>  

          <center>
          <!-- BOTONES **************************************************************************-->
              <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Cancelar</button></a>
              <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Editar&nbsp;&nbsp;</button>
          </center>    

          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>
      </div>
    </div>   
  </div>
  <div class="col-md-4"></div>
</div>




@endsection
@include('templates.main2')