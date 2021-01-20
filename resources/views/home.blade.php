@extends('layouts.app')

@section('content')
<div class="container">
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
                
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ route('rssfeeds.index', ['id'=>Auth::user()->id]) }}" class="text-sm text-gray-700 underline">RSS Feeds Controller</a></li>
                        <li class="list-group-item"><a href="{{ route('showrssfeeds') }}" class="text-sm text-gray-700 underline">Show RSS Feeds</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
