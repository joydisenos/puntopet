@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Historial de Ventas')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			@if($ventas->count() == 0)
			<div class="text-center">
				<h6>Aún no tienes ventas, comparte tu tienda para que comiences a generar más ventas!</h6>
			</div>
			@else
			<div class="row mb-4">
							<div class="col">
								<input type="text" id="buscar" class="form-control" placeholder="Buscar">
							</div>
						</div>

			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Usuario</th>
						<th>Detalles</th>
						<th>Envío</th>
						<th>Pago</th>
						<th>Estatus</th>
						<th>Marcar</th>
					</thead>
					<tbody class="list">
						@foreach($ventas as $venta)
						<tr>
							<td>{{ $venta->id }}</td>
							<td>{{ $venta->user->nombre }}</td>
							<td><a href="{{ route('negocio.ver.orden' , $venta->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
							<td>{{ $venta->envio }}</td>
							<td>{{ $venta->pago }}</td>
							<td>{{ $venta->verEstatus($venta->estatus) }}</td>
							<td>
								@if($venta->estatus == 1)
								<a href="{{ route('negocio.estatus.orden' , [$venta->id , 2]) }}" class="btn btn-success"><i class="fa fa-check"></i></a>
								<a href="{{ route('negocio.estatus.orden' , [$venta->id , 0]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif
			
			
			
		</div>
	</div>
</div>
@endsection
@section('scripts')
	@include('includes.busqueda')
@endsection