@include('layouts.modaldashboard')


<style>
      th {
    color: #A2A2A2 !important;
    padding-bottom: 20px !important;
    padding-top: 20px !important;
}

 .card.card-preview {
    border-radius: 0px !important;
}

 table.datatable-init.nowrap.table {
    background: #fff !important;
}

  .modal-body {
    padding: 1.5rem 0rem !important;
}

 .modal-header, .modal-footer {
    padding-bottom: 0px !important;
}

 .modal-body {
    padding: .5rem 0rem .5rem 0rem !important;
}


.modal-content {
    padding: 10px 0px 15px 0px;
}

.modal-header {padding-bottom: 10px !important;}

button.btn.btn-default.waves-effect {
    padding-top: 10px;
    margin-left: 8px;
}


div#myModalEditBidPurchase  .form-popup {
    padding-right: 30px;
    padding-left: 30px;
    padding-top: 15px;
    padding-bottom: 15px;
}


#myModalEditBidPurchase  .modal-header {
    padding-left: 0px;
}

div#myModalBdlog  .row.justify-between.g-2 {
    border-radius: 0px;
}

</style>




<div id="myModalBdlog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Upwork Account</h5>
                </div> 
                <div class="modal-body">
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto table-faces">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table  ">
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
                                                    <td><a title="Edit" class="btn" onclick="editbidpurchase('{{$concatamountandqty}}')"> <img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" > </a></td>
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
                <button type="button" class="btn btn-default waves-effect" onclick="modalclose()">Cancel</button> 
            </div>
        </div>
    </div>
    <div id="myModalEditBidPurchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content form-popup">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bid Purchase</h5>
                 
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
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
     function modalclose(){
        $('#myModalBdlog').modal('hide');
    }
</script>
@push('scripts')
@endpush
