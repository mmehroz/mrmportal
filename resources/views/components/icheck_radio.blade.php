<div class="form-inline">
	@if($options)
		@foreach( $options as $value => $label )
            <div class="d-inline-block custom-radio mr-5 mt-1">
              {!! Form::radio($name, $value, null, ['id' => $value, 'class' => 'icheck']) !!}
              {!! Form::label($value, $label) !!}
            </div>
		@endforeach
	@endif
</div>