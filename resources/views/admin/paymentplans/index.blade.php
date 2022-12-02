@extends('admin.layouts/adminlayout')


@section('title', 'Payment Plans')
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

                        <h2 class="mb-2">Payment Plans</h2>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route("payment.create") }}"><i class="fas fa-plus"></i>
                                New Plan</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mt-4">
                        <div class="card">
                            <div class="card-header pb-0 px-3">
                                <h3 class="mb-0">Plan Information(s)</h3>
                            </div>
                            <div class="card-body pt-4 p-3">
                                @if(count($allplans))
                                    @foreach ($allplans as $aps)
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="list-group-item mr-2">{{ $loop->iteration }}</div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-3 text-sm">
                                                    {{ $aps->name }} 
                                                    @if($aps->status)
                                                        <span class="bg-success p-2 rounded">Active</span>
                                                    @else
                                                    <span class="bg-secondary p-2 rounded">Draft</span>
                                                    @endif
                                                </h6>
                                                <span class="mb-2 text-xs">Duration No: <span
                                                        class="text-dark font-weight-bold ms-sm-2">{{ $aps->duration_in_number }} Days</span></span>
                                                <span class="mb-2 text-xs">Duration: <span
                                                        class="text-dark ms-sm-2 font-weight-bold">{{ $aps->duration_in_name }}</span></span>
                                                <span class="text-xs">Amount: <span
                                                        class="text-dark ms-sm-2 font-weight-bold">N {{ $aps->amount }}</span></span>
                                            </div>
                                            <div class="ms-auto text-end">
                                                <form id="delete" action="{{ route('payment.delete', $aps->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn bg-danger text-light mb-2 px-3 mb-0"><i class="far fa-trash-alt me-2"></i> Dele</button>
                                                </form>
                                               
                                                <a class="btn btn-link bg-info text-dark px-3 mb-0" href="{{ route('payment.edit', $aps->id) }}"><i
                                                        class="fas fa-pencil-alt text-dark me-2"
                                                        aria-hidden="true"></i>Edit</a>
                                            </div>
                                        </li>
                                    </ul>
                                    @endforeach
                                @else
                                    <p>No Payment plan(s) at the moment</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-4">
                        <div class="card h-100 mb-4">
                            <div class="card-header pb-0 px-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="mb-0">Your Transaction's</h6>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        <small>23 - 30 March 2020</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-4 p-3">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                                <ul class="list-group">
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fas fa-arrow-down"></i></button>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                                <span class="text-xs">27 March 2020, at 12:30 PM</span>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                            - $ 2,500
                                        </div>
                                    </li>
                               
                                </ul>
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                                <ul class="list-group">
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fas fa-exclamation"></i></button>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                                                <span class="text-xs">26 March 2020, at 05:00 AM</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                            Pending
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
<script>
    $(function(){
        $(document).on('click', '#delete', function(e){
          e.preventDefault();
          var link = $(this).data("id");
          console.log({link});
    
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              if($("#delete").submit()){
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            }
          })
        })
    
      })
</script>



@endsection