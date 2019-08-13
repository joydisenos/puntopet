@extends('master.front')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Editar slider principal')
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
								<th>Destacar</th>
								<th>Nombre</th>
								<th>Productos</th>
								<th>Fecha de registro</th>
							</thead>
							<tbody class="list">
								@foreach($tiendas as $tienda)
								<tr>
									<td>
											
										    <input type="checkbox" class="activar" data-id="{{ $tienda->id }}" {{ $tienda->destacado == 1? 'checked' : '' }}>
										 
									</td>
									<td>{{ $tienda->nombre }}</td>
									<td>{{ $tienda->productos->count() }}</td>
									<td>{{ $tienda->created_at->format('d/m/Y') }}</td>
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

	<script>
		$.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });

		$('.activar').change(function(){
			button = $(this);
			tiendaId = button.data('id');

			$.ajax({
	           type:'POST',
	           url:"{{route('admin.slider.destacar')}}",
	           data:{ 
	           			id:tiendaId 
	           		},

	           success:function(data){
	           	console.log(data);
	           	if(data.estatus == 1)
	           	{
	           		button.prop('checked' , true);
	           	}else{
	           		button.prop('checked' , false);
	           	}
	           }

	        });
		});
	</script>
@endsection