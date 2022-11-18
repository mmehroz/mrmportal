@extends('layouts.dashboard')
<style>

    #project-table td, th {
        position: relative;
        text-align: center;
    }

    #project-table .hover {
        background-color: aliceblue;
    }

    .table-scroll {
        position: relative;
        margin: auto;
        overflow: hidden;

    }

    .table-wrap {
        width: 100%;
        overflow: auto;
    }

    .table-scroll table {
        width: 100%;
        margin: auto;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-scroll th, .table-scroll td {
        /*padding:5px 10px;*/
        /*border:1px solid #fff;*/

        white-space: nowrap;
        vertical-align: top;
    }

    .clone {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .clone th, .clone td {
        visibility: hidden
    }

    .clone .fixed-side {
        background: rgb(255, 255, 255);
        visibility: visible;
    }
</style>

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block  nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="table-responsive">
                                    <div id="table-scroll" class="table-scroll">
                                        <div class="table-wrap">
                                            <table
                                                class="table-bordered  table-condensed   table table-hover  main-table  ">

                                                <form method="post" enctype="multipart/form-data"
                                                      action="{{ route('store.attendance') }}">
                                                    @csrf
                                                    <tr>
                                                        <td class="fixed-side">
                                                            <label class="form-label" for="default-06">Select File for
                                                                Upload</label>
                                                            <div class="form-control-wrap">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                           id="select_file" name="select_file" required>
                                                                    <label class="custom-file-label" for="customFile">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" name="upload" class="form-control"
                                                                   value="Upload">
                                                        </td>
                                                    </tr>
                                                </form>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
