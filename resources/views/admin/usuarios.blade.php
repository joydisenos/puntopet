@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Usuarios')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col-md-9 pt-4 pb-4 mt-4 mb-4">

			<div class="row mb-4">
				<div class="col">
					<input type="text" id="buscar" class="form-control" placeholder="Buscar">
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>Nombre</th>
								<th>Email</th>
								<th>Tipo</th>
							</thead>
							<tbody class="list">
								@foreach($usuarios as $user)
								<tr>
									<td>{{ title_case($user->nombre) }} {{ title_case($user->apellido) }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->nombre_negocio != null ? 'Negocio' : 'Usuario' }}</td>
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
@section('scripts')
	@include('includes.busqueda')
@endsection