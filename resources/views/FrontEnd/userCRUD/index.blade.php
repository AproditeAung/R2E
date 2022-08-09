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


    <div class="col-lg-12 ">
        <div class="card card-body mt-3 bg-transparent border-secondary   ">
            <form action="{{ route('user.index') }}"  method="get" class="col-3 p-0  ">
                <select class="form-select" name="role" onchange='this.form.submit()' aria-label="Default select example">
                    <option selected value="3">All</option>
                    <option  {{ request()->role == '2'? "selected"  : ''}} value="2">Admin</option>
                    <option {{ request()->role == '1' ? "selected" : '' }} value="1">Editor</option>
                    <option {{ request()->role == '0' ? "selected" : '' }} value="0">User</option>
                </select>
            </form>
            <table class="table  table-bordered  p-0  mt-3 table-responsive-md  " id="dataTable">
                <thead class="fw-bolder  ">
                <tr>
                    <td>#</td>
                    <td >Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Upgrade Admin</td>
                    <td class="no-sort text-nowrap" >Control</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td >{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @php $role = ['Reader','Editor','Admin']; @endphp
                        <td>{{ $role[$user->role] }}</td>
                        <td class=" ">
                            <form action="{{ route('user.upgradeAdmin') }}" id="upgradeAdmin{{ $user->id }}" method="post" class="">
                                @csrf
                                <div class="form-group  ">
                                    <div class="form-check form-switch">
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                                        <input class="form-check-input" {{  $user->role == 2 ? 'checked' : '' }} name="admin_upgrade" onchange="confirmUpgradeAdmin({{ $user->id }})" type="checkbox" role="switch" id="flexSwitchCheckChecked" >

                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="text-nowrap " >
                            <a href="{{ route('user.edit',$user->id) }}" class="icofont icofont-edit text-decoration-none  btn btn-outline-secondary   text-warning  fsize-1  mx-3 "></a>
                            <form id="userDelete{{ $user->id }}" action="{{ route('user.destroy',$user->id) }}" method="post" class=" d-inline  ">
                                @csrf @method('delete')
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                <span class="icofont icofont-trash text-danger text-decoration-none  btn btn-outline-secondary    fsize-1 " onclick="allow('{{ $user->name}}','{{  $user->id }}')"></span>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

@endsection

@section('script')
    <script>
        function allow(name,id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: name + id,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#userDelete'+id).submit();

                }
            })
        }

        function confirmUpgradeAdmin(id){
            Swal.fire({
                title: "UPGRADE ADMIN",
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $("#upgradeAdmin"+id).submit();

                }
            })
        }
    </script>

@endsection


