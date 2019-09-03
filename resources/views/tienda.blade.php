@extends('master.front')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
	.fotos{
		height: 200px;
		width: 100%;
	}
	.card{
		position: relative;
		transition: all ease .5s;
	}
	.card:hover{
		box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
		transform: translateY(-5px);
	}
	.floating{
		position: absolute;
		bottom: 10px;
		right: 10px;
	}
	.nav-pills .nav-link.active, .show>.nav-pills .nav-link{
		background-color: #ffffff !important;
		border-radius: 0px;
		color: #18D26E;
	}
	.nav-pills .nav-link{
		background-color: #18D26E !important;
		color: #ffffff;
	}
	.logo-tienda{
		max-width: 50px;
		margin-bottom: 8px;
	}
	.contenedor-carrito{
		max-width: 150px;
	}
	.header-panel{
		min-height: 200px !important;
	}
	.btn-carrito{
		position: fixed;
		bottom: 10px;
		left: 10px;
		box-shadow: 4px 4px 8px rgba(0,0,0,0.5);
		z-index: 999;
	}
	#map{
		height: 300px;
		width: 100%;
		margin: 0;
		padding: 0;
		overflow: hidden;
	}
	.map-container{
		position: relative;
		margin: 0;
		padding: 0;
	}
	.dir{
		position: absolute;
		top: 0px;
		left: 0px;
		max-width: 70%;
		box-shadow: 4px 4px 8px rgba(0,0,0,0.3);
		background: #ffffff;
		padding: 10px;
	}
	.dir p{
		margin: 0px;
	}
	.botones{
		background: #18D26E;
	}

	/* Comentarios */

	  .estrellas p {
	  text-align: center;
	}

	.estrellas label {
	  font-size: 20px;
	}

	.estrellas input[type="radio"] {
	  display: none;
	}

	.estrellas label {
	  color: grey;
	}

	.clasificacion {
	  direction: rtl;
	  unicode-bidi: bidi-override;
	}

	.estrellas label:hover,
	.estrellas label:hover ~ .estrellas label {
	  color: orange;
	}

	.estrellas input[type="radio"]:checked ~ label {
	  color: orange;
	}

	@if($tienda->foto_local != null )
	.header-panel{
		background-image: url('{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->foto_local ) }}') !important;
		background-position: center center;
		background-size: cover;
	}
	@endif

</style>
@endsection

@section('content')

@component('components.headertienda')
	@slot('logo')
		@if($tienda->logo_local != null)
		 <img src="{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->logo_local) }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre }}">
		@else
		 <img src="{{ asset('images/paw.png') }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $tienda->nombre }}">
		@endif
	@endslot
    @slot('titulo' , title_case($tienda->nombre))
    @slot('negocio_id' , $tienda->id)
    	
    @endslot
@endcomponent
@include('includes.compartir')

<section class="botones">

	<div class="container">
		<div class="row">

			<div class="col">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link {{isset($_GET['page'])? '' : 'active'}}" id="pills-home-tab" data-toggle="pill" href="#productos" role="tab" aria-controls="pills-home" aria-selected="true">Productos</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link {{isset($_GET['page'])? 'active' : ''}}" id="pills-profile-tab" data-toggle="pill" href="#informacion" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
					  </li>
					</ul>
				</div>
			
		</div>
	</div>
	
</section>

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade {{isset($_GET['page'])? ''  : 'show active'}}" id="productos" role="tabpanel" aria-labelledby="pills-home-tab">
				
				@if($productos->count() > 0)
				<div class="row">
					<div class="col">
								<header class="section-header">
					  				<h3>Productos</h3>
					  			</header>
					</div>
				</div>
				@else
				<div class="row">
					<div class="col">
								<header class="section-header">
					  				<h3>Aún no tiene productos</h3>
					  			</header>
					</div>
				</div>
				@endif

				<div class="row mb-4 d-flex align-items-stretch">
					@foreach($productos as $producto)
					<div class="col-md-4 mb-4">

						<div class="fondo-foto"
							@if($producto->foto == null)
							style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
							@else 
							style="background-image: url('{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $producto->foto ) }}');"
							@endif
							>
						
							<div class="fondo">
								<h6 class="border-bottom">{{ title_case($producto->nombre) }}</h6>
								<p>{{ $producto->descripcion }}</p>
								<p><a 
									@if($producto->foto == null)
									href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
									@else
									href="{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $producto->foto ) }}"
									@endif 
									rel="lightbox">Ampliar imagen</a></p>
									<form action="{{ route('agregar.carrito' , $producto->id) }}" method="get">
										@csrf
						
										<h6>${{ number_format($producto->precio) }}</h6>
									
										<button type="submit" class="btn btn-primary rounded-circle btn-small floating">
											<i class="fa fa-plus"></i>
										</button>
									</form>

							</div>
						</div>


						
					</div>
					@endforeach
				</div>

					
					  </div>
					  <div class="tab-pane fade {{isset($_GET['page'])? 'show active' : ''}}" id="informacion" role="tabpanel" aria-labelledby="pills-profile-tab">

					  
					  	<section id="skills" class="p-0">
					      <div class="container">

					      	<div class="row">
					      		<div class="col-md-4">
					      			 @if($tienda->logo_local != null)
									 <img src="{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->logo_local) }}" style="max-width: 100px;" class="mr-4 float-left" alt="Logo {{ $tienda->nombre }}">
									@else
									 <img src="{{ asset('images/paw.png') }}" style="max-width: 100px;" class="mr-4 float-left" alt="Logo {{ $tienda->nombre }}">
									@endif
					      		</div>

					      		<div class="col-md-8">
					      			<header class="section-header">

					        	

					          <h3>{{ title_case($tienda->nombre) }}</h3>

					          <p>{{ $tienda->descripcion }}</p>

					          @if($tienda->twitter != null || $tienda->facebook != null || $tienda->instagram != null || $tienda->googleplus != null || $tienda->linkedin != null )
							  	<div class="row mb-4">
							  		<div class="col text-right">
							  			<div class="social-links">
							  			@if($tienda->twitter != null)
							              <a href="{{ $tienda->twitter }}" class="twitter p-2 background-primary text-white"><i class="fa fa-twitter"></i></a>
							            @endif

							            @if($tienda->facebook != null)
							              <a href="{{ $tienda->facebook }}" class="facebook p-2 background-primary text-white"><i class="fa fa-facebook"></i></a>
							            @endif

							            @if($tienda->instagram != null)
							              <a href="{{ $tienda->instagram }}" class="instagram p-2 background-primary text-white"><i class="fa fa-instagram"></i></a>
							            @endif

							            @if($tienda->googleplus != null)
							              <a href="{{ $tienda->googleplus }}" class="google-plus p-2 background-primary text-white"><i class="fa fa-google-plus"></i></a>
							            @endif

							            @if($tienda->linkedin != null)
							              <a href="{{ $tienda->linkedin }}" class="linkedin p-2 background-primary text-white"><i class="fa fa-linkedin"></i></a>
							            @endif
							            </div>
							  		</div>
							  	</div>
							  	@endif
					        </header>
					      		</div>
					      	</div>

					        

					  			
					  			<div class="row mb-4">
					  				<div class="col">
					  					@if($tienda->email != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-envelope color-primary mr-4"></i> <a href="mailto:{{ $tienda->email }}">{{ $tienda->email }}</a></p>
							  			@endif

							  			@if($tienda->telefono != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-phone color-primary mr-4"></i> {{ $tienda->telefono }}</p>
							  			@endif

							  			@if($tienda->contacto != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-user color-primary mr-4"></i> {{ $tienda->contacto }}</p>
							  			@endif
					  				</div>
					  			</div>

					  			
							
							@if($tienda->verEstadisticas()->total == 0)
							<h3>Esta tienda aún no tiene comentarios</h3>
							@else
					        <div class="skills-content">



					          <div class="progress">
					            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $tienda->verEstadisticas()->excelente }}" aria-valuemin="0" aria-valuemax="100">
					              <span class="skill">Excelente <i class="val">{{ round($tienda->verEstadisticas()->excelente) }}%</i></span>
					            </div>
					          </div>

					          <div class="progress">
					            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $tienda->verEstadisticas()->muybueno }}" aria-valuemin="0" aria-valuemax="100">
					              <span class="skill">Muy Bueno <i class="val">{{ round($tienda->verEstadisticas()->muybueno) }}%</i></span>
					            </div>
					          </div>

					          <div class="progress">
					            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ $tienda->verEstadisticas()->bueno }}" aria-valuemin="0" aria-valuemax="100">
					              <span class="skill">Bueno <i class="val">{{ round($tienda->verEstadisticas()->bueno) }}%</i></span>
					            </div>
					          </div>

					          <div class="progress">
					            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ $tienda->verEstadisticas()->regular }}" aria-valuemin="0" aria-valuemax="100">
					              <span class="skill">Regular <i class="val">{{ round($tienda->verEstadisticas()->regular) }}%</i></span>
					            </div>
					          </div>

					          <div class="progress">
					            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $tienda->verEstadisticas()->malo }}" aria-valuemin="0" aria-valuemax="100">
					              <span class="skill">Malo <i class="val">{{ round($tienda->verEstadisticas()->malo) }}%</i></span>
					            </div>
					          </div>

					        </div>

					        
					        @endif
							
							@guest
							@else
					        <div class="row">
					        	<div class="col text-right">
					        		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#comment">Publicar comentario</button>
					        	</div>
					        </div>
					        @endguest

					        @foreach($tienda->getComentarios() as $comentario)
					        	<div class="row mb-4">
									<div class="col-md-3 text-center">
										@if($comentario->user->foto_perfil == null)
										<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded mb-4" alt="">
										@else
										<img src="{{ asset('storage/archivos/' . $comentario->user->id . '/' . $comentario->user->foto_perfil) }}" style="max-width: 100px;" class="img-fluid rounded mb-4" alt="">
										@endif
										<p class="mb-0 pb-0">{{ $comentario->user->nombre }} {{ $comentario->user->apellido }}</p>
										<p>{{ $comentario->created_at->format('d/m/Y') }}</p>
									</div>

									<div class="col">
										
										<p>"{{ $comentario->comentario }}"</p>
									</div>
								</div>
					        @endforeach

					        <div class="row">
					        	<div class="col">
					        		{{ $tienda->getComentarios()->links() }}
					        	</div>
					        </div>

					      </div>
					    </section>

					  

					 	
						
						
						
						
						

					  </div>
					  
			</div>

					
					
				</div>

				<div class="col-4 pt-4 pb-4 mt-4 mb-4 d-none d-lg-block">
						<div id="scroller-anchor"></div>
					<div class="row" id="scroller">
						<div class="col text-center border p-4 bg-white">
							<h6 class="mb-4">Mi Pedido <span class="badge badge-primary background-primary">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/paw.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
										<div class="col"></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ $total += $carro->price * $carro->qty }}</div>
										<div class="col"><a href="{{ route('eliminar.carrito' , $carro->rowId) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a></div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ $total }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-primary">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>
				</div>
	</div>
