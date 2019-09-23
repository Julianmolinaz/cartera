@section('title','crear negocio')


@section('contenido')


<div class="row" id="negocio-template">

  <div class="col-md-2 col-sm-2 ">
  </div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading" v-if="status == 'crear'">Crear Negocio</div>
      <div class="panel-heading" v-if="status == 'editar'">Editar Negocio</div>
      <div class="panel-body">

       
        <div  class="form-horizontal form-label-left">        

          <!-- NOMBRE**************************************************************************-->
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input    type="text" 
                        class="form-control" 
                        placeholder="ingrese nombre"
                        v-model="negocio.nombre">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="">Descripción</label>
                <textarea cols="30" rows="10" class="form-control"
                    v-model="negocio.descripcion"></textarea>
            </div>
        </div>
         
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="">Carteras</label>
                <select class="form-control" @change="addCartera()" v-model="carteraToAdd">
                    <option disabled selected>- -</option>
                    <option v-for="cartera in carteras" :value="cartera">@{{ cartera.nombre }}</option>
                </select>
            </div>
        </div>
         <!-- BOTONES **************************************************************************-->

        <div class="form-group">
            <center>    
                <a href="{{route('admin.negocios.index')}}">
                    <button type="button" class="btn btn-primary">Cancelar</button></a>
                    <button type="submit" class="btn btn-danger" @click="onSubmit">
                        <span v-if="status=='crear'">Crear</span>
                        <span v-if="status=='editar'">Guardar Cambios</span>
                    </button>
            </center>

        </div>

      </div>
      </div>
    </div>
    </div>      
    <div class="col-md-4 col-sm-4 ">
        <div class="panel panel-primary">
            <div class="panel-heading">Carteras</div>
            <div class="panel-body">
                <ul v-if="negocio.carteras" class="list">
                    <li v-for="(cartera, index) in negocio.carteras" class="item">
                        <a href="javascript:void(0);" @click="eliminarCartera(index)">
                            <i class="far fa-window-close ico" ></i>
                        </a>
                        @{{ cartera.nombre }}</li>
                </ul>
            </div>
        </div>
    </div>
  </div>  
  <div class="col-md-2 col-sm-2 ">

  </div>
</div>  

<script>

    var negocio_component = new Vue({
        el : "#negocio-template",
        data : {
            nombre : 'negocio-component',
            status : {!! json_encode($status) !!},
            carteras : {!! json_encode($carteras) !!},
            carteraToAdd : [],
            negocio : {!! json_encode($negocio) !!}
        },
        methods : {
            addCartera(){
                if(this.negocio.carteras.find(cartera => {
                    return cartera.id == this.carteraToAdd.id
                })){
                    alert('La cartera ya se adicionó');
                } else {
                    this.negocio.carteras.push(this.carteraToAdd) 
                }
            },
            onSubmit(){
                var self = this
                if(this.status == 'crear'){
                    this.create()
                } 
                else if(this.status == 'editar'){
                    this.editar()
                }
            },
            create(){
                axios.post('/admin/negocios', this.negocio )
                    .then( res => {
                        alert(res.data.message)
                        if(res.data.success){
                            document.location.href= "{{url('admin/negocios')}}";
                        } else {
                            console.log(res.data.error)
                        }
                    })
            },
            editar(){
                axios.put('/admin/negocios/'+this.negocio.id, this.negocio )
                    .then( res => {
                        alert(res.data.message)
                        if(res.data.success){
                            document.location.href= "{{url('admin/negocios')}}";
                        } else {
                            console.log(res.data.error)
                        }
                    })
            },
            eliminarCartera(index){
                this.carteraToAdd = ''
                this.negocio.carteras.splice(index, 1);
            }
        }
    });

</script>
<style scope>
    .list {
        list-style : none;
    }
    .ico {
        margin-right: 10px;
        color:red;
    }
    .item {
        margin: 0px 0px 0px -33px;
    }
</style>
@endsection
@include('templates.main2')