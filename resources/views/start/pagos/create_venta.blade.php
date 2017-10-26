@section('title','crear factura')

@section('contenido')


    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <!--panel generador de pagos-->
<!--**********************************************************************-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Generador de pagos</h3>
          </div>
          <div class="panel-body">
          @include('templates.error')
          <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
            <strong id="error"></strong>
          </div>

            <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->  
            
            <form class="form-horizontal form-label-left" action="" method="POST" style="font-size:10px"> 

              <div class="form-group">
               <!-- num_factura *****-->   
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label># Factura:</label>
                  <input class="form-control input-sm" type="text" id="num_factura" placeholder="#">
                </div>

                 <!-- fecha_factura *****-->   
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label>Fecha:</label>
                  <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_factura">
                 </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label for="">Cartera</label>
                  <select class="form-control input-sm" id="cartera">
                  <option value="" readonly selected hidden="">- -</option>
                    @foreach($carteras as $cartera)
                      <option value="{{$cartera->id}}">{{$cartera->nombre}}</option>
                    @endforeach                     
                  </select>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label for="">Tipo de Pago</label>
                  <select class="form-control input-sm" id="tipo">
                  <option value="" readonly selected hidden="">- -</option>
                    @foreach($tipos_pago as $tipo)
                      <option value="{{$tipo}}">{{$tipo}}</option>
                    @endforeach                     
                  </select>
                </div>
              </div>  

                 <!-- documento *****-->   
              <div class="form-group">

                <div class="col-md-4 col-sm-4 col-xs-12" >
                  <label for="">Concepto:</label>
                  <input type="text" class="form-control input-sm" placeholder="concepto" name="concepto" id="concepto" required>
                </div>

               <!-- monto *****-->
                <div class="col-md-4 col-sm-4 col-xs-12" >
                  <label for="">Valor Unitario:</label>
                  <input type="number" class="form-control input-sm" placeholder="$" name="valor" id="valor" required>
                </div>

               <!-- cantidad *****-->
                <div class="col-md-4 col-sm-4 col-xs-12" >
                  <label for="">Cantidad:</label>
                  <input type="number" class="form-control input-sm" placeholder="cant" name="cantidad" id="cantidad" required>
                </div>
              </div>

                <center> 
                  {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning'],$secure = null) !!}
                  {!! link_to('#',$title='Limpiar',$attributes =  ['id'=>'limpiar','class'=>'btn btn-default'],$secure = null) !!}
                  {!! link_to('#',$title='Agregar',$attributes =  ['id'=>'agregar','class'=>'btn btn-primary'],$secure = null) !!}

                </center>    

              <input type="hidden" name="token" id="token" value="{{ csrf_token() }}" />
            </form>

            <!--Fin del formulario creador de pagos-->

          </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
        <!--end panel generador de pagos-->
      </div>
      <div class="col-md-3"></div>
    </div>  
<!--**********************************************************************-->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <!--panel resumen de pagos-->

        <div class="panel panel-primary">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 class="panel-title">Listado de los pagos</h3>
          </div>
          <div class="panel-body">
            <table id="tabla" class="table table-striped" style="font-size:12px">
                  <thead>
                    <tr>
                      <th>  Cant        </th>
                      <th>  Concepto    </th>
                      <th>  Valor Unitario</th>
                      <th>  Subtotal    </th>
                    </tr>
                  </thead>
                  <tbody>
                   <td></td>
                   <td></td>
                   <td style="color:#ff0000"><strong>Total:</strong></td>
                   <td id="total" style="color:#ff0000"></td>
                 </tbody>
               </table>

               <!-- BOTON ACEPTAR -->  
               <center>
                <div class="col-md-12 col-sm-12 col-xs-12"><br>


                
                {!! link_to('#',$title='Borrar',$attributes =  ['id'=>'borrar','class'=>'btn btn-danger '],$secure = null) !!}
                {!! link_to('#',$title='Aceptar',$attributes =  ['id'=>'aceptar','class'=>'btn btn-primary '],$secure = null) !!}
                </div>
               </center> 

          </div>

        </div>  


        <!--end panel resumen de pagos-->        
      </div>
       <div class="col-md-3"></div>

  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Mis Pagos</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered" style="font-size:12px">
              <thead>
                <tr>
                  <th>Número de factura</th>
                  <th>Id Pago</th>
                  <th>Fecha</th>
                  <th>Concepto</th>
                  <th>Cantidad</th>                  
                  <th>Valor Unitario</th>
                  <th>Subtotal</th>
                  <th>Total</th>
                  <th>Tipo de pago</th>
                  <th>Creó</th>
                  <th>Cartera</th>
                </tr>
              </thead>
              <tbody>
                @foreach($otros_pagos as $otro_pago)
                <tr>
                  <td>{{ $otro_pago->factura->num_fact }}</td>
                  <td>{{ $otro_pago->id}}</td>
                  <td><small>{{ $otro_pago->factura->fecha}}</small></td>
                  <td>{{ $otro_pago->concepto }}</td>
                  <td>{{ $otro_pago->cantidad }}</td>                  
                  <td align="right">{{ number_format($otro_pago->valor_unitario,0,",",".") }}</td>
                  <td align="right">{{ number_format($otro_pago->subtotal,0,",",".") }}</td>
                  <td align="right">{{ number_format($otro_pago->factura->total,0,",",".") }}</td>
                  <td>{{ $otro_pago->factura->tipo }}</td>
                  <td><small>{{ $otro_pago->factura->user_create->name.' ('.$otro_pago->created_at.')'}}</small></td>
                  <td> {{ $otro_pago->cartera->nombre }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
      </div>      
    </div>  
  </div>  



@include('mis_js.otros_pagos_create_js')


@endsection
@include('templates.main2')