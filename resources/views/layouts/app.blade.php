<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!--<title>Dashboard Sidebar Menu</title>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
    @livewireStyles
</head>

<body>
    <nav class="sidebar close" style="background-color:#2F3645">
        <header>
            <div class="image-text">
                <div class="text logo-text">
                    <span style="color:white" class="name ml-5">CONTACT</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links m-0 p-0">
                    <li class="nav-link">
                        <a href="/ContactList">
                            <i style="color:white" class='bx bx-list-ul icon'></i>
                            <span style="color:white" class="text nav-text">Contacts</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/AuditTrail">
                            <i style="color:white" class='bx bx-food-menu icon'></i>
                            <span style="color:white" class="text nav-text">Audit Trail</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/WebSocket">
                            <i style="color:white" class='bx bx-bell icon'></i>
                            <span style="color:white" class="text nav-text">Web Socket</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="/logout">
                        <i class='bx bx-log-out icon'></i>
                        <span style="color:white" class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>

    </nav>

    <section class="home" style="background-color:white">
        {{ $slot }}
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @livewireScripts
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");
        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })
    </script>
    <script>
        var pusher = new Pusher('7985b68dea8ee8b4f360', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('channel_name');


        channel.bind('eventName', function(data) {
            var message = data.message;
            $.ajax({
                url: '/processEvent',
                data: {
                    message: message
                },
                success: function(message) {

                }
            });
        });
    </script>


</body>

</html>