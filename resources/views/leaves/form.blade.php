@include('layouts.modaldashboard')


<style>

 .new-btn {

    padding: 12px 20px;

}





#myModalEdit .modal-body {

    padding: 0rem 1.5rem;

}



#myModalEdit .card-inner {

    padding: 0rem 0rem 1.5rem 0rem;

    background: #F6F8FC;

}



#myModalEdit .modal-content {

    padding: 18px 12px;

}



#myModalEdit h5.modal-title { 

    font-weight: 500;

}





.form-icon.form-icon-left {

    color: #000000;

}



.form-icon .icon {

    color: #000000;

    font-size: 18px;

}



input.form-control.datepicker {

    color: #414042;

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

                                    {!! Form::model($leaves, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

                                    @method($section->method)

                                        <div class=" g-gs">

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">Leave / Half Day ?</label>

                                                    <div class="form-control-wrap ">

                                                        @php

                                                        if($section->method == 'PUT'){

                                                            if($leaves->no_of_days == 0.5){

                                                                $selected = 0;

                                                            }elseif($leaves->no_of_days == 1){

                                                                $selected = 1;

                                                            }

                                                            else{ $selected = 2; }

                                                        }

                                                        else{ $selected = null;}

                                                        @endphp

                                                        {!! Form::select('leave_type', array(0 => "Half Day", 1 => "Full Day", 2 => "Multple Days"), $selected ,['class' => 'select2 form-control form-select', 'placeholder' => 'Please Select', 'required' => 'required']) !!}

                                                       

                                                    </div>

                                                </div>

                                            </div>

                                            <div class=" from-field {{ $section->method != 'PUT' ? 'd-none' : '' }}" style="padding-top: 0px !important;">

                                            <div class="form-group">

                                                    <label class="form-label" for="fv-topics">From</label>

                                                    <div class="form-control-wrap ">

                                                      <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>

                                                        {!! Form::text('date_from', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter From Date', 'required' => 'required']) !!}

                                                    </div>

                                                </div>

                                            </div>

                                             <div class=" to-field {{ $section->method != 'PUT' ? 'd-none' : '' }}" style="padding-top: 0px !important;">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">To</label>

                                                    <div class="form-control-wrap ">

                                                      <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>

                                                        {!! Form::text('date_to', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter To Date', 'required' => 'required',]) !!}

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12 p-t" style="padding-top: 0px !important;">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Reason</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => 'Enter Leave Reason', 'required' => 'required', 'rows' => 1]) !!}

                                                    </div>

                                                </div>

                                            </div>

                                            @if($section->method == 'PUT' && in_array(auth()->user()->user_type,[0,1,3,6,7]))

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">Status</label>

                                                    <div class="form-control-wrap ">

                                                        {!! Form::select('status', array(0 => "Pending", 1 => "Reject", 2 => "Approve"), null,['class' => 'select2 form-control form-select', 'placeholder' => 'Please Select', ]) !!}

                                                       

                                                    </div>

                                                </div>

                                            </div>

                                            @endif

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    {!! Form::button('Apply', ['type' => 'submit', 'class' => 'btn btn-primary new-btn']) !!}

                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

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

@push('scripts')

    <script>

        $(document).ready(function() {

            $('.select2').select2().on('change', function (e) {

                if ($(this).val() == 2){

                    $('.from-field').removeClass('d-none')

                    $('.from-field').find('label').text('From')

                    $('.to-field').removeClass('d-none')

                }

                else if ($(this).val() == 1){

                    $('.from-field').removeClass('d-none')  

                    $('.from-field').find('label').text('Date')

                    $('.to-field').addClass('d-none')

                }

                else{

                    $('.from-field').removeClass('d-none')

                    $('.from-field').find('label').text('Date')

                    $('.to-field').addClass('d-none')        

                }

                });

        });



        $('.datepicker').datepicker({

            format: 'yyyy-mm-dd',

        });



    </script>

@endpush

