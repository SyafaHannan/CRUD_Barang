<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="userName" class="form-control form-control-lg" placeholder="Enter a valid username" />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" id="password" class="form-control form-control-lg" placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btnLogin" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="module">
        $('.btnLogin').on('click', function(a){
             //a.preventDefault();
                //alert('clicked');
                axios.post('login/check', {
                    username: $('#userName').val(),
                    password: $('#password').val(),
                    _token: '{{csrf_token()}}'
                }).then(function(response) {
                        if (response.data.success) {
                            window.location.href = response.data.redirect_url;
                        } else {
                            swal.fire('Gagal Login, Username/Password salah', '', 'error');
                        }
                });
        })
                
    </script>
</body>

</html>