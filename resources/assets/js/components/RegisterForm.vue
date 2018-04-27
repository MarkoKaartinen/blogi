<script>
    export default {
        data() {
            return {
                form: {
                    nickname: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                },
                loading: false,
                errors: {},
            };
        },
        methods: {
            register(){
                this.loading = true;
                axios
                    .post("rekisteroidy", this.form)
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