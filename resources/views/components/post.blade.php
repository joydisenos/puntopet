@csrf

			
				<div class="row mb-4">
					<div class="col">
						<label for="">Imagen del Post</label>
					</div>
					<div class="col">
						<input type="file" name="imagen" class="form-control" placeholder="Imagen">
					</div>
				</div>

				<div class="row mb-4">
					<div class="col">
						<input type="text" name="titulo" class="form-control" placeholder="Título del post" value="{{ isset($post) ? $post->titulo : ''}}" required>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<input type="text" name="palabras_clave" class="form-control" placeholder="Palabras clave (opcional)" value="{{ isset($post) ? $post->palabras_clave : ''}}" required>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col">
						<textarea name="mensaje" class="form-control" cols="30" rows="10" id="editor" required>{!! isset($post) ? $post->mensaje : ''!!}</textarea>
					</div>
				</div>
				