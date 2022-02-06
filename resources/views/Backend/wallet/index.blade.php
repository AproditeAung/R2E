@extends('Backend.layout.app')
@section('title') Wallet  @endsection
@section('wallet_index_active','mm-active')
@section('content')
    <div class="app-page-title mb-3 ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>  Wallet Management </div>
            </div>

        </div>
    </div>

    <div class="card card-body mt-3 ">

        <table class="table table-bordered text-center table-responsive-sm w-100" id="dataTable">
            <thead>
            <tr>
                <td>#</td>
                <td >Wallet_Person</td>
                <td>Wallet_Account</td>
                <td>Amount [MMK]</td>
                <td class="no-sort text-nowrap" >Update Time</td>
            </tr>
            </thead>
            <tbody>      </tbody>
        </table>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable( {
                processing: true,
                serverSide: true,
                ajax: "{!!route('admin.wallet.dataTable')!!}",
                columns: [
                    {data:'id',name: 'id'}, //DT_RowIndex is 1.2.3.4. can't sort
                    {data: 'wallet_person', name: 'wallet_person'  },
                    {data: 'acc_number', name: 'acc_number'},
                    {data: 'amount', name: 'amount'},
                    {data: 'updated_at',name:'updated_at'},

                ],
                columnDefs : [
                    { targets : 'no-sort' , sortable  : false } //fucking s is so noisy
                ],
                order: [
                    [ 4,'desc'],
                ]
            } );

        } );
    </script>

@endsection

