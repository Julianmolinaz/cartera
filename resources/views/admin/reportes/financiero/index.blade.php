@section('title','Reportes')
@section('contenido')

  <div class="col-md-6 col-md-offset-3">
  
    <div class="panel panel-default">
      <div class="panel-body" id="panel">
     
        <div class="row">
          <div class="col-md-12">
            <center>
              <button type="button" class="btn btn-default" aria-label="Left Align" 
                @click="general">
                <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
                General
              </button> 
              <button type="button" class="btn btn-default" aria-label="Left Align"
               @click="sucursales()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                Sucursales
              </button> 
              <button type="button" class="btn btn-default" aria-label="Left Align"
                @click="comparativa_anual()">
                <span class="glyphicon glyphicon-indent-left" aria-hidden="true"></span>
                Comparativa anual
              </button> 
            </center>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-6 col-md-offset-3" id="range">
             <center>
              <h4 v-text="reporte" style="margin-top:-2px;"></h5>

              <div v-show="range">
                <input type="text" name="daterange" id="daterange" class="form-control" value="" />  
                <small class="text-muted">Seleccione un rango de fecha.</small> 
              </div>

              <div v-show="anios">
                
                <select name="" id="" class="form-control" v-model="repo.anio">
                    <option selected disabled></option>
                  @foreach($anios as $anio)
                    <option :value="{{ $anio }}">{{ $anio }}</option>
                  @endforeach
                </select>
                <small class="text-muted">Seleccione un año.</small> 
              </div>

              <div v-show="list_sucursales">
                <br>
                <select name="" id="" class="form-control" v-model="repo.sucursal_id">
                    <option selected disabled></option>
                    <option :value="-1">Todas</option>
                  @foreach($sucursales as $sucursal)
                    <option :value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                  @endforeach
                </select>
                <small class="text-muted">Seleccione una sucursal.</small> 
              </div>
            </center>
            <center v-if="btn_consultar" @click="consultar">
              <button type="button" class="btn btn-primary btn-lg">Consultar</button>
            </center>
          </div>
        </div> 

        
      </div>
    </div>
  
  </div>

<script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      locale: { format: 'DD-MM-YYYY' }
    });
  });


  var panel = new Vue({
    el:"#panel",
    data: {
      repo:{
        anio      : '',
        daterange : '',
        sucursal_id  : '',
      },
      range : false,
      reporte : '',
      list_sucursales: false,
      anios : false,
      btn_consultar : false
    },
    methods:{
      general(){
        this.reset()
        this.reporte = 'General'
        this.range = true
        this.btn_consultar  = true
      },
      sucursales(){
        this.reset()
        this.reporte = 'Sucursales'
        this.range = true
        this.list_sucursales = true
        this.btn_consultar  = true
      },
      comparativa_anual(){
        this.reset()
        this.reporte = 'Comparativa anual'
        this.anios = true
        this.btn_consultar  = true
      }, 
      reset(){
        this.repo.daterange  = ''
        this.repo.anio       = '' 
        this.repo.sucursal   = ''
        this.reporte         = ''
        this.range           = false
        this.list_sucursales = false
        this.anios           = false
      },
      consultar()
      {
        if(this.reporte == 'General'){

          this.repo.daterange = $('#daterange').val()
          window.open("{{url('repor-financiero/general')}}/"+this.repo.daterange, '_blank');
    
        }
        else if(this.reporte == 'Sucursales'){
        
          this.repo.daterange = $('#daterange').val()
          if(this.repo.sucursalid)
            window.open("{{url('repor-financiero/sucursales')}}/"+this.repo.daterange+'/'+this.repo.sucursal_id, '_blank');
        
        }
        else if(this.reporte == 'Comparativa anual'){
          if(this.repo.anio){
            window.open("{{url('repor-financiero/comparativo-anual')}}/"+this.repo.anio, '_blank');
          }
        }
      }
    },
  });

</script>



@endsection
@include('templates.main2')