@extends('admin.layouts/adminlayout')


@section('title', 'User profile :: '.$user->username)
@section('adminlayout')

<div class="container-fluid py-4" style="height:100vh">

  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          @if(session('status'))
          <div class="alert alert-success">{{session('status')}}</div>
          @endif
          <div class="d-flex justify-content-between">

            <h6 class="mb-2">user Details</h6>
            <p style="float: right"><a class="btn btn-outline-primary" href="{{ route('users.all') }}"><i
                  class="fas fa-arrow-left"></i> Back</a>
            </p>

          </div>
          <h5>
            Account Status<sup><span class="font-weight-light">, {{ $user->status === 1 ? "Active" : "Inactive"
                }}</span></sup>
          </h5>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card-body card-profile shadow-lg">
              <img style="height: 30vh;object-fit:cover" src="{{ asset('backend/assets/img/bg-profile.jpg') }}"
                alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-4 col-lg-4 order-lg-2">
                  <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                    <a href="javascript:;">
                      <img src="{{ $user->image ? $user->image : "
                        https://ui-avatars.com/api/?name=No+image&background=0D8ABC&color=fff&bold=true&size=128" }}"
                        class="rounded-circle img-fluid border border-2 border-white">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                <div class="d-flex justify-content-between">
                  <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Approve Payment</a>
                  <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                      class="ni ni-collection"></i></a>
                  <a href="{{ route('users.suspend', $user->id) }}" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block"> Suspend
                    Account</a>
                  <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                      class="ni ni-email-83"></i></a>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <h4>Dated Joined: </h4>
                    <p class="leading">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
                  </div>
                </div>
                <div class="text-center mt-4">
                  <h5>
                    {{ ucwords($user->name) }}<sup><span class="font-weight-light">, {{ $user->role_as === 1 ? "Admin" :
                        "Suscriber" }}</span></sup>
                  </h5>

                  <div class="h6 font-weight-300">
                    <i class="ni location_pin mr-2"></i>{{ $user->email }}
                  </div>

                  <div>
                    <i class="ni education_hat mr-2"></i> {{ $user->userid }}
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-2"></div>
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