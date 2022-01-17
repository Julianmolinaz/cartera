 <div class="card-header">
    <div class="card-title">Credito =2322</div>
    <div class="card-menu">
        <a href="#" class='btn btn-default btn-xs my-btn'>
            <span
                class="glyphicon glyphicon-pencil"
                data-toggle="tooltip"
                data-placement="top"
                title="Editar crédito">                            
            </span>
        </a>
        	
        <a 	href="#" 
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Hacer Pago">
            <span class="glyphicon glyphicon-usd"></span>
        </a>
        <a href="{{route('start.clientes.show',$data['solicitud']['cliente']['id'])}}" 
            class='btn btn-default btn-xs my-btn' 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Ver Cliente">
            <span class="glyphicon glyphicon-user" ></span>
        </a>
        <a href="" 
            class='btn btn-default btn-xs my-btn' 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Sanciones diarias">
            <span class="glyphicon glyphicon-record" ></span>
        </a>
        <a  href="" 
            class='btn btn-default btn-xs my-btn' 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Multas prejuridicas y juridicas">
            <span class="glyphicon glyphicon-hourglass"></span>
        </a>
        <a
            href="{{route('start.creditos.refinanciar',$data['solicitud']['id'])}}"
            class="btn btn-default btn-xs my-btn"
            data-toggle="tooltip" 
            data-placement="top" 
            title="Refinanciar crédito">
            <i class="fa fa-reply-all" aria-hidden="true"></i>
        </a>
        <a
            href="javascript:void(0);"
            class="btn btn-default btn-xs my-btn"
            data-toggle="tooltip" 
            data-placement="top" 
            title="Acuerdos de pago">
            <span class="glyphicon glyphicon-calendar"></span>
        </a>
        <a href=""
		    class='btn btn-default btn-xs'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Llamar">
            <span class = "glyphicon glyphicon-phone-alt"></span>
        </a>				

        <a href="javascript:void(0);"
            onclick="showModalCertificados()"
            class='btn btn-default btn-xs'  
            data-toggle="tooltip" 
            data-placement="top" 
            title="Certificados">
            <span class = "glyphicon glyphicon-file">
        </a>
        <a href=""
            class='btn btn-default btn-xs'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Estado de cuenta">
            <span><i class="fab fa-laravel"></i></span>
        </a>
        <a href=""
            class="btn btn-default btn-xs"
            onclick="return confirm('¿Esta seguro de eliminar el crédito?')" 
            data-toggle="tooltip"
            data-placement="top"
            title="Eliminar Crédito">
            <span class="glyphicon glyphicon-trash"></span>
        </a>        
    </div>
</div>
<div class="card-content">
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Estado</div>
            <div>Cancelado</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha referencia</div>
            <div>
                <span class="pg-tag pg-tag--primary">Agosto-2019</span>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha aprobación</div>
            <div>17-09-2021 09:16:09</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha de pago</div>
            <div style="font-weight:900">17-09-2021
                <i class="far fa-calendar-alt"></i>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Valor total crédito</div>
            <div>$1’000.000,oo</div>
        </div>
    </div>
    <div class="card-content__item" style="background-color: #fcee2163">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Saldo deuda</div>
            <div>$900.000,oo</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Rendimiento</div>
            <div>$300.000,oo</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Cuotas faltantes</div>
            <div>9 de 10</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Credito padre</div>
            <div>43322</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Credito hijo</div>
            <div>...</div>
        </div>
    </div>
    <div style="background-color: #E5E5E5">
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Saldo a favor</div>
                <div>0</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Jurídico</div>
                <div>0</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Prejurídico</div>
                <div>0</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Sanciones diarias</div>
                <div>$20.000,oo</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Debe de pagos parciales</div>
                <div>$25.000,oo</div>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Descuentos</div>
            <div>$25.000,oo</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Total pagos</div>
            <div>$25.000,oo</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Castigada</div>
            <div>No</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Creó</div>
            <div>
                <p>Pablo Adrian Gonzalez Salazar <br>12-07-2021 18:15:20</p>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Actualizó</div>
            <div>
                <p>Pablo Adrian Gonzalez Salazar <br>12-07-2021 18:15:20</p>
            </div>
        </div>
    </div>
</div>
