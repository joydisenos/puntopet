<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>PuntoPet</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons 
 
  -->

  <!-- Google Fonts --> 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{ asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/toastr.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">

  @yield('header')
    
<style>
    .ocultar{
        display:none;
    }
    .header-panel{
        background: url('{{ asset('img/freddy-anca-chuquihumani-1055220-unsplash.jpg')  }}') center center;
        background-size: cover; 
        min-height: 150px;
        width: 100%;
        display: flex;
    }
    .pantalla{
        background: rgba(0,0,0,0.6);
        width: 100%;
    }
</style>
  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="{{ (URL::current() == url('/')) ? '#intro' : url('/') }}" class="scrollto">PuntoPet</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>
                            <nav id="nav-menu-container">
                                

                                <ul class="nav-menu">
                                    
                                    
                                    <li class="">
                                        <a class="nav-link" href="{{ (URL::current() == url('/')) ? '#about' : url('/#about') }}">Nosotros</a>
                                    </li>

                                    <li class="">
                                        <a class="scrollto" href="{{ (URL::current() == url('/')) ? '#contact' : url('/#contact') }}">Contacto</a>
                                    </li>

                                    <li class="">
                                        <a href="{{ route('tiendas') }}">Tiendas</a>
                                    </li>
                                    
                                    @guest
                                    
                                    <li><a href="#" class="" data-toggle="modal" data-target="#login-modal"><span class="ti-user"></span> Ingresar</a></li>
                                    @else
                                    <li class="menu-has-children">
                                        <a class="" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ title_case(Auth::user()->nombre) }} <span class="icon-arrow-down"></span></a>

                                       <ul>
                                            @role('admin|dev')
                                            <li>
                                                <a  href="{{ route('admin.configuraciones') }}"><i class="fa fa-cog mr-3" aria-hidden="true"></i> Configuraciones</a>
                                            </li>
                                            @else

                                            @role('negocio|dev')
                                            <li>
                                                <a href="{{ route('negocio.productos') }}"><i class="fa fa-birthday-cake mr-3" aria-hidden="true"></i> Productos</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('negocio.ventas') }}"><i class="fa fa-money mr-3" aria-hidden="true"></i> Ventas</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('negocio.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil</a>
                                            </li>
                                            @else
                                            <li>
                                                <a href="{{ route('usuario.favoritos') }}"><i class="fa fa-heart mr-3" aria-hidden="true"></i> Favoritos</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('usuario.direcciones') }}"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Direcciones</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('usuario.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('usuario.pedidos') }}"><i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i> Pedidos</a>
                                            </li>
                                            @endrole
                                            
                                            @endrole

                                            <li>
                                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-3" aria-hidden="true"></i> Salir</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                    @endguest
                                </ul>
                            </nav>

      
    </div>
  </header><!-- #header -->

  @yield('content')

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>PuntoPet</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Secciones</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contacto</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>PuntoPet</strong> 2019. Todos los derechos reservados
      </div>
      
    </div>
  </footer><!-- #footer -->

   @guest
    <!-- Modal -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
    
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="tab-btn nav-link active" data-target=".login" href="#">Iniciar Sesión</a>
                  </li>
                  <li class="nav-item">
                    <a class="tab-btn nav-link" data-target=".registro" href="#">Regístrate</a>
                  </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body mt-4 mb-4 login">

              <form method="POST" action="{{ route('login') }}">
                        @csrf

                <div class="container-fluid">
                <div class="form-group row justify-content-center">

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                    
                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        
                        <div class="row pl-4 pr-4 justify-content-center">
                            
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check">
                                 @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    </div>
                            </div>

                        </div>
                        

                        <div class="form-group row mb-0 justify-content-center">
                                <div class="col-md-10 text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                </div>

                  
                    
                 
            </form>
              </div>

              <div class="modal-body modal-body mt-4 mb-4 ocultar registro">
                  <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme su contraseña" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
              </div>


            </div>
          </div>
        </div>


         <div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
    
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="tab-btn nav-link active" data-target=".alta" href="#">Tengo negocio</a>
                  </li>
                  <li class="nav-item">
                    <a class="tab-btn nav-link" data-target=".sugerir" href="#">Sugerir negocio</a>
                  </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body mt-4 mb-4 alta">

              <form method="POST" action="{{ route('alta') }}">
                        @csrf


                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="nombre_negocio" type="text" class="form-control @error('nombre_negocio') is-invalid @enderror" name="nombre_negocio" value="{{ old('nombre_negocio') }}" placeholder="Nombre de su Negocio" required autocomplete="nombre_negocio" autofocus>

                                @error('nombre_negocio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme su contraseña" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Dar de alta
                                </button>
                            </div>
                        </div>
                    </form>
              </div>

              <div class="modal-body modal-body mt-4 mb-4 ocultar sugerir">
                   <form method="POST" action="{{ route('sugerir') }}">
                        @csrf

                       

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="nombre_negocio" type="text" class="form-control @error('nombre_negocio') is-invalid @enderror" name="nombre_negocio" value="{{ old('nombre_negocio') }}" placeholder="Nombre de su Negocio" required autocomplete="nombre_negocio" autofocus>

                                @error('nombre_negocio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Sugerir
                                </button>
                            </div>
                        </div>
                    </form>
              </div>
              </div>


            </div>
          </div>
        
    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
  <script src="{{ asset('lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{ asset('lib/superfish/superfish.min.js')}}"></script>
  <script src="{{ asset('lib/wow/wow.min.js')}}"></script>
  <script src="{{ asset('lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{ asset('lib/counterup/counterup.min.js')}}"></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('lib/isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('lib/lightbox/js/lightbox.min.js')}}"></script>
  <script src="{{ asset('lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('contactform/contactform.js')}}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('js/main.js')}}"></script>
  <script src="{{ asset('js/toastr.js')}}"></script>

  @if (session('status'))
    <script>
        toastr.success( '{{ session("status") }}' );
    </script>
    @endif

    @if ($errors->any())
    
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error( '{{ $error }}' );
                </script>
            @endforeach
        
    @endif

  <script>
        $(document).ready(function(){
            $('.tab-btn').click(function(e){

                e.preventDefault();

                button = $(this);
                parent = '#' + button.parents('.modal').attr('id');
                target = button.data('target');
               
                $(parent + ' .modal-body').hide();
                $(target).show();

                $(parent + ' .tab-btn').removeClass('active');
                button.addClass('active');

            });
        })
    </script>

</body>
</html>
