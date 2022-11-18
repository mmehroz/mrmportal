
<style>
    .add-new-btn {
    color: #fff !important;
    font-weight: 400;
     }

     .modal-title{
    font-weight: 500 !important;
 }
 .card {
    background-color: unset !important;
}

.form-label {color: #414042;}

div#myModalJss .modal-dialog {
    max-width: 1140px !important;
}

div#myModalBdlog .modal-dialog {
    max-width: 1140px !important;
}

.tables-js  .modal-body {
    padding: 1.5rem 0rem !important;
}

.tables-js .modal-header, .modal-footer {
    padding-bottom: 0px !important;
}

.tables-js .modal-body {
    padding: .5rem 0rem 2.5rem 0rem !important;
}


.table-border-cc .card-inner {
    background: #fff;
}

.table-border-cc .g-2 {
    margin-left: 0px !important;
    margin-right: 0px !important;
}

.table-border-cc .card-inner {
    border-radius: 20px;
}


.fade.modal-backdrop.show {
    display: none;
}


.table-border-cc .datatable-wrap.my-3 {
    margin-top: 0px !important;
}


div#myModalJss .row.justify-between.g-2 {
    border-radius: 0px;
}


@media only screen and (max-width:600px) {

    .nk-block-between {flex-flow: column;}
} 


.card.card-preview div#DataTables_Table_0_filter {
    float: right;
    margin-right: -100%;
    position: relative;
  z-index: 99;
}

.card.card-preview div#DataTables_Table_0_length {
  position: absolute;
  bottom: 33px;
  right: 120px;
}

.card.card-preview .card.card-preview .row.justify-between.g-2 {
    position: unset;
}

.card.card-preview .col-5.col-sm-6.text-right {
    position: unset;
    z-index:9;
}

div#modals .card.card-preview div#DataTables_Table_0_length {
    bottom: 12px;
}

</style>


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">   {{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">  {{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
                         @if((in_array('create-profile', getUserPermissions())))                
                            <div class="nk-block-head-content">
                            <a onclick="createprofile()" class="btn btn-primary add-new-btn"  >Add New {{ $section->title }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview table-border-cc">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table table-ggg">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>JSS Record</th>
                                            <th>Bid Purchase Record</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $profiles )
                                            @foreach( $profiles as $profile )
                                                <tr id="rowID-{{ $profile->id }}">
                                                    <td>{{ $profile->id  }}</td>
                                                    <td>{{$profile->name}}</td>
                                                    <td>{!!($profile->status == 0) ? '<span class="badge badge-dim badge-danger disable-check"> <i class="fas fa-check-circle"></i>    &nbsp; Inactive</span>' : '<span class="badge badge-dim badge-success enable-check">  <i class="fas fa-check-circle"></i>  &nbsp;  Active</span>'!!}</td>
                                                    <td>
                                                        {{ (getProfileJss($profile->id)) ? getProfileJss($profile->id) : 0 }} %
                                                        <a  style="cursor: pointer;" class="" onclick="viewjss({{$profile->id}})">View Records</a>
                                                    </td>
                                                    <td>
                                                        <a  style="cursor: pointer;" class="" onclick="viewbdlog({{$profile->id}})">View Records</a>
                                                    </td>
                                                    <td>
                                                         @if((in_array('update-profile', getUserPermissions())))
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn edits" onclick="editprofile({{$profile->id}})">  <img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" >  </a>
                                                        </div>
                                                        @endif
                                                    </td>
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
            </div>
        </div>
    </div>
    <div id ='modals'></div>
@endsection
<script>
    function createprofile(){
      $.get('{{ route("profiles.create")}}',function(data){
      $('#modals').empty().append(data);
      $('#myModalCreate').modal('show');
      });
    }
    function editprofile($id){
      $.get('{{ URL::to("dashboard/profiles")}}/'+$id+"/edit",function(data){
      $('#modals').empty().append(data);
      $('#myModalEdit').modal('show');
      });
    }
    function viewjss($id){
    $('.row.justify-between.g-2').remove();
    $('.row.align-items-center').remove();
      $.get('{{ URL::to("dashboard/profiles/jss_record")}}/'+$id,function(data){
      $('#modals').empty().append(data);
      $('#myModalJss').modal('show');
      });
    }
    function viewbdlog($id){
    $('.row.justify-between.g-2').remove();
    $('.row.align-items-center').remove();
      $.get('{{ URL::to("dashboard/bdlog")}}/'+$id,function(data){
      $('#modals').empty().append(data);
      $('#myModalBdlog').modal('show');
      });
    }
</script>
@push('scripts')
@endpush
