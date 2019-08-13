@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Administrar tipos de negocio')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col-md-9 pt-4 pb-4 mt-4 mb-4">

		<form action="{{ route('admin.registrar.tipos.negocio') }}" method="POST">
			@csrf
			<div class="row mb-4">
					<div class="col-md-8">
						<input type="text" id="buscar" class="form-control" name="nombre" placeholder="Buscar o agregar">
					</div>
					<div class="col-md-4 text-right">
						<button type="submit" class="btn btn-primary">Registrar</button>
					</div>
			</div>
		</form>
			
			<div class="row">
				<div class="col">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>Nombre</th>
								<th>Tiendas</th>
								<th></th>
							</thead>
							<tbody class="list">

								@foreach($tipos as $tipo)
								<tr>
									<td>{{ title_case($tipo->nombre) }}</td>
									<td>{{ $tipo->tiendas->count() }}</td>
									<td><a href="{{ route('admin.eliminar.tipos.negocio' , $tipo->id) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a></td>
								</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</div>
@endsection