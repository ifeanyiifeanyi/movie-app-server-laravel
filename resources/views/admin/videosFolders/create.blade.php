@extends('admin.layouts/adminlayout')


@section('title', 'Create Video')
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

                        <h6 class="mb-2">Create Video</h6>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route('videos') }}"><i
                                    class="fas fa-university"></i> Back To Video(s)</a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="" id="add_videos" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                        placeholder="Title" name="title" aria-label="text" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                        placeholder="Slug" name="slug" aria-label="text" value="{{ old('slug') }}">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        value="{{ old('length') }}">
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
                                            <option value="{{ $genre_value->id }}">{{ ucwords($genre_value->name) }}</option>
                                                
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
                                        <option value="">Video Rating</option>
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
                                    <input type="file"
                                        class="form-control form-control-lg @error('video') is-invalid @enderror"
                                        placeholder="Video File" name="video" aria-label="text"
                                        value="{{ old('video') }}">
                                    @error('video')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Thumbnail</label>
                                    <input type="file"
                                        class="form-control form-control-lg @error('thumbnail') is-invalid @enderror"
                                        placeholder="Thumbnail" name="thumbnail" aria-label="text"
                                        value="{{ old('thumbnail') }}">
                                    @error('thumbnail')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="short_description"
                                        class="form-control form-control-lg @error('short_description') is-invalid @enderror"
                                        placeholder="Short Description"></textarea>
                                    @error('short_description')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="long_description"
                                        class="form-control form-control-lg @error('long_description') is-invalid @enderror"
                                        placeholder="Long Description"></textarea>
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
                                            <input @error('status') is-invalid @enderror type="checkbox" name="status"
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
                           
                            <button id="btn1" type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Save
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

<script src="{{ asset('backend/assets/js/core/jquery.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $("#add_videos").submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);

        $.ajax({
            url: "{{ route('store.videos') }}",
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
                    $('#btn1').html('Save');
                    $('#btn1').attr("disabled", false);
                    $.each(data, function( index, value ) {
                        toastr.error(value);
                    });      
                    return false; 
                }
                if (res.status === 200) {
                    $('#add_videos').trigger("reset");
                    $('#btn1').html('Save');
                    $('#btn1').attr("disabled", false);
                    Swal.fire(
                        'Created',
                        'Content upload was successful',
                        'success'
                    );
                    setTimeout(function () {
                        $('#add_videos').trigger("reset");
                        $('#btn1').html('Save');
                        $('#btn1').attr("disabled", false);
                        window.location.href="{{ route('videos') }}";
                    }, 50000);
                }
               
            },

        })
    })
</script>



@endsection