@extends('master.front')

@section('header')
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
		background-color: #18D26E !important;
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
    @slot('puntos')
    	
    @endslot
@endcomponent

<div class="container">
	<div class="row">
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#mascotas" role="tab" aria-controls="pills-home" aria-selected="true">Mascotas</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#informacion" role="tab" aria-controls="pills-profile" aria-selected="false">Información</a>
					  </li>
					</ul>
				</div>
			</div>

			<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="mascotas" role="tabpanel" aria-labelledby="pills-home-tab">

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

					  	@if($hogar->descripcion != null)
					  	<div class="row mb-4">
					  		<div class="col">
					  			<p>{{ $hogar->descripcion }}</p>
					  		</div>
					  	</div>
					  	@endif

					  	@if($hogar->telefono != null)
					  	<div class="row">
					  		<div class="col">
					  			<p><strong>Teléfono</strong> {{ $hogar->telefono }}</p>
					  		</div>
					  	</div>
					  	@endif
						
						@if($hogar->direccion != null)
					  	<div class="row mb-4">
					  		<div class="col">
					  			<p><strong>Dirección:</strong> {{ $hogar->direccion }}</p>
					  		</div>
					  	</div>
					  	@endif
						
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
@endsection