<style>

    .badge {

    border: unset !important;

    font-size: 16px !important;

    font-family: 'Work Sans';

}





#myModalCreate .card-inner {

    background: #F6F8FC;

    padding-top: 10px;

}



#myModalCreate .modal-body {

    padding: 0px;

}



#myModalCreate .modal-header {

    padding: 1rem 1.5rem 10px 1.5rem;

}



#myModalCreate .modal-content {

    padding: 18px 16px;

}



#myModalCreate h5.modal-title {

    font-weight: 500;

}



.newbid-btn{

    color:#fff !important;

}





@media only screen and (max-width:600px) {



.nk-block-between {

    flex-flow: column;

}



a.btn.btn-primary.newbid-btn {

    margin-bottom: 0px;

}



}   



</style>





@extends('layouts.dashboard')



@section('content')

    <div class="nk-content ">

        <div class="container-fluid">

            <div class="nk-content-inner">

                <div class="nk-content-body">

                    <div class="nk-block-head nk-block-head-sm">

                        <div class="nk-block-between">

                            <div class="nk-block-head-content">

                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>

                                <nav>

                                    <ul class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>

                                        <li class="breadcrumb-item active">{{ $section->title }}</li>

                                    </ul>

                                </nav>

                            </div><!-- .nk-block-head-content -->

                             @if((in_array('create-leave', getUserPermissions())))

                            <div class="nk-block-head-content">

                                <a onclick="createleave()" class="btn btn-primary newbid-btn">Add New {{ $section->heading }}</a>

                            </div><!-- .nk-block-head-content -->

                            @endif

                        </div><!-- .nk-block-between -->

                    </div>



                    <!-- main alert @s -->

                    @include('partials.alerts')

                    <!-- main alert @e -->



                    <div class="components-preview  mx-auto">



                        <div class="nk-block nk-block-lg">

                            <div class="card card-preview">

                                <div class="card-inner">

                                    <table class="datatable-init nowrap table">

                                        <thead>

                                        <tr>

                                            <th>ID</th>

                                            {{-- Admin, Owner, Manager, HR --}}

                                            @if(in_array(auth()->user()->user_type,[0,1,3,6,7])) 

                                            <th>Applied By</th>

                                            @endif

                                            <th>Reason</th>

                                            <th>From</th>

                                            <th>To</th>

                                            <th>No. of Days</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                        @if( $leaves )

                                            @foreach( $leaves as $key => $leave )

                                                <tr id="rowID-{{ $key + 1 }}">

                                                    <td>{{ $key + 1 }}</td>

                                                    {{-- Admin, Owner, Manager, HR --}}

                                                    @if(in_array(auth()->user()->user_type,[0,1,3,6,7])) 

                                                    <td>{{ $leave->user->name }}</td>

                                                    @endif

                                                    <td>{{ $leave->reason }}</td>

                                                    <td>{{ $leave->date_from }}</td>

                                                    <td>{{ $leave->date_to }}</td>

                                                    <td>

                                                     @if( $leave->no_of_days == 0.5)

                                                         Half Day

                                                    @else  

                                                        {{ $leave->no_of_days }} Days

                                                    @endif

                                                    </td>

                                                    <td>

                                                        @if( $leave->status == 0)

                                                        <span class="badge badge-dim "> <i class="fas fa-minus-circle pending-ico"></i> &nbsp; Pending</span>

                                                        @elseif($leave->status == 1)

                                                        <span class="badge badge-dim badge-danger">Not Approved</span>

                                                        @else

                                                        <span class="badge badge-dim badge-success">Approved</span>

                                                        @endif

                                                    </td>

                                                    <td>

                                                    @if((in_array('update-leave', getUserPermissions())))

                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        <a class="btn" onclick="editleave({{$leave->id}})">  <img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" > </a>

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



@push('scripts')

    <script>

        $(document).ready(function() {

            $('.select2').select2();

        });





        $('.start-datepicker').datepicker({

            format: 'yyyy-mm-dd',

            // startDate: '-3d'

            endDate: '1d'

        });

        $('.end-datepicker').datepicker({

            format: 'yyyy-mm-dd',

            endDate: '1d'

        });

    function createleave(){

      $.get('{{ route("leaves.create")}}',function(data){

      $('#modals').empty().append(data);

      $('#myModalCreate').modal('show');

      });

    }

    function editleave($id){

      $.get('{{ URL::to("dashboard/leaves")}}/'+$id+"/edit",function(data){

      $('#modals').empty().append(data);

      $('#myModalEdit').modal('show');

      });

    }

    </script>

@endpush

