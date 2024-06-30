<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box
        }

        html,
        body {
            display: table;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: #eee;
        }

        body {
            display: table-cell;
            vertical-align: middle;
        }

        .box {
            margin: auto;
            padding: 25px 50px;
            width: 350px;
            min-height: 115px;
            background: #fff;
            border-left: 5px solid #9b2;
            box-shadow: 0 0 20px rgba(0, 0, 0, .15);
            font: 12px/15px Arial, Helvetica, sans-serif;
            color: #666;
        }

        h2 {
            margin: 0 10px;
            line-height: 40px;
        }

        form {
            padding: 0 10px 10px;
        }

        form::after {
            content: "";
            display: block;
            clear: both;
        }

        label {
            position: absolute;
            left: -9999px;
        }

        input {
            position: relative;
            z-index: 10;
            margin: 0;
            padding: 0 5px;
            width: 225px;
            height: 30px;
            border: 1px solid #ccc;
        }

        input:focus {
            z-index: 15;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            outline: 0;
        }

        #password {
            top: -1px;
            margin-bottom: 5px;
        }

        .register-form {
            display: none;
        }

        .register-form input {
            margin: -1px 0;
        }

        #first-name {
            margin-top: 5px;
        }

        .captcha {
            margin: 10px 0;
        }

        .captcha label {
            position: relative;
            left: 0;
        }

        #submit {
            float: right;
            padding: 0;
            width: 75px;
            background: #9b2;
            color: #140;
            border-color: #471;
        }

        #submit:hover {
            color: #025;
            background: #28e;
            border-color: #16c;
        }

        #submit~a {
            display: block;
            float: left;
            width: 120px;
            text-decoration: none;
            color: #666;
        }

        #submit~a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Login</h2>
        <!-- Login Form -->
        <form id="login-form">
            @csrf
            <div class="login-form">
                <label for="username">Username</label>
                <input style="margin-top:10px" name="username" type="text" id="username" placeholder="Username">
                <label for="password">Password</label>
                <input style="margin-top:10px" name="password" type="password" id="loginpassword" placeholder="Password">
                <button type="button" class="btn btn-primary mt-2" onclick="login()">LogIn</button>
            </div>
            <!-- Register Form -->
            <div class="register-form">
                <label for="first-name" style="padding: 10px;">First Name</label>
                <input style="margin-top:10px" name="name" disabled type="text" id="name" placeholder="First Name">
                <label for="email">E-mail Address</label>
                <input style="margin-top:10px" name="email" disabled type="text" id="email" placeholder="E-mail Address">
                <label for="Password">Password</label>
                <input style="margin-top:10px" name="password" disabled type="text" id="Password" placeholder="Password">
                <label for="confirmpassword">Confirm Password</label>
                <input style="margin-top:10px" disabled type="text" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                <button style="margin-top:10px" type="button" onclick="Register()" class="btn btn-primary">Register</button>
            </div>
        </form>
        <a class="register" style="margin-top:10px">Register!</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        (function($) {
            // Easing equation based on EaseInOutExpo by Robert Penner
            $.extend($.easing, {
                eioe: function(x, t, b, c, d) {
                    if (t == 0) return b;
                    if (t == d) return b + c;
                    if ((t /= d / 2) < 1) return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
                    return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b;
                }
            });

            // Toggle disabled
            $.fn.toggleDisabled = function() {
                return this.each(function() {
                    this.disabled = !this.disabled;
                });
            };

            // Toggle attribute value
            $.fn.toggleAttr = function(a, v1, v2) {
                return this.each(function() {
                    var $t = $(this),
                        v = $t.attr(a) === v1 ? v2 : v1;
                    $t.attr(a, v);
                });
            };

            // Toggle login/register form
            $('.register').click(function() {
                $('.register-form, .login-form').slideToggle({
                    easing: 'eioe',
                    duration: 250
                }).find('input').toggleDisabled();

                // Change header
                var $h2 = $('.box h2'),
                    headerText = $h2.text() === "Login" ? "Register" : "Login";
                $h2.text(headerText);

                // Change submit button value
                $('#submit').toggleAttr('value', 'Login', 'Register');

                // Change signup link
                var $su = $('.register'),
                    signupLinkText = $su.text() === "Register!" ? "Login!" : "Register!";
                $su.text(signupLinkText);

                // Change form action
                $('form').toggleAttr('action', 'login.php', 'register.php');

                return false;
            });
        })(jQuery);

        function login() {
            var username = $('#username').val();
            var password = $('#loginpassword').val();
            if (!username || !password) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Username and password is Required!",
                });
                return;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/login',
                data: {
                    email: username,
                    password: password
                },
                statusCode: {
                    500: function(response) {
                        console.log(response)
                    }
                },
                success: function(message) {
                    window.location.href = "/ContactList";
                },
                error: function(xhr, status, error) {
                    alert('Login failed: ' + error);
                }
            });
        }

        function Register() {




            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#Password').val();
            var confirmpassword = $('#confirmpassword').val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!name || !email || !password || !confirmpassword) {
                Swal.fire({
                    icon: "error",
                    text: "All fields are required",
                });
                return;
            }
            if (password !== confirmpassword) {
                Swal.fire({
                    icon: "error",
                    text: "Passwords do not match.",
                });
                return;
            }

            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: "error",
                    text: "Invalid email address",
                });
                return;
            }

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/Registers',
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                statusCode: {
                    500: function(response) {
                        console.log(response);
                    }
                },
            });
        }
    </script>
</body>

</html>