@extends('main')
@section('video_active','active')
@section('meta')
{{--    <script type="text/javascript"--}}
{{--            src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js">--}}
{{--    </script>--}}
<link rel="icon" href="{{ asset('Image/profile.webp') }}">
@endsection
@section('style')
    <style>

        .box{
            padding: 10px;
            background: white;
            border-radius: 10px;
        }
        .customInput{
            border: none;
            background: transparent;
        }
        .customInput:focus{
            outline: none;
        }
        .title{
            font-size: 20px;
            font-weight: bolder;
        }

        @media screen and (max-width: 480px){
            .title{
                font-size: 16px;
            }
        }
    </style>
@endsection

@section('image','https://cdn3d.iconscout.com/3d/premium/thumb/video-editor-app-5482228-4569701.png')
@section('contant')

    <div class="d-flex justify-content-end ">
        <div class="col-md-6 col-lg-4 mt-3 text-end align-self-end ">
            <form action="{{ route('all.video')  }}" method="get" class="d-flex align-items-baseline box   ">
                <i class="icofont icofont-search  me-2 "></i>
                <input type="text" name="search" placeholder="search blog" class="customInput flex-grow-1">
                <i class="icofont icofont-settings my-2  text-end  w-25   " type="button" id="dropdownMenuButtonForCategory" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu   " aria-labelledby="dropdownMenuButtonForCategory">
                    @forelse(Conner\Tagging\Model\Tag::all() as $tag)
                        <li class="list-inline ">
                            <a class="p-2 text-decoration-none link-secondary" href="{{ url('/allvideos?tag='.$tag->slug) }}">{{ $tag->name }}</a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </form>
        </div>
    </div>

<div class="col-md-12 my-3 ">
    <div class="row">

        @forelse($videos as $video)

        <div class="col-lg-4 mt-3  ">

            <div class="card bg-transparent border-secondary ">
                <div class="card-body">
                   <div class="d-flex justify-content-between align-items-center">
                       <h3>{{ $video->title }}</h3>
                       <span onclick="playVideo('{{ $video->name }}','{{ $video->title }}')">
                        <img src="https://cdn3d.iconscout.com/3d/free/thumb/video-eth-3678192-3061802@0.png" width="50" alt="">
                    </span>
                   </div>
                    <div class="d-flex justify-content-between align-items-center">
                        @forelse($video->tagged as $tag)
                            <small class="small border-1 border-secondary border px-2 rounded ">
                                {{ $tag->tag_name }}
                            </small>
                        @empty
                            <small class="small">
                                No Tag
                            </small>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        @empty
        <div class="my-5 text-center ">
            <img src="{{ asset('Image/nodata.webp') }}" alt="" width="200">
            <div class="">
                <a href="{{ route('all.video') }}" class="btn btn-primary "> GO BACk </a>
            </div>
        </div>
        @endforelse

        <div class="text-center mt-4 d-flex justify-content-center align-items-center ">
            {{ $videos->links() }}
        </div>
    </div>

</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-sm" hidden data-bs-toggle="modal" data-bs-target="#showVideo" id="showVideoButton">
    <i class="icofont icofont-video text-success"></i>
</button>

<!-- Modal -->
<div class="modal fade " id="showVideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showVideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title" id="showVideoLabel">Video Show Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="player" class="w-100"></div>

                <div class="w-100 position-relative overflow-hidden">
                    <div id="player"></div>
                    <video src="" preload="auto" controls style="width: 100%;height: 100%" id="videoSource"></video>
                </div>

            </div>
        </div>
    </div>
</div>


{{--<script>--}}
{{--    var player = new Clappr.Player({source: '{{ asset('storage/video/'.$video->name) }}', parentId: "#player"});--}}
{{--</script>--}}


@endsection


@section('script')

    <script>

        function playVideo(video,title){

            $('#showVideoButton').click();
            {{--$("#player").html('')--}}
            {{--var player = new Clappr.Player({--}}
            {{--    source: "{{ asset('storage/video/') }}/" + video,--}}
            {{--    poster: "{{ asset('Image/profile.webp') }}",--}}
            {{--    parentId: "#player",--}}
            {{--    height: 200,--}}
            {{--    width: 300--}}
            {{--});--}}

            document.getElementById('videoSource').src = "{{ asset('storage/video/') }}/" + video;
            document.getElementById('showVideoLabel').innerText = title;
            console.log(video)
        }

    </script>

@endsection

