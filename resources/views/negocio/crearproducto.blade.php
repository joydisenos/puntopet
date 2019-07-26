@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Crear Producto')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('negocio.guardar.producto') }}" method="post" enctype="multipart/form-data">
				@csrf
				
				<div class="row mb-4">
					<div class="col">
						<h5>Seleccionar tienda</h5>
					</div>
					<div class="col">
						<select name="negocio_id" class="form-control" required>
								<option>Seleccione una tienda</option>
							@foreach(Auth::user()->negocios as $negocio)
								<option value="{{ $negocio->id }}">{{ $negocio->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row mb-4">
					<div class="col"></div>
					<div class="col">
						<input type="file" name="foto" class="form-control">
					</div>
				</div>

				<div class="row mb-4">

					<div class="col">
						<input type="text" name="nombre" placeholder="Nombre" class="form-control">
					</div>

					<div class="col">
						<input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control">
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