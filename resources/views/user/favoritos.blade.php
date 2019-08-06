@extends('master.front')
@section('header')
<style>
	.negocio-row{
		padding: 20px;
		box-shadow: 0px 0px 0px rgba(0,0,0,0);
		transition: all ease .5s;
	}
	.negocio-row:hover{
		transform: translateY(-10px);
		box-shadow: 5px 5px 30px rgba(0,0,0,0.3);
	}
	.hidden{
		display: none;
	}
</style>
@endsection

@section('content')

@component('components.header')
    @slot('titulo' , 'Favoritos')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

						@if($favoritosTienda->count() == 0 && $favoritosHogar->count() == 0)
						<h6 class="mb-4">Aún no tienes favoritos, explora todas las mejores tiendas y hogares para tu mascota!</h6>
						<a href="{{ route('tiendas') }}" class="btn btn-primary">Tiendas</a>
						<a href="{{ route('hogares') }}" class="btn btn-primary">Hogares</a>
						@endif
						
						<div class="row">

						@foreach($favoritosTienda as $favorito)
						
							<div class="col-md-6 mb-4 negocio-row">
							<div class="row">
								<div class="col-4 text-center">
									@if($favorito->tienda->logo_local == null)
									<img src="{{ asset('images/paw.png') }}" style="max-height: 150px;" class="img-fluid" alt="{{ $favorito->tienda->nombre }}">
									@else
									<img src="{{ asset( 'storage/archivos/'. $favorito->tienda->user->id . '/' . $favorito->tienda->logo_local) }}" style="max-height: 150px;" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $favorito->tienda->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($favorito->tienda->nombre) }}</strong></h3>

									<div class="row">
										
										<div class="col">
											
											
											<a href="{{ route('ver.tienda' , [$favorito->tienda->slug]) }}" class="btn btn-primary">Visitar Tienda</a>
											
										</div>
									</div>

								</div>
							</div>
							</div>
						
						@endforeach

						@foreach($favoritosHogar as $favorito)
						
							<div class="col-md-6 mb-4 negocio-row">
							<div class="row">
								<div class="col-4 text-center">
									@if($favorito->hogar->logo_local == null)
									<img src="{{ asset('images/paw.png') }}" style="max-height: 150px;" class="img-fluid" alt="{{ $favorito->hogar->nombre }}">
									@else
									<img src="{{ asset( 'storage/archivos/'. $favorito->hogar->user->id . '/' . $favorito->hogar->logo_local) }}" style="max-height: 150px;" class="img-fluid logo-hogar d-inline rounded mr-1" alt="Logo {{ $favorito->hogar->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($favorito->hogar->nombre) }}</strong></h3>

									<div class="row">
										
										<div class="col">
											
											
											<a href="{{ route('ver.hogar' , [$favorito->hogar->slug]) }}" class="btn btn-primary">Visitar Hogar</a>
											
										</div>
									</div>

								</div>
							</div>
							</div>
						
						@endforeach
						</div>

		</div>
	</div>
</div>
@endsection