@extends('admin.layouts/adminlayout')


@section('title', 'Create Categories')
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                       
                        <h2 class="mb-2">Create Movie Categories</h2>
                        <p style="float: right"><a class="btn btn-outline-primary"
                                href="{{ route('category.view') }}"><i class="fas fa-university"></i> Back To
                                Categories</a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Category Name"
                                        name="name" aria-label="text" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Category Slug"
                                        name="slug" aria-label="text" value="{{ old('slug') }}">
                                    @error('slug')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <textarea id="editor1" class="form-control form-control-lg @error('description') is-invalid @enderror"
                                placeholder="Category Description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary btn-lg w-100 mt-4 mb-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection