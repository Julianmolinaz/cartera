<script>
    const showErrorValidation = (strMessage) => {
        let strErrors = "";
        JSON.parse(strMessage).forEach(error => strErrors += error + "<br>" );
        return strErrors;
    }

    const capitalize = (str) => {
        if (!str) return "";

        value = str.toString();
        return value.toUpperCase();
    }

    const formatPrice = (value) => {
        let val = (value/1).toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>