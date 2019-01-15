<script>
  
  Vue.component('list_pagos_generados-component',{
    template: `
      <div class="panel panel-warning">
        <!-- Default panel contents -->
        <div class="panel-heading" style="background-color: #FFC300;color:black;">
          <h3 class="panel-title"><i class="fas fa-shopping-cart"></i> Pagos generados</h3>
        </div>
        <div class="panel-body" style="padding:5px;">
          <table id="tabla" class="table table-striped" >
                <thead>
                  <tr>
                    <th>  Cant        </th>
                    <th>  Concepto    </th>
                    <th>  Subtotal    </th>
                    <th>  Acción      </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(pago,index) in factura.pagos">
                     <td class="td-small">1</td>
                     <td class="td-small">@{{ pago[0].concepto.nombre }}</td>
                     <td class="td-small">@{{ pago[0].subtotal }}</td>
                     <td class="td-small">
                     <a href="#" class="btn btn-default btn-xs" @click="borrar_pago(index)">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                     </a>
                     </td>
                  </tr>
                  <tr v-if="factura.total">
                    <td></td>
                    <td>TOTAL: </td>
                    <td>@{{ factura.total }}</td>
                  </tr>
               </tbody>
            </table>

             <!-- BOTON ACEPTAR -->
             <center>
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">

              {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning '],$secure = null) !!}
              <a href="#" class="btn btn-danger" @click="borrar_todos_los_pagos">Borrar</a>
              <a href="#" class="btn btn-primary" @click="aceptar">Aceptar</a>
            
              </div>
             </center>
  

        </div>

      </div>
    `,
    data(){
      return {
        factura: ''
      }
    },
    methods:{
      borrar_pago(index){
        this.sub_total(index)
        this.factura.pagos.splice(index,1)
      },
      get_total(){
        this.factura.total = 0
        for (var i = 0; i < this.factura.pagos.length; i++) {
          this.factura.total += parseInt(this.factura.pagos[i][0].subtotal)
        }
      },
      sub_total(index){
        this.factura.total = this.factura.total - 
                             this.factura.pagos[index][0].subtotal;
      },
      borrar_todos_los_pagos(){
        this.factura.pagos = []
        this.factura.total = 0
      },
      aceptar(){
        var route = "/start/fact_precreditos";
        axios.post(route, {factura: this.factura}).then(
          function(res){
            console.log('guardar',res)
          })
      }
    },
    created(){
      var self = this;
      Bus.$on('add_pago', function(factura){
        self.factura = factura
        self.get_total()
      })
    }
  });
    

</script>

