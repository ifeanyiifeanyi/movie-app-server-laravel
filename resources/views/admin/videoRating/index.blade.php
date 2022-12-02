@extends('admin.layouts/adminlayout')


@section('title', 'Video Ratings')
@section('adminlayout')

<

<div class="container-fluid py-4" style="height:100vh">

    <div class="row mt-4" style="height:100vh">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    @if(session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                    
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-2">Video Ratings</h2>
                    </div>
                    <div class="row">

                        @if(!isset($rating->id))
                        {{-- create genre form --}}
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ route('ratings.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                placeholder="Video rating" name="name" aria-label="text"
                                                value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-info btn-lg w-100 mt-4 mb-0">Save</button>
                                </div>
                            </form>
                        </div>
                        @else
                        {{-- update ratings form --}}
                        <div class="col-md-12">
                            <form role="form" method="POST" action="{{ route('ratings.update', $rating->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                 name="name" aria-label="text"
                                                value="{{ $rating->name }}">
                                            @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-lg bg-gradient-warning btn-lg w-100 mt-4 mb-0">Update</button>
                                </div>
                            </form>
                        </div>

                        @endif

                        {{-- display all ratings --}}
                        <div class="col-md-12">
                            <div class="table-responsive p-3">
                                @if($ratings)
                                   
                                    <table class="table table-hover" width="100%">
                                        <tr>
                                            <th>s/n</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($ratings as $rating)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($rating->name) }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{ route('ratings.show', $rating->id) }}" class="btn btn-outline-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form id="delete" action="{{ route('ratings.destroy', $rating->id) }}"
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
                                        
                                    </table>
                                        
                                    

                                @else

                                    <p>No Ratings Available</p>
                                @endif
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