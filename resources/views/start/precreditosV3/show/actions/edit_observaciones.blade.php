
<script>
    function editObservaciones(observaciones, solicitudId) {
        let route = "/start/precreditosV3/observaciones";
        let content = `
            <form method="POST" action="${route}" id="formObservaciones">
                <div class="row form-group">
                    <label>Observaciones</label>
                    <textarea 
                        name="observaciones"
                        class="form-control"
                    >${observaciones}</textarea>
                </div>
                <input type="hidden" name="solicitudId" value="${solicitudId}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;
        alertify.confirm(content, () => {
            const form = document.querySelector("#formObservaciones");
            form.submit();
        })
        .set({
            title: "Editar Observaciones",
            labels: {ok: "Guardar Cambios", cancel: "Cerrar"}
        });
    }
</script>