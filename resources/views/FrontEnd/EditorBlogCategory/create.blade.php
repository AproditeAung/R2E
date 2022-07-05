@extends('main')

@section('title') Blog @endsection
@section('profile_active','fw-bold')

@section('contant')

            <div class="col-md-9 my-4 ">
                <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
                    <div class="card-body">
                        <form class=" mt-2 " action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group  mb-3 ">
                                    <label class="form-label   h6 ">Blog Titile</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control bg-white ">
                                    @error('title')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>

                                <div class="form-group  mb-3 ">
                                    <label class="form-label   h6 ">Category</label>
                                    <select class="form-select bg-white" name="category_id" aria-label="Default select example">
                                        <option selected disabled class="form-control  ">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }} class=" text-capitalize "> {{ $cat->name  }}</option>
                                        @endforeach
                                    </select>
                                </div>



                            <div class="form-group  mb-3 ">
                                <label class="form-label   h6">Description</label>
                                <textarea name="body" id="summernote"  class="form-control bg-white" rows="10" cols="30"> {{ old('body') }}</textarea>

                                @error('body')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                                <div class="form-group  mb-3 ">
                                    <label class="form-label   h6 ">Picture</label>
                                   <div class="">
                                       <img src="{{ asset('Image/blogPic.png') }}" id="previewImg" onclick="document.getElementById('blogPic').click()" width="30%" alt="">
                                   </div>
                                    <input type="file" class="form-control " hidden   onchange="change()" id="blogPic" name="blogPic">
                                    @error('blogPic')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>



                            <div class="form-group mb-0  text-end  ">
                                <button tpe="submit" class="btn btn-dark  mt-2   ">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection

@section('script')

    <script>
        let blogPic = document.getElementById('blogPic');
        let preview = document.getElementById('previewImg');


        function change(){
            let file = document.getElementById('blogPic').files[0];

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
