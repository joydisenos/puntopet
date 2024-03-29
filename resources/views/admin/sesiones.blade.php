@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Sesiones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<th>Nombre</th>
						<th>User</th>
						<th>Visitas</th>
						<th>Detalles</th>
					</thead>
					<tbody>
						@foreach($negocios as $negocio)
						<tr>
							<td>{{ $negocio->nombre }}</td>
							<td>{{ $negocio->user ? $negocio->user->nombre : '' }}</td>
							<td>{{ $negocio->visitas() }}</td>
							<td><a href="{{ route('admin.sesiones.negocio' , $negocio->slug ) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection