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
                    
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-ui-tab" data-toggle="tab" href="#nav-ui" role="tab" aria-controls="nav-ui" aria-selected="true">UI</a>
                          <a class="nav-item nav-link" id="nav-xml-tab" data-toggle="tab" href="#nav-xml" role="tab" aria-controls="nav-xml" aria-selected="false">XML</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <!-- UI FORMAT -->
                        <div class="tab-pane fade show active" id="nav-ui" role="tabpanel" aria-labelledby="nav-ui-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                    @foreach($array['channel'] as $key=>$val)
                                        @if(!is_array($val))
                                            @if($key=='title')
                                                <h4><strong>Source Title:</strong> {{ $val }}</h4>
                                            @endif
                                            @if($key=='description')
                                                <p><strong>Description:</strong> {{ $val }}</p>
                                            @endif
                                            @if($key=='link')
                                                <p><strong>Link:</strong> {{ $val }}</p>
                                            @endif
                                            @if($key=='lastBuildDate')
                                                <p><strong>Dated:</strong> {{ $val }}</p>
                                            @endif
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="col-md-6">
                                    @foreach($array['channel'] as $key=>$val)
                                        @if(is_array($val))
                                            @if($key=='image')
                                                <img src="{{ $val['url'] }}" class="img-fluid" alt="{{ $val['title'] }}">
                                            @endif
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="col-md-12">
                                    @foreach($array['channel'] as $key=>$val)
                                        @if(is_array($val))
                                            @if($key=='item')
                                                @foreach($val as $nestedKey=>$nestedValue)
                                                    <hr>
                                                    @if(array_key_exists('title', $nestedValue))
                                                    <h6><strong>Post Title:</strong> {{ $nestedValue['title'] }}</h6>
                                                    @endif
                                                    @if(array_key_exists('description', $nestedValue))
                                                    <p><strong>Description:</strong> {{ $nestedValue['description'] }}</p>
                                                    @endif
                                                    @if(array_key_exists('link', $nestedValue))
                                                    <p><strong>Url:</strong> {{ $nestedValue['link'] }}</p>
                                                    @endif
                                                    @if(array_key_exists('pubDate', $nestedValue))
                                                    <p><strong>Published Date:</strong> {{ $nestedValue['pubDate'] }}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <!-- XML FORMAT -->
                        <div class="tab-pane fade" id="nav-xml" role="tabpanel" aria-labelledby="nav-xml-tab">
                            <ul class="list-group">      
                                @foreach($array['channel'] as $key=>$val)
    
                                    @if(is_array($val))
                                        @if($key=='item')
                                            @foreach($val as $nestedKey=>$nestedValue)
                                            <a class="list-group">
                                                <li class="list-group-item">{{ '<' .$key. '>' }}</li>
                                                @foreach($nestedValue as $itemKey=>$itemValue)
                                                    @if(!is_array($itemValue))
                                                        <li class="list-group-item">{{ '<' .$itemKey. '>' }} {{$itemValue}} {{ '</' .$itemKey. '>' }}</li>
                                                    @endif
                                                @endforeach
                                                <li class="list-group-item">{{ '</' .$key. '>' }}</li>
                                            </a>
                                            @endforeach
                                        @else
                                            <a class="list-group">
                                                <li class="list-group-item">{{ '<' .$key. '>' }}</li>
                                                @foreach($val as $nestedKey=>$nestedValue)
    
                                                    @if(!is_array($nestedValue)) 
                                                    
                                                        <li class="list-group-item">{{ '<' .$nestedKey. '>' }} {{$nestedValue}} {{ '</' .$nestedKey. '>' }}</li>
                                                
                                                    @endif
                                                @endforeach
                                                <li class="list-group-item">{{ '</' .$key. '>' }}</li>
                                            </a>
                                        @endif
                                    
                                    @else
                                    
                                        <li class="list-group-item">{{ '<' .$key. '>' }} {{$val}} {{ '</' .$key. '>' }}</li>
                                    
                                    @endif
                                @endforeach
                            </ul>   
                        </div>
                    </div>          

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
