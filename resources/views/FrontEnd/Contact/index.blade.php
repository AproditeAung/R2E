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

        <div class="col-12 my-5 ">
            <div class="card bg-transparent border-secondary">

                <div class="card-body table-responsive ">
                    <div class="fw-bolder h3 ">
                        Blog List
                    </div>
                    <hr>
                    <table class="table  able-responsive table-hover ">
                        <thead>
                        <tr class="icon-gradient bg-happy-fisher  ">
                            <td>No</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td class="d-none d-lg-block">Description</td>
                            <td>Action</td>
                        </tr>
                        </thead>

                        <tbody >
                        @forelse($contacts as $key=>$contact)
                            <tr>
                                <td class="">{{ $key+1 }}</td>
                                <td class="">{{ $contact->email }}</td>
                                <td class="">{{ $contact->phone }}</td>
                                <td class="d-none d-lg-block ">{{ \Illuminate\Support\Str::words($contact->description,10) }}</td>
                                <td class="wrap">
                                    <form action="{{ route('contact.destroy',$contact->id) }}" id="blogDelete" method="post">
                                        @csrf @method('delete')
                                    </form>
                                    <button class="btn btn-danger " type="button" onclick="confirm()"><i class="icofont icofont-trash "></i></button>

                                    <a href="{{ route('contact.show',$contact->id) }}" class="btn btn-info "><i class="icofont icofont-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center fw-bolder text-danger">NO CONTACT</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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
