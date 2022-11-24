@extends('admin.layouts/adminlayout')


@section('title', 'Genre')
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

                        <h6 class="mb-2">Genre</h6>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST" action="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                placeholder="Category Name" name="name" aria-label="text"
                                                value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                placeholder="Category Slug" name="slug" aria-label="text"
                                                value="{{ old('slug') }}">
                                            @error('slug')
                                            <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <textarea
                                        class="form-control form-control-lg @error('description') is-invalid @enderror"
                                        placeholder="Category Description"
                                        name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive p-3">
                                <table class="table table-hover" width="100%">
                                    <tr>
                                        <th>s/n</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>name</td>
                                        <td>action</td>
                                    </tr>
                                </table>
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