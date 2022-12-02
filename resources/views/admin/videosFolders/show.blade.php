@extends('admin.layouts/adminlayout')


@section('title', 'Video Details :: '.$video->slug)
<style>
    input, textarea, select{
        border: none !important;
    }
</style>

@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">

                        <h2 class="mb-2">Video Details:: {{ ucwords($video->title) }}</h2>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route('videos') }}"><i
                                    class="fas fa-university"></i> Back To Video(s)</a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                        name="title" aria-label="text" value="{{ $video->title }}" disabled>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                        name="slug" aria-label="text" value="{{ $video->slug }}" disabled>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('category_id') is-invalid @enderror"
                                        name="category_id" disabled>
                                        <option>Select Category</option>
                                        @if(count($categories) > 0)

                                        @foreach ($categories as $category)
                                        <option {{ $video->category_id == $category->id ? "selected" : ""
                                            }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                        @else
                                        <option value="">Not Available</option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('length') is-invalid @enderror"
                                        name="length" aria-label="text" value="{{ $video->length }}" disabled>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select class="form-control form-control-lg @error('genre_id') is-invalid @enderror"
                                        placeholder="Genre" name="genre_id" disabled>
                                        <option value="">Video Genre</option>
                                        @if ($genre)
                                        @foreach ($genre as $genre_value)
                                        <option {{ $video->genres_id == $genre_value->id ? "selected" : "" }}
                                            value="{{ $genre_value->id }}">{{ ucwords($genre_value->name) }}</option>

                                        @endforeach
                                        @else
                                        <option>No genre available</option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('rating_id') is-invalid @enderror"
                                        name="rating_id" disabled>
                                        <option value="">Select Video Rating</option>
                                        @if ($ratings)
                                        @foreach ($ratings as $rating)
                                        <option {{ $video->rating_id == $rating->id ? "selected" : "" }} value="{{
                                            $rating->id }}">{{ $rating->name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">No Rating Available</option>
                                        @endif
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('parent_control_id') is-invalid @enderror"
                                        name="parent_control_id" disabled>
                                        <option value="">Parental Control</option>
                                        @if ($parentControls)
                                        @foreach ($parentControls as $pc)
                                        <option {{ $video->parent_control_id == $pc->id ? "selected" : "" }} value="{{
                                            $pc->id }}">{{ $pc->name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">No parental Control</option>
                                        @endif
                                    </select>

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="label">Video File</label>
                                <video id="videoFile" src="{{ asset($video->video) }}" width="100%" height="300px"
                                    controls></video>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="label">Video Thumbnail</label>
                                <img id="imgFile" src="{{ asset($video->thumbnail) }}" width="100%" height="300px"
                                    alt="" class="fluid">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="mb-3">
                                    <textarea name="short_description"
                                        class="form-control form-control-lg @error('short_description') is-invalid @enderror"
                                        disabled>{{ $video->short_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="long_description"
                                        class="form-control form-control-lg @error('long_description') is-invalid @enderror"
                                        disabled>{{ $video->long_description }}</textarea>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    @if ($video->status)
                                    <p class="badge bg-gradient-success">{{ ('Active') }}</p>
                                    @else
                                    <p class="badge bg-gradient-secondary">{{ ('Draft') }}</p>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection