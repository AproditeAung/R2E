@extends('Backend.layout.app')
@section('title') Movie @endsection
@section('one_movie_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Movie Create </div>
            </div>


        </div>
    </div>

    <div class="container-fluid  mt-3 p-0">
        <div class="row p-0 ">

            <div class="col-md-8">
                <div class="card ">
                    <div class="card-body ">
                        <h4 class="icon-gradient bg-mean-fruit d-flex align-items-center  ">
                            <span class="pe-7s-video mr-3 h2  "></span>
                            <span class="lead "> Movie Lists  </span>
                        </h4>
                        <table class="table  table-bordered  p-0  mt-3 table-responsive-md  ">
                            <tr class="table-success font-weight-bolder  ">
                                <td>No</td>
                                <td>Title</td>
                                <td>Director</td>
                                <td> Year</td>
                                <td>Action</td>
                            </tr>

                            <tbody>
                            @foreach($movies as $m)
                                <tr>
                                    <td>{{ $m->id }}</td>
                                    <td class="text-nowrap ">{{ $m->title }} <span>{{ $m->is_serie ? '(Series)' : '(Movie)' }}</span></td>
                                    <td class="text-nowrap ">{{ $m->director }}</td>
                                    <td>{{ $m->release_year }}</td>
                                    <td class="  ">
                                        <a href="{{ route('movie.edit',$m->id) }}" class="pe-7s-pen text-decoration-none  text-warning  fsize-1 "></a>
                                        <a href="{{ route('movie.show',$m->id) }}" class="pe-7s-info text-decoration-none  mx-2   fsize-1 "></a>
                                        <form id="deleteGenre" action="{{ route('movie.destroy',$m->id) }}" method="post" class=" d-inline     ">
                                            @csrf @method('DELETE')
                                            <div class="pe-7s-trash text-danger   text-decoration-none  fsize-1 " onclick="allow('{{$m->title}}','{{ $m->id }}')"></div>
                                        </form>

                                    </td>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                        <span >{!! $movies->links() !!}</span>
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
                title: name,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteGenre').submit();
                }
            })
        }
    </script>

@endsection
