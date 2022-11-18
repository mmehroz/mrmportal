@php
	if( $layout === 'inline' ){
		$wrapperClass = 'input-group';
		$innerClass = 'd-inline-block custom-control custom-checkbox mr-1 mr-1';
	}else{
		$wrapperClass = null;
		$innerClass = 'custom-control custom-checkbox';
	}
@endphp
<div class="{{ $wrapperClass }}">
	@if($options)
		@foreach( $options as $value => $label )
			<div class="{{ $innerClass }}">
			    {!! Form::checkbox($name, $value, null, ['id' => $value, 'class' => 'custom-control-input']) !!}
			    {!! Form::label($value, $label, ['class' => 'custom-control-label']) !!}
			</div>
		@endforeach
	@endif
</div>