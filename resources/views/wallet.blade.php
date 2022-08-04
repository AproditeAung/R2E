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
@section('wallet_active','fw-bold active')

@section('contant')


    <div class="col-lg-4 my-lg-5 mb-3 mb-lg-0   ">
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
                    <div class="small text-danger ">min withdraw 1000 ks</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 my-lg-5 mb-3 mb-lg-0  d-none d-lg-block  ">
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
                        <td>Type</td>
                        <td>Status</td>
                        <td>Time</td>
                    </tr>
                    </thead>

                    <tbody >
                    @forelse($withdraws as $key=>$withdraw)
                        <tr class="small ">
                            <td class=" ">{{ $key+1 }}</td>
                            <td class="" style="white-space: nowrap">
                                <span class="me-2">{{ \Illuminate\Support\Facades\Crypt::decryptString($withdraw->phone) }}</span>
                            </td>
                            <td class="text-dark ">
                                {{ $withdraw->amount }} Ks
                            </td>
                            <td >
                                {{ $withdraw->type }}
                            </td>
                            <td >
                                @if($withdraw->status == 1 )
                                    <i class="icofont icofont-verification-check h4   text-success "></i>

                                @else
                                    <i class="icofont icofont-worker  h4   text-warning "></i>

                                @endif
                            </td>
                            <td style="white-space: nowrap" class="small">
                                <small>{{ $withdraw->created_at->format('d M Y') }} / {{ $withdraw->created_at->format('H : i : s') }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center fw-bolder text-danger">NO WITHDRAW </td>
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

    {{--    withdarw History will show only in small and medium screen--}}
    <div class="d-block d-lg-none col-lg-12 my-lg-5 mb-3 mb-lg-0   ">
        <div class="card border-secondary bg-transparent  ">
            <div class="card-body ">
                 <span class="h4 fw-bolder ">
                    Withdraw History
                </span>
                <hr>
                @forelse($withdraws as $key=>$withdraw)
                    <div class="d-flex justify-content-between align-items-center mb-3  ">
                        <div class="">
                            @if($withdraw->status == 1 )
                                <i class="icofont icofont-verification-check icofont-3x   text-success "></i>

                            @else
                                <i class="icofont icofont-worker  icofont-3x   text-warning "></i>

                            @endif
                        </div>
                        <div class="">
                            <div class="small">{{ \Illuminate\Support\Facades\Crypt::decryptString($withdraw->phone) }}</div>
                            <div class="small">{{ $withdraw->created_at->format('d/m H:i:s') }}</div>
                        </div>
                        <div class="">
                            <div class="h4">{{ $withdraw->amount }} Ks</div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="text-center fw-bolder text-danger">NO WITHDRAW </td>
                    </tr>
                @endforelse
                <div class="bg-transparent mt-3 float-end  ">
                    {{ $withdraws->links() }}
                </div>
            </div>
        </div>
    </div>
    {{--    withdarw History will show only in small and medium screen--}}

    {{--    this will show only in large screen--}}
    <div class="d-none d-lg-block col-lg-12 my-lg-5 mb-3 mb-lg-0   ">
        <div class="card border-secondary bg-transparent  shadow-sm ">
            <div class="card-body table-responsive ">
                 <span class="h4 fw-bolder ">
                    Earn History
                </span>
                <hr>
                <table class="table text-secondary table-borderless mb-0    ">
                    <thead>
                    <tr class=" fw-bolder ">
                        <td>No</td>
                        <td>Type</td>
                        <td>Message</td>
                        <td>Amount</td>
                        <td>Time</td>
                    </tr>
                    </thead>

                    <tbody >
                    @forelse($notifications as $key=>$noti)
                        <tr>
                            <td class=" ">{{ $key+1 }}</td>
                            <td class="" style="white-space: nowrap"><span class="me-2">{{ $noti->type }}</span> <i class="icofont icofont-verification-check text-success   "></i></td>
                            <td class=" ">
                                {{ $noti->data['message'] }}
                            </td>
                            <td class=" ">
                                {{ $noti->data['data']['amount'] }} MMK
                            </td>
                            <td style="white-space: nowrap"> {{ $noti->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center fw-bolder text-danger">NO WITHDRAW </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="bg-transparent mt-3 float-end  ">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
    {{--    this will show only in large screen--}}

    {{--    this will show only in small and medium screen--}}
    <div class="d-block d-lg-none col-lg-12 my-lg-5 mb-3 mb-lg-0   ">
        <div class="card border-secondary bg-transparent  shadow-sm ">
            <div class="card-body ">
                 <span class="h4 fw-bolder ">
                    Earn History
                </span>
                <hr>
                @forelse($notifications as $key=>$noti)
                    <div class="d-flex justify-content-between align-items-center mb-3  ">
                        <div class="">
                            <img src="{{ asset('Image/earn-money.png') }}" width="50" alt="">
                        </div>
                        <div class="">
                            <div class="small">{{ $noti->data['message'] }}</div>
                            <div class="small">{{ $noti->created_at->format('d/m H:i:s') }}</div>
                        </div>
                        <div class="">
                            <div class="h4">{{ $noti->data['data']['amount'] }} Ks</div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="text-center fw-bolder text-danger">NO WITHDRAW </td>
                    </tr>
                @endforelse
                <div class="bg-transparent mt-3 float-end  ">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
    {{--    this will show only in small and medium screen--}}


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

