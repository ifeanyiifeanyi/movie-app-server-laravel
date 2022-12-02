@extends('admin.layouts/adminlayout')


@section('title', 'Categories')
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
                      
                        <h2 class="mb-2">Movie Categories</h2>
                        <p style="float: right"><a class="btn btn-outline-primary" href="{{ route('category.create') }}"><i class="fas fa-plus"></i> New Category</a></p>
                    </div>
                </div>
                <div class="table-responsive p-5">
                    <table class="table table-hover" style="width: 100%">
                        <tbody>
                           <tr>
                            <th>s/n</th>
                            <th>Name</th>
                            <th>Action</th>
                           </tr>
                           @if(count($categories) > 0)
                            @foreach ($categories as $c)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($c->name) }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('category.edit', $c->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-3">
                                            <form id="delete" action="{{ route('category.delete', $c->id) }}"
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
                            
                           @else
                            <p class="text-lg text-secondary">No Categories at the moment ...</p>
                           @endif
                            
                        </tbody>
                    </table>
                    @if ($categories->hasPages())
                    <div class="pagination-wrapper text-dark">
                        {{ $categories->links() }}
                    </div>
                @endif
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