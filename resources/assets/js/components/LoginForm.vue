<script>
    export default {
        data() {
            return {
                form: {
                    email: "",
                    password: "",
                    remember: "",
                },
                errors: {},
            };
        },
        methods: {
            login(){
                this.loading = true;
                axios
                    .post("kirjaudu", this.form)
                    .then(function (response) {
                        window.location = response.request.responseURL;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.loading = false;
                    });
            }
        }
    }
</script>