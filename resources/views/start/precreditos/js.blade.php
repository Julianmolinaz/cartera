<script>

  var crear_credito = new Vue({
    el: '#crear_credito',
    data: {
      precredito_id : {!! $precredito->id !!},
      mes   : '',
      anio  : '',
      anios  : {!! json_encode($anios) !!}
    },
    methods:{
      setMes(precredito_id){
        this.precredito_id = precredito_id
        $('#mes').modal('show')
      },
      crearCredito(){
        if(this.mes && this.anio) {
          var route = '/start/creditos/create/'+this.precredito_id+'/'+this.mes+'/'+this.anio;

          $('#mes').modal('toggle')
          window.open(route, "_self")
        } else {
          alert('Seleccione un año y un mes por favor ...')
        }
      }
    },
    created(){
      // $('#mes').modal('show')
    }
  })

  const element = new Vue({
    el:  '#element',
    methods: {
      print(factura_id){
      	var self = this
        var route = "{{ url('start/precredito-invoice-print') }}/" + factura_id
        axios.get(route).then(function(res){
        	self.print_html(res.data)
        })
      },//.print
      print_html(str){
				var printed = window.open('','Print-Window');
				printed.document.write(str);
				printed.document.close();
				printed.print();
				printed.close();
      }//.print_html
    }
  });
</script>