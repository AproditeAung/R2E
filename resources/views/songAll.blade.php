@extends('main')
@section('music_active','active')
@section('meta')
    <link rel="icon" href="https://cdn3d.iconscout.com/3d/premium/thumb/music-note-5385109-4503429.png">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="Happy Music"/>
    <meta property="og:image" content="https://cdn3d.iconscout.com/3d/premium/thumb/music-note-5385109-4503429.png"/>
    <meta property="og:url" content="{{ \Illuminate\Support\Facades\URL::full() }}"/>
    <meta property="og:site_name" content="Music"/>
    <meta property="og:description" content="Listen to earn with your free time."/>
    <meta property="og:type"   content="website" />

@endsection
@section('style')
    <style>

        .course {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            max-width: 100%;
            overflow: hidden;
            margin-bottom: 20px;
        }

      .artist_img{
            min-width: 100px;
            min-height: 100px;
        }

        @media screen and (max-width: 480px) {


        }

        .nav-scrollerforArtist{
            position: relative;
            z-index: 2;
            height: 80px;
            overflow-y: hidden;
        }

        .progressBar{
            width: 300px;
            height: 8px;
            background: #dcdbdb;
            border-radius: 10px;
        }

        .inlineProgress{
            height: 7px;
            width: 0;
            border-radius: 10px;
            background-color: #0a73a2;
            transition: .3s all;
        }
    </style>
@endsection
@section('image','https://cdn3d.iconscout.com/3d/premium/thumb/music-note-5385109-4503429.png')
@section('contant')

    <div class="container  position-sticky sticky-top">
        <div class="nav-scrollerforArtist bg-transparent text-white p-3   py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                @foreach($artists as $c)
                    <a class="p-2 link-secondary" href="{{ url('allsongs/?search='.$c->id) }}">
                        <img src="{{ asset('storage/artist_pic/'.$c->photo) }}" width="50"  class="rounded rounded-circle" alt="">
                    </a>
                @endforeach
            </nav>
        </div>
    </div>

    <div class="col-md-12 my-3 ">
        <form action="{{ route('all.music')  }}" method="get" class="d-flex mb-3  ">
            <input class="form-control border-secondary   me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary  " type="submit">Search</button>
        </form>
        <audio src="" hidden id="sourceAudio" autoplay ></audio>


    <div class="row">

        @if($songs->count() > 0)
            @foreach($songs as $song)
                <div class="col-lg-4 mb-3  ">
                    <div class="card border-0 rounded-3 overflow-hidden position-relative bg-transparent shadow-sm " style="border-radius: 30px">
                        <div class="card-body p-0 " >
                            <div class="row ">
                               <div class="col-4 artist_img">
                                   <img src="{{ asset('storage/artist_pic/'.$song->artist->photo) }}" width="100%" height="100%" alt="">
                               </div>
                                <div class="col-8  ">


                                            <div class="py-2 pe-2 position-relative ">
                                                <span class="  position-absolute " style="right: 5px; top: 5px" >
                                                    <i class="icofont icofont-play btn btn-outline-info btn-sm " id="play{{ $song->id }}" onclick="playMusic('{{ $song->path }}','{{ $song->duration }}','{{ $song->id }}')"></i>
                                                    <i class="icofont icofont-pause btn btn-outline-info btn-sm  d-none" id="pause{{ $song->id }}" onclick="pauseMusic()"></i>
                                                </span>
                                                <p class=" mb-0  fw-bolder h5 text-uppercase  "> {{ $song->name }} </p>
                                                <div class="d-flex justify-content-between align-items-center w-100 my-3 ">
                                                    <p class="small mb-0    "> <i class="icofont icofont-listening h5   me-1 me-md-2  text-secondary"></i> {{ $song->countPlay }} Listen</p>
                                                    <p class="small mb-0 "> <i class="icofont icofont-music  h5   me-1 me-md-2 text-secondary"></i> {{ $song->category->name }} </p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center ">
                                                    <p class="small mb-0  "> <i class="icofont icofont-microphone  h5  me-1 me-md-2 text-secondary"></i> {{ $song->artist->name }} </p>

                                                </div>
                                            </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="my-5 text-center text-danger">
                <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">
                <div class="">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-primary "> Back Home </a>
                </div>
            </div>
        @endif
    </div>

        <div class="d-flex justify-content-center mt-4  ">
            {{ $songs->links() }}
        </div>
    </div>

           <div class="position-fixed bottom-0 " style="width: 400px; ">
               <nav class="px-5 d-none music-box shadow-sm rounded-pill  rounded p-3 bg-body   ">
                   <div class="controller">
                       <div class="control d-flex justify-content-between align-items-center mb-3 ">
                           <div class="">
                               <span><i class="icofont  icofont-ui-previous  " id="previous" ></i></span>
                               <span><i class="icofont mx-3  icofont-ui-play" id="play"></i></span>
                               <span><i class="icofont mx-3  icofont-ui-play-stop d-none" id="pause"></i></span>
                               <span><i class="icofont  icofont-ui-next" id="next"></i></span>
                           </div>
                           <div class="">
                               <span class="currentSongTime">00</span> / <span class="Duration">00</span>
                           </div>
                       </div>
                       <div class="progressBar">
                           <div class="inlineProgress" id="inlineProgress"></div>
                       </div>
                   </div>
               </nav>
           </div>
    </div>

@endsection

