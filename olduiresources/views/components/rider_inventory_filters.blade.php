{!! Form::open( ['route' => $section->slug.'.list.'.$route, 'id' => $class, 'class' => $class] ) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('date', 'Date') !!}
                <div class="input-group">
                    {!! Form::text('date', null, ['class' => 'form-control datepicker']) !!}
                    <div class="input-group-append">
                            <span class="input-group-text">
                              <span class="fa fa-calendar-o"></span>
                            </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('rider', 'Rider') !!}
                <div class="input-group">
                    {!! Form::select('rider_id', $GRiders->toSelect(), null, ['class' => 'form-control border-primary select2']) !!}
               </div>
                </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('shift', 'Shift') !!}
                <div class="input-group">
                    {!! Form::select('shift_id', $shifts, $selected_shift, ['class' => 'form-control border-primary select2', 'placeholder'=>'Select Shift']) !!}
                    </div>
                </div>

        </div>
        <div class="col-md-2 py-xl-2">
            <button class="btn btn-primary waves-effect search-btn form-filter filter-search float-right"
                    id="search-btn" type="button">Search
            </button>

        </div>
    </div>
{!! Form::close() !!}