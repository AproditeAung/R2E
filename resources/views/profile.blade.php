@extends('main')
@section('meta')
    <link rel="icon" href="{{ asset('Image/profile.webp') }}">
@endsection
@section('style')
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
        <div class="card border-secondary shadow-sm bg-transparent position-relative  ">

            {{-- this is qr code--}}
            <div class="button position-absolute top-0 p-2 " style="right: 0; cursor:pointer" onclick="copyToClipboard()" >
                <i class="icofont icofont-qr-code icofont-2x  "></i>
            </div>

            <div class="card-body">
                <!-- Button trigger modal -->

                <div class="d-flex justify-content-between align-items-center flex-column " style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#changeProfile">
                    <img  src="{{ asset('Image/'.$user->photo) }}" width="150" class="rounded-circle rounded " alt="">
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
                    <span class="fw-bold h6 " id="content" onclick="copyToClipboard()" >
                        {{ $user->detail->reference_id }}
                    </span>
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
                                 class="" style="height: 5px; background: #9200ffa1;width: {{  $user->reader->readBlog / 300 * 200 }}%">
                            </div>
                        </div>

                    </div>
                </div>

                <div class=" mt-3 d-flex justify-content-between align-items-center   ">
                    <span class="fw-bold h6 ">
                        @if($user->reader->updated_at->format('d') == now()->format('d'))
                            <img src="{{ asset('Image/only-today.png') }}" width="50" alt="">
                        @else
                            <img src="{{ asset('Image/yesterday.png') }}" width="50" alt="">
                        @endif

                    </span>


                    <div class="">

                        <span class="d-flex justify-content-between ">
                              @if($user->reader->updated_at->format('d') != now()->format('d'))
                                <span class=" small " style="color:#9200ffa1;">Yesterday View Only!</span>
                            @endif

                           @if($user->reader->todayRead == 50)
                                <span class="me-3 small " style="color:#9200ffa1;">Mission Completed!</span>
                            @endif
                         ({{ $user->reader->todayRead }} / 50)
                        </span>
                        <div class="" style="height: 5px; background: #cbcbcb;width: 200px">
                            <div data-bs-container="body"
                                 class="" style="height: 5px; background: #9200ffa1;width: {{  $user->reader->todayRead / 50 * 200  }}%">
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
                    <span class="fw-bold h3 mb-0 mt-3  ">....</span>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal For Profile Change -->
    <div class="modal fade" id="changeProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeProfileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content border-secondary   ">

                <div class="modal-body">
                   <div class="d-flex justify-content-between align-content-center ">
                       <h5 class="modal-title" id="changeProfileLabel">Change Profile</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                    <hr>

                   <div class="d-flex justify-content-between flex-wrap ">
                       @for($i=1; $i<=6; $i++)

                           <form action="{{ route('change.profile') }}" method="get" id="{{ $i }}ChangeProfile">
                               <input type="text" name="profile" hidden value="{{$i.'.webp'}}">
                               <div class=" m-4 " style="cursor: pointer" onclick="document.getElementById('{{$i}}ChangeProfile').submit()">
                                   <img  src="{{ asset('Image/'.$i.'.webp') }}" width="100" class="rounded-circle rounded" alt="">
                               </div>
                           </form>

                           @endfor
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        function copyToClipboard() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success mx-3',
                    cancelButton: 'btn btn-outline-danger mx-3'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                html:
                    `<div class="visible-print text-center">
                        <h3 class='mb-4' > Scan To Share Your Referral Code </h3>
                         {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::style('round')->size(300)->generate(url('register?reference_id='.$user->detail->referral_id)) !!}

                    </div>`
            })
        }
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

