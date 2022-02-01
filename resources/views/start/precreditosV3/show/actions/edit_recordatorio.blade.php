
<script>
    function editRecordatorio(recordatorio, creditoId) {
        let route = "/start/v3/creditos/update-recordatorio";
        let content = `
            <form method="POST" action="${route}" id="formRecordatorio">
                <div class="row form-group">
                    <label>Recordatorio</label>
                    <textarea 
                        name="recordatorio"
                        class="form-control"
                        rows="10"
                    >${recordatorio}</textarea>
                </div>
                <input type="hidden" name="creditoId" value="${creditoId}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;
        alertify.confirm(content, () => {
            const form = document.querySelector("#formRecordatorio");
            form.submit();
        })
        .set(
            {title: "Editar recordatorio"},
            {labels: {ok: "Guardar Cambios", cancel: "Cerrar"}}
        );
    }
</script>