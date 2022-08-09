@extends('main')
@section('meta')
    <style>
        .page-link{
            background-color: #494848 !important;
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') setting @endsection
@section('setting_active','active fw-bold')

@section('contant')



        <div class="col-lg-8 mb-3 my-md-5  ">
            <div class="card border-secondary bg-transparent  shadow-sm ">

                <div class="card-body table-responsive ">
                 <span class="h3 fw-bolder text-center ">
                    Setting
                </span>
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
                                <a href="{{ route('music.index') }}" class="btn btn-outline-secondary">Songs</a>
                            </div>
                        </div>
                        <div class=" col-6 col-lg-4 mb-3  mb-lg-0 ">
                            <h4 class="mb-3 ">Comming Soon</h4>
                            <div class="mb-2 ">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">.....</a>
                            </div>
                        </div>
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

