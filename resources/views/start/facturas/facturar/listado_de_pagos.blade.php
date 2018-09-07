
<div class="panel panel-warning">
  <!-- Default panel contents -->
  <div class="panel-heading" style="background-color: #FFC300;color:black;">
    <h4>Listado de pagos</h4>
  </div>
  <div class="panel-body">
    <table id="tabla" class="table table-striped" >
          <thead>
            <tr>
              <th>  Cant        </th>
              <th>  Concepto    </th>
              <th>  Pago desde  </th>
              <th>  Pago hasta  </th>
              <th>  Subtotal    </th>
            </tr>
          </thead>
          <tbody>
           <td></td>
           <td></td>
           <td></td>
           <td style="color:#ff0000"><strong>Total:</strong></td>
           <td id="total" style="color:#ff0000"></td>
         </tbody>
       </table>

       <!-- BOTON ACEPTAR -->
       <center>
        <div class="col-md-12 col-sm-12 col-xs-12"><br>

        {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning '],$secure = null) !!}
        {!! link_to('#',$title='Borrar',$attributes =  ['id'=>'borrar','class'=>'btn btn-danger '],$secure = null) !!}
        {!! link_to('#',$title='Aceptar',$attributes =  ['id'=>'aceptar','class'=>'btn btn-primary '],$secure = null) !!}
        </div>
       </center>

  </div>

</div>