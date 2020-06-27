@extends('templates.main2')

@section('title','permisos')
@section('contenido')

<div class="row" id="permisos_template">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-primary">


            <div class="panel-heading">
                <p><h4><i class="fa fa-user" style="margin-right:10px;"></i> Roles y Permisos de Usuario</h4></p>
            </div>
            
            <div class="panel-body" style="margin:2px 10px">

                <div class="row">
                    <div class="alert alert-danger" role="alert" style="margin:2 10px" v-if="errors">
                        <ul  v-for="error in errors">
                            <li>
                                @{{ error[0] }}
                            </li>
                        </ul>

                    </div>
                
                </div>

                <div class="row" style="padding: 10px 40px">

                    <div class="col-md-6">
                        @include('admin.roles.componentes.gestionar')
                    </div>
                    <div class="col-md-6">
                        @include('admin.roles.componentes.listar')
                    </div>

                </div><!-- .row  -->


            </div><!-- .panel-body   -->

        </div>
    </div>
</div>


    <script>
  
        const permisos_component = new Vue({
            el: '#permisos_template',
            data: {
                categorias  : {!! json_encode($categorias) !!},
                roles       : {!! json_encode($roles) !!},
                name        : '',
                descripcion : '',
                errors      : '',
                select_todo : true
            },
            methods: {
                async onSubmit() {
                    this.errors = ''
                    
                    const res = await axios.post('/admin/roles', {
                        categorias : this.categorias,
                        name       : this.name,
                        descripcion : this.descripcion
                    })

                    alert(res.data.message)

                    if (res.data.success) {
                        this.reset()
                        this.getRoles()
                    } else {
                        if (res.data.dat) {
                            this.errors = res.data.dat
                        }
                    }
                },
                async getRoles() {
                    let res = await axios.get('/admin/roles');

                    if (res.data.success) {
                        this.roles = res.data.dat
                    } else {
                        alert(res.data.message)
                    }
                },
                reset() {
                    this.name        = ''
                    this.descripcion = ''
                    this.errors      = '' 
                    this.resetPermisos()               
                },
                async resetPermisos() {
                    let res = await axios.get('/admin/categorias_con_permisos');

                    if (res.data.success) {
                        this.categorias = res.data.dat
                    } else {
                        alert(res.data.message)
                    }
                },
                show_all() {

                    console.log('show_all');

                    this.select_todo = ! this.select_todo

                    for (let i = 0; i < this.categorias.length; i++) {
                        console.log(i)

                        for (let j = 0; j < this.categorias[i].permisos.length; j++) {
                            this.categorias[i].permisos[j].selected = false
                            // this.cateorias[i].permisos[j].selected = true
                        }
                    }
                }
            },
            created() {
                //
            }
        });
    </script>


@endsection









