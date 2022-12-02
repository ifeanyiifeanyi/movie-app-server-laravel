@extends('admin.layouts/adminlayout')


@section('title', 'All Videos')
@section('adminlayout')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<div class="container-fluid py-4" style="height:100vh">

  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">
        <div class="card-header pb-0 p-3">
          @if(session('status'))
          <div class="alert alert-success">{{session('status')}}</div>
          @endif
          <div class="d-flex justify-content-between">

            <h2 class="mb-2">All Vidoes</h2>
            <p style="float: right"><a class="btn btn-outline-primary" href="{{ route("create.videos") }}"><i
                  class="fas fa-plus"></i> New Video</a>
            </p>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="height: 100vh">
            <table id="myTable" class="table table-hover w-100" >
              <thead class="bg-gradient-dark">
                <tr>
                  <th>s/n</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Thumbnail</th>
                  <th>Category</th>
                  <th>Genre</th>
                  <th>PC</th>
                  <th>Rating</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @if($videos)
              <tbody>
                @foreach ($videos as $video)

                <tr>
                  <td>{{$loop->iteration }}</td>
                  <td>
                    {{ ucwords($video->title) }}
                    <br>
                    <a title="view {{ ucwords($video->slug) }}" href="{{ route("show.videos", $video->id) }}" class="badge bg-gradient-info badge-sm">
                      <i class="fas fa-eye"></i> View
                    </a><br>
                    @if($video->status)
                    <a href="{{ route("draft.videos", $video->id) }}" class="badge bg-gradient-dark badge-sm">
                      Send to Draft
                    </a>
                    @else
                    <a href="{{ route("activate.videos", $video->id) }}" class="badge bg-gradient-success badge-sm">
                      Activate
                    </a>
                    @endif
                  </td>
                  <td>{{ ucwords($video->slug) }}</td>
                  <td>
                    <img src="{{ asset($video->thumbnail) }}" alt="Thumbnail" width="100px" height="80px" class="">
                  </td>
                  <td>{{ ucwords($video->catName) }}</td>
                  <td>{{ ucwords($video->genName) }}</td>
                  <td>{{ ucwords($video->PcName) }}</td>
                  <td>{{ ucwords($video->rateName) }}</td>
                  <td>
                    @if($video->status )
                    <span class="badge bg-gradient-success">Active</span>
                    @else
                    <span class="badge bg-gradient-secondary">Draft</span>

                    @endif
                  </td>
                  <td>
                    <div class="row">

                      <div class="col-md-4">
                        <a title="Edit" href="{{ route("edit.videos", $video->id) }}" class="badge bg-gradient-primary badge-sm">
                          <i class="fas fa-edit"></i>
                        </a>
                      </div>
                      <div class="col-md-4">
                        <form id="delete" action="{{ route("destory.videos", $video->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button title="Delete" style="border: none" type="submit" class="badge bg-gradient-danger badge-sm"><i
                              class="fas fa-times"></i></button>
                        </form>

                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
              @else

              <p class="lead">This is awkward, try again later</p>
              @endif
            </table>
            @if ($videos->hasPages())
            <div class="pagination-wrapper text-dark">
              {{ $videos->links() }}
            </div>
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
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 <script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>
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