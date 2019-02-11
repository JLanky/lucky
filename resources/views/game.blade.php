@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!empty($userScore))
                            <div>
                                <span class="money">Your money: {{$userScore->money}} </span>
                            </div>
                            <div>
                                <span class="bonus"> Your bonus: {{$userScore->bonus}}</span>
                            </div>
                            <div>
                                <span class="surprise">Your surprise: {{$userScore->surprise}}</span>
                            </div>
                        @else
                            <div><span class="money">Your money: 0</span><br>
                                <span class="bonus"> Your bonus: 0</span>
                            </div>
                            <div>
                                <span class="surprise">Your surprise: </span>
                            </div>
                        @endif
                        <div style="margin-top: 20px;">
                            <span id="get"
                                  style="border:#0d3625 dashed; cursor: pointer;background-color: red; padding: 5px 10px;">Click here!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
