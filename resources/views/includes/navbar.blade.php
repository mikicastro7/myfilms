
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    myfilms
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/login">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">{{ __('Register') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cart">
                                    <span class="fa-stack fa-2x has-badge" data-count={{Session::has('cart') ? Session::get('cart')->totalQty : '0' }}>

                                        <i style="" class="fa fa-shopping-cart fa-stack-2x red-cart"></i>
                                      </span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/logout">
                                        Logout

                                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                <a class="dropdown-item" href="/myfilms/{{Auth::id()}}">myfilms</a>
                                @if(Auth::user()->type <= 1)
                                <a class="dropdown-item" href="/admin">Admin</a>
                                @endif
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/cart">
                                    <span class="fa-stack fa-2x has-badge" data-count=
                                    @if (Session::has('cart') && Session::get('cart') != [])
                                    {{Session::get('cart')->totalQty}}
                                    @else
                                    {{'0'}}
                                    @endif>
                                        <i style="" class="fa fa-shopping-cart fa-stack-2x red-cart"></i>
                                      </span>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

<style>
.nav-link:hover{
    color: white !important;
}

.fa-stack[data-count]:after {
	position: absolute;
	right: -30%;
	top: -30%;
	content: attr(data-count);
	font-size: 45%;
	padding: 0.3em;
	border-radius: 999px;
	line-height: 0.65em;
	color: white;
	text-align: center;
	min-width: 1em;
	font-weight: bold;
	background: red;
}
.fa-circle {
	color: #df0000;
}
.fa-stack{
    width: 1em !important;
    height: 1em !important;
}


</style>

<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
