@extends('layouts.dashboard')


@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">


                    <!-- main alert @s -->
                @include('partials.alerts')
                <!-- main alert @e -->


                    <div class="container">
                        @livewire('messages')
                    </div>







                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/apps/chats.js?ver=2.4.0') }}"></script>
@endpush