</div>

	@if($tienda->direccion != null)
					  
					  		<div class="map-container">
					  			<input type="hidden" name="latitud" id="lat" value="{{ $tienda->latitud }}">
								<input type="hidden" name="longitud" id="long" value="{{ $tienda->longitud }}">
					  			<div id="map"></div>
					  			<div class="dir"><p>{{ $tienda->direccion }}</p></div>
					  		</div>
					  	
					  	@endif

<button class="btn btn-primary btn-carrito d-lg-none" data-toggle="modal" data-target="#carrito-mobile"><i class="fa fa-shopping-cart"></i> {{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</button>

 <div class="modal fade" id="carrito-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
              
              	<h6 class="modal-title" id="exampleModalLongTitle">Mi Pedido <span class="badge badge-primary background-primary">{{ $carrito->count() > 0 ? ' '. $carrito->count() : ''}}</span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">

              	<div class="row">
						<div class="col text-center p-4">
							
									@if($carrito->count() == 0)
								<div class="contenedor-carrito mx-auto">
									<img src="{{ asset('images/paw.png') }}" class="img-fluid img-carrito mb-4" alt="">
								</div>
							<p class="mb-4">Aún no tienes pedidos</p>
									@else
									<div class="row mb-4 text-left">
										<div class="col-2"><strong>Cant.</strong></div>
										<div class="col"><strong>Nombre</strong></div>
										<div class="col"><strong>Precio</strong></div>
										<div class="col"></div>
									</div>
									<hr>

									@foreach($carrito as $carro)
									<div class="row mb-4 text-left">
										<div class="col-2">{{ $carro->qty }}</div>
										<div class="col">{{ $carro->name }} {{ $carro->options->sabor }}</div>
										<div class="col">${{ number_format($totalMobile += $carro->price * $carro->qty , 0  , ',' , '.') }}</div>
										<div class="col"><a href="{{ route('eliminar.carrito' , $carro->rowId) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a></div>
									</div>
									<hr>
									@endforeach

									<div class="row mb-4 text-left">
										<div class="col-2"></div>
										<div class="col"><strong>Total:</strong></div>
										<div class="col"><strong>${{ number_format($totalMobile , 0  , ',' , '.') }}</strong></div>
									</div>

									<div class="row">
										<div class="col text-center">
											<a href="{{ route('ordenar' , [$tienda->slug]) }}" class="btn btn-primary">Ordenar</a>
										</div>
									</div>

									@endif
						</div>
					</div>

              </div>
            </div>
          </div>
        </div>


        @guest
        @else
        <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Publicar comentarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('usuario.comentar') }}" method="post">
      <div class="modal-body">
       
          @csrf
          <input type="hidden" id="user_id" name="negocio_id" value="{{$tienda->id}}">
          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
          
          <div class="row">
            <div class="col-md-4">
               <label class="col-form-label">Valoración:</label>
            </div>
            <div class="col-md-8">
              <div class="estrellas">
          <p class="clasificacion">
            <input id="radio1" type="radio" name="puntos" value="5"><!--
            --><label for="radio1">★</label><!--
            --><input id="radio2" type="radio" name="puntos" value="4"><!--
            --><label for="radio2">★</label><!--
            --><input id="radio3" type="radio" name="puntos" value="3"><!--
            --><label for="radio3">★</label><!--
            --><input id="radio4" type="radio" name="puntos" value="2"><!--
            --><label for="radio4">★</label><!--
            --><input id="radio5" type="radio" name="puntos" value="1"><!--
            --><label for="radio5">★</label>
          </p>
          </div>
            </div>
          </div>
          

          <div class="form-group">
            <label for="message-text" class="col-form-label">Comentario:</label>
            <textarea class="form-control" id="message-text" name="comentario"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Comentar</button>
      </div>
      </form>
    </div>
  </div>
