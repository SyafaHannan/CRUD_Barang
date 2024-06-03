<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])


</head>

<body>
    <div class="header">
        <a href="#default" class="logo">MiniMark</a>
        <div class="header-right">
        </div>
    </div>
    <br>
    <br>
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

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btnLogin" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        .header {
            overflow: hidden;
            background-color:lightblue;
            padding: 20px 10px;
        }

        /* Style the header links */
        .header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
        .header a.logo {
            font-size: 25px;
            font-weight: bold;
            font-family: cursive;
        }

        /* Change the background color on mouse-over */
        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style the active/current link*/
        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        /* Float the link section to the right */
        .header-right {
            float: right;
        }

        /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }
    </style>


    <script type="module">
        $('.btnLogin').on('click', function(a) {
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
                    Swal.fire({
                            title: 'Gagal',
                            text: response.data.pesan,
                            icon: 'error'
                        });                }
            });
        })
    </script>
</body>

</html>