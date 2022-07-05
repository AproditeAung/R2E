@extends('main')
@section('title') Video @endsection
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js" integrity="sha512-UWMGINgjUq/2sNur/d2LbiAX6IHmZkkCivoKSdoX+smfB+wB8f96/6Sp8ediwzXBXMXaAqymp6S55SALBk5tNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('profile_active','fw-bolder')
@section('contant')

    <div class="container mt-3 ">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Upload File</h5>
                    </div>

                    <div class="card-body">
                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-primary">Brows File</button>
                        </div>
                        <div  style="display: none" class="progress mt-3" style="height: 25px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                        </div>

                        <div class="card-footer p-4" style="display: none">
                            <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                        </div>

                        <form action="{{ route('create.video') }}" class="" method="post">
                            @csrf
                            <div class="form-group mb-3 ">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control">
                                <input type="hidden" name="name" id="name">
                            </div>
                            <div class="form-group mb-3 ">
                                <label for="">Description</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-outline-secondary">Upload</button>
                        </form>
                    </div>



                </div>
            </div>

                <div class="col-md-8">
                    <div class="card">
                        <table class="table table-borderless">
                            <tr>
                                <td>No</td>
                                <td>Title</td>
                                <td>Descripition</td>
                                <td>Action</td>
                                <td>Crated Date</td>
                            </tr>
                            <tbody>
                            @foreach(\App\Models\VideoBlog::all() as $key=>$video)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->description }}</td>
                                    <td>

                                    </td>
                                    <td>{{ $video->created_at->format('d M Y')  }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

        </div>
    </div>
@endsection

@section('script')
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

