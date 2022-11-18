<style>

   .new-btn{

color:#fff !important;

   } 



@media only screen and (max-width:600px) {



.nk-block-between {

    flex-flow: column;

}

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

                                <h2 class="nk-block-title fw-normal">  {{ $section->title }}</h2>

                                <nav>

                                    <ul class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>

                                        <li class="breadcrumb-item active">{{ $section->title }}</li>

                                    </ul>

                                </nav>

                            </div><!-- .nk-block-head-content -->

                             @if((in_array('create-services', getUserPermissions())))

                            <div class="nk-block-head-content">

                                <a onclick="createservice()" class="btn btn-primary new-btn">Add New {{ $section->title }}</a>

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

                                            <th>Name</th>

                                            <th>Sorting Order</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                        @if( $services )

                                            @foreach( $services as $services )

                                                <tr id="rowID-{{ $services->id }}">

                                                    <td>{{$services->id }}</td>

                                                    <td>{{$services->name}}</td>

                                                    <td>{{$services->sorting_order}}</td>

                                                    <td>{!!($services->status == 0) ? '<span class="badge badge-dim badge-danger disable-check"> <i class="fas fa-minus-circle"></i>    &nbsp; Inactive</span>' : '<span class="badge badge-dim badge-success enable-check">  <i class="fas fa-check-circle"></i>  &nbsp;  Active</span>'!!}</td>

                                                    <td>

                                              @if((in_array('update-services', getUserPermissions())))



                                                        <div class="btn-group" role="group" aria-label="Basic example">

                                                            <a class="btn" onclick="editservice({{$services->id}})"> <img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" >  </a>

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

    function createservice(){

      $.get('{{ route("services.create")}}',function(data){

      $('#modals').empty().append(data);

      $('#myModalCreate').modal('show');

      });

    }

    function editservice($id){

      $.get('{{ URL::to("dashboard/services")}}/'+$id+"/edit",function(data){

      $('#modals').empty().append(data);

      $('#myModalEdit').modal('show');

      });

    }

</script>

@push('scripts')

@endpush

