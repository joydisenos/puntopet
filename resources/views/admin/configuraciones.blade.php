@extends('master.front')

@section('content')

@component('components.header')
    @slot('titulo' , 'Configuraciones')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

	
			
				<div class="row">
					<div class="col">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<th>Sección</th>
									<th>Texto</th>
									<th>Valor</th>
									<th>Modificar</th>
								</thead>
								<tbody>
									<tr>
										<td><strong>Tipos de Negocio</strong></td>
										<td></td>
										<td></td>
										<td class="text-center">
											<a href="{{ route('admin.editar.tipos.negocio') }}" class="btn btn-primary">Administrar</a>
										</td>
									</tr>
									@foreach($legales as $legal)
									<tr>
										<td><strong>{{ title_case($legal->nombre) }}</strong></td>
										<td>{{ str_limit($legal->texto , 30) }}</td>
										<td>{{ $legal->valor }}</td>
										<td class="text-center">
											<a href="{{ route('admin.editar.seccion' , $legal->slug) }}" class="btn btn-primary">
												Modificar
											</a>
										</td>
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
