@extends('main')

@section('title') Blog @endsection
@section('profile_active','fw-bold')

@section('contant')

    <div class="col-md-12 my-4 ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                         <span class="h3 fw-bolder text-center ">
                            Sharing is Caring !
                        </span>
                <hr>
                <form class="row mt-2 " action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="col-lg-9  ">
                        <div class="form-group  mb-3 ">
                            <label class="form-label   h6">Description</label>
                            <textarea name="body" id="summernote"  class="form-control " > {{ old('body',$blog->body) }}</textarea>

                            @error('body')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3  ">
                        <div class="form-group  mb-3 ">
                            <label class="form-label   h6 ">Blog Title</label>
                            <input type="text" name="title" value="{{ old('title',$blog->title) }}" class="form-control  ">
                            @error('title')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 ">
                            <label class="form-label   h6 ">Category</label>
                            <select class="form-select " name="category_id" aria-label="Default select example">
                                <option selected disabled class="form-control  ">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id',$blog->category_id) == $cat->id ? 'selected' : '' }} class=" text-capitalize "> {{ $cat->name  }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 ">
                            <label class="form-label   h6">Sample</label>
                            <textarea name="sample"  class="form-control " rows="5" cols="10"> {{ old('sample',$blog->sample) }}</textarea>

                            @error('sample')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 ">
                            <label class="form-label   h6 ">Picture (16:9)</label>
                            <div class="">
                                <img src="{{ asset('Image/'.$blog->ImageRec) }}" id="EditpreviewImg"  onclick="document.getElementById('EditblogPic').click()" width="100%" alt="">
                            </div>
                            <input type="file" class="form-control " hidden   onchange="change()" id="EditblogPic" name="blogPic">
                            @error('blogPic')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </div>



                        <div class="form-group mb-0  text-end  ">
                            <button type="submit" class="btn btn-dark  mt-2  w-100  ">Update</button>
                        </div>
                    </div>
                </form>

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

