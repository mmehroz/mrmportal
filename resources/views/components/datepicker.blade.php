<div class="input-group date datepicker" id="{{ $name }}">
	@php 
      $attributes['class'] = isset($attributes['class']) ? 'form-control '.$attributes['class'] : 'form-control';
    @endphp
	{!! Form::text($name, $value, $attributes) !!}
	<div class="input-group-append">
		<span class="input-group-text">
			<span class="fa fa-calendar"></span>
		</span>
	</div>
</div>