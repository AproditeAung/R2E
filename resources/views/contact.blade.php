@extends('main')
@section('contact_active','active fw-bolder')
@section('contant')


    <div class="col-md-9 m-auto my-5  ">
        <h1 class="fw-bolder text-center ">Contact Us</h1>

        <form action="{{ route('contact.store') }}"  method="post" >
            @csrf
            <div class="form-group mb-3 ">
                <label class="form-label " for="email" >Email</label>
                <input type="email" class="form-control text-white  " name="email">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3 ">
                <label class="form-label " for="phone" >Phone</label>
                <input type="text"  name="phone" class="form-control text-white " >
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3 ">
                <label class="form-label " for="descripiton" >Description</label>
                <textarea type="text" name="description" class="form-control text-white " > </textarea>
                @error('description')
                <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mt-4 text-end ">
                <button class="btn btn-primary btn-block w-100  "> Submit </button>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>
    </div>

@endsection
