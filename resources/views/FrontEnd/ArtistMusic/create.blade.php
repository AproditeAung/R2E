@extends('main')

@section('title') Upload Artis @endsection

@section('setting_active','fw-bold')

@section('contant')

    <div class="col-lg-4  my-lg-4 ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                  <span class="h3 fw-bolder text-center ">
                      Upload Artist
                    </span>
                <hr>
                <form class="row mt-2 " action="{{ route('artist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6"> Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">

                        @error('name')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>



                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Date of Birth</label>
                        <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control  ">
                        @error('birthday')
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


                    <div class="form-group  my-3 ">
                        <label class="form-label   h6 ">Picture (1:1)</label>
                        <div class="">
                            <img src="{{ asset('Image/songPic.png') }}" id="artistPreviewImg" onclick="document.getElementById('artistPic').click()" width="100%" alt="">
                        </div>
                        <input type="file" class="form-control " hidden   onchange="change()" id="artistPic" name="artistPic">
                        @error('artistPic')
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

    <div class="col-lg-8 my-lg-4 ">
        <div class="card bg-transparent border-secondary ">

            <div class="card-body table-responsive">
                   <div class="d-flex justify-content-between align-items-center ">
                         <span class="h3 fw-bolder mb-0   ">
                        Artists
                        </span>
                   </div>
                <hr>

                <table class="table table-borderless text-black  ">
                    <thead>
                    <tr class="  ">
                        <td>No</td>
                        <td>Name</td>
                        <td>Birthday</td>
                        <td>Geners</td>
                        <td>Action</td>
                    </tr>
                    </thead>

                    <tbody >
                    @forelse($artists as $key=>$artist)
                        <tr>
                            <td class="  ">{{ $key+1 }}</td>
                            <td class="  ">{{$artist->name }} </td>
                            <td class="  ">{{ $artist->birthday }}</td>
                            <td class="  ">{{ $artist->musicCategory_id }}</td>

                            <td>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                                    <form action="{{ route('artist.destroy',$artist->id) }}" id="songDelete" method="post">
                                        @csrf @method('delete')
                                    </form>
                                    <button class="btn-outline btn-danger btn " type="button" onclick="confirm()"><i class="icofont icofont-trash"></i></button>
                                @endif

                                <a href="{{ route('artist.edit',$artist->id) }}" class="btn btn-outline-warning "><i class="icofont icofont-edit"></i></a>
                                <a href="{{ route('artist.show',$artist->id) }}" class="btn btn-outline-info "><i class="icofont icofont-info"></i></a>
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center fw-bolder text-danger">NO ARTIST</td>
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
        let artistPic = document.getElementById('artistPic');
        let preview = document.getElementById('artistPreviewImg');


        function change(){
            let file = document.getElementById('artistPic').files[0];

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
