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

        class Role {
            constructor() {
                this.display_name        = '';
                this.description = '';
            }
        }

  
        const permisos_component = new Vue({
            el: '#permisos_template',
            data: {
                categorias  : {!! json_encode($categorias) !!},
                roles       : {!! json_encode($roles) !!},
                role        : new Role(),
                estatus     : 'crear',
                errors      : '',
                select_todo : false
            },
            methods: {
                crearRol() {

                },
                async onSubmit() {
                    this.errors = ''
                    var self = this
                    var res = ''

                    if (this.estatus == 'crear') this.store()
                    else this.update();
                },
                async store() {

                    alertify.set('notifier','position', 'top-right');
                    var self = this
                    const res = await axios.post('/admin/roles', {
                        categorias : this.categorias,
                        role       : this.role
                    })

                    console.log({res});

                    if (!res.data.error) {   
                        alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });

                        this.reset()
                        this.getRoles()
                    } else {
                        alertify.notify(res.data.message, 'error', 5, function(){  console.log(''); });

                        if (res.data.dat) {
                            this.errors = res.data.dat
                        }
                    }
                },
                async update() {

                    var self = this
                    const res = await axios.put('/admin/roles/'+this.role.id, {
                        categorias : this.categorias,
                        role       : this.role
                    })

                    console.log({res});

                    if (!res.data.error) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });

                        this.reset()
                        this.getRoles()
                    } else {

                        alertify.set('notifier','position', 'top-right');
                        alertify.notify(res.data.message, 'error', 5, function(){  console.log(''); });

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
                    this.estatus = 'crear';
                    this.role = new Role();
                    this.errors = '';
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
                showAll() {

                    this.select_todo = ! this.select_todo

                    for (let i = 0; i < this.categorias.length; i++) {
                        this.categorias[i].selected = this.select_todo
                        
                        for (let j = 0; j < this.categorias[i].permisos.length; j++) {
                            
                            this.categorias[i].permisos[j].selected = this.select_todo
                        }
                    }
                },
                selectPorItem(categoria) {

                    console.log({categoria})

                    for (let i = 0; i < this.categorias.length; i++) {
                        console.log(this.categorias[i].category);
                        if (this.categorias[i].category == categoria) {

                  

                            for (let j = 0; j < this.categorias[i].permisos.length; j++) {

                                this.categorias[i].permisos[j].selected = this.categorias[i].selected
                            }
                        } 
                    }
                },
                async getPermisosRol(item) {
                    var res = await axios.get('/admin/roles/show/'+item.id);

                    if (!res.data.error) {
                        this.role       = res.data.dat.role;
                        this.categorias = res.data.dat.categorias;
                        this.estatus    = 'editar';
                    }

                    console.log({res});
                }
            },
            created() {
                //
            }
        });
    </script>


@endsection









