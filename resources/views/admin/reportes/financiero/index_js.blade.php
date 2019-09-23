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
        this.repo.sucursal_id= ''
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
          if(this.repo.sucursal_id)
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
