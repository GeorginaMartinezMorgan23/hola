<style>
#enlace2{
    position: absolute;
            left: 150px;
            
            font-size:20px;
}

#enlace3{
    position: absolute;
            left: 1000px;
            top:  80px;
            font-size:25px;
            color:#ffcc00;
}

#enlace3.hover{
    color:#ffcc00;

}

#enlace4{
    position: absolute;
            left: 1100px;
            top:  80px;
            font-size:25px;
            color:#ffcc00;
}




</style>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- favicon :icono de pestaña navegador -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  -->
<style>
body{
    
}

</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Smile Software</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" >
        
                <a style="    color: #0099cc;
                     text-shadow: 2px 0 #ffcc66, 0 2px #ffcc66, 2px 0 #ffcc66, 0 2px #ffcc66;font-family: serif;left: 150px; top: 60px;font-size: 40px"
                     class="navbar-brand" href="{{ url('/') }}" id="enlace2">
                     Smile Software <?php $logotipos=App\Logotipo::where('id','=',1)->get();?>
                        @forelse($logotipos  as $tag)
                    <img  style="  border-radius: 70%;"class="logo" id="imlogoactual"src="{{Storage::url($tag->logo)}}" class="mr-3" alt="image" width="80px" high="100px" id="dos">
                    @empty
                    <img  style="  border-radius: 70%;" class="logo" src="{{ asset('Imagenes/Icono.jpg') }}" class="mr-3" width="80px" id="dos"> 
                    @endforelse
                </a>

              

                <a  class="navbar-brand" href="{{ url('/') }}" id="enlace3">Home</a>
                <a  class="navbar-brand" href="{{ url('/login') }}" id="enlace4">Login</a>




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
                                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        

        <main class="py-4">
            @yield('content')


        </main>



    </div>


    
</body>
</html>
