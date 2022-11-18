<style>
 .pop-btn {
    padding: 12px 25px;
}

.modal-body {
    padding-top: 0px;
    padding-left: 0px;
    padding-right: 0px;
}

.modal-header {
    padding-bottom: 0px;
}

.modal-content {
    padding: 20px 10px 0px 10px;
}

.pop-btn {
    padding: 12px 25px;
}
</style>



<div id="myModalCreate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Sales Profile</h5>                   
                </div> 
                <div class="modal-body">
                        @include('partials.alerts')
                        <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    {!! Form::model($profile, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data','autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="g-gs">
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'required' => 'required', ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">JSS Record</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('jss_record', null, ['class' => 'form-control', 'placeholder' => 'Enter profile JSS record', 'required' => 'required', 'min' => 0, 'max' => 100, 'onkeypress' => 'return isDecimal(event)' ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Status</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('status', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                    </div>
                                                </div>
                                            </div>
                                        {{--     @if($section->method != 'POST')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Sorting Order</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('sorting_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sorting Order', 'required' => 'required', 'onkeypress' => 'return isNumber(event)', 'maxlength' => 3]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::button(' Add Profile', ['type' => 'submit', 'class' => 'btn btn-primary pop-btn']) !!}
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                 </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    </div>
    </div>
    </div>
