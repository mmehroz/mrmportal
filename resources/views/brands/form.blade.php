<style>

    .card-inner {

    background: #F6F8FC;

}



.modal-title {

    font-weight: 500;

}



.modal-body {

    padding: 0rem 1.5rem;

}



.form-control {

    width: 100%;

    color: #C7CACE;

    font-size: 16px;

}



.pop-btn {

    padding: 12px 25px;

}







#myModalEdit .form-label {

    color: #414042;

}



#myModalEdit  .modal-body {

    padding-top: 0px;

}



#myModalEdit .form-label {

    color: #414042;

}



#myModalEdit .modal-content {

    padding: 20px 15px 20px 10px;

}





#myModalEdit .card-inner {

    padding: 0rem 0rem 1.5rem 0rem;

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

                                    {!! Form::model($brand, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

                                    @method($section->method)

                                        <div class=" g-gs">

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Brand Name</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Brand Name', 'required' => 'required', 'name' => 'name', ]) !!}

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

                                            <div class="">

                                                <label class="form-label" for="default-06">Product Picture</label>

                                                <div class="form-control-wrap">

                                                    <div class="custom-file">

                                                        <input type="file" class="custom-file-input" id="image" name="image">

                                                        <label class="custom-file-label" for="customFile">Choose file</label>

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



                                                <div class="col-md-12">

                                                    <img class="email-logo" src="{{ asset($brand->picture) }}" alt="logo" style="width: 250px;">

                                                </div>



                                            @endif

                                               <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Brand Address / Contact:</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::textarea('detail', null, ['class' => 'form-control', 'placeholder' => 'Enter Brand Address and Contact Detail', 'required' => 'required' ]) !!}

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    {!! Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary pop-btn']) !!}

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