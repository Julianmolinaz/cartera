<script>
    function editPeriodoDias(periodo, pFecha, sFecha, solicitudId) {
        let route = "/start/v3/creditos/update-fecha-pago";
        let content = `
            <form method="POST" action="${route}" id="formFechaPago">
                <div class="row form-group">
                    <label>Periodo</label>
                    <select 
                        name="periodo"
                        class="form-control"
                    >
                        <option value="Mensual" ${periodo === "Mensual" ? 'selected' : ''}>Mensual</option>
                        <option value="Quincenal" ${periodo === "Quincenal" ? 'selected' : ''}>Quincenal</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label>Primera fecha</label>
                    <select 
                        name="p_fecha"
                        class="form-control"
                    >
                    </select>
                </div>
                <div class="row form-group">
                    <label>Segunda fecha</label>
                    <select 
                        name="s_fecha"
                        class="form-control"
                    >
                    </select>
                </div>
                <input type="hidden" name="creditoId" value="${solicitudId}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;
        alertify.confirm(content, () => {
            const form = document.querySelector("#formFechaPago");
            form.submit();
        })
        .set(
            {title: "Editar periodo y dias de pago"},
            {labels: {ok: "Guardar Cambios", cancel: "Cerrar"}}
        );
    }
</script>