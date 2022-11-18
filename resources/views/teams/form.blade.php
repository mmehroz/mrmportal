@include('layouts.modaldashboard')
<style>

        .modal-title{

        font-weight:500 !important;

    }

    .pop-btn {

    padding: 12px 25px;

   }



.modal-header {

    padding-bottom: 0px;

}



.modal-body {

    padding-top: 10px;

}



.pop-btn {

    padding: 12px 25px;

}


.form-control-wrap.mehwidth span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}

 span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

</style>

<div id="myModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Edit Team</h5>

                </div>

                <div class="modal-body">

                @include('partials.alerts')

                                    {!! Form::model($team, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

                                    @method($section->method)

                                        <div class=" g-gs">

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-full-name">Team Name</label>

                                                    <div class="form-control-wrap">

                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Name', 'required' => 'required', 'name' => 'name', ]) !!}

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">Team Lead</label>

                                                    <div class="form-control-wrap mehwidth">

                                                        @php

                                                            // dd(getTeamMembers($team->id));

                                                        @endphp

                                                        @if($section->method != 'PUT')

                                                        {!! Form::select('team_lead', getAllMembers(), null,['class' => 'select2 form-control form-select',  'required' => 'required', 'placeholder' => 'Please Select', ]) !!}

                                                        @else

                                                        {!! Form::select('team_lead', getAllMembers(), getTeamLead($team->id)['member_id'],['class' => 'select2 form-control form-select',  'required' => 'required', 'placeholder' => 'Please Select', ]) !!}

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">Members</label>

                                                    <div class="form-control-wrap ">

                                                        @if($section->method != 'PUT')

                                                        {!! Form::select('member_id[]',getAllMembers(), null , ['class' => 'form-control form-select select2', 'required' => 'required', 'multiple', ]); !!}

                                                        @else

                                                        {!! Form::select('member_id[]',getAllMembers(), getTeamMembers($team->id), ['class' => 'form-control form-select select2', 'required' => 'required', 'multiple', ]); !!}

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="">

                                                <div class="form-group">

                                                    <label class="form-label" for="fv-topics">Team Target <small>(in USD)</small></label>

                                                    <div class="form-control-wrap ">

                                                        {!! Form::text('team_target', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Target', 'onkeypress' => 'return isDecimal(event)', ]); !!}

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    {!! Form::button('Edit Team', ['type' => 'submit', 'class' => 'btn btn-primary pop-btn']) !!}

                                                    <button type="button" class="btn btn-default waves-effect" onclick="modalclose()">Cancel</button>

                                                </div>



                                            </div>

                                        </div>

                                    {!! Form::close() !!}

                              </div>

            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->

    </div>
    <script>
     function modalclose(){
        $('#myModalEdit').modal('hide');
    }
    </script>
