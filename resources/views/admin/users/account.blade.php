@extends('templates.main2')
@section('title','usuarios')

@section('contenido')

<div class="col-md-4 col-md-offset-4">
    <center>
        <dl>
            <dt>Identificador de usuario</dt>
            <dd>{{$user->id}}</dd>
        </dl>
        <dl>
            <dt>Nombre</dt>
            <dd>{{$user->name}}</dd>
        </dl>
        <dl>
            <dt>Correo / Usuario</dt>
            <dd>{{$user->email}}</dd>
        </dl>
        <dl>
            <dt>Punto</dt>
            <dd>{{$user->punto->nombre}}</dd>
        </dl>

        <dl>
            <dt>Rol</dt>
            <dd>{{$user->role->display_name}}</dd>
        </dl>
    </center>
</div>


@endsection

