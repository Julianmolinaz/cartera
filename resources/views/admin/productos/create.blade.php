@extends('templates.main2')

@section('title','crear producto')

@section('contenido')

  <div class="col-md-2 col-sm-2"></div>

  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Crear Producto</div>
      <div class="panel-body">

        @include('templates.error')
        @include('flash::message')

        <form class="form-horizontal form-label-left" action="{{route('admin.productos.store')}}" method="POST">        

            <div class="col-md-12" style="padding:0;">
                <!-- NOMBRE -->
                <div class="form-group">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <label for="">Nombre *:</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="ingrese nombre del producto"
                            id="nombre"
                            name="nombre"
                            value="{{old('nombre')}}"
                        >
                    </div>  
                    <div class="col-md-4">
                        <label for="estado">Estado *</label>
                        <select 
                            name="estado"
                            id="estado"
                            class="form-control"
                        >
                        @foreach($insumos['estados'] as $estado)
                            <option
                                value="{{$estado['code']}}" 
                                {{$estado['code'] === 1 ? 'selected' : ''}}
                            >{{$estado['label']}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="padding:0;">
                <div class="form-group">
                    <div class="col-md-3">
                        <label style="display: block;">Requiere vehículo</label>
                        <input 
                            type="checkbox" 
                            value="1"
                            name="con_vehiculo"
                            style="margin: 10px auto"
                            {{ old('con_vehiculo') ? 'checked' : '' }}
                        >
                    </div>
                    <div class="col-md-3">
                        <label style="display: block;">Requiere facturación</label>
                        <input 
                            type="checkbox"
                            value="1"
                            name="con_invoice"
                            style="margin: 10px auto"
                            {{ old('con_invoice') ? 'checked' : '' }}
                        >
                    </div>
                </div>
            </div>
            <!-- DESCRIPCION -->  
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Descripción :</label>
                    <textarea 
                        class="form-control"
                        rows="3"
                        id="descripción"
                        name="descripcion"
                        placeholder='Escriba la descripción del producto' 
                        autocomplete="off"  
                        value="{{old('descripcion')}}"
                    ></textarea>
                </div>
            </div>

            <!-- BOTONES -->
            <center>
                <a 
                    href="{{route('admin.productos.index')}}"
                    class="btn btn-default"
                >Cancelar</a>
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </center>   


            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>

      </div>
    </div>
  </div>      



@endsection
