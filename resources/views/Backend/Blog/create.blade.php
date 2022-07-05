@extends('Backend.layout.app')
@section('title') Blog @endsection
@section('blog_create_active','mm-active')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Blog Create </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12  ">
                <div class="card mb-2 mb-md-5 ">
                    <div class="card-body">
                        <form class=" mt-2 " action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6 ">Blog Titile</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control icon-gradient bg-mean-fruit">
                                    @error('title')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6 ">Category</label>
                                    <select class="form-select bg-white" name="category_id" aria-label="Default select example">
                                        <option selected disabled class="form-control  ">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }} class="form-control text-capitalize "> {{ $cat->name  }}</option>
                                        @endforeach
                                    </select>
                                </div>



                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Description</label>
                                <textarea name="body" class="form-control" rows="10" cols="30"> {{ old('body') }}</textarea>
                                @error('body')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                                <div class="form-group ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6 ">Picture</label>
                                   <div class="">
                                       <img src="{{ asset('Image/blogPic.png') }}" id="previewImg" onclick="document.getElementById('blogPic').click()" width="30%" alt="">
                                   </div>
                                    <input type="file" class="form-control " hidden   onchange="change()" id="blogPic" name="blogPic">
                                    @error('blogPic')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>



                            <div class="form-group mb-0   ">
                                <input type="submit" class="btn btn-secondary  mt-2  icon-gradient bg-mean-fruit ">
                            </div>
                        </form>
                    </div>
                </div>
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
