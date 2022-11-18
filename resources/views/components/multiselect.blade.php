<div class="form-group">
      <div class="form-inline">
      	@php 
      		$attributes['class'] = isset($attributes['class']) ? 'ms '.$attributes['class'] : 'ms';
      		$attributes['multiple'] = true;
      	@endphp
      	{!! Form::select($name, $value, $checked, $attributes) !!}
      </div>
</div>