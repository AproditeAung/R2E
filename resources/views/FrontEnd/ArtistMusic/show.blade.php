@extends('main')

@section('title') Upload Artis @endsection

@section('profile_active','fw-bold')

@section('contant')

    <div class="col-lg-4  my-lg-4  mx-auto ">
        <div class="card mb-2 mb-md-5 bg-transparent border-secondary  ">
            <div class="card-body">
                  <span class="h3 fw-bolder text-center ">
                        Artist Detail
                    </span>
                <hr>
                <div class="form-group  my-3  d-flex justify-content-between align-items-center ">
                    <label class="form-label   h5 ">Name</label>
                    <div class="">
                       <h5>{{ $artist->name }}</h5>
                    </div>
                </div>
                <div class="form-group  my-3  d-flex justify-content-between align-items-center ">
                    <label class="form-label   h5 ">Birthday</label>
                    <div class="">
                        <h5>{{ $artist->birthday }}</h5>
                    </div>
                </div>
                <div class="form-group  my-3  d-flex justify-content-between align-items-center ">
                    <label class="form-label   h5 ">Type</label>
                    <div class="">
                        <h5>{{ $artist->category->name ?? 'unknow' }}</h5>
                    </div>
                </div>

                <div class="form-group  my-3 ">
                    <label class="form-label   h5 ">Picture </label>
                    <div class="">
                        <img src="{{ asset('storage/artist_pic/'.$artist->photo) }}" id="artistPreviewImg" width="100%" alt="">
                    </div>
                </div>



                    <div class="form-group mb-0  text-end  ">
                        <a href="{{ route('artist.create') }}" type="submit" class="btn btn-dark  mt-2  w-100  ">Go Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>




@endsection
