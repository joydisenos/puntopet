@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Crear Mascota')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.guardar.mascota') }}" method="post" enctype="multipart/form-data">
				@csrf
				
				<div class="row mb-4">
					<div class="col">
						<h5>Hogar</h5>
					</div>
					<div class="col">
						<select name="hogar_id" class="form-control" required>
								<option>Seleccione un Hogar</option>
							@foreach(Auth::user()->hogares as $hogar)
								<option value="{{ $hogar->id }}">{{ $hogar->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row mb-4">

					<div class="col">
						<input type="text" name="nombre" placeholder="Nombre" class="form-control">
					</div>

					<div class="col">
						<input type="file" name="foto" class="form-control">
					</div>					
				</div>

				<div class="row mb-4">
					<div class="col">
						<textarea name="descripcion" placeholder="Descripción" cols="30" rows="10" class="form-control"></textarea>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-primary">
							Crear
						</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
</div>
@endsection