<div class="col-md-3 pt-4 pb-4 mt-4 mb-4">

	<div class="text-center">
		@guest
		<img src="{{ asset('images/perfil.png') }}" style="max-width: 100px;" class="img-fluid rounded-circle" alt="">
		@else
		<img src="{{ asset('storage/archivos/' . Auth::user()->id . '/' . Auth::user()->foto_perfil) }}" style="max-width: 100px;" class="img-fluid rounded-circle" alt="">
		@endif
		<h6 class="m-3">Usuario</h6>
	</div>
	<ul class="list-group list-group-flush">

		<a href="{{ route('admin.usuarios') }}">
		  	<li class="list-group-item">
			  	<i class="fa fa-users mr-3" aria-hidden="true"></i> Categorías
			</li>
		</a>

		
	</ul>

</div>