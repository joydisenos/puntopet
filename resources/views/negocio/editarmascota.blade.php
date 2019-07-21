@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Editar Macota')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.actualizar.mascota' , [$mascota->id]) }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row mb-4">
					<div class="col">
						<h5>Hogar</h5>
					</div>
					<div class="col">
						<select name="hogar_id" class="form-control" required>
								<option {{ $mascota->hogar_id == null ? 'selected' : '' }}>Seleccione un hogar</option>
							@foreach(Auth::user()->hogares as $hogar)
								<option value="{{ $hogar->id }}" {{ $mascota->hogar_id == $hogar->id? 'selected' : '' }}>{{ $hogar->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col text-center">
						@if($mascota->foto == null)
						<img src="{{ asset('images/paw.png') }}" class="img-fluid" style="max-width: 100px" alt="Imagen {{ $mascota->nombre }}">
						@else
						<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . $mascota->foto) }}" class="img-fluid" alt="Imagen {{ $mascota->nombre }}">
						@endif
					</div>
					<div class="col">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>

				<div class="row mb-4">

					<div class="col">
						<input type="text" name="nombre" value="{{ $mascota->nombre }}" placeholder="Nombre" class="form-control">
					</div>
					
				</div>

				<div class="row mb-4">
					<div class="col">
						<textarea name="descripcion" placeholder="Descripción" cols="30" rows="10" class="form-control">{{ $mascota->descripcion }}</textarea>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-primary">
							Actualizar
						</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
</div>
@endsection