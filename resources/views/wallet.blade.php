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
@section('wallet_active','fw-bold')

@section('contant')


    <div class="col-md-8 my-5  ">
        <div class="card border-secondary bg-transparent  shadow-sm ">

            <div class="card-body table-responsive ">
                 <span class="h4 fw-bolder ">
                    Withdraw History
                </span>
                <hr>
                <table class="table text-secondary table-borderless mb-0    ">
                    <thead>
                    <tr class=" fw-bolder ">
                        <td>No</td>
                        <td>Gmail</td>
                        <td>Amount</td>
                        <td>Time</td>
                    </tr>
                    </thead>

                    <tbody >
                    @forelse($withdraws as $key=>$withdraw)
                        <tr>
                            <td class=" ">{{ $key+1 }}</td>
                            <td class="" style="white-space: nowrap"><span class="me-2">{{ $withdraw->gmail }}</span> <i class="icofont icofont-verification-check text-success   "></i></td>
                            <td class=" ">
                                {{ $withdraw->amount }}
                            </td>
                            <td style="white-space: nowrap"> {{ $withdraw->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center fw-bolder text-danger">NO WITHDRAW </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="bg-transparent mt-3 float-end  ">
                    {{ $withdraws->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 my-5  ">
        <div class="card border-secondary shadow-sm bg-transparent mb-3 ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('Image/earn-money.png') }}" width="50" alt="">
                    <span class="fw-bold h4 ">Wallet</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3   ">
                    <span class="fw-bold h4 ">Amount</span>
                    <span class="fw-bold h4 ">{{ $wallet->amount }} MMK</span>
                </div>
                <div class="d-flex justify-content-between align-items-baseline  mt-3   ">
                    @include('components.withdraw')
                    <div class="small text-success ">minimal withdraw 10k</div>
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

