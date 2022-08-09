@extends('main')
@section('meta')
    <style>
        .page-link{
            background-color: #494848 !important;
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') setting @endsection
@section('setting_active','active fw-bold')
@section('contant')


    <div class="row">
        <div class="col-md-6 ">
            <div class="card card-body mt-3 bg-transparent border-secondary" >
                <span class="h3 fw-bolder  ">
                    User Manager
                </span>
                <hr>
                <form action="{{ route('user.store') }}" method="post" id="create">
                    @csrf

                    <div class="form-group mb-3 ">
                        <label for="">Name</label>
                        <input type="text"  class="form-control " name="name" >

                    </div>

                    <div class="form-group mb-3 ">
                        <label for="">Email</label>
                        <input type="text" class="form-control " name="email" >

                    </div>

                    <div class="form-group mb-3 ">
                        <label for="">Password</label>
                        <input type="password"  class="form-control " name="password" >

                    </div>

                    <div class="form-group mb-3 ">
                        <label for="">Role</label>
                       <div class="d-flex">
                           <div class="form-check me-4 ">
                               <input class="form-check-input" type="checkbox" value="0" name="role" id="flexCheckIndeterminate">
                               <label class="form-check-label" for="flexCheckIndeterminate">
                                   Reader
                               </label>
                           </div>
                           <div class="form-check">
                               <input class="form-check-input" type="checkbox" value="1" name="role" id="flexCheckIndeterminate2">
                               <label class="form-check-label" for="flexCheckIndeterminate2">
                                   Editor
                               </label>
                           </div>
                       </div>
                    </div>

                    <div class="form-group  text-end">
                        <button type="submit" class="btn btn-info">Create User</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card card-body mt-3 border-secondary bg-transparent" >
                <h3 class="fw-bolder">Generate User</h3>
                <hr>
                <a href="{{ route('user.generateUser') }}" class="btn btn-outline-success ">GENERATE READER</a>


                @if(session('message'))

                    <div class="d-flex justify-content-between align-items-center my-2 mt-4 ">
                        <span class="fw-bolder ">Name</span>
                        <span class="fw-bolder " id="nameG">KOKO</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <span class="fw-bolder ">Email</span>
                        <span class="fw-bolder " id="emailG">KOKO</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <span class="fw-bolder ">Password</span>
                        <span class="fw-bolder " id="passwordG">mustbewin</span>
                    </div>
                    <script>
                        let user = {{ \Illuminate\Support\Js::from(session('message')) }};
                        document.getElementById('nameG').innerHTML = user.user.name;
                        document.getElementById('emailG').innerHTML = user.user.email;
                        console.log(user);
                    </script>
                    @endif
            </div>
        </div>
    </div>

@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UserCreateRequest', '#create'); !!}


@endsection

