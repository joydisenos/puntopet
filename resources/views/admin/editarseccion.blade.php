@extends('master.front')

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.18.0/ui/trumbowyg.css" rel="stylesheet">
@endsection


@section('content')

@component('components.header')
    @slot('titulo' , title_case($legal->nombre))
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">
			
			<form action="{{ route('admin.actualizar.seccion' , $legal->id) }}" method="post">
				@csrf
				<div class="row">
					<div class="col">
						<h4>{{ title_case($legal->nombre) }}</h4>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>

				@if($legal->valor != null)
				<div class="row">
					<div class="col">
						<input type="nomber" min="0" step="any" name="valor" class="form-control" value="{{ $legal->valor }}" required>
					</div>
				</div>
				@endif
				
				@if($legal->texto != null)
				<div class="row">
					<div class="col">
						<textarea name="texto" class="form-control" cols="30" rows="10" id="editor" required>{{ $legal->texto }}</textarea>
					</div>
				</div>
				@endif
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