@section('title','crear cliente') @section('contenido')


<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Crear Cliente</div>
                <div class="panel-body" style="z-index:100;">
                    @include('templates.error')


                    <form class="form-horizontal form-label-left" action="{{route('start.clientes.store')}}" method="POST">


                        <div class="form-group">

                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <label class="title-section">Datos personales del solicitante</label>
                                <hr class="linea">
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12 ">


                                <label class="txt-small">Primer nombre *:</label>
                                <input type="text" class="form-control" placeholder="primer nombre" id="primer_nombre" name="primer_nombre" value="{{old('primer_nombre')}}">

                            </div>


                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="txt-small">Segundo nombre :</label>
                                <input type="text" class="form-control" placeholder="segundo nombre" id="segundo_nombre" name="segundo_nombre" value="{{old('segundo_nombre')}}">
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="txt-small">Primer Apellido *:</label>
                                <input type="text" class="form-control" placeholder="primer apellido" id="primer_apellido" name="primer_apellido" value="{{old('primer_apellido')}}">
                            </div>


                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="txt-small">Segundo Apellido :</label>
                                <input type="text" class="form-control" placeholder="segundo apellido" id="segundo_apellido" name="segundo_apellido" value="{{old('segundo_apellido')}}">
                            </div>
                        </div>

                        <!-- NUM DOC -->
                        <div class="form-group">

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="txt-small">Tipo de documento *:</label>
                                <select class="form-control" id="tipo_doc" name="tipo_doc">

                                <option value="" disabled selected hidden=""></option>
                                @foreach($tipos_documento as $tipo_doc)
                                    <option value="{{$tipo_doc}}" {{ (old("tipo_doc") == $tipo_doc ? "selected":"") }}>{{$tipo_doc}}</option>
                                @endforeach
                                </select>

                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="txt-small">Documento *: </label>
                                <input type="number" class="form-control" placeholder="#" id="num_doc" name="num_doc" value="{{old('num_doc')}}">
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="txt-small">F. nacimiento *:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                            </div>

                        </div>
                        <br>
                        <label class="title-section">Datos de ubicación</label>
                        <hr class="linea">

                        <!-- DIRECCION -->
                        <div class="form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Dirección *:</label>
                                <input type="text" class="form-control" placeholder="dirección" id="direccion" name="direccion" value="{{old('direccion')}}">
                            </div>

                            <!-- BARRIO **************************************************************************-->
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Barrio/Vereda  *: </label>
                                <input type="text" class="form-control" placeholder="ingrese barrio" id="barrio" name="barrio" value="{{old('barrio')}}">

                            </div>

                            <!-- MUNICIIPIO **************************************************************************-->
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Municipio *:</label>
                                <input type="text" class="form-control" placeholder="ingrese municipio" id="municipio" value="{{old('municipio')}}">
                                <div id="list_mun" 
                                    style="margin:0px;padding:0px;line-height:0;float:left;z-index:900;position:absolute;">
                                    <ul style="padding:0px;"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- MOVIL **************************************************************************-->
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Celular *:</label>
                                <input type="tel" class="form-control" placeholder="ingrese # celular" id="movil" name="movil" value="{{old('movil')}}">
                            </div>
                            <!-- FIJO **************************************************************************-->
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Telefono : </label>
                                <input type="tel" class="form-control" placeholder="ingrese # teléfono" id="fijo" name="fijo" value="{{old('fijo')}}">
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Email :</label>
                                <input type="email" class="form-control" placeholder="correo electrónico" id="email" name="email" value="{{old('email')}}" size="60">
                            </div>
                        </div>

                        <br>

                        <label class="title-section">Datos laborales</label>
                        <hr class="linea">

                        <!-- OCUPACION **************************************************************************-->

                        <div class="form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Ocupación *:</label>
                                <input type="text-small" class="form-control" placeholder="ocupación" id="ocupacion" name="ocupacion" value="{{old('ocupacion')}}">
                            </div>

                            <!-- TIPO DE ACTIVIDAD *****************************************************-->
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Tipo de actividad *: </label>
                                <select class="form-control" name="tipo_actividad" id="tipo_actividad">
                                <option value="" disabled selected hidden="">- -</option>
                                    @foreach($tipo_actividades as $tipo_actividad)
                                        <option value="{{$tipo_actividad}}" {{ (old("tipo_actividad") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small ">Nombre empresa :</label>
                                <input type="text" class="form-control" placeholder="ingrese empresa" id="empresa" name="empresa" value="{{old('empresa')}}">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <label class="txt-small">Teléfono empresa :</label>
                                <input type="text" class="form-control" placeholder="ingrese teléfono empresa" id="tel_empresa" name="tel_empresa" value="{{old('tel_empresa')}}">
                            </div>

                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <label class="txt-small">Dirección empresa :</label>
                                <input type="text" class="form-control" placeholder="ingrese dirección empresa" id="dir_empresa" name="dir_empresa" value="{{old('dir_empresa')}}">
                            </div>
                        </div>

                        <br>

                        <label class="title-section">Otros</label>
                        <hr class="linea">

                        <!-- PLACA VEHIUCLO **************************************************************************-->
                        <div class="form-group">

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="txt-small">Placa :</label>
                                <input type="text" class="form-control" placeholder="placa" id="placa" name="placa" value="{{old('placa')}}">
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="txt-small">F. vencimiento SOAT :</label>
                                <input type="date" class="form-control" id="soat" name="soat" value="{{old('soat')}}">
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="municipio_id" id="municipio_id" value="{{old('municipio_id')}}">
                        <br>

                        <center>
                            <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
                            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
                        </center>

                </div>
            </div>
        </div>


        </form>

    </div>


    <script>
        var municipios = '';
        var encontrados = [];
        var mun = {};

        $.get('/municipios/index', (res) => {
            if (res.success) {
                municipios = res.dat;
            } else {
                alert(res.error);
            }
        });

        $('#municipio').keyup(function() {
            var str = $('#municipio').val();
            var html = '';
            remove();
            encontrados = [];

            console.log('stra: ',str);
 
            console.log('html: ',html);
            

            encontrados = municipios.filter(municipio => {
                return municipio.nombre.toLowerCase().indexOf(str.toLowerCase()) > -1;
            })

            if (encontrados && str.length ) {
                encontrados.forEach(function(encontrado) {
                    html += '<li style="list-style:none;">'+
                      '<a href="javascript:void(0);" onclick="return addMunicipio('+encontrado.id+');" class="btn btn-default btn-md">' + 
                            encontrado.nombre +'-'+encontrado.departamento+'</a></li>';
                })
            }
            
            $('#list_mun ul').append(html);

        });

        var remove = function() {
            $('#list_mun').find('li').remove();
        }

        function addMunicipio(id){
            var mun = municipios.find( function(municipio){
                return municipio.id == id;
            })

            if(mun){
                $('#municipio').val(mun.nombre+'-'+mun.departamento);
                $('#municipio_id').val(mun.id);
                remove();
            }
        }
    </script>

    @endsection @include('templates.main2')