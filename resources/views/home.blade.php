@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card" >
             

                <div class="card-body row" style="padding: 0px !important; margin: 0px !important">
                   <div class="col-md-5 col-12 pe-2">
                    
                        @include('pages.chat_header')
                        @include('pages.chat_history')
                    </div>
                    <div class="col-md-7 col-12 message-sec ">
                        @include('pages.chat_to')
                        @include('pages.chat')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
