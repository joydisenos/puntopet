@extends('master.front')

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/ui/trumbowyg.css" rel="stylesheet">
@endsection


@section('content')

@component('components.header')
    @slot('titulo' , 'Editar Post ' . title_case($post->titulo))
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<form action="{{ route('usuario.actualizar.post' , [$post->slug]) }}" method="post" enctype="multipart/form-data">

				@component('components.post')
				@slot('post' , $post)
				@endcomponent

				<div class="row mb-4">
						<div class="col">
							<button class="btn btn-primary" type="submit">
								Actualizar
							</button>
						</div>
					</div>
				
			</form>
			
			
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/trumbowyg.min.js"></script>
<script>
  $(document).ready(function(){
    $('#editor').trumbowyg();
  });
</script>
@endsection