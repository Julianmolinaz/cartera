<!-- 
<script>

    const centro_de_costos = document.getElementById('centro_de_costos');
    const centro_de_costos_formateado = document.getElementById('centro_de_costos_formateado');

    centro_de_costos.addEventListener('keyup', () => {

        let numero_formateado = format(centro_de_costos);
        if(centro_de_costos.value){
            centro_de_costos_formateado.textContent = '$ ' + numero_formateado;
        } else {
            centro_de_costos_formateado.textContent = '';
        }
    });


</script> -->