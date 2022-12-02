@extends('admin.layouts/adminlayout')


@section('title', 'Users')
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
                        <h2 class="mb-2">All Registered Members</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-5">
                        @if(count($users) > 0)
                        <table id="myTable" class="table table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>s/n</th>
                                    <th>Account ID</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->userid }}</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ ucwords($user->username) }}</td>
                                    <td>
                                        @if($user->status)
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                        <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->role_as)
                                        <p class="badge bg-success">Admin</p>
                                        <p>
                                            <a href="{{ route('admin.revoke', $user->id) }}" class="badge badge-sm bg-gradient-secondary">Revoke</a>
                                        </p>
                                        @else
                                        <p class="badge badge-sm bg-gradient-secondary">Suscriber</p>
                                        <p>
                                            <a href="{{ route('make.admin', $user->id) }}" class="badge badge-sm bg-gradient-success">Grant</a>
                                        </p>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a title="View user Details"
                                                    href="{{ route('users.detail', $user->id) }}"
                                                    class="btn btn-primary"><i class="far fa-eye"></i></a>
                                            </div>
                                            <div class="col-md-4">
                                                @if($user->status === "1")
                                                <a title="suspend Account" href="{{ route('users.suspend', $user->id) }}" class="btn btn-warning"><i
                                                        class="fas fa-window-close"></i></a>
                                                @else 

                                                <a title="Activate Account" href="{{ route('users.activate', $user->id) }}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                                @endif
                                            </div>
                                            <div class="col-md-4" title="Delete user account">
                                                <form id="delete" action="{{ route('user.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($users->hasPages())
                            <div class="pagination-wrapper text-dark">
                                {{ $users->links() }}
                            </div>
                        @endif
                        @else
                        <p>No registered member(s)</p>
                        @endif
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