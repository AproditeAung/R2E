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
                    <span class="fw-bold h6 ">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Role</span>
                    <span class="fw-bold h6 ">
                        {{ $user->role == '0' ? 'Reader' : 'Editor' }}
                        @if($user->role == '0')
                            @include('components.upgraderow')
                            @endif
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h6 ">Gmail</span>
                    <span class="fw-bold h6 ">{{ $user->email }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline  mt-3   ">
                    <span class="fw-bold h6 ">Referral Id</span>
                    <span class="fw-bold h6 ">{{ $user->detail->reference_id }}</span>
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

