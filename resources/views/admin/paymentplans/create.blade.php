@extends('admin.layouts/adminlayout')


@section('title', 'Create Payment Plans')
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                       
                        <h2 class="mb-2">Create Payment Plans</h2>
                        <p style="float: right"><a class="btn btn-outline-primary"
                                href="{{ route('payment.plan') }}"><i class="fas fa-university"></i> Back To
                                Payment plans </a></p>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('payment.save') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Payment Plan Name"
                                        name="name" aria-label="text" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('amount') is-invalid @enderror" placeholder="Amount"
                                        name="amount" aria-label="text" value="{{ old('amount') }}">
                                    @error('amount')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-lg @error('duration_in_name') is-invalid @enderror" placeholder="Duration In Name"
                                        name="duration_in_name" aria-label="text" value="{{ old('duration_in_name') }}">
                                    @error('duration_in_name')
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