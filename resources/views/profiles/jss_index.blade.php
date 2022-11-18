@include('layouts.modaldashboard')

<style>    
div#myModalJss .modal-body {background: #fff;padding: 0px;}

div#myModalJss  .card.card-preview {
    border-radius: 0px;
}

div#myModalJss thead th {position: relative;top: -12px;}

.close-edts {
    padding: 20px 20px;
}

a.btn.edists {
    padding-left: 0px;
}

div#myModalJss .row.justify-between.g-2 {
    border-radius: 0px !important;
}


div#myModalJss .row.justify-between.g-2 {
    padding-bottom: 20px;
    margin-top: -27px !important;
}

div#myModalJss .datatable-wrap.my-3 {
    margin-bottom: 0px !important;
}

div#myModalJss .row.align-items-center {
    background: #414042 !important;
}

</style>

<div id="myModalJss" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upwork Account</h5>

                </div>
                <div class="modal-body">
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
`                                            <th>ID</th>
                                            <th>JSS Record</th>
                                            <th>Created Date</th>
                                            <th>Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $profiles )
                                            @foreach( $profiles as $profile )
                                                <tr id="rowID-{{ $profile->id }}">
                                                    <td>{{ $profile->id  }}</td>
                                                    <td>{{$profile->jss_record}} %</td>
                                                    <td>{{ \Carbon\Carbon::parse($profile->created_at)->format('Y-m-d h:s:i a')}}</td>
                                                    <td><a title="Edit" class="btn edists" onclick="editjss({{$profile->id}})"><img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
               </div>
               <button type="button" class="btn btn-default waves-effect close-edts" onclick="modalclose()" >Cancel</button>  
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script>
    function editjss($id){
      $.get('{{ URL::to("dashboard/editjss")}}/'+$id,function(data){
      $('#modals').empty().append(data);
      $('#myModalEditJss').modal('show');
      });
    }
    function modalclose(){
        $('#myModalJss').modal('hide');
    }
    </script>
