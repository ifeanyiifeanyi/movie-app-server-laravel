@extends('admin.layouts/adminlayout')


@section('title', 'Edit Video '.$video->slug)
@section('mystyles')
<style>
    .fa-cog, .l{
        font-size: 35px !important;
        color: #fff !important;
    }
</style>
@endsection
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">

                        <h2 class="mb-2">Edit Video :: {{ ucwords($video->title) }}</h2>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route('videos') }}"><i
                                    class="fas fa-university"></i> Back To Video(s)</a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="" id="update_videos" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                        placeholder="Title" name="title" aria-label="text" value="{{ $video->title }}">
                                    @error('title')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                        placeholder="Slug" name="slug" aria-label="text" value="{{ $video->slug }}">
                                    @error('slug')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option>Select Category</option>
                                        @if(count($categories) > 0)

                                        @foreach ($categories as $category)
                                        <option 
                                        {{ 
                                            $video->category_id == $category->id ? "selected" : "" 
                                        }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                        @else
                                        <option value="">Not Available</option>
                                        @endif
                                    </select>
                                    @error('category_id')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('length') is-invalid @enderror"
                                        placeholder="Duration In Number" name="length" aria-label="text"
                                        value="{{ $video->length }}">
                                    @error('length')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select class="form-control form-control-lg @error('genre_id') is-invalid @enderror"
                                        placeholder="Genre" name="genre_id">
                                        <option value="">Video Genre</option>
                                        @if ($genre)
                                            @foreach ($genre as $genre_value)
                                            <option 
                                            {{ $video->genres_id == $genre_value->id ? "selected" : "" }}
                                             value="{{ $genre_value->id }}">{{ ucwords($genre_value->name) }}</option>
                                                
                                            @endforeach
                                        @else
                                            <option>No genre available</option>
                                        @endif
                                    </select>
                                    @error('genre_id')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('rating_id') is-invalid @enderror"
                                        placeholder="Rating" name="rating_id">
                                        <option value="">Select Video Rating</option>
                                        @if ($ratings)
                                            @foreach ($ratings as $rating)
                                                <option {{ $video->rating_id == $rating->id ? "selected" : "" }} value="{{ $rating->id }}">{{ $rating->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Rating Available</option>
                                        @endif
                                    </select>
                                    @error('rating_id')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select
                                        class="form-control form-control-lg @error('parent_control_id') is-invalid @enderror"
                                        placeholder="Parential Control" name="parent_control_id">
                                        <option value="">Parental Control</option>
                                        @if ($parentControls)
                                            @foreach ($parentControls as $pc)
                                                <option {{ $video->parent_control_id == $pc->id ? "selected" : "" }} value="{{ $pc->id }}">{{ $pc->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No parental Control</option>
                                        @endif
                                    </select>
                                    @error('parent_control_id')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Video</label>
                                    <input type="file" onchange="changeVideo(event)"
                                        class="form-control form-control-lg @error('video') is-invalid @enderror"
                                        placeholder="Video File" name="video" aria-label="text"
                                        value="{{ $video->video}}">
                                    @error('video')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <video id="videoFile" src="{{ asset($video->video) }}" width="150px" height="100px" controls></video>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Thumbnail</label>
                                    <input type="file" onchange="changeImg(event)"
                                        class="form-control form-control-lg @error('thumbnail') is-invalid @enderror"
                                        placeholder="Thumbnail" name="thumbnail" aria-label="text"
                                        value="{{ old('thumbnail') }}">
                                    @error('thumbnail')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <img id="imgFile" src="{{ asset($video->thumbnail) }}" width="150px" height="100px" alt="" class="fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="short_description"
                                        class="form-control form-control-lg @error('short_description') is-invalid @enderror">{{ $video->short_description }}</textarea>
                                    @error('short_description')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="long_description"
                                        class="form-control form-control-lg @error('long_description') is-invalid @enderror">{{ $video->long_description }}</textarea>
                                    @error('long_description')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input {{ $video->status ? "checked" : "" }} @error('status') is-invalid @enderror type="checkbox" name="status"
                                                id="status"> <label for="status">Status</label>
                                            @error('status')
                                            <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="text-center">
                           
                            <button id="btn1" type="submit" class="btn btn-lg bg-gradient-warning btn-lg w-100 mt-4 mb-0">Update
                            </button>


                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
@section('videoScripts')

<script>
    function changeImg(event){
        let imgFile = document.querySelector("#imgFile");
        if(true){
            imgFile.src = URL.createObjectURL(event.target.files[0])
        }
    }

    function changeVideo(event){
        let videoFile = document.querySelector("#videoFile");
        if(true){
            videoFile.src = URL.createObjectURL(event.target.files[0])
        }
    }
</script>

<script src="{{ asset('backend/assets/js/core/jquery.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $("#update_videos").submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);

        $.ajax({
            url: "{{ route('update.videos', $video->id) }}",
            method: "POST",
            data: fd,
            cache:false,
            processData: false,
            contentType:false,
            beforeSend: function () {
                    $('#btn1').html('<i class="fas fa-cog fa-spin"></i> <span class="l">Loading</span>');
                    $('#btn1').attr("disabled", true);
            },
            
            success: function(res){
                console.log(res);
                let data = res.error;
                if (data) {    
                    $('#btn1').html('Update');
                    $('#btn1').attr("disabled", false);
                    $.each(data, function( index, value ) {
                        toastr.error(value);
                    });      
                    return false; 
                }
                if (res.success) {
                    $('#update_videos').trigger("reset");
                    $('#btn1').html('Update');
                    $('#btn1').attr("disabled", false);
                    Swal.fire(
                        'Created',
                        'Content update was successful',
                        'success'
                    );
                    setTimeout(function () {
                        $('#update_videos').trigger("reset");
                        $('#btn1').html('Update');
                        $('#btn1').attr("disabled", false);
                        window.location.href="{{ route('videos') }}";
                    }, 5000);
                }
               
            },

        })
    })
</script>



@endsection