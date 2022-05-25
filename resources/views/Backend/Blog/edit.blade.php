@extends('Backend.layout.app')
@section('title') Edit Blog @endsection
@section('blog_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Blog Edit </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-12 m-auto ">
                <div class="card">
                    <div class="card-body">
                        <form class=" mt-2 " action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')

                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6 ">Blog Title</label>
                                <input type="text" name="title" value="{{ old('title',$blog->title) }}" class="form-control icon-gradient bg-mean-fruit">
                                @error('title')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6 ">Category</label>
                                <select class="form-select  bg-white" name="category_id" aria-label="Default select example">
                                    <option selected disabled class="form-control ">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id',$blog->category_id) == $cat->id ? 'selected' : '' }} class="form-control text-capitalize "> {{ $cat->name  }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Description</label>
                                <textarea name="body" id="summernote" > {{ old('body',$blog->body) }}</textarea>
                                @error('body')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6 ">Picture</label>
                                <div class="">
                                    <img src="{{ asset('Image/'.$blog->ImageRec) }}" id="EditpreviewImg" onclick="document.getElementById('EditblogPic').click()" width="30%" alt="">
                                </div>
                                <input type="file" class="form-control " hidden   onchange="change()" id="EditblogPic" name="blogPic">
                                @error('blogPic')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Sample Letter</label>
                                <textarea name="sample" class="form-control " >{{ old('sample',$blog->sample) }}</textarea>
                                @error('sample')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>


                            <div class="form-group mb-0   ">
                                <button type="submit" class="btn btn-secondary  mt-2  icon-gradient bg-mean-fruit "> Update </button>
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
        let blogPic = document.getElementById('EditblogPic');
        let preview = document.getElementById('EditpreviewImg');


        function change(){
            let file = document.getElementById('EditblogPic').files[0];

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

