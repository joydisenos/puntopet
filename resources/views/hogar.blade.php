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
	#map{
		height: 300px;
		width: 100%;
		overflow: hidden;
	}
	.map-container{
		position: relative;
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
	@if($hogar->foto_local != null )
	.header-panel{
		background-image: url('{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $hogar->foto_local ) }}') !important;
		background-position: center center;
		background-size: cover;
	}
	@endif

</style>
@endsection

@section('content')

@component('components.headertienda')
	@slot('logo')
		@if($hogar->logo_local != null)
		 <img src="{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $hogar->logo_local) }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $hogar->nombre }}">
		@else
		 <img src="{{ asset('images/paw.png') }}" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $hogar->nombre }}">
		@endif
	@endslot
    @slot('titulo' , title_case($hogar->nombre))
    @slot('negocio_id' , $hogar->id)
    @slot('puntos')
    	
    @endslot
@endcomponent
@include('includes.compartir')

<section class="botones">

	<div class="container">
		<div class="row">

			<div class="col">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#mascotas" role="tab" aria-controls="pills-home" aria-selected="true">Mascotas en adopción</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#informacion" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
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
					<div class="tab-pane fade show active" id="mascotas" role="tabpanel" aria-labelledby="pills-home-tab">

								
				@if($hogar->mascotas->count() > 0)
				<div class="row">
					<div class="col">
								<header class="section-header">
					  				<h3>Mascotas en adopción</h3>
					  			</header>
					</div>
				</div>
				@endif

								<div class="row mb-4">
									
									@foreach($hogar->mascotas as $mascota)
									<div class="col-md-4 mb-4">
										
											
											<div class="fondo-foto"
											@if($mascota->foto == null)
											style="background-image: url('{{ asset( 'img/channey-528973-unsplash.jpg' ) }}');"
											@else 
											style="background-image: url('{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $mascota->foto ) }}');"
											@endif
											>
											
												<div class="fondo">
													<h6 class="border-bottom">{{ $mascota->nombre }}</h6>
													<p>{{ $mascota->descripcion }}</p>
													<p><a 
														@if($mascota->foto == null)
														href="{{ asset( 'img/channey-528973-unsplash.jpg' ) }}"
														@else
														href="{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $mascota->foto ) }}"
														@endif 
														rel="lightbox">ver foto</a></p>
												</div>
											</div>
											
									</div>
									@endforeach

								</div>

					
					 </div>

					<div class="tab-pane fade" id="informacion" role="tabpanel" aria-labelledby="pills-profile-tab">

					  	
						<section id="skills" class="p-0">
					      <div class="container">

					      	<div class="row">
					      		<div class="col-md-4">
					      			@if($hogar->logo_local != null)
									 <img src="{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $hogar->logo_local) }}" style="max-width: 100px;" class="mr-4 float-left" alt="Logo {{ $hogar->nombre }}">
									@else
									 <img src="{{ asset('images/paw.png') }}" style="max-width: 100px;" class="mr-4 float-left" alt="Logo {{ $hogar->nombre }}">
									@endif
					      		</div>
					      		<div class="col-md-8">
					      			 <header class="section-header">

					        	 

					          <h3>{{ title_case($hogar->nombre) }}</h3>

					          <p>{{ $hogar->descripcion }}</p>

					          @if($hogar->twitter != null || $hogar->facebook != null || $hogar->instagram != null || $hogar->googleplus != null || $hogar->linkedin != null )
							  	<div class="row mb-4">
							  		<div class="col text-right">
							  			<div class="social-links">
							  			@if($hogar->twitter != null)
							              <a href="{{ $hogar->twitter }}" class="twitter p-2 background-primary text-white"><i class="fa fa-twitter"></i></a>
							            @endif

							            @if($hogar->facebook != null)
							              <a href="{{ $hogar->facebook }}" class="facebook p-2 background-primary text-white"><i class="fa fa-facebook"></i></a>
							            @endif

							            @if($hogar->instagram != null)
							              <a href="{{ $hogar->instagram }}" class="instagram p-2 background-primary text-white"><i class="fa fa-instagram"></i></a>
							            @endif

							            @if($hogar->googleplus != null)
							              <a href="{{ $hogar->googleplus }}" class="google-plus p-2 background-primary text-white"><i class="fa fa-google-plus"></i></a>
							            @endif

							            @if($hogar->linkedin != null)
							              <a href="{{ $hogar->linkedin }}" class="linkedin p-2 background-primary text-white"><i class="fa fa-linkedin"></i></a>
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
					  					@if($hogar->email != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-envelope color-primary mr-4"></i> <a href="mailto:{{ $hogar->email }}">{{ $hogar->email }}</a></p>
							  			@endif

							  			@if($hogar->telefono != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-phone color-primary mr-4"></i> {{ $hogar->telefono }}</p>
							  			@endif

							  			@if($hogar->contacto != null)
							  				<p class="ml-4 mb-1"><i class="fa fa-user color-primary mr-4"></i> {{ $hogar->contacto }}</p>
							  			@endif
					  				</div>
					  			</div>

					  			

					        

					      </div>
					    </section>

					  	
						
						
						
						<div class="row">
					  	@foreach($hogar->fotos as $foto)
						<div class="col-md-4 mb-4">
							
								
								<div class="fondo-foto" style="background-image: url('{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $foto->archivo ) }}');">
								
									<div class="fondo">
										<p class="border-bottom">{{ $foto->nombre }}</p>
										<p><a href="{{ asset( 'storage/archivos/'. $hogar->user->id . '/' . $foto->archivo ) }}" rel="lightbox">ver foto</a></p>
									</div>
								</div>
								
						</div>
						@endforeach
						</div>

						
						
						

					</div>
					  
			</div>

					
					
		</div>

				
	</div>
</div>

<section class="map">
	@if($hogar->direccion != null)
					  	
					  		<div class="map-container">
					  			<input type="hidden" name="latitud" id="lat" value="{{ $hogar->latitud }}">
								<input type="hidden" name="longitud" id="long" value="{{ $hogar->longitud }}">
					  			<div id="map"></div>
					  			<div class="dir"><p>{{ $hogar->direccion }}</p></div>
					  		</div>
					
					  	@endif
</section>
@endsection
@section('scripts')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<script>

				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });

			$('#favorito-btn').click(function(e){
				e.preventDefault();
				tipo = 'hogar';
	        	id = $(this).attr('rel');
	        	
	        	$.ajax({

		           type:'POST',
		           url:"{{route('usuario.agregar.favorito')}}",
		           data:{ tipo:tipo,
		           			id:id 
		           		},
		           success:function(data){
		           	console.log(data);
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
			zoom: 9 
			});

			markerCurrent = new mapboxgl.Marker()
				.setLngLat([long, lat])
				.addTo(map2);
</script>
@endsection