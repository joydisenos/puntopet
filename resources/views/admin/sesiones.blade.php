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
						<th>IP</th>
						<th>User</th>
						<th>Visitas</th>
						<th>Último Registro</th>
					</thead>
					<tbody>
						@foreach($sesiones as $sesion)
						<tr>
							<td>{{ $sesion->client_ip }}</td>
							<td>{{ $sesion->user ? $sesion->user->email : '' }}</td>
							<td>{{ $sesion->log->count() }}</td>
							<td>{{ $sesion->updated_at->format('d-m-Y') }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection