@extends('admin.layouts/adminlayout')


@section('title', 'Active Payment Plan Details')
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card shadow-lg">
                <div class="card-header pb-0 p-3">
                    @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                    <div class="d-flex justify-content-between">

                        <h2 class="mb-2">@yield('title')</h2>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route("payment.plan") }}"><i class="fas fa-plus"></i>
                                Back to plans</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered p-5">
                            <tr>
                                <th>Name: </th>
                                <td>{{ ucwords($activePlan->payment_name) }}</td>
                            </tr>
                            <tr>
                                <th>Transaction Code: </th>
                                <td>{{ ucwords($activePlan->transaction_reference) }}</td>
                            </tr>
                            <tr>
                                <th>Price: </th>
                                <td>{{ ucwords($activePlan->amount) }}</td>
                            </tr>
                            <tr>
                                <th>User: </th>
                                <td>{{ ucwords($activePlan->name) }}</td>
                            </tr>
                            <tr>
                                <th>User Email: </th>
                                <td>{{ ucwords($activePlan->email) }}</td>
                            </tr>
                            <tr>
                                <th>Start Date: </th>
                                <td>{{ ucwords(\Carbon\Carbon::parse($activePlan->startDate)->diffForHumans()) }}</td>
                            </tr>
                            <tr>
                                <th>End Date: </th>
                                <td>{{ ucwords(\Carbon\Carbon::parse($endDate)->diffForHumans()) }}</td>
                            </tr>
                            <tr>
                                <th>Remaining  No. of Days: </th>
                                <td>{{ $remainingDays }}</td>
                            </tr>
                            
                          
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('backend/assets/js/core/jquery.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection
