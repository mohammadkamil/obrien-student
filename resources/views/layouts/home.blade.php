<!doctype html>
<html lang="en">

<head>
    <title>O'brien</title><link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    <style>
        .contact-info {
            background-color: #FFFFFF;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' %3E%3Cdefs%3E%3ClinearGradient id='a' x1='0' x2='0' y1='0' y2='1'%3E%3Cstop offset='0' stop-color='%23412AFF'/%3E%3Cstop offset='1' stop-color='%23FF0000'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpattern id='b' width='24' height='24' patternUnits='userSpaceOnUse'%3E%3Ccircle fill='%23FFFFFF' cx='12' cy='12' r='12'/%3E%3C/pattern%3E%3Crect width='100%25' height='100%25' fill='url(%23a)'/%3E%3Crect width='100%25' height='100%25' fill='url(%23b)' fill-opacity='0.1'/%3E%3C/svg%3E");
            background-attachment: fixed;
        }

    </style>
    {{-- @livewireStyles --}}

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <main>
        @yield('content')

    </main>

    {{-- @livewireScripts --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> ___scripts_1___
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>


    <script src="js/main.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#formprospect").submit(function(event) {
            $("#btnsubmit").prop("disabled",true);

            var formData = {
                name: $("input[name=name]").val(),
                tel: $("input[name=tel]").val(),
                ic_no: $("input[name=ic_no]").val(),
                email: $("input[name=email]").val(),
                gander: $("#gander").val(),
                current_status: $("input[name=current_status]").val(),
                current_institution: $("input[name=current_institution]").val(),
                get_know_obrien: $("#get_know_obrien").val(),
                funding: $("#funding").val(),

            };
            console.log(formData);

            // alert(JSON.stringfy(formData));
            $.ajax({
                type: "POST",
                url: "{{ route('api.prospect') }}",
                data: formData,
                dataType: "json",
                encode: true,
                success: function(response) {

                    console.log(response);
                    if (response) {
                        alert('{{ "success submit." }}');
                        //   $('.success').text(response.success);
                        $("#formprospect")[0].reset();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            }).done(function(data) {
                $("#btnsubmit").prop("disabled",false);

                console.log(data);
            });

            event.preventDefault();
        });

    </script>
</body>

</html>
