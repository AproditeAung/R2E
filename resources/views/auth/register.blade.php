@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-5  ">
                <div class="card bg-transparent border-secondary shadow-sm text-secondary " style="border-radius: 20px;">

                    <div class="card-body">
                        <div class="d-flex align-items-center   px-3  my-4 ">
                            <h5  class="fw-bolder ml-5 pl-5  mb-0 ">REGISTER </h5>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text"
                                           class="form-control  border-secondary   @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                           class="form-control  border-secondary @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="row mb-3">--}}
{{--                                <label for="phone"--}}
{{--                                       class="col-md-4 col-form-label text-md-end"> Phone </label>--}}

{{--                                <div class="col-md-8">--}}
{{--                                    <input id="phone" type="text"--}}
{{--                                           class="form-control  border-secondary @error('phone') is-invalid @enderror" name="phone"--}}
{{--                                           value="{{ old('phone') }}" required autocomplete="phone">--}}

{{--                                    @error('phone')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                           class="form-control  border-secondary @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control  border-secondary"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="reference_id"
                                       class="col-md-4 col-form-label text-md-end">Reference ID</label>

                                <div class="col-md-8">
                                    <input id="reference_id" type="text" class="form-control  border-secondary"
                                           name="reference_id" value="{{ request()->referral_id ?? '' }}">
                                </div>
                            </div>


                            <div class="row mb-0 ">
                                <div class="col-md-6 offset-md-9  text-right ">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
