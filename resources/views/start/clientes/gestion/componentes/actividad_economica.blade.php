<script type="text/x-template" id="actividad_economica-template">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    <label>Ocupacion u oficio *</label>
                    <input type="text" class="text form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-6">
                    <label>Empresa de trabajo</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Direccion</label>
                    <input type="text" class="text form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3">
                    <label>Barrio *</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Municipio *</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Nit/Cédula</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Teléfono empresa *</label>
                    <input type="text" class="text form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-6">
                    <label>Cargo *</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Tipo de contrato</label>
                    <select name="" id="" class="form-control"></select>
                </div>
                <div class="form-group col-md-3">
                    <label>Fecha de vinculación</label>
                    <input type="date" name="" id="" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-12">
                    <label for="">Descripcion actividad</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <button class="btn btn-default">Salvar</button>
                    <button class="btn btn-primary" id="continuar_cony">Continuar</button>
                </center>
            </div>

        </div>
    </div>
</script>


<script>

    Vue.component('actividad_economica-component',{
        template: '#actividad_economica-template'
    });

</script>