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

        var date = new Date(value + ' 01:00:00');

        let day = date.getDate();

        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        
        if (day < 10) day = `0${day}`;
        if (month < 10) month = `0${month}`;

        return `${day}-${month}-${year}`;

    });

    Vue.filter('ddmmyyyyhhmmss', (value) => {

        if (!value) {
            return '';
        }

        var date = new Date(value);

        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let hours = date.getHours()
        let minutes = date.getMinutes()
        let seconds = date.getSeconds()

        
        if (day < 10) day = `0${day}`;
        if (month < 10) month = `0${month}`;
        if (hours < 10) hours = `0${hours}`;
        if (minutes < 10) minutes = `0${minutes}`;
        if (seconds < 10) seconds = `0${seconds}`;


        return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
    });

</script>