@extends('main')
@section('music_active','active')
@section('style')

@endsection
@section('contant')
    @include('components.categorybar')

    <div class="col-md-9 my-3 ">
        <form action="{{ route('all.music')  }}" method="get" class="d-flex ">
            <input class="form-control border-secondary   me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary  " type="submit">Search</button>
        </form>
        <audio src="" hidden id="sourceAudio" preload="auto" autoplay  controls></audio>


            @forelse($songs as $key=>$song)
            <table class="table-borderless table">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Artis</td>
                    <td>Genres</td>
                    <td>Duration</td>
                    <td>Play</td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $song->name }}</td>
                    <td>{{ $song->artist->name }}</td>
                    <td>{{ $song->category->name }}</td>
                    <td> {{ (floor($song->duration / 60 )) .':'. ($song->duration % 60) }}</td>
                    <td>
                        <button class="btn btn-outline-info" onclick="playMusic('{{ $song->path }}','{{ $song->duration }}','{{ $song->id }}')">
                            <i class="icofont icofont-play " id="play"></i>
                            <i class="icofont icofont-pause  d-none" id="pause"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
            @empty
                <div class="my-5 text-center text-danger">
                    <h2>NO DATA FOUND <i class="icon icofont-emo-sad"></i></h2>
                    <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>
                </div>
            @endforelse


        <div class="d-flex justify-content-center mt-4  ">
            {{ $songs->links() }}
        </div>
    </div>

    <div class="col-md-3">

        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar1.png') }}" class="rounded 100% " alt="">
        </div>
        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar2.png') }}" class="rounded 100% " alt="">
        </div>
        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar3.png') }}" class="rounded 100% " alt="">
        </div>
    </div>
@endsection

@section('script')

    <script>
        let glass = document.getElementById('glass');
        let sourceAudio = document.getElementById('sourceAudio');
        window.addEventListener('DOMContentLoaded',function (){

        },true);

        function pauseMusic()
        {
            sourceAudio.pause();
            document.getElementById('pause').classList.add('d-none');
            document.getElementById('play').classList.remove('d-none');
        }

        function playMusic(path,duration,id){
           document.getElementById('pause').classList.remove('d-none');
           document.getElementById('play').classList.add('d-none');
            sourceAudio.src = path;
            sourceAudio.play();

            setTimeout(()=>{
                let url = '{{ route('music.payment') }}';
                let data = {
                    '_token' : '{{ csrf_token() }}',
                    'music_id' : id
                }
                glass.classList.add('active');

                $.ajax({
                    type : "POST",
                    url : url,
                    data : data,
                    success : function (res){
                        console.log(res)
                        localStorage.setItem('path',res.path);
                        localStorage.setItem('id',res.id);
                        glass.classList.remove('active');

                        Swal.fire({
                            position: 'top-end',
                            icon: res.status,
                            title: res.message,
                            showConfirmButton: true,
                            timer: 2000
                        })
                    }
                })

            },1000) //duration*
        }


    </script>
@endsection
