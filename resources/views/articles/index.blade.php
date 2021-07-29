@extends('layouts.app')

@section('title')
    {{ __('Articles') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('layouts.message')

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">{{ __('Articles List') }}</div>
                            <div class="col-md-6">
                                <a href="{{ route('articles.create') }}"
                                   class="btn btn-primary float-right">{{ __('Create Article') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td><img width="100" src="{{ asset($article->image->image) }}"
                                             alt="{{ $article->title }}"></td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('articles.edit', ['article' => $article]) }}"
                                               class="btn btn-success">{{ __('Edit') }}</a>
                                            <a href="{{ route('articles.show', ['article' => $article]) }}"
                                               class="btn btn-primary">{{ __('Detail') }}</a>
                                            <form action="{{ route('articles.destroy', ['article' => $article]) }}"
                                                  onsubmit="return confirm('Are you sure to delete this article?')"
                                                  method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-danger">{{ __('Remove') }}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <br>
                        <br>
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
