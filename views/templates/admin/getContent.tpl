<form id="configuration_form" class="defaultForm form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="panel" id="fieldset_0">
		<div class="panel-heading">
			<i class="icon-share"></i>
			{l s='Activar boton de chat de Whatsapp' d='Modules.pswhatsaap.Shop'}
		</div>
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Activar boton' d='Modules.pswhatsaap.Shop'}
				</label>
				<div class="col-lg-9">
					<span class="switch prestashop-switch fixed-width-lg">
						<input type="radio" name="pswhatsaap_What" id="pswhatsaap_What_on" value="1" {if $pswhatsaap_What == "1"} checked {/if}>
						<label for="pswhatsaap_What_on">{l s='Sí' d='Modules.pswhatsaap.Shop'}</label>
						<input type="radio" name="pswhatsaap_What" id="pswhatsaap_What_off" value="0" {if $pswhatsaap_What == "0"} checked {/if}>
						<label for="pswhatsaap_What_off">{l s='No' d='Modules.pswhatsaap.Shop'}</label>
						<a class="slide-button btn"></a>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Animar boton' d='Modules.pswhatsaap.Shop'}
				</label>
				<div class="col-lg-9">
					<span class="switch prestashop-switch fixed-width-lg">
						<input type="radio" name="pswhatsaap_animation" id="pswhatsaap_animation_on" value="1" {if $pswhatsaap_animation == "1"} checked {/if}>
						<label for="pswhatsaap_animation_on">{l s='Sí' d='Modules.pswhatsaap.Shop'}</label>
						<input type="radio" name="pswhatsaap_animation" id="pswhatsaap_animation_off" value="0" {if $pswhatsaap_animation == "0"} checked {/if}>
						<label for="pswhatsaap_animation_off">{l s='No' d='Modules.pswhatsaap.Shop'}</label>
						<a class="slide-button btn"></a>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Número de telefono de Whatsapp' d='Modules.pswhatsaap.Shop'}
				</label>							
				<div class="col-lg-9">
					<input type="text" name="pswhatsaap_NumWhat" id="pswhatsaap_NumWhat" value="{$pswhatsaap_NumWhat} " class="fixed-width-lg">
					<p class="help-block">
						{l s='Establece el número de telefono de Whatsapp ejemplo +04121567173' d='Modules.pswhatsaap.Shop'}
					</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Icono de Whatsapp' d='Modules.pswhatsaap.Shop'}
				</label>
				<div class="col-lg-6">
					<input id="Whatsapp_IMG" type="file" name="Whatsapp_IMG" class="hide">
					<div class="dummyfile input-group">
						<span class="input-group-addon"><i class="icon-file"></i></span>
						<input id="Whatsapp_IMG-name" type="text" class="disabled" name="filename" readonly="">
						<span class="input-group-btn">
							<button id="Whatsapp_IMG-selectbutton" type="button" name="submitAddAttachment" class="btn btn-default">
								<i class="icon-folder-open"></i>{l s='Selecciona un archivo' d='Modules.pswhatsaap.Shop'}
							</button>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div id="BANNER_IMG-2-images-thumbnails" class="col-lg-12">
					<img src="{$uri}/views/img/{$img_whatsapp}" class="img-thumbnail">
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button type="submit" value="1" id="pswhatsaap_env" name="pswhatsaap_env" class="btn btn-default pull-right">
				<i class="process-icon-save"></i>{l s='Guardar' d='Modules.pswhatsaap.Shop'}
			</button>
		</div>
	</div>
</form>

<script>
	$(document).ready(function(){
		$('#Whatsapp_IMG-selectbutton').click(function(e){
			$('#Whatsapp_IMG').trigger('click');
		});
		$('#Whatsapp_IMG').change(function(e){
			var val = $(this).val();
			var file = val.split(/[\\/]/);
			$('#Whatsapp_IMG-name').val(file[file.length-1]);
		});
	});
</script>