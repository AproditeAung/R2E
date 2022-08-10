@extends('main')

@section('title') Song @endsection

@section('profile_active','fw-bold')

@section('contant')

    <div class="col-lg-4  my-lg-4 ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                         <span class="h3 fw-bolder text-center ">
                            Relaxing With Song!
                        </span>
                <hr>
                <form class="row mt-2 " id="createMusic" action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6">Song Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">

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
                                <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }} class=" text-capitalize "> {{ $artist->name  }}</option>
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
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }} class=" text-capitalize "> {{ $cat->name  }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>

                    <div class="form-group mb-0  text-end  ">
                        <button type="button" onclick="LoadingShow('createMusic')" class="btn btn-dark  mt-2  w-100  ">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-lg-8 my-lg-4 ">
        <div class="card bg-transparent border-secondary ">

            <div class="card-body table-responsive">
                   <div class="d-flex justify-content-between align-items-center ">
                         <span class="h3 fw-bolder mb-0   ">
                        Songs
                        </span>
                       <div class="">
                           <audio src="" id="audioPlay" controls></audio>
                       </div>
                   </div>
                <hr>

                <table class="table table-borderless ">
                    <thead>
                    <tr class="  ">
                        <td>No</td>
                        <td>Name</td>
                        <td>Artist</td>
                        <td>Type</td>
                        <td>Action</td>
                        <td>Play</td>
                    </tr>
                    </thead>

                    <tbody >
                    @forelse($songs as $key=>$song)
                        <tr>
                            <td class="  ">{{ $key+1 }}</td>
                            <td class="  ">{{$song->name }}</td>
                            <td class="  ">{{ $song->artist->name  }}</td>
                            <td class="  ">{{ $song->category->name  }}</td>

                            <td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                                    <form action="{{ route('music.destroy',$song->id) }}" id="songDelete" method="post">
                                        @csrf @method('delete')
                                    </form>
                                    <button class="btn-outline btn-danger btn " type="button" onclick="confirmBox()"><i class="icofont icofont-trash"></i></button>
                                @endif

                                <a href="{{ route('music.edit',$song->id) }}" class="btn btn-outline-secondary "><i class="icofont icofont-pen-alt-2"></i></a>
                                <a href="{{ route('music.show',$song->id) }}" class="btn btn-outline-info "><i class="icofont icofont-info"></i></a>
                            </td>
                            <td class="  ">
                                <button class="btn btn-outline-secondary" onclick="play('{{ $song->path }}')">
                                    <i class="icofont icofont-ui-play"></i>
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center fw-bolder mt-4  text-danger">
                                <img src="{{ asset('Image/nodata.webp') }}" width="150" alt="">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection

@section('script')

    <script>
        let songPic = document.getElementById('songPic');
        let preview = document.getElementById('previewImg');

        function confirmBox()
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
                    $('#songDelete').submit();

                }
            })
        }

        function change(){
            let file = document.getElementById('songPic').files[0];

            const reader = new FileReader();

                reader.addEventListener("load", function () {
                    // convert image file to base64 string
                    preview.src = reader.result;
                    console.log(preview);

                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
        }


        function play(path){
            let audio = document.getElementById('audioPlay');
            audio.src = path;
            audio.play();
        }

    </script>
@endsection
