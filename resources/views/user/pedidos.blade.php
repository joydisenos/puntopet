@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Mi Cuenta')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			@if($pedidos->count() == 0)
			<h6 class="mb-4">Aún no tienes pedidos, Explora todas las mejores tiendas y hogares para tu mascota!</h6>
						<a href="{{ route('tiendas') }}" class="btn btn-primary">Tiendas</a>
						<a href="{{ route('hogares') }}" class="btn btn-primary">Hogares</a>
			@else
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Orden</th>
						<th>Fecha</th>
						<th>Productos</th>
						<th>Detalles</th>
						<th>Total</th>
						<th>Estatus</th>
					</thead>
					<tbody>
						@foreach( $pedidos as $pedido )
							<tr>
								<td>{{ $pedido->id }}</td>
								<td>{{ $pedido->created_at->format('d-m-Y') }}</td>
								<td>{{ $pedido->productos->count() }}</td>
								<td><a href="{{ route('usuario.ver.orden' , $pedido->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
								<td>${{ number_format($pedido->total) }}</td>
								<td>{{ $pedido->verEstatus($pedido->estatus) }}</td>
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