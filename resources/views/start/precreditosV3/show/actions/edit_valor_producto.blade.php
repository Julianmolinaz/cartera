
<script>

    function editValorProducto(valor, ventaId, solicitudId, index) {
        let route = "";
        let headers = { Authorization: "Bearer " + "{{ session('accessToken') }}" };
        showFormEditValorProducto(valor, ventaId, solicitudId, index);
    }

    function showFormEditValorProducto(valor, ventaId, solicitudId, index) {
        let route = "/start/ventas/update-valor";
        let content = `
            <form method="POST" action="${route}" id="formValorVenta${index}">
                <div class="row form-group">
                    <label>Valor</label>
                    <input 
                        type="number"
                        name="valor"
                        class="form-control"
                        value="${valor}"
                        required
                    />
                </div>
                <input type="hidden" name="index" value="${index}" />
                <input type="hidden" name="solicitudId" value="${solicitudId}" />
                <input type="hidden" name="ventaId" value="${ventaId}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;

        alertify.confirm(content, () => {
            const form = document.querySelector(`#formValorVenta${index}`);
            form.submit();
        })
        .set({
            "title": `Editar valor producto ${index}`,
            "labels": { ok: "Guardar Cambios", cancel: "Cerrar" }
        });
    }
</script>