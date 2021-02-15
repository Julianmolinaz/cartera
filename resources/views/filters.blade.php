<script>

    Vue.filter('formatPrice', (value) => {
        let val = (value/1).toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    });

    Vue.filter('miles', (value) => {
        return new Intl.NumberFormat("es-Co").format(value);
    });

    Vue.filter('ddmmyyyy', (value) => {

        if (!value) {
            return '';
        }

        var date = new Date(value);

        let day = date.getDate() + 1
        let month = date.getMonth() + 1
        let year = date.getFullYear()

        if (day < 10) {
            day = `0${day}`;
        } 

        if (month < 10) {
            return `${day}-0${month}-${year}`;
        } else{
            return `${day}-${month}-${year}`;
        }

    });

</script>