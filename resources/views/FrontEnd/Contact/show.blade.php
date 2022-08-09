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


            <div class="col-12 m-auto my-5  ">
                <div class="card mb-2 mb-md-5 bg-transparent border-secondary">
                    <div class="card-body">
                        <h4 class="fw-bolder h5 "> <i class="icofont icofont-mail"></i> : {{ $contact->email }} </h4>
                        <h5 class="fw-bolder h5 my-4 "> <i class="icofont icofont-phone"></i>  : {{ $contact->phone }} </h5>

                        <p class="h6" style="text-align: justify;line-height: 1.5rem">
                            {{ $contact->description }}
                        </p>

                        <div class="text-end mt-4 ">
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary ">GO HOME</a>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('script')


@endsection
