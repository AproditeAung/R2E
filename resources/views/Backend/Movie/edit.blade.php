@extends('Backend.layout.app')
@section('title') Movie @endsection
@section('movie_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class=" icon-gradient bg-mean-fruit"> Movie Edit </div>
            </div>


        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <form class=" mt-2 " action="{{ route('movie.update',$movie->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row ">
                                <div class="form-group col-6">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6 ">Movie Name</label>
                                    <input type="text" name="name" value="{{ old('name',$movie->title) }}" class="form-control icon-gradient bg-mean-fruit">
                                    @error('name')
                                    <x-alert error="{{ $message }}" css="danger my-4 icon-gradient bg-mean-fruit"> </x-alert>
                                    @enderror
                                </div>
                                <div class="form-group col-6 ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6">Director</label>
                                    <input type="text" name="director" value="{{ old('director',$movie->director) }}" class="form-control icon-gradient bg-mean-fruit">
                                    @error('director')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-6 ">
                                    <div class="form-group">
                                        <label class="form-label  icon-gradient bg-mean-fruit h6">Release Year</label>
                                        <input type="text" name="year" value="{{ old('year',$movie->release_year) }}" class="form-control icon-gradient bg-mean-fruit">
                                        @error('year')
                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                        @enderror
                                    </div>

                                    <div class="form-group c">
                                        <label class="form-label  icon-gradient bg-mean-fruit h6">Photo</label>
                                        <img src="" alt="">
                                        <input type="file" name="photos" value="{{$movie->photo}}" class="form-control" accept="image/jpeg,image/png">
                                        <input type="hidden" name="old_photo" value="{{$movie->photo}}" >
                                        @error('photos')
                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-6 ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6">Movie Geners</label>
                                    <br>
                                    <div class="row justify-content-around ">
                                        @foreach(\App\Models\Genre::all() as $gen)
                                            <div class="form-check form-check-inline col-xl-4 col-md-6 ">
                                                <input
                                                    class="form-check-input text-lowercase "
                                                    type="checkbox" {{ in_array($gen->id,old('gens',$movie->genres->pluck('id')->toArray())) ? 'checked' : '' }}
                                                    name="gens[]" value="{{ $gen->id }}" id="gen{{ $gen->id }}">
                                                <label class="form-check-label  icon-gradient bg-mean-fruit h6  " for="gen{{ $gen->id }}">
                                                    {{ $gen->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('gens')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>

                                    @enderror
                                    @error('gens.*')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control">
                                    {{ $movie->description }}
                                </textarea>
                                @error('description')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline  ">
                                <div class="form-group">
                                    <div class="form-check form-switch ml-3 ">
                                        <input class="form-check-input  "  name="is_serie" type="checkbox" role="switch" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label  icon-gradient bg-mean-fruit h6" for="flexSwitchCheckChecked">Is Series?</label>
                                    </div>
                                </div>
                                <div class="form-group mb-0   ">
                                    <input type="submit" class="btn btn-secondary  mt-2  icon-gradient bg-mean-fruit ">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <img src="{{ asset('storage/movie_photos/'.$movie->photo) }}" class="card-img-top " alt="">
                </div>
            </div>

{{--            <div class="col-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="icon-gradient bg-mean-fruit d-flex align-items-center lead  ">--}}
{{--                            <span class="pe-7s-video mr-4  "></span>--}}
{{--                            <span> List Of Movies  </span>--}}
{{--                        </h4>--}}
{{--                        <table class="table table-striped table-bordered mt-3 ">--}}
{{--                            <tr class="table-success font-weight-bolder ">--}}
{{--                                <td>No</td>--}}
{{--                                <td>Title</td>--}}
{{--                                <td>Director</td>--}}
{{--                                <td>Release Year</td>--}}
{{--                                <td>Action</td>--}}

{{--                            </tr>--}}

{{--                        <tbody>--}}
{{--                        @foreach($movies as $m)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $m->id }}</td>--}}
{{--                                <td>{{ $m->title }} <span>{{ $m->is_serie ? '(Series)' : '(Movie)' }}</span></td>--}}
{{--                                <td>{{ $m->director }}</td>--}}
{{--                                <td>{{ $m->release_year }}</td>--}}
{{--                                <td class="d-flex ">--}}
{{--                                    <a href="{{ route('movie.edit',$m->id) }}" class="pe-7s-pen text-decoration-none btn btn-sm  fsize-1 "></a>--}}
{{--                                    <a href="{{ route('movie.show',$m->id) }}" class="pe-7s-info text-decoration-none btn btn-sm  fsize-1 "></a>--}}
{{--                                    <form id="deleteGenre" action="{{ route('movie.destroy',$m->id) }}" method="post" class="mx-2  ">--}}
{{--                                        @csrf @method('DELETE')--}}
{{--                                    </form>--}}
{{--                                    <span class="pe-7s-trash text-danger   text-decoration-none btn btn-sm fsize-1 " onclick="allow('{{$m->title}}','{{ $m->id }}')"></span>--}}

{{--                                </td>--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                        @endforeach--}}

{{--                        </tbody>--}}

{{--                        </table>--}}
{{--                        <span >{!! $movies->links() !!}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
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
