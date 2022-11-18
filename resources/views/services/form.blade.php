<style>

.card-inner {

    background: #F6F8FC;

}



h5.modal-title {

    font-weight: 500;

}



.modal-body {

    padding: 0rem 1.5rem 1.5rem 1.5rem;

}



.modal-header {

    padding-bottom: 0px;

}



.card-inner {

    padding: 0px 0px 0px 0px;

}



.modal-content {

    padding: 10px 10px  0px  10px;

}



.pop-btn {

    padding: 12px 25px;

}

</style>







<div id="myModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">{{$section->title}}</h5>

                 

                </div>

                <div class="modal-body">

                        @include('partials.alerts')

                        <!-- main alert @e -->

                        <div class="nk-block nk-block-lg">

                            <div class="card card-bordered">

                                <div class="card-inner">

                                    {!! Form::model($service, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

                                    @method($section->method)

                                        <div class="g-gs">

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Service Name</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Service Name', 'required' => 'required', 'name' => 'name', ]) !!}

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

                                            @if($section->method != 'POST')

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Sorting Order</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::text('sorting_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sorting Order', 'required' => 'required', 'onkeypress' => 'return isNumber(event)', 'maxlength' => 3, ]) !!}

                                                    </div>

                                                </div>

                                            </div>

                                            @endif

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    {!! Form::button(' Save', ['type' => 'submit', 'class' => 'btn btn-primary pop-btn']) !!}
                                                      
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>

                                            </div>

                                        </div>

                                    {!! Form::close() !!}

                                </div>

                            </div>

                        </div><!-- .nk-block -->

                    </div><!-- .components-preview -->

                </div>

            </div>

        </div>