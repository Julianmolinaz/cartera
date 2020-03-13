<div class="panel panel-default">
    <div class="panel-body">

        <div class="form-group" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Información del crédito</label>
            </div>
        </div>

        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">
            
        <div class="form-group">

            <!-- estado credito  -->
            <div class="col-md-3">
                <label>Estado</label>
                <select class="form-control" v-model="credito.estado">
                    <option :value="estado" v-for="estado in estados_credito" v-text="estado"></option>
                </select>
            </div>
            
            <!-- cuotas faltantes  -->
            <div class="col-md-3">
                <label>Cts faltantes</label>
                <input type="text" class="form-control" v-model="credito.cuotas_faltantes">
            </div>
        
            <!-- saldo  -->
            <div class="col-md-3">
                <label>Saldo deuda</label>
                <input type="text" class="form-control" v-model="credito.saldo">
            </div>

            <!-- saldo a favor  -->
            <div class="col-md-3">
                <label>Saldo a favor</label>
                <input type="text" class="form-control" v-model="credito.saldo_favor">
            </div>

        </div>

        <div class="form-group">
        
            <!-- rendimiento  -->
            <div class="col-md-3">
                <label>Rendimiento</label>
                <input type="text" class="form-control" v-model="credito.rendimiento">
            </div>

            <!-- valor total de credito  -->   
            <div class="col-md-3">
                <label>Vlr total crédito</label>
                <input type="text" class="form-control" v-model="credito.valor_credito">
            </div>

            <!-- castigada -->
            <div class="col-md-3">
                <label>Castigada</label>
                <select class="form-control" v-model="credito.castigada">
                    <option :value="'Si'">Si</option>
                    <option :value="'No'">No</option>
                </select>
            </div>

            <!-- fecha de pago  -->
            <div class="col-md-3">
                <label>Fecha de pago</label>
                <input type="date" class="form-control" v-model="fecha_pago">
            </div>
            
        </div>

        <div class="form-group">

            <!-- recordatorios de pago  -->
            <div class="col-md-12">
                <label>Recordatorio de pago</label>
                <textarea class="form-control" v-model="credito.recordatorio"></textarea>
            </div>

        </div>

    </div>
</div>