<form action="{{ route('serie.store') }}" method="post" class="id"  >

    @csrf
    <div class="form-group ">
        <div class="d-flex justify-content-between align-items-baseline ">
            <label for="downlink" class="icon-gradient bg-mean-fruit">Download Link</label>
            <span class="icon-gradient bg-mean-fruit">
                <a href="{{ $m->download_link ?? 'nolink' }}" target="_blank">
                    <i class="pe-7s-cloud-download font-size-xlg  "></i>
                </a>
            </span>
        </div>
        <div class=" d-flex ">

            <input type="text"
                   name="download_link"
                   class="form-control mr-3 "
                   value="{{ old('download_link') }}"
                   placeholder="url ">

            <input type="text" name="episode"
                   class="form-control mr-3 icon-gradient bg-mean-fruit  w-25"
                   value="{{ old('rating') }}"
                   placeholder="episode">

            <select class="form-select  w-25 mr-3 " name="quality"  aria-label="Default select example">
                <option selected >Quality</option>
                @foreach( config('movie_quality.quality') as $key=>$q )
                    <option   value="{{ $key }}" >{{ $q }}</option>
                @endforeach

            </select>

            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            <button class="btn btn-outline-light  icon-gradient bg-mean-fruit">SUBMIT</button>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $err)
                <x-alert error="{{ $err }}" css="danger my-4"> </x-alert>
            @endforeach
        @endif

    </div>
</form>
