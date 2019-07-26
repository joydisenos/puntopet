@extends('master.front')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
	.negocio-row{
		margin-bottom: 20px;
		padding: 20px;
		box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
		transition: all ease .5s;
	}
	.negocio-row:hover{
		transform: translateY(-10px);
		box-shadow: 5px 5px 30px rgba(0,0,0,0.3);
	}
	.hidden{
		display: none;
	}
</style>
@endsection
@section('content')

@component('components.header')
    @slot('titulo' , 'Negocios registrados')
@endcomponent

<div class="container">
	<div class="row">
		@include('includes.nav-side')
		<div class="col pt-4 pb-4 mt-4 mb-4">

			<div class="row">
					<div class="col mb-4 text-right">
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#agregar_negocio">
							Crear Negocio
						</a>
					</div>
				</div>

			
						@foreach($negocios as $negocio)
						
							<div class="row negocio-row">
								<div class="col-4 text-center">
									@if($negocio->logo_local == null)
									<img src="{{ asset('images/paw.png') }}" style="max-height: 150px;" class="img-fluid" alt="{{ $negocio->nombre }}">
									@else
									<img src="{{ asset( 'storage/archivos/'. $negocio->user->id . '/' . $negocio->logo_local) }}" style="max-height: 150px;" class="img-fluid logo-tienda d-inline rounded mr-1" alt="Logo {{ $negocio->nombre }}">
									@endif
								</div>
								<div class="col">
									<h3><strong>{{ title_case($negocio->nombre) }}</strong></h3>

									<div class="row">

										<div class="col">
											<h6>Entrega a Domicilio</h6>
										</div>
										
										<div class="col">
											
											<span class="button-checkbox">
										        <button type="button" class="btn" data-color="primary"></button>
										        <input type="checkbox"  class="hidden" rel="{{ $negocio->id }}" name="entrega_domicilio" {{ $negocio->entrega_domicilio == 1 ? 'checked' : '' }}/>
										    </span>
											
										</div>
									</div>

									<hr>

									<div class="row">

										<div class="col">
											<h6>Entrega a Local</h6>
										</div>
										
										<div class="col">
											
											<span class="button-checkbox">
										        <button type="button" class="btn" data-color="primary"></button>
										        <input type="checkbox"  class="hidden" rel="{{ $negocio->id }}" name="entrega_local" {{ $negocio->entrega_local == 1 ? 'checked' : '' }}/>
										    </span>
											
										</div>
									</div>

									<hr>

									<div class="row">

										<div class="col">
											<h6>Envío gratis</h6>
										</div>
										
										<div class="col">
											
											<span class="button-checkbox">
										        <button type="button" class="btn" data-color="primary"></button>
										        <input type="checkbox"  class="hidden" rel="{{ $negocio->id }}" name="envio_gratis" {{ $negocio->envio_gratis == 1 ? 'checked' : '' }}/>
										    </span>
											
										</div>
									</div>

								</div>
							</div>
						
						@endforeach
					
			
			
			
		</div>
	</div>
</div>



@endsection
@section('scripts')
<script>
	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


	$('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {

        	campo = $(this).attr('name');
        	id = $(this).attr('rel');
        	
        	$.ajax({

	           type:'POST',

	           url:"{{route('negocio.actualizar.envio')}}",

	           data:{ campo:campo,
	           			id:id 
	           		},

	           success:function(data){
	           	console.log(data);
	             updateDisplay();

	           }

	        });
            
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active')
                    .text('Activado');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default')
                    .text('Desactivado');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
</script>
@endsection