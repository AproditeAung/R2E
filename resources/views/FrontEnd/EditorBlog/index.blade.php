@extends('main')
@section('title') Blog @endsection
@section('blog_index_active','mm-active')
@section('contant')

    <div class=" mt-5 ">
        <div class="col-12">
            <div class="card bg-transparent border-secondary ">

                <div class="card-body table-responsive">
                     <span class="h3 fw-bolder mb-0 p-3  ">
                        Your Blogs
                    </span>
                    <hr>

                    <table class="table table-borderless  table-hover ">
                        <thead>
                        <tr class="icon-gradient bg-happy-fisher  ">
                            <td>No</td>
                            <td>Titile</td>
                            <td>Sample</td>
                            <td>Actions</td>
                        </tr>
                        </thead>

                        <tbody >
                            @forelse($blogs as $key=>$blog)
                                <tr>
                                    <td class="  ">{{ $key+1 }}</td>
                                    <td class="  ">{{\Illuminate\Support\Str::limit($blog->title,40) }}</td>
                                    <td class="  ">{{ \Illuminate\Support\Str::limit($blog->sample,50) }}</td>
                                    <td>
                                        @if($blog->user->role == 2)
                                            <form action="{{ route('blog.destroy',$blog->id) }}" id="blogDelete" method="post">
                                                @csrf @method('delete')
                                            </form>
                                            <button class="btn-outline btn-danger " type="button" onclick="confirm()"><i class="icofont icofont-trash"></i></button>
                                            <a href="{{ route('pin.post',$blog->id) }}" class="btn btn-outline-{{ $blog->pinBlog == '1' ? 'success' : 'outline-success' }}"><i class="pe-7s-pin"></i></a>
                                        @endif

                                        <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-outline-secondary "><i class="icofont icofont-pen-alt-2"></i></a>
                                        <a href="{{ route('blog.show',$blog->id) }}" class="btn btn-outline-info "><i class="icofont icofont-info"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center fw-bolder text-danger">NO BLOGS</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
