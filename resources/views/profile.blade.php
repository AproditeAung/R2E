@extends('main')
@section('meta')
    <style>
        .page-link{
            background-color: #494848 !important;
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') profile @endsection
@section('profile_active','active fw-bold')

@section('contant')

    <div class="col-lg-4 my-md-5  ">
        <div class="card border-secondary shadow-sm bg-transparent ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-column ">
                    <img  src="{{ asset('Image/profile.webp') }}" width="150" class="rounded-circle rounded " alt="">
                    <span class="fw-bold h3 mb-0 mt-3  ">Profile</span>
                </div>
                <hr >

                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Name</span>
                    <span class="fw-bold h6 ">{{ $user->name }}</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Gmail</span>
                    <span class="fw-bold h6 ">
                        {{ $user->email }}
{{--                        {{ \Illuminate\Support\Str::of($user->email)->mask('*',-19,5)}}--}}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline  mt-3   ">
                    <span class="fw-bold h6 ">Referral Id</span>
                    <span class="fw-bold h6 ">{{ $user->detail->reference_id }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Rank</span>
                    <span class="fw-bold h6 ">
                        {{ $user->role == '0' ? 'Reader' : 'Editor' }}
                        @if($user->role == '0')
                            @include('components.upgraderow')
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 my-md-5 my-3   ">
        <div class="card  border-secondary shadow-sm bg-transparent ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-column ">
                    <img  src="{{ asset('Image/vrman.webp') }}" width="150" class="" alt="">
                    <span class="fw-bold h3 mb-0 mt-3  ">Read Profile</span>
                </div>
                <hr >
                <div class=" mt-3 d-flex justify-content-between align-items-center   ">
                    <span class="fw-bold h6 ">
                        <img src="{{ asset('Image/work-in-progress.png') }}" width="50" alt="">
                    </span>


                    <div class="">
                        <span class="d-flex justify-content-end ">
                           @if($user->reader->todayRead == 300)
                                <span class=" small " style="color:#9200ffa1;">Mission Completed!</span>
                            @else
                                <span class="me-2 small d-flex justify-content-end align-items-center" style="color:rgba(150,21,246,0.63);font-size: 10px">
                                     Start Earn After Full Bar
                                    <i class="icofont icofont-heart mx-2  "></i>
                                </span>
                            @endif
                         ({{ $user->reader->readBlog }} / 300)
                        </span>
                        <div class="" style="height: 5px; background: #cbcbcb;width: 200px">
                            <div data-bs-container="body"
                                 class="" style="height: 5px; background: #9200ffa1;width: {{ (200 / 100) * $user->reader->readBlog / 300 * 100 }}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class=" mt-3 d-flex justify-content-between align-items-center   ">
                    <span class="fw-bold h6 ">
                        <img src="{{ asset('Image/only-today.png') }}" width="50" alt="">
                    </span>


                    <div class="">
                        <span class="d-flex justify-content-end ">
                           @if($user->reader->todayRead == 50)
                                <span class="me-3 small " style="color:#9200ffa1;">Mission Completed!</span>
                            @endif
                         ({{ $user->reader->todayRead }} / 50)
                        </span>
                        <div class="" style="height: 5px; background: #cbcbcb;width: 200px">
                            <div data-bs-container="body"
                                 class="" style="height: 5px; background: #9200ffa1;width: {{ (200 / 100) * $user->reader->todayRead / 50 * 100 }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 my-md-5 my-3   ">
        <div class="card  border-secondary shadow-sm bg-transparent ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-column ">
                    <img  src="{{ asset('Image/coming-soon.png') }}" width="150" class="" alt="">
                    <span class="fw-bold h3 mb-0 mt-3  "....</span>
                </div>


            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        function confirm()
        {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#blogDelete').submit();
                }
            })
        }
    </script>

@endsection

