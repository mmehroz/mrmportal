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
                                        <li class="breadcrumb-item"><a href="{{ route("daily_target.index") }}">{{ $section->title }}</a></li>
                                        <li class="breadcrumb-item active">Day Report</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
{{--                            @if((in_array('create-daily-target', getUserPermissions())))--}}
{{--                            <div class="nk-block-head-content">--}}
{{--                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="color: #fff;">Add New {{ $section->heading }}</a>--}}
{{--                            </div><!-- .nk-block-head-content -->--}}
{{--                            @endif--}}
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview">
                        <div class="nk-block nk-block-lg">
                            <div class="col-lg-12 ">
                                <div class="row g-gs">
                                    @if(auth()->user()->user_type != 4)
                                    <div class="col-sm-3">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Daily Bidding Target</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $dailytarget }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-3">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Bids</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->count() }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Chat Open</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->sum('is_chat') }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Sale Open</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->sum('is_sale') }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">

                                    <table class="datatable-init nowrap table">

                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Link</th>
                                            <th>Is Chat Opened ?</th>
                                            <th>Is Sale Opened ?</th>
                                            <th>Date</th>
                                            <th>Bidder</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $targets )
                                            @foreach( $targets as $target )
                                                <tr id="rowID-{{ $target->id }}">
                                                    <td>{{ $target->id }}</td>
                                                    <td>{{$target->bid_link}}</td>
                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>
                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>
                                                    <td>{{ $target->bid_date }}</td>
                                                    <td>{{ $target->user->name }}</td>
                                                    <td>{!! ($target->is_request == 1) ? "<span class='badge badge-danger'>Pending</span>" : "" !!}</td>
                                                    <td>
                                                       @if((in_array('update-daily-target', getUserPermissions())))
                                                            @if($target->is_request == 1)
                                                                @if((in_array(auth()->user()->user_type, [1,3])))
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>
                                                                </div>
                                                            @endif
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



    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New {{ $section->heading }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('daily_target.store') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Bid Link (Fiverr/Upwork/Freelancer/Guru)</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('bid_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Link ', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-topics">Is Chat Opened ?</label>
                                <div class="form-control-wrap ">
                                    {!! Form::select('is_chat', array(1 => 'Yes', 0 => 'No'), 0, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-topics">Is Sale Opened ?</label>
                                <div class="form-control-wrap ">
                                    {!! Form::select('is_sale', array(1 => 'Yes', 0 => 'No'), 0, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Bid Amount <small>(in USD)</small></label>
                                <div class="form-control-wrap">
                                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Amount ', 'required' => 'required', 'onkeypress' => 'return isDecimal(event)']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Bidding Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('bid_date', null, ['class' => 'form-control  bidder-datepicker', 'placeholder' => 'Enter Bid Date ', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $('.select2').select2();
    });

     $('.target-datepicker').datepicker({
         format: 'yyyy-mm-dd',
        // startDate: '-3d'
        endDate: '1d'
    });
   $('.bidder-datepicker').datepicker({
       format: 'yyyy-mm-dd',
       endDate: '1d'
   });
</script>
@endsection
