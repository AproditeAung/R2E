@extends('Backend.layout.app')
@section('title') Blog @endsection
@section('contact_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Contact Lists </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 ">
        <div class="col-12">
            <div class="card">
                <div class="icon-gradient bg-mean-fruit card-header">
                    Blog List
                </div>
                <div class="card-body">
                    <table class="table  able-responsive table-hover ">
                        <thead>
                        <tr class="icon-gradient bg-happy-fisher  ">
                            <td>No</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Description</td>
                        </tr>
                        </thead>

                        <tbody >
                        @forelse($contacts as $key=>$contact)
                            <tr>
                                <td class="icon-gradient bg-mean-fruit  ">{{ $key+1 }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ $contact->email }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ $contact->phone }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ \Illuminate\Support\Str::limit($contact->description,50) }}</td>
                                <td>
                                    <form action="{{ route('contact.destroy',$contact->id) }}" id="blogDelete" method="post">
                                        @csrf @method('delete')
                                    </form>
                                    <button class="btn btn-danger " type="button" onclick="confirm()"><i class="pe-7s-trash "></i></button>

                                    <a href="{{ route('contact.show',$contact->id) }}" class="btn btn-info "><i class="pe-7s-info"></i></a>
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
