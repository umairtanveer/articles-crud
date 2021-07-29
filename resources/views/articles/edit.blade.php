@extends('layouts.app')

@section('title')
    {{ __('Update Article') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.message')
            <div class="col-md-12">
                <form action="{{ url('articles/update', ['id' => $article->id]) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">{{ __('Update Article') }}</div>
                                <div class="col-md-6">
                                    <button type="submit"
                                            class="btn btn-primary float-right">{{ __('Save Changes') }}</button>

                                    <a href="{{ route('articles.index') }}"
                                       class="btn btn-secondary float-right mr-3">{{ __('Back') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" maxlength="256" name="title" id="title"
                                               value="{{ old('title', $article->title) }}" required>
                                        @error('title')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">{{ __('Detail') }}</label>
                                        <textarea name="detail" class="form-control" id="detail" maxlength="1000"
                                                  cols="30" required
                                                  rows="10"> {{ old('detail', $article->detail) }}</textarea>
                                        @error('detail')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="panel">
                                            <div class="button_outer">
                                                <div class="btn_upload">
                                                    <input type="file" id="upload_file" name="image">
                                                    {{ __('Upload Image') }}
                                                </div>
                                                <div class="processing_bar"></div>
                                                <div class="success_box"></div>
                                            </div>
                                        </div>
                                        <div class="error_msg"></div>
                                        <div class="uploaded_file_view" id="uploaded_view">
                                            <span class="file_remove">X</span>
                                        </div>

                                        <img src="{{ asset($article->image->image) }}" id="old_image"
                                             width="200" alt="{{ $article->title }}">

                                        @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
