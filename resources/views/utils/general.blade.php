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
</script>