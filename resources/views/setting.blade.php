@extends('main')
@section('meta')
    <link rel="icon" href="{{ asset('Image/profile.webp') }}">
@endsection
@section('style')
    <style>
        .page-link{
            background-color: #494848 !important;   
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') setting @endsection
@section('setting_active','active fw-bold')
@section('image','https://cdn3d.iconscout.com/3d/free/thumb/settings-3543017-2969404.png')
@section('contant')

        <div class="col-lg-8 mb-3 my-md-5  ">
            <div class="card border-secondary bg-transparent  shadow-sm ">

                <div class="card-body table-responsive ">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h3 fw-bolder text-center ">
                            Setting
                        </div>
                       @if(\Illuminate\Support\Facades\Auth::user()->role != '0')
                            <div class="h3 fw-bolder text-center ">
                                <a href="{{ route('dashboard') }}" class=" btn btn-outline-secondary ">Dashboard</a>
                            </div>
                           @endif
                    </div>
                    <hr>
                    <div class="row ">
                        <div class=" col-6 col-lg-4 mb-3  mb-lg-0 ">
                            <h4 class="mb-3 ">BLog Manager</h4>
                            <div class="mb-2 ">
                                <a href="{{ route('blog.create') }}" class="btn btn-outline-secondary">Create Blog</a>
                            </div>
                            <div class="mb-2 ">
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">Blogs</a>
                            </div>
                            <div class="mb-2 ">
                                <a href="{{ route('category.create') }}" class="btn btn-outline-secondary">Create Category</a>
                            </div>
                        </div>
                        <div class=" col-6 col-lg-4 mb-3  mb-lg-0 ">
                            <h4 class="mb-3 ">Music Manager</h4>
                            <div class="mb-2 ">
                                <a href="{{ route('artist.create') }}" class="btn btn-outline-secondary">Upload Artist</a>
                            </div>
                            <div class="mb-2 ">
                                <a href="{{ route('music.create') }}" class="btn btn-outline-secondary">Upload Music</a>
                            </div>
                            <div class="mb-2 ">
                                <a href="{{ route('all.music') }}" class="btn btn-outline-secondary">Songs</a>
                            </div>
                        </div>
                        <div class=" col-6 col-lg-4 mb-3  mb-lg-0 ">
                            <h4 class="mb-3 ">Video Manager</h4>
                            <div class="mb-2 me-4  ">
                                <img src="{{ asset('Image/coming-soon.png') }}" width="100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       @if(\Illuminate\Support\Facades\Auth::user()->role == '2')
           <div class="col-lg-4 mb-3 my-md-5  ">
               <div class="card border-secondary bg-transparent  shadow-sm ">

                   <div class="card-body ">
                        <div class="mb-3 ">
                              <span class="h3 fw-bolder text-center ">
                            User Manager
                            </span>
                            <hr>
                            <div class="d-flex flex-wrap justify-content-between ">
                                <div class="mb-2 me-2 ">
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">User List</a>
                                </div>
                                <div class="mb-2 me-2 ">
                                    <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary">Contact List</a>
                                </div>
                                <div class="mb-2 me-2 ">
                                    <a href="{{ route('requestEditor.index') }}" class="btn btn-outline-secondary">Editor List</a>
                                </div>
                            </div>
                        </div>

                      <div class="">
                           <span class="h3 fw-bolder text-center  ">
                               Contact Manager
                        </span>
                          <hr>
                          <div class="mb-2 me-2 ">
                              <a href="{{ route('user.create') }}" class="btn btn-outline-secondary">Create User</a>
                          </div>
                      </div>

                   </div>
               </div>
           </div>
    @endif



@endsection
@section('script')

    <script>
        function confirm()
        {
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
                    $('#blogDelete').submit();
                }
            })
        }
    </script>

@endsection

