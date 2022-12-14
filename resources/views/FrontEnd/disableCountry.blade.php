@extends('main')

@section('contant')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary text-white d-none" id="countryDisable" data-bs-toggle="modal" data-bs-target="#staticBackdropForCountryDisable">
        Country
    </button>

    <!-- Modal -->
    <div class="modal fade " id="staticBackdropForCountryDisable" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropForCountryDisableLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-body text-center text-dark">
                    <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">

                    <h1> Sorry For Myanmar User! </h1>

                    <p>
                        This website is not available in your country.
                    </p>

                    <h4>
                        Please Connect VPN!
                    </h4>

                    <a href="{{ route('welcome') }}" class="">
                        <img src="{{ asset('Image/reload-5591029-4653032.png') }}" width="50" height="50" alt="">
                    </a>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        window.addEventListener('load',function (){
                document.getElementById('countryDisable').click();
        })
    </script>

@endsection
