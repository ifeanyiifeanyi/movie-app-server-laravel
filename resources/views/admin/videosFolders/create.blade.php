@extends('admin.layouts/adminlayout')


@section('title', 'Create Video')
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                       
                        <h6 class="mb-2">Create Video</h6>
                        <p style="float: right"><a class="btn btn-outline-primary"
                                href="{{ route('videos') }}"><i class="fas fa-university"></i> Back To Video(s)</a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" placeholder="Title"
                                        name="title" aria-label="text" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('slug') is-invalid @enderror" placeholder="Slug"
                                        name="slug" aria-label="text" value="{{ old('slug') }}">
                                    @error('slug')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select class="form-control form-control-lg @error('category_id') is-invalid @enderror"      name="category_id">
                                        <option>Select Category</option>
                                        @if(count($categories) > 0)

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            
                                        @else
                                            
                                        @endif
                                    </select>
                                    @error('category_id')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('duration_in_number') is-invalid @enderror" placeholder="Duration In Number"
                                        name="duration_in_number" aria-label="text" value="{{ old('duration_in_number') }}">
                                    @error('duration_in_number')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input @error('status') is-invalid @enderror type="checkbox" name="status" id="status"> <label for="status">Status</label>
                                    @error('status')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input @error('status') is-invalid @enderror type="checkbox" name="status" id="status"> <label for="status">Status</label>
                                    @error('status')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection