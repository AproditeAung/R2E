@extends('main')

@section('title') Edit Artist @endsection

@section('profile_active','fw-bold')

@section('contant')

    <div class="col-lg-4  my-lg-4 mx-auto  ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                  <span class="h3 fw-bolder text-center ">
                      Edit Artist
                    </span>
                <hr>
                <form class="row mt-2 " action="{{ route('artist.update',$artist->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('patch')
                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6"> Name</label>
                        <input type="text" name="name" value="{{ old('name',$artist->name) }}" class="form-control">

                        @error('name')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>



                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Date of Birth</label>
                        <input type="date" name="birthday" value="{{ old('birthday',$artist->birthday) }}" class="form-control  ">
                        @error('birthday')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>

                    <div class="form-group  mb-3 ">
                        <label class="form-label   h6 ">Category</label>
                        <select class="form-select " name="category_id" aria-label="Default select example">
                            <option selected disabled class="form-control  ">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id',$artist->musicCategory_id) == $cat->id ? 'selected' : '' }} class=" text-capitalize "> {{ $cat->name  }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                        @enderror
                    </div>


                    <div class="form-group  my-3 ">
                        <label class="form-label   h6 ">Picture (1:1)</label>
                        <div class="">
                            <img src="{{ asset('storage/artist_pic/'.$artist->photo) }}" id="EditArtistPreviewImg" onclick="document.getElementById('EditArtistPic').click()" width="100%" alt="">
                        </div>
                        <input type="file" class="form-control " hidden   onchange="change()" id="EditArtistPic" name="artistPic">
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


@endsection

@section('script')

    <script>
        let artistPic = document.getElementById('EditArtistPic');
        let preview = document.getElementById('EditArtistPreviewImg');


        function change(){
            let file = document.getElementById('EditArtistPic').files[0];

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




    </script>
@endsection
