@extends('master.front')

@section('header')
<style>
	.fondo-foto{
		height: 300px;
		width:100%;
		background-size: cover;
		background-position: center center;
	}
	.fondo{
		height: 100%;
		width: 100%;
		background: rgba(0,0,0,0.4);
		color: #ffffff;
		padding:30px;
		transition: all ease .5s;
	}
	.fondo:hover{
		background: rgba(0,0,0,0.7);
	}
	.fondo h3{
		border-bottom: solid medium #18d26e;
		font-weight: bold;
	}
	.fondo p{
		opacity: 0;
		transform: translateY(100px);
		transition: all ease .5s;
	}
	.fondo:hover p{
		opacity: 1;
		transform: translateY(0);
	}
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Hogares para mascotas')
@endcomponent

<div class="container">
	<div class="row">
		
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<h6>Búsqueda:</h6>
				</div>
				
				<div class="col">
					<form action="{{ route('buscar.hogar.nombre') }}" class="form-buscar">
						<input type="text" placeholder="Nombre" class="form-control" name="nombre">
					</form>
				</div>
				
				<div class="col">
					<form action="{{ route('buscar.hogar.nombre') }}" class="form-buscar">
					<select name="ciudad" class="form-control" id="">
						<option value="">Ciudad</option>
						@foreach(App\Ciudad::ciudades() as $ciudad)
						<option value="{{ $ciudad->slug }}">{{ title_case($ciudad->nombre) }}</option>
						@endforeach
					</select>
					</form>
				</div>
				<div class="col">
					<form action="{{ route('buscar.hogar.nombre') }}" class="form-buscar">
					<select name="comuna" class="form-control" id="">
						<option value="">Comuna</option>
						@foreach(App\Comuna::comunas() as $comuna)
						<option value="{{ $comuna->slug }}">{{ title_case($comuna->nombre) }}</option>
						@endforeach
					</select>
					</form>
				</div>
			</div>
			
			<div class="row">
				
			@foreach($tiendas as $tienda)
				<div class="col-md-3 m-0 p-0 p-md-1">
					<a href="{{ route('ver.hogar' , [$tienda->slug]) }}">
					
					@if($tienda->foto_local == null )
					<div class="fondo-foto" style="background-image: url('{{ asset('img/jannes-jacobs-683471-unsplash.jpg') }}');">
					@else
					<div class="fondo-foto" style="background-image: url('{{ asset( 'storage/archivos/'. $tienda->user->id . '/' . $tienda->foto_local ) }}');">
					@endif
						<div class="fondo">
							<h3>{{ $tienda->nombre }}</h3>
							<p>{{ str_limit($tienda->descripcion , 300) }}</p>
						</div>
					</div>
					</a>
				</div>	
			@endforeach

			</div>

		</div>


	</div>
</div>
@endsection