</div>
        @endguest
@endsection
@section('scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<script>

	function moveScroller() {
    var $anchor = $("#scroller-anchor");
    var $scroller = $('#scroller');

    var move = function() {
        var st = $(window).scrollTop();
        var ot = $anchor.offset().top - 80;
        if(st > ot) {
            $scroller.css({
                position: "fixed",
                top: "80px",
                zIndex: "999"
            });
        } else {
            $scroller.css({
                position: "relative",
                top: ""
            });
        }
    };
    $(window).scroll(move);
    move();
}

moveScroller();

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

			$('#favorito-btn').click(function(e){
				e.preventDefault();
				tipo = 'tienda';
	        	id = $(this).attr('rel');
	        	
	        	$.ajax({

		           type:'POST',
		           url:"{{route('usuario.agregar.favorito')}}",
		           data:{ tipo:tipo,
		           			id:id 
		           		},
		           success:function(data){
		           	//console.log(data);
		           	if(data.estatus == 'guardado')
		           	{
		           		$('#icono-fav').removeClass('text-white');
		           		$('#icono-fav').addClass('text-danger');
		           	}else{
		           		$('#icono-fav').removeClass('text-danger');
		           		$('#icono-fav').addClass('text-white');
		           	}
		           }

		        });
			});

			lat = $('#lat').val();
			long = $('#long').val();

			mapboxgl.accessToken = 'pk.eyJ1Ijoiam95ZGlzZW5vcyIsImEiOiJjanhsNjl1OHMwMnVoM3hxZWtjamJxeGpoIn0.fsWaR9XzZr2IcBCNZCzQ6A';

			var map2 = new mapboxgl.Map({
			container: 'map', 
			style: 'mapbox://styles/joydisenos/cjz7xli4s374q1cpg1h3hcvbj?optimize=true',
			center: [long, lat],
			zoom: 13 
			});

			markerCurrent = new mapboxgl.Marker()
				.setLngLat([long, lat])
				.addTo(map2);
</script>
@endsection