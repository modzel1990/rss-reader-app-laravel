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
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            @foreach($rssOutputArray as $key=>$val)
                                <div class="row">
                                    <div class="col-md-6">
                                    @foreach($val as $subKey=>$subVal)
                                        @if(!is_array($subVal))
                                            @if($subKey=='title')
                                                <h4><strong>Title:</strong> {{ $subVal }}</h4>
                                            @endif
                                            @if($subKey=='description')
                                                <p><strong>Description:</strong> {{ $subVal }}</p>
                                            @endif
                                            @if($subKey=='link')
                                                <p><strong>Link:</strong> {{ $subVal }}</p>
                                            @endif
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        @foreach($val as $subKey=>$subVal)
                                        @if(is_array($subVal))
                                            @if($subKey=='image')
                                                <img src="{{ $subVal['url'] }}" class="img-fluid" alt="{{ $subVal['title'] }}">
                                            @endif
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            </div>
                        </div>
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
