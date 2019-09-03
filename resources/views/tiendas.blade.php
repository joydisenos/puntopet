@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Tiendas')
@endcomponent
			<div class="text-white bg-primary text-right p-2 rounded-right busqueda-toggle" id="btn-filtro">
					<i class="fa fa-filter"></i>
			</div>
<div class="container">
	<div class="row">

		<div class="col-md-2 pt-4 pb-4 mt-4 mb-0" id="filtros-buscar">

			
			
			<div class="row">
				<div class="col">
					<h6 class="text-center color-primary"><strong>Búsqueda</strong></h6>
					<hr class="color-primary">
				<form action="{{ route('buscar.tienda.nombre') }}" class="form-buscar">
					<input type="text" placeholder="Nombre" class="form-control bg-primary text-white mb-3" value="{{ isset($_GET['nombre']) ? $_GET['nombre'] : '' }}" name="nombre">

					<select name="tipo" class="form-control bg-primary text-white mb-3">
						<option value="">Tipo de Negocio</option>
						@foreach(App\Clase::clases() as $clase)
						<option value="{{ $clase->slug }}" {{ isset($_GET['tipo']) && $_GET['tipo'] == $clase->slug ? 'selected' : '' }}>{{ title_case($clase->nombre) }}</option>
						@endforeach
					</select>

					<select name="ciudad" class="form-control bg-primary text-white mb-3" id="">
						<option value="">Ciudad</option>
						@foreach(App\Ciudad::ciudades() as $ciudad)
						<option value="{{ $ciudad->slug }}" {{ isset($_GET['ciudad']) && $_GET['ciudad'] == $ciudad->slug ? 'selected' : '' }}>{{ title_case($ciudad->nombre) }}</option>
						@endforeach
					</select>

					<select name="comuna" class="form-control bg-primary text-white mb-3" id="">
						<option value="">Comuna</option>
						@foreach(App\Comuna::comunas() as $comuna)
						<option value="{{ $comuna->slug }}" {{ isset($_GET['comuna']) && $_GET['comuna'] == $comuna->slug ? 'selected' : '' }}>{{ title_case($comuna->nombre) }}</option>
						@endforeach
					</select>

					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
				
				

				</div>
			</div>

			
			
		</div>
		
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<div class="row">

				@if($tiendas->count() == 0)
					<div class="col text-center">

						<h2>No se encontraron tiendas!</h2>
						<img src="{{ asset('images/paw.png') }}" style="max-width: 300px" alt="">
					</div>
				@endif
				
			@foreach($tiendas as $tienda)
				<div class="col-md-3 m-0 p-0 p-md-1">
					<a href="{{ route('ver.tienda' , [$tienda->slug]) }}">
					
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