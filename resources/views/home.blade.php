@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div id="switch-container" class="d-flex justify-content-center pb-4">
        <div id="available" class="">SEMPRE DISPONIBILE</div>
        <div id="unavailable" class="">MAI DISPONIBILE</div>
    </div>

    <div id="calendar">
        <div id="calendar_header">
            <i class="icon-chevron-left"></i>
            <h1></h1>
            <i class="icon-chevron-right"></i>
        </div>
        <div id="calendar_weekdays"></div>
        <div id="calendar_content"></div>
    </div>
@endsection

@push('script')
    <script>
        $(function() { // after the page has loaded..
            
            // let days = $('#calendar_content').find('.day'); 
            // console.log(days);


        })
    </script>
@endpush
