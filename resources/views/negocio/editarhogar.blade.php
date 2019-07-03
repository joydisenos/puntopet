@extends('master.front')
@section('content')

@component('components.header')
    @slot('titulo' , 'Editar Hogar ' . title_case($hogar->nombre))
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<form action="{{ route('hogar.actualizar' , [$hogar->id]) }}" method="post" enctype="multipart/form-data">
				@csrf

				@component('components.negocios')
				@slot('negocio' , $hogar)
				@endcomponent

				<div class="row mb-4">
					<div class="col">
						<button class="btn btn-primary">
							Actualizar
						</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
</div>
@endsection