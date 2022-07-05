@extends('main')
@section('title') Category @endsection
@section('profile_active','fw-bolder')
@section('contant')



    <div class="container mt-3 ">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0 ">
                <div class="card bg-transparent border-secondary ">
                    <div class="card-body">
                        <h3 class="fw-bold h4 mb-4 ">Create Category</h3>
                        <form action="{{ route('category.store') }}" method="post" class="">
                            @csrf
                            <input type="text" name="title" class="form-control bg-transparent text-secondary ">
                            <input type="submit" class="btn btn-success mt-2 w-100  ">
                        </form>

                        @error('title')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror



                    </div>
                </div>
            </div>
            <div class="col-md-8 ">
                <div class="card bg-transparent border-secondary ">
                    <div class="card-body table-responsive">
                        <h3 class="fw-bold h4 mb-4 "> Categories</h3>

                        <table class="table text-secondary  table-borderless  ">
                           <thead class="fw-bolder  ">
                           <tr>
                               <td>Id</td>
                               <td>Name</td>
                               <td>Action</td>
                               <td>Created At</td>
                           </tr>
                           </thead>
                          <tbody>
                          @foreach($Genres as $key=>$g)
                              <tr id="Cat{{ $g->id }}">
                                  <td>{{ $key+1 }}</td>
                                  <td class="text-uppercase">{{ $g->name }}</td>
                                  <td class="">
                                      <a href="{{ route('category.edit',$g->id) }}" class="icofont icofont-pencil text-decoration-none btn  btn-outline-warning  "></a>
                                      <form id="deleteGenre" action="{{ route('category.destroy',$g->id) }}" method="post" class="mx-2  d-inline-block  ">
                                          @csrf @method('DELETE')
                                      </form>
                                      <span class="icofont icofont-trash  text-decoration-none btn  btn-outline-danger " onclick="allow('{{$g->name}}','{{ $g->id }}')"></span>

                                  </td>
                                  <td>
                                      <small>{{ $g->created_at->diffForHumans() ?? '' }}</small>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
        <script>
          function allow(name,id){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              Swal.fire({
                  title: 'Are you sure?',
                  text: name,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.isConfirmed) {
                    console.log("/category/"+id);
                      $.ajax({
                          method: "DELETE",
                          url: "/category/"+id,
                          data:{ 'category_id': id , '_token' : '{{ csrf_token() }}' }
                      }).done(function( msg ) {
                          console.log(msg)
                          $('#Cat'+msg.id.id).remove();
                          Swal.fire(
                              'Deleted!',
                              'Successfully Deleted',
                              'success'
                          )
                      });

                  }
              })
          }
        </script>

@endsection
