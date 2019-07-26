@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Clics ' . title_case($negocio->nombre))
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
						<th>Referido</th>
						<th>Último Registro</th>
					</thead>
					<tbody>
						@foreach($sesiones as $sesion)
						<tr>
							<td>{{ $sesion->session->client_ip }}</td>
							<td>{{ $sesion->session->user ? $sesion->session->user->email : '' }}</td>
							<td>{{ $sesion->referer->url }}</td>
							<td>{{ $sesion->session->updated_at->format('d-m-Y') }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
		</div>
	</div>
</div>
@endsection