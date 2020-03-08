<script>

  Vue.config.devtools = true

  class Solicitud {
    constructor(){
      this.id             = '',
      this.num_fact       = '',
      this.fecha          = '',
      this.cartera_id     = '',
      this.funcionario_id = '',
      this.cliente_id     = '', 
      this.producto_id    = '',
      this.productos      = '',
      this.vlr_fin        = '',
      this.periodo        = '',
      this.meses          = '',
      this.cuotas         = '',
      this.vlr_cuota      = '', 
      this.p_fecha        = '',
      this.s_fecha        = '',
      this.estudio        = '',
      this.cobro_estudio  = '',
      this.cuota_inicial  = '', 
      this.aprobado       = '',
      this.observaciones  = ''
    }
  }

  class Producto {
    constructor(ref, nombre){
      this.referencia   = ref,
      this.nombre       = nombre,
      this.proveedor_id = '',
      this.num_factura  = '',
      this.fecha_exp    = '',
      this.costo        = '',
      this.iva          = ''
    }
  }


  const obligacion = new Vue({
    el: "#obligacion",
    data: {
      carteras    : {!! json_encode($carteras) !!},
      productos   : {!! json_encode($productos) !!},
      estado      : {!! json_encode($estado) !!},
      estados_aprobacion: {!! json_encode($estados_aprobacion) !!},
      arr_productos : [],
      solicitud   : new Solicitud(),
      temp        : '',
      arr_estudios: {!! json_encode($arr_estudios) !!},  
      arr_periodos: {!! json_encode($arr_periodos) !!},

    },
    methods: {
      generarInputs(){

        this.solicitud.producto_id = this.temp.id;
        this.arr_productos = [];

        switch (this.temp.id) {
          case 1:
            this.arr_productos.push(new Producto(this.temp.id,this.temp.nombre));
            console.log(this.arr_productos);
            break;
          case 2:
            this.arr_productos.push(new Producto(this.temp.id,this.temp.nombre));
            console.log(this.arr_productos);
            break;
          case 3:
            this.arr_productos.push(new Producto(this.temp.id,'SOAT'));
            this.arr_productos.push(new Producto(this.temp.id,'RTM'));
            console.log(this.arr_productos);
            break;
          default:
            console.log(this.solicitud.producto_id);
            break;
        }
      },
      changePeriodo(){
        if (this.solicitud.meses){
          var factor_periodo = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;
          this.solicitud.cuotas = this.solicitud.meses * factor_periodo;
        }
      },
      changeMeses(){
        if (this.solicitud.periodo){
          var factor_periodo = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;
          this.solicitud.cuotas = this.solicitud.meses * factor_periodo;
        } else {
          alert('Se requiere el periodo');
        }
      }
    },
    created(){

      if (this.estado == 'creacion') {
        this.solicitud.aprobado = 'En estudio';
      }
      console.log(this.carteras);
      console.log('producto',this.producto);
      console.log(this.estado);
      console.log(this.solicitud);
    }
  });

</script>
