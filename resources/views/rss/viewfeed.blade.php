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
                    
                    <!-- will be used to show any messages -->
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    
                    <ul class="list-group">
                        <a class="btn btn-small btn-success" href="{{ route('rssfeeds.create') }}">Add RSS Feed +</a>
                    </ul>

                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>RSS Name</td>
                            <td>RSS Url</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rssfeeds as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->rss_name }}</td>
                            <td>{{ $value->rss_url }}</td>

                            <!-- show, edit, and delete buttons -->
                            <td>
                                <a class="btn btn-small btn-success" href="{{ URL::to('rssfeeds/' . $value->id) }}">Show rss feed</a>
                                <a class="btn btn-small btn-info" href="{{ URL::to('rssfeeds/' . $value->id . '/edit') }}">Edit rss feed</a>
                                <form method="post" action="{{ route('rssfeeds.destroy', [$value->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete rss feed</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
