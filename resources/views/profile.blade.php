@extends('main')
@section('meta')
    <style>
        .page-link{
            background-color: #494848 !important;
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') profile @endsection
@section('profile_active','fw-bold')

@section('contant')


    <div class="col-lg-8 my-md-5  ">
        <div class="card border-secondary bg-transparent  shadow-sm ">

            <div class="card-body table-responsive ">
                 <span class="h3 fw-bolder text-center ">
                    Setting
                </span>
                <hr>
                <div class="row ">
                    <div class="col-lg-4 mb-3  mb-lg-0 ">
                        <h4 class="mb-3 ">BLog Manager</h4>
                        <div class="mb-2 ">
                            <a href="{{ route('blog.create') }}" class="btn btn-outline-secondary">Create Blog</a>
                        </div>
                        <div class="mb-2 ">
                            <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">Blogs</a>
                        </div>
                        <div class="mb-2 ">
                            <a href="{{ route('blog.create') }}" class="btn btn-outline-secondary">Create Category</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-3  mb-lg-0 ">
                        <h4 class="mb-3 ">Video Manager</h4>
                        <div class="mb-2 ">
                            <a href="{{ route('blog.create') }}" class="btn btn-outline-secondary">Create Video</a>
                        </div>
                        <div class="mb-2 ">
                            <a href="{{ route('blog.create') }}" class="btn btn-outline-secondary">Videos</a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-3  mb-lg-0 ">
                        <h4 class="mb-3 ">Comming Soon</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 my-md-5  ">
        <div class="card border-secondary shadow-sm bg-transparent ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center   ">
{{--                    <img  src="https://cdn-icons-png.flaticon.com/128/4128/4128176.png" width="40" alt="">--}}
                    <span class="fw-bold h3 mb-0  ">Profile</span>
                </div>
                <hr >

                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Name</span>
                    <span class="fw-bold h6 ">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Role</span>
                    <span class="fw-bold h6 ">
                        {{ $user->role == '0' ? 'Reader' : 'Editor' }}
                        @if($user->role == '0')
                            @include('components.upgraderow')
                            @endif
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Gmail</span>
                    <span class="fw-bold h6 ">{{ $user->email }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline  mt-3   ">
                    <span class="fw-bold h6 ">Phone</span>
                    <span class="fw-bold h6 ">{{ $user->phone }}</span>
                </div>

            </div>
        </div>
    </div>

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

