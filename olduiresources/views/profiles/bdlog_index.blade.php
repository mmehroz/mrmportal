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
                                            <th>Cost</th>
                                            <th>Quantity</th>
                                            <th>buyer</th>
                                            <th>Created At</th>
                                            @if(auth()->user()->user_type == 3 || auth()->user()->user_type == 6)
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $profiles )
                                            @foreach( $profiles as $profile )
                                                <tr id="rowID-{{ $profile->connectpurchase_id }}">
                                                    <td>{{$profile->connectpurchase_id}}</td>
                                                    <td>{{$profile->connectpurchase_amount}}</td>
                                                    <td>{{$profile->connectpurchase_qty}}</td>
                                                    <td>{{$profile->connectpurchase_buyer}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($profile->created_at)->format('Y-m-d h:s:i a')}}</td>
                                                    @if(auth()->user()->user_type == 3 || auth()->user()->user_type == 6)
                                                    <?php $concatamountandqty = $profile->connectpurchase_amount.'~'.$profile->connectpurchase_qty.'~'.$profile->connectpurchase_id.'~'.$profile->connectpurchase_profile?>
                                                    <td><a title="Edit" class="btn btn-primary" onclick="editbidpurchase('{{$concatamountandqty}}')"><em class="icon ni ni-edit"></em></a></td>
                                                    @endif
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
    <div id="myModalEditBidPurchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bid Purchase</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('profiles.editbidpurchase') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <input type="hidden" name="connectpurchase_id" id="bidid" value="">
                        <input type="hidden" name="connectpurchase_profile" id="bidprofile" value="">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Connects Cost</label>
                                <div class="form-control-wrap">
                                    {!! Form::number('bid_purchaseamount', null, ['class' => 'form-control','required' => 'required' , 'id' => 'bidamount', 'value' => '434']) !!}
                                </div>
                            </div>
                              <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Connects Qty</label>
                                <div class="form-control-wrap">
                                    {!! Form::number('bid_purchasequantity', null, ['class' => 'form-control', 'required' => 'required' , 'id' => 'bidqty', 'value' => '43']) !!}
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
    </div>
@endsection
<script>
    function editbidpurchase($id){
        var amountandqty = $id.split("~");
        $('#myModalEditBidPurchase').modal('toggle');
        var amount = amountandqty[0];
        var qty = amountandqty[1];
        var id = amountandqty[2];
        var profile = amountandqty[3];
        $("#bidamount").val( amount );
        $("#bidqty").val( qty );
        $("#bidid").val( id );
        $("#bidprofile").val( profile );
    }
</script>
@push('scripts')
@endpush
