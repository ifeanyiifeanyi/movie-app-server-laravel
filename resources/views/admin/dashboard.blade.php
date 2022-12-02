@extends('admin.layouts/adminlayout')

@section('title', 'Dashboard')
@section('adminlayout')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Videos</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $active_video }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Last Update</span><br>
                                        {{ \Carbon\Carbon::parse($last_inserted_video_date)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-button-play text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Draft Videos</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $draft_video }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Last Update</span><br>
                                        {{ \Carbon\Carbon::parse($last_inserted_video_date)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-button-pause text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Users</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $active_users }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">
                                            Last created
                                        </span>
                                        {{ \Carbon\Carbon::parse($last_created_user_account_date)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Inactive Users</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $inactive_users }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">
                                            Last created
                                        </span>
                                        {{ \Carbon\Carbon::parse($last_created_user_account_date)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-success text-center rounded-circle">
                                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mt-3">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Admin</p>
                                    <h5 class="font-weight-bolder">
                                    {{$admin_users}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">
                                            Last created
                                        </span>
                                        {{ \Carbon\Carbon::parse($last_created_user_account_date)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-warning text-center rounded-circle">
                                    <i class="ni ni-settings-gear-65 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">Categories</h4>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @if ($categories)
                                @foreach ($categories as $category)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-primary shadow text-center">
                                            <i class="ni ni-mobile-button text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm"><i class="ni ni-check-bold text-primary opacity-10"></i></h6>
                                            <span class="text-xs"><span class="font-weight-bold">{{ ucwords($category->name) }}</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                @endforeach
                            @else
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-danger text-sm"><div class="fas fa-times"></div> </h6>
                                        <span class="text-xs"><span class="font-weight-bold">No category avaliable</span></span>
                                    </div>
                                </div>
                                
                            </li>
                            @endif
                            
                        
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">Genre</h4>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @if ($genres)
                                @foreach ($genres as $genre)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center">
                                            <i class="ni ni-bell-55 text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm"><i class="ni ni-check-bold text-primary opacity-10"></i></h6>
                                            <span class="text-xs"><span class="font-weight-bold">{{ ucwords($genre->name) }}</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                @endforeach
                            @else
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-danger text-sm"><div class="fas fa-times"></div> </h6>
                                        <span class="text-xs"><span class="font-weight-bold">No Genre avaliable</span></span>
                                    </div>
                                </div>
                                
                            </li>
                            @endif
                            
                        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection