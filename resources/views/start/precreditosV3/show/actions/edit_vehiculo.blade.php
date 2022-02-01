
<script>

    function editVehiculo(vehiculo, solicitudId, index) {
        axios.get('/api/tipo_vehiculos/list-all')
            .then(res => {
                if (res.data.success) {
                    showFormEditVehiculo(vehiculo, solicitudId, index, res.data.dat);
                }
            })
    }

    function showFormEditVehiculo(vehiculo, solicitudId, index, tipoVehiculos) {
        console.log(vehiculo, solicitudId);
        let route = "/start/vehiculos";
        let options = '';

        tipoVehiculos.forEach(tipo => {
            options += `
                <option 
                    value="${tipo.id}"
                    ${tipo.id == vehiculo.tipo_vehiculo_id ? 'selected' : ''}
                >${tipo.nombre}</option>
            `;
        });

        let content = `
            <form method="POST" action="${route}" id="formVehiculo${index}">
                <div class="row form-group">
                    <label>Placa</label>
                    <input 
                        type="text"
                        name="placa"
                        class="form-control"
                        value="${vehiculo.placa}"
                        required
                    />
                </div>
                <div class="row form-group">
                    <label>Tipo vehículo</label>
                    <select
                        name="tipo_vehiculo_id"
                        class="form-control"
                        id="tipo_vehiculo${index}"
                        required
                    >${options}
                    </select>
                </div>
                <div class="row form-group">
                    <label>Modelo</label>
                    <input 
                        type="number"
                        name="modelo"
                        class="form-control"
                        value="${vehiculo.modelo}"
                        required
                    />
                </div>
                <div class="row form-group">
                    <label>Cilindraje</label>
                    <input 
                        type="number"
                        name="cilindraje"
                        class="form-control"
                        value="${vehiculo.cilindraje}"
                        required
                    />
                </div>
                <div class="row form-group">
                    <label>Vencimiento SOT</label>
                    <input 
                        type="date"
                        name="vencimiento_soat"
                        class="form-control"
                        value="${vehiculo.vencimiento_soat}"
                    />
                </div>
                <div class="row form-group">
                    <label>Vencimiento RTM</label>
                    <input 
                        type="date"
                        name="vencimiento_rtm"
                        class="form-control"
                        value="${vehiculo.vencimiento_rtm}"
                    />
                </div>
                <input type="hidden" name="id" value="${vehiculo.id}" />
                <input type="hidden" name="solicitudId" value="${solicitudId}" />
                <input type="hidden" name="index" value="${index}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        `;

        alertify.confirm(content, () => {
            const form = document.querySelector(`#formVehiculo${index}`);
            form.submit();
        })
        .set(
            {title: "Editar vehículo"},
            {labels: {ok: "Guardar Cambios", cancel: "Cerrar"}}
        );
    }
</script>