@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Historial de Ventas')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Negocio</th>
						<th>Ventas</th>
						<th>Total</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($negocios as $negocio)
						<tr>
							<td>{{ $negocio->nombre }}</td>
							<td>{{ $negocio->ventas->count() }}</td>
							<td>${{ number_format($negocio->ventas->sum('total') , 0 , ',' , '.') }}</td>
							<td><a href="{{ route('negocio.ventas.negocio' , [$negocio->slug]) }}" class="btn btn-primary">Ventas</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
			
			
		</div>
	</div>
</div>
@endsection