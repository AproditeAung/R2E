@extends('main')
@section('title') Edit Video @endsection
@section('style')
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #504545 !important;
            padding: 1px;
            border: 1px solid;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 2px;
            color: red;
        }
        .bootstrap-tagsinput input{
            width: 20% !important;
        }
        .tabindex{
            height: 250px !important;
            width: 100% !important;
        }
        .bootstrap-tagsinput{
            display: block;
            width: 100%;
            padding: 0.375rem 1rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            background-color: transparent !important;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
{{--    <head>--}}
{{--        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@clappr/player@latest/dist/clappr.min.js"></script>--}}
{{--    </head>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js" integrity="sha512-UWMGINgjUq/2sNur/d2LbiAX6IHmZkkCivoKSdoX+smfB+wB8f96/6Sp8ediwzXBXMXaAqymp6S55SALBk5tNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('profile_active','fw-bolder')
@section('contant')

    <div class="container mt-3 ">
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-transparent border-secondary">

                    <div class="card-body">
                        <h5 class="text-center">Upload File</h5>
                        <hr>

                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-secondary  ">Brows File</button>
                        </div>
                        <div  style="display: none" class="progress mt-3" style="height: 25px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                        </div>

                        <div class="card-footer p-4" style="display: none">
                            <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                        </div>

                        <form action="{{ route('video.update',$video->id ) }}" class="" method="post">
                            @csrf @method('put')
                            <div class="form-group mb-3 ">
                                <label for="">Title</label>
                                <input type="text" name="title" value="{{ $video->title }}" class="form-control">
                                <!-- this is video path -->
                                <input type="hidden" name="name" id="name">
                            </div>
                            <div class="form-group mb-3 ">
                                <label for="">Description</label>
                                <textarea type="text" name="description" class="form-control">
                                    {{ $video->description }}
                                </textarea>

                            </div>

                            <div class="mb-3">
                                <label for="">Tags</label>


                                <input type="text" class="form-control"
                                       value="@forelse($video->tagged as $tag) {{ $tag->tag_name.',' }}@empty @endforelse"
                                       data-role="tagsinput"  name="tags">

                                @if ($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>

                            <button class="btn btn-outline-secondary " id="uploadVideoButton">Upload</button>
                        </form>
                    </div>



                </div>
            </div>



        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('video.store') }}',
            query:{
                _token:'{{ csrf_token() }}',
            } ,// CSRF token
            fileType: ['mp4'],
            chunkSize: 1*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)

            $('#name').val(response.filename);
            $('#browseFile').addClass('d-none');
            $('#videoPreview').attr('src',response.path);
            $('.card-footer').show();
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            console.log(file);
            console.log(response);
            alert('file uploading error.')
        });


        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

@endsection

