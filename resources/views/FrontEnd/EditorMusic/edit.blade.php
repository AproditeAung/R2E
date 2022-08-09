@extends('main')

@section('title') Song @endsection
@section('setting_active','fw-bold')

@section('contant')

    <div class="col-lg-4  my-lg-4 ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                         <span class="h3 fw-bolder text-center ">
                            Relaxing With Song!
                        </span>
                <hr>
                <form class="row mt-2 " action="{{ route('music.update',$music->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('put')
                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6">Song Name</label>
                        <input type="text" name="name" value="{{ old('name',$music->name) }}" class="form-control">

                        @error('name')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>

                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Song File</label>
                        <input type="file" name="song_file" value="{{ old('song_file') }}" class="form-control" accept="audio/1d-interleaved-parityfec">
                        @error('song_file')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>


                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Artist</label>
                        <select class="form-select " name="artist_id" aria-label="Default select example">
                            <option selected disabled class="form-control  ">Select Artist</option>
                            @foreach($artists as $artist)
                                <option value="{{ $artist->id }}" {{ old('artist_id',$music->artist_id) == $artist->id ? 'selected' : '' }} class=" text-capitalize "> {{ $artist->name  }}</option>
                            @endforeach
                        </select>
                        @error('artist_id')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>

                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Category</label>
                        <select class="form-select " name="category_id" aria-label="Default select example">
                            <option selected disabled class="form-control  ">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id',$music->musicCategory_id) == $cat->id ? 'selected' : '' }} class=" text-capitalize "> {{ $cat->name  }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>

                    <div class="form-group mb-0  text-end  ">
                        <button type="submit" class="btn btn-dark  mt-2  w-100  ">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')


@endsection

