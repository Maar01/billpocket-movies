<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="alert alert-danger" @click="funcion" v-if="has_error && !success">
                            <p v-if="error == 'login_error'">Validation Errors.</p>
                            <p v-else>Error, unable to connect with these credentials.</p>
                        </div>
                        <form autocomplete="off" @submit.prevent="login" method="post">
                            <div class="form-group">
                                <label for="email">item.E-mail</label>
                                <input type="email" id="email" class="form-control" :placeholder="variable" v-model="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" v-model="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign-in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                success: false,
                has_error: false,
                peliculas: [],
                error: '',
                cargando:true,

            }
        },
        mounted() {// inicializador de compoente
            //
        }, created() {
           //aquí también podemos cargar
        },
        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect();
                var app = this;
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        // handle redirection
                        app.success = true;
                        const redirectTo = 'dashboard';
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.has_error = true;
                        app.error = res.response.data.error
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
        }
    }
</script>
