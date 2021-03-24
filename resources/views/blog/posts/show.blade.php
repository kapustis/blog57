@extends('layouts.app')

@section('content')
    <header class="masthead" style="background-image: url({{ asset('images/posts/03.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{$item->title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                {{$item->content_html}}
                <hr>

                <div class="clearfix">
                    <a class="btn btn-primary float-left" href="#"
                       data-toggle="tooltip" data-placement="top" title=""
                       data-original-title="The dreams of yesterday are the hopes of today and the reality of tomorrow."
                    >
                        ← Previous
                        <span class="d-none d-md-inline"> Post </span>
                    </a>

                    <a class="btn btn-primary float-right"
                       href="#"
                       data-toggle="tooltip"
                       data-placement="top" title=""
                       data-original-title="Science has not yet mastered prophecy"
                    >
                        Next
                        <span class="d-none d-md-inline"> Post</span> →
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
