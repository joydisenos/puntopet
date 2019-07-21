@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mascotas')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

				<div class="row">
					<div class="col mb-4 text-right">
						<a href="{{ route('negocio.crear.mascota') }}" class="btn btn-primary">
							Nueva Mascota
						</a>
					</div>
				</div>
				@foreach($mascotas->chunk(3) as $row)
				<div class="row mb-4">
						@foreach($row as $mascota)
					<div class="col-md-4">
						<div class="card">
						  <div class="card-body">
						    <h5 class="card-title">{{ title_case($mascota->nombre) }}</h5>
						    <h6 class="card-subtitle mb-2 text-muted">{{ title_case($mascota->hogar->nombre) }}</h6>
						    <p class="card-text">{{ str_limit($mascota->descripcion , 40) }}</p>
						    <a href="{{ route('negocio.modificar.mascota' , $mascota->id) }}" class="btn btn-primary">Editar</a>
						  </div>
						</div>
					</div>
						@endforeach
				</div>
				@endforeach
			
		</div>
	</div>
</div>
@endsection