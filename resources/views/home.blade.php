@extends('master.front')
@section('content')
<!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">


          @foreach($tiendas as $key => $tienda)

          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <div class="carousel-background"><img src="{{ $tienda->foto_local != null ? asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->foto_local ) : asset('img/freddy-anca-chuquihumani-1055220-unsplash.jpg')}}" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>{{ $tienda->nombre }}</h2>
                <p>{{ $tienda->descripcion }}</p>
                <a href="{{ route('ver.tienda' , [$tienda->slug]) }}" class="btn-get-started">Ver tienda</a>
              </div>
            </div>
          </div>

          @endforeach

          

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">
    
    <section class="mt-4 mb-4">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <h1 class="border-bottom">Productos</h1>
          </div>
        </div>
        <div class="row">
          @foreach($productos as $producto)
            <div class="col-md-3 mb-4">
             
              <div class="fondo-foto"
              @if($producto->foto == null)
              style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
              @else 
              style="background-image: url('{{ asset( 'storage/archivos/'. $producto->user->id . '/' . $producto->foto ) }}');"
              @endif
              >
            
              <div class="fondo">
                <h6 class="border-bottom">{{ title_case($producto->nombre) }}</h6>
                <p>{{ str_limit( $producto->descripcion , 200) }}</p>
                <p><a 
                  @if($producto->foto == null)
                  href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
                  @else
                  href="{{ asset( 'storage/archivos/'. $producto->negocio->user->id . '/' . $producto->foto ) }}"
                  @endif 
                  rel="lightbox">Ampliar imagen</a></p>
                <p><a href="{{ route('ver.tienda' , [$producto->negocio->slug]) }}">Visitar tienda</a></p>
                  

              </div>
            </div>

            </div>
          @endforeach
        </div>
      </div>
    </section>

     <section class="mt-4 mb-4">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <h1 class="border-bottom">Mascotas</h1>
          </div>
        </div>
        <div class="row">
          @foreach($mascotas as $mascota)
            <div class="col-md-3 mb-4">
             
              <div class="fondo-foto"
              @if($mascota->foto == null)
              style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
              @else 
              style="background-image: url('{{ asset( 'storage/archivos/'. $mascota->user->id . '/' . $mascota->foto ) }}');"
              @endif
              >
            
              <div class="fondo">
                <h6 class="border-bottom">{{ title_case($mascota->nombre) }}</h6>
                <p>{{ str_limit( $mascota->descripcion , 200) }}</p>
                <p><a 
                  @if($mascota->foto == null)
                  href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
                  @else
                  href="{{ asset( 'storage/archivos/'. $mascota->hogar->user->id . '/' . $mascota->foto ) }}"
                  @endif 
                  rel="lightbox">Ampliar imagen</a></p>
                <p><a href="{{ route('ver.tienda' , [$mascota->hogar->slug]) }}">Visitar hogar</a></p>
                  

              </div>
            </div>

            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeIn">
      <div class="container text-center">
        <h3>Registra tu Negocio</h3>
        <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <a class="cta-btn" href="#" data-toggle="modal" data-target="#registro-modal">Registro</a>
      </div>
    </section><!-- #call-to-action -->

    

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contacto</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Dirección</h3>
              <address>{{ App\Legal::direccion() }}</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Teléfono</h3>
              <p><a href="tel:+155895548855">{{ App\Legal::telefono() }}</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">{{ App\Legal::email() }}</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Enviar</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>
 
@endsection