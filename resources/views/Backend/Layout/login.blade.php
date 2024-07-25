<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>

<body>



    <div class="container-scroller">
        
        @yield('content')

        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>

    <!-- plugins:js -->
    

<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
@yield('script')

</body>

</html>
