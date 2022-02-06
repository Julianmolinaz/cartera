
<script>
    function editFechaPago(fechaPago, creditoId) {
        let route = "/start/fecha_cobros/update-fecha-pago";
        let content = `
            <form method="POST" action="${route}" id="formFechaPago">
                <div class="row form-group">
                    <label>Fecha de pago</label>
                    <input 
                        type="date"
                        onkeydown="return false"
                        name="fechaPago"
                        class="form-control"
                        value="${fechaPago}"
                    />
                </div>
                <input type="hidden" name="creditoId" value="${creditoId}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;
        alertify.confirm(content, () => {
            const form = document.querySelector("#formFechaPago");
            form.submit();
        })
        .set(
            {title: "Editar fecha de pagos"},
            {labels: {ok: "Guardar Cambios", cancel: "Cerrar"}}
        );
    }
</script>