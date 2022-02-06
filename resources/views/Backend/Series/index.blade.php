@extends('Backend.layout.app')
@section('title') Dashboard @endsection
@section('serie_index_active','mm-active')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper d-flex justify-content-between align-items-center ">
            <div class="page-title-heading d-flex justify-content-between ">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit ">   </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Dashboard</div>
            </div>
            <div class=" "> {{ $movies->links()  }}</div>

        </div>
    </div>

    <div class="container-fluid p-0   page-title-heading mt-3 mt-md-4 ">
        <div class="row ">
            <div class="col-xxl-10  m-auto ">
                <div class="card app-page-title ">
                    <div class="card-body bg-transparent ">
                        <table class="table   table-borderless mb-0 fw-bolder  table-responsive-md  icon-gradient bg-mean-fruit" id="dataTable">
                            <thead>
                            <tr >
                                <td class="w-25 ">id</td>
                                <td class="w-25 ">Movie name</td>
                                <td class="w-25 ">Director name</td>
                                <td>Relase year</td>
                            </tr>
                            </thead>
                        </table>
                        <div class="accordion accordion-flush  border border-light  " id="accordionFlushExample">
                            @foreach($movies as $movie)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne{{$movie->id}}">
                                        <button class="accordion-button collapsed icon-gradient bg-mean-fruit" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$movie->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$movie->id}}">
                                            <table class="table   table-borderless    mb-0  table-responsive-md  icon-gradient bg-mean-fruit" id="dataTable">
                                                <tbody>
                                                    <tr>
                                                        <td class="w-25 ">{{ $movie->id }}</td>
                                                        <td class="w-25 ">{{ $movie->title }}</td>
                                                        <td class="w-25 ">{{ $movie->director }}</td>
                                                        <td>{{ $movie->release_year }}</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </button>
                                    </h2>


                                    <div id="flush-collapseOne{{$movie->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{$movie->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-right ">
                                            <div class="row">
                                                <div class=" p-3 app-page-title d-inline    ">
                                                    <a href="{{ route('movie.edit',$movie->id) }}" class="pe-7s-pen text-decoration-none  h2  text-warning   "></a>
                                                    <a href="{{ route('movie.show',$movie->id) }}" class="pe-7s-info text-decoration-none h2   mx-3    "></a>
                                                    <form id="deleteGenre" action="{{ route('movie.destroy',$movie->id) }}" method="post" class=" d-inline     ">
                                                        @csrf @method('DELETE')
                                                        <div class="pe-7s-trash text-danger  h2  text-decoration-none " onclick="allow('{{$movie->title}}','{{ $movie->id }}')"></div>
                                                    </form>
                                                </div>
                                                @foreach($movie->series as $key=>$s)
                                                    <div class="col-md-4 mt-3 ">
                                                        <div class="card  app-page-title">
                                                            <div class="card-body p-2 ">
                                                                <div class="d-flex justify-content-between align-items-baseline ">
                                                                    <div class="h5 icon-gradient bg-mean-fruit mb-3 "> Episode {{ $s->episode }} </div>
                                                                    <a href="{{ route('serie.edit',$s->id) }}" class="text-decoration-none">
                                                                        <i class="pe-7s-pen   "></i>
                                                                    </a>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-start ">
                                                                    @foreach($s->quality  as $q)
                                                                        <a href="{{ $q->download_link ?? 'nolink' }}" target="_blank"  class="mr-3 d-flex align-items-center text-decoration-none    ">
                                                                            <label for="downlink" class="icon-gradient bg-mean-fruit mr-2 ">
                                                                            {{config('movie_quality.quality')[$q->quality]}}
                                                                            </label>
                                                                            <i class="pe-7s-cloud-download   "></i>
                                                                        </a>
                                                                    </span>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
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