@section('script')

    <script>
        let glass = document.getElementById('glass');
        let sourceAudio = document.getElementById('sourceAudio');
        let inlineProgress = document.getElementById('inlineProgress');
        let currentTimeSongUi = document.querySelector('.currentSongTime');
        let durationSongUi = document.querySelector('.Duration');
        const songs = {{ \Illuminate\Support\Js::from($songs) }};

        window.addEventListener('DOMContentLoaded',function (){

        },true);


        isPlaying = false;
        songIndex = 0;
        function playMusic(path,duration,id){

                sourceAudio.src = '{{ \Illuminate\Support\Facades\URL::route('welcome') }}'+path;
                console.log('{{ \Illuminate\Support\Facades\URL::route('welcome') }}'+path)
                sourceAudio.play();
                sourceAudio.addEventListener('ended',function (){
                    let url = '{{ route('music.payment') }}';
                    let data = {
                        '_token' : '{{ csrf_token() }}',
                        'music_id' : id
                    }
                    glass.classList.add('active');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-outline-success mx-3',
                            cancelButton: 'btn btn-outline-danger mx-3'
                        },
                        buttonsStyling: false
                    })
                    $.ajax({
                        type : "POST",
                        url : url,
                        data : data,
                        success : function (res){
                            console.log(res)
                            localStorage.setItem('path',res.path);
                            localStorage.setItem('id',res.id);
                            glass.classList.remove('active');

                            swalWithBootstrapButtons.fire({
                                icon: res.status,
                                title: res.message,
                                showConfirmButton: true,
                            })
                        }
                    })
                })

                songIndex = songs.data.findIndex(el => el.id == id);

            $('.icofont-play').toArray().map(el=>{
                el.nextElementSibling.classList.add('d-none');
                el.classList.remove('d-none');
            })

            $('#play').addClass('d-none');
            $('#pause').removeClass('d-none');
            isPlaying = true;
            songIndex = songs.data.findIndex( el => el.id == id );
            document.getElementById('pause'+id).classList.remove('d-none');
            document.getElementById('play'+id).classList.add('d-none');

            toggleMusicBox();

        }

        function toggleMusicBox(){
            $('.music-box').removeClass('d-none');

            setTimeout(()=>{
                $('.music-box').addClass('d-none');
            },10000);
        }

        let duration;
        sourceAudio.addEventListener('loadeddata',function (){
            duration = Math.floor(sourceAudio.duration);

            const minuteAndSecond = updateMinuteAndSeconde(duration);
            durationSongUi.innerHTML =  minuteAndSecond;
        })

        sourceAudio.addEventListener('timeupdate',function (a){
            currentTime = (300/duration) * this.currentTime;

            inlineProgress.style.width = currentTime+'px';

            currentTimeSongUi.innerHTML = updateMinuteAndSeconde(Math.floor(this.currentTime));
        })

        function updateMinuteAndSeconde(duration){
            const  minute = Math.floor( duration / 60) ;
            const  second = Math.floor( duration % 60) ;


            return minute +' : '+ second;

        }


        function pauseMusic(){
            $('.icofont-play').toArray().map(el=>{
                el.classList.remove('d-none');
                el.nextElementSibling.classList.add('d-none');

            })
            isPlaying = false;

            $('#play').removeClass('d-none');
            $('#pause').addClass('d-none');

            let playPromise =  sourceAudio.pause();
            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    // Automatic playback started!
                    // Show playing UI.
                    // We can now safely pause video...
                    video.pause();
                })
                    .catch(error => {
                        // Auto-play was prevented
                        // Show paused UI.
                        console.log(error);
                    });
            }


            toggleMusicBox()

        }

        $('#play').click(function (){
            let song = songs.data[songIndex];

            console.log(song);
            playMusic(song.path,song.duration,song.id);
        });

        $('#pause').click(function (){
            pauseMusic();
        });

        $('#previous').click(function (){
            skip('this is last song',-1)
        })

        $('#next').click(function (){
            skip('there is no song',+1)
        })

        function skip(text,index){
            isPlaying = false;
            if(index == -1){
                if(songIndex == 0) {
                    return  Swal.fire({
                        icon: 'error',
                        title: text,
                        showConfirmButton: true,
                    })
                }
                console.log('songindex equal 0');
            }else{
                if(songIndex == (songs.data.length-1)) {
                    return  Swal.fire({
                        icon: 'error',
                        title: text,
                        showConfirmButton: true,
                    })
                }

            }

            let song = songs.data[songIndex+index];
            playMusic(song.path,song.duration,song.id);
        }
    </script>
@endsection


{{--<table class="table-borderless table">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <td>No</td>--}}
{{--        <td>Name</td>--}}
{{--        <td>Artis</td>--}}
{{--        <td>Type</td>--}}
{{--        <td>Duration</td>--}}
{{--        <td>Listen</td>--}}
{{--        <td>Play</td>--}}
{{--    </tr>--}}
{{--    </thead>--}}

{{--    <tbody>--}}
{{--    @forelse($songs as $key=>$song)--}}
{{--        <tr>--}}
{{--            <td>{{ $key+1 }}</td>--}}
{{--            <td>{{ $song->name }}</td>--}}
{{--            <td>{{ $song->artist->name }}</td>--}}
{{--            <td>{{ $song->category->name }}</td>--}}
{{--            <td> {{ (floor($song->duration / 60 )) .':'. ($song->duration % 60) }}</td>--}}
{{--            <td> {{ $song->countPlay  }}</td>--}}
{{--            <td>--}}
{{--                <button class="btn btn-outline-info" onclick="playMusic('{{ $song->path }}','{{ $song->duration }}','{{ $song->id }}')">--}}
{{--                    <i class="icofont icofont-play " id="play{{ $song->id }}"></i>--}}
{{--                    <i class="icofont icofont-pause  d-none" id="pause{{ $song->id }}"></i>--}}
{{--                </button>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @empty--}}
{{--        <div class="my-5 text-center text-danger">--}}
{{--            <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">--}}
{{--            <div class="">--}}
{{--                <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforelse--}}
{{--    </tbody>--}}
{{--</table>--}}
