@extends('main')
@section('music_active','active')
@section('style')
    <style>
        .nav-scrollerforArtist{
            position: relative;
            z-index: 2;
            height: 80px;
            overflow-y: hidden;
        }
    </style>
@endsection
@section('image','https://cdn3d.iconscout.com/3d/premium/thumb/music-note-5385109-4503429.png')
@section('contant')

    <div class="container  position-sticky sticky-top">
        <div class="nav-scrollerforArtist bg-transparent text-white p-3   py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                @foreach(\App\Models\Artist::all() as $c)
                    <a class="p-2 link-secondary" href="{{ url('allsongs/?search='.$c->id) }}">
                        <img src="{{ asset('storage/artist_pic/'.$c->photo) }}" width="50"  class="rounded rounded-circle" alt="">
                    </a>
                @endforeach
            </nav>
        </div>
    </div>

    <div class="col-md-12 my-3 ">
        <form action="{{ route('all.music')  }}" method="get" class="d-flex ">
            <input class="form-control border-secondary   me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary  " type="submit">Search</button>
        </form>
        <audio src="" hidden id="sourceAudio" preload="auto" autoplay  controls></audio>



           @if($songs->count() > 0)
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
                @forelse($songs as $key=>$song)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $song->name }}</td>
                        <td>{{ $song->artist->name }}</td>
                        <td>{{ $song->category->name }}</td>
                        <td> {{ (floor($song->duration / 60 )) .':'. ($song->duration % 60) }}</td>
                        <td>
                            <button class="btn btn-outline-info" onclick="playMusic('{{ $song->path }}','{{ $song->duration }}','{{ $song->id }}')">
                                <i class="icofont icofont-play " id="play{{ $song->id }}"></i>
                                <i class="icofont icofont-pause  d-none" id="pause{{ $song->id }}"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <div class="my-5 text-center text-danger">
                        <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">
                        <div class="">
                            <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>
                        </div>
                    </div>
                @endforelse
                </tbody>
            </table>
               @else
                <div class="my-5 text-center text-danger">
                    <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">
                    <div class="">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-primary "> Back Home </a>
                    </div>
                </div>
               @endif


        <div class="d-flex justify-content-center mt-4  ">
            {{ $songs->links() }}
        </div>
    </div>

    <div class="col-md-3">

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

            $('.icofont-play').toArray().map(el=>{
                el.nextElementSibling.classList.add('d-none');
                el.classList.remove('d-none');
            })
           document.getElementById('pause'+id).classList.remove('d-none');
           document.getElementById('play'+id).classList.add('d-none');
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

            },duration * 1000) //duration*
        }


    </script>
@endsection
