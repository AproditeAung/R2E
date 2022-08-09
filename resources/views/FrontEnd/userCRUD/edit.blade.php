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


        <div class="col-7 m-auto">
            <div class="card card-body mt-3 bg-transparent border-secondary" >
                @if(session('status'))
                    {{ session('status') }}
                @endif
                    <h3 class="fw-bolder">Edit User</h3>
                    <hr>
                <form action="{{ route('user.update',$user->id) }}" method="post" id="update">
                    @csrf @method('patch')
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text"  class="form-control " name="name" value="{{ $user->name }}" >

                    </div>

                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" class="form-control " name="email"  value="{{ $user->email }}" >

                    </div>

                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password"  class="form-control " name="password"  placeholder="**** Should Change ******">

                    </div>

                    <div class="form-group mb-3">
                        <label for="">Role</label>
                        <input type="number"  class="form-control  " value="{{ $user->role }}" name="role" >

                    </div>


                    <div class="form-group text-end mt-3 ">
                        <button type="button" id="backBtn" class="btn btn-outline-secondary">Cancel</button>
                        <button type="submit" class="btn btn-info">Edit User</button>
                    </div>
                </form>
            </div>
        </div>

@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest', '#update'); !!}
    <script>



        $(document).ready(function() {

        } );
    </script>

@endsection

