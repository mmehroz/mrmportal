<div class="input-group">
	<fieldset>
      <div class="float-left">
      	@php 
      		$attributes['class'] = isset($attributes['class']) ? 'switch '.$attributes['class'] : 'switch';
      		// $checked = false; 
      	@endphp
      	{{ Form::checkbox($name, $value, $checked, $attributes ) }}
      </div>
    </fieldset>
</div>