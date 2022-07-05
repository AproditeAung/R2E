@extends('Backend.layout.app')
@section('title') Create User  @endsection
@section('user_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Create  User </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 ">
            <div class="card card-body mt-3" >

                <form action="{{ route('user.store') }}" method="post" id="create">
                    @csrf

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text"  class="form-control " name="name" >

                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control " name="email" >

                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password"  class="form-control " name="password" >

                    </div>

                    <div class="form-group">
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

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-info">Create Reader</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card card-body mt-3" >
                <h3>Generate User</h3>

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

