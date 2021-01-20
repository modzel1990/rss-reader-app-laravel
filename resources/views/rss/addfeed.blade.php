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
                    
                    <form method="post" action="{{ route('rssfeeds.store') }}">
                        @csrf
                        
                        <div class="form-group">
                          <label for="rss_name">RSS Name</label>
                          <input type="text" class="form-control" name="rss_name" id="rss_name" aria-describedby="rss_name" placeholder="Enter rss name...">
                        </div>
                        <div class="form-group">
                          <label for="rss_url">RSS Url</label>
                          <input type="text" class="form-control" name="rss_url" id="rss_url" aria-describedby="rss_url" placeholder="Enter rss url...">
                        </div>
                        <div class="form-group">
                          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
