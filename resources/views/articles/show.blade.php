@extends('layouts.app')

@section('title')
    {{ __('Update Article') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Article Detail') }}</div>
                            <div class="col-md-6">
                                <a href="{{ route('articles.edit', ['article' => $article]) }}"
                                   class="btn btn-primary float-right md-3">{{ __('Edit') }}</a>

                                <a href="{{ route('articles.index') }}"
                                   class="btn btn-secondary float-right mr-3">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h5>{{ __('Author') }}</h5>
                                <p>{{ $article->user->name }}</p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5>{{ __('Created at') }}</h5>
                                <p>{{ $article->created_at }}</p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5>{{ __('Title') }}</h5>
                                <p>{{ $article->title }}</p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5>{{ __('Detail') }}</h5>
                                <p>{{ $article->detail }}</p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5>{{ __('Image') }}</h5>
                                <img src="{{ asset($article->image->image) }}" id="old_image"
                                     width="200" alt="{{ $article->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
