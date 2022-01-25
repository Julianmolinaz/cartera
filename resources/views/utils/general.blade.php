<script>
    const showErrorValidation = (strMessage) => {
        let strErrors = "";
        JSON.parse(strMessage).forEach(error => strErrors += error + "<br>" );
        return strErrors;
    }
</script>