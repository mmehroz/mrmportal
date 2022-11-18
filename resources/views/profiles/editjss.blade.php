<style>
    div#myModalEditJss {
    background: #000000CC !important;
}

.card-preview {
    border-top: 0px !important;
}

.modal-body {
    padding: 0rem 1.5rem 1.5rem 1.5rem !important;
}

.modal-content {
    padding: 10px 10px  10px  10px;
}


</style>

<div id="myModalEditJss" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit JSS</h5>

                </div>
                <div class="modal-body">
                    @include('partials.alerts')
                    <div class="components-preview  mx-auto">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <form action="{{URL::to('dashboard/submiteditjss')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="hdnjssid" value="{{$jss->id}}">
                                    <label class="form-label">JSS Record</label>
                                    <input type="text" class="form-control" name="jss_record" value="{{$jss->jss_record}}"><br>
                                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>   
                                </form>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
               </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>