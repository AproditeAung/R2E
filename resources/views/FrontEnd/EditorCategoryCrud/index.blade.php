@extends('main')
@section('title') Category @endsection
@section('profile_active','fw-bolder')
@section('contant')



    <div class="container mt-3 ">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0 ">
                <div class="card bg-transparent border-secondary ">
                    <div class="card-body">
                        <h3 class="fw-bold h4 mb-4 "><i class="icofont icofont-blogger text-primary me-3 "></i>Create BLog Category </h3>
                        <form action="{{ route('category.store') }}" method="post" id="createBlogCategory" class="">
                            @csrf
                            <input type="text" name="title" class="form-control bg-transparent text-secondary ">
                            <button type="button" onclick="LoadingShow('createBlogCategory')" class="btn btn-primary mt-2 w-100 text-white  "> Create </button>
                        </form>

                        @error('title')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror



                    </div>
                </div>
                <div class="card bg-transparent border-secondary mt-3  ">
                    <div class="card-body">
                        <h3 class="fw-bold h4 mb-4 "> <i class="icofont icofont-music-notes text-primary me-3  "></i> Create Music Category </h3>
                        <form action="{{ route('music_category.store') }}" id="createMusicCategory" method="post" class="">
                            @csrf
                            <input type="text" name="name" class="form-control bg-transparent text-secondary ">
                            <button type="button" onclick="LoadingShow('createMusicCategory')" class="btn btn-secondary mt-2 w-100  "> Create </button>
                        </form>

                        @error('name')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror



                    </div>
                </div>
            </div>
            <div class="col-md-8 ">
                <div class="card bg-transparent border-secondary ">
                    <div class="card-body table-responsive">
                        <h3 class="fw-bold h4 mb-4 ">BLog Categories</h3>

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
                          @foreach($categories as $key=>$category)
                              <tr id="Cat{{ $category->id }}">
                                  <td>{{ $key+1 }}</td>
                                  <td class="text-uppercase">{{ $category->name }}</td>
                                  <td class="">
                                      <a href="{{ route('category.edit',$category->id) }}" class="icofont icofont-pencil text-decoration-none btn  btn-outline-warning  "></a>
                                      @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                                          <form id="deleteGenre" action="{{ route('category.destroy',$category->id) }}" method="post" class="mx-2  d-inline-block  ">
                                              @csrf @method('DELETE')
                                          </form>
                                          <span class="icofont icofont-trash  text-decoration-none btn  btn-outline-danger " onclick="allow('{{$category->name}}','{{ $category->id }}')"></span>

                                      @endif

                                  </td>
                                  <td>
                                      <small>{{ $category->created_at->diffForHumans() ?? '' }}</small>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                <div class="card bg-transparent border-secondary mt-4  ">
                    <div class="card-body table-responsive">
                        <h3 class="fw-bold h4 mb-4 ">Music Categories</h3>

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
                          @foreach($musicCategories as $key=>$musicCategory)
                              <tr id="Cat{{ $musicCategory->id }}">
                                  <td>{{ $key+1 }}</td>
                                  <td class="text-uppercase">{{ $musicCategory->name }}</td>
                                  <td class="">
                                      <a href="{{ route('music_category.edit',$musicCategory->id) }}" class="icofont icofont-pencil text-decoration-none btn  btn-outline-warning  "></a>
                                      @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                                          <form id="deleteGenre" action="{{ route('category.destroy',$musicCategory->id) }}" method="post" class="mx-2  d-inline-block  ">
                                              @csrf @method('DELETE')
                                          </form>
                                          <span class="icofont icofont-trash  text-decoration-none btn  btn-outline-danger " onclick="allow('{{$musicCategory->name}}','{{ $musicCategory->id }}')"></span>

                                      @endif

                                  </td>
                                  <td>
                                      <small>{{ $musicCategory->created_at->diffForHumans() ?? '' }}</small>
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
