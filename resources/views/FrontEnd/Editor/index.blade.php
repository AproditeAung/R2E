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
        <div class="col-12 my-md-5 ">
            <div class="card bg-transparent border-secondary">

                <div class="card-body table-responsive">
                    <div class="fw-bolder h3 ">
                        Editor Lists
                    </div>
                    <hr>
                    <table class="table mb-0  table-hover ">
                        <thead>
                        <tr class="icon-gradient bg-happy-fisher  ">
                            <td>No</td>
                            <td>User</td>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Time</td>
                        </tr>
                        </thead>

                        <tbody >
                        @forelse($editors as $key=>$editor)
                            <tr>
                                <td class="  ">{{ $key+1 }}</td>
                                <td class="  ">{{ $editor->user->name }}</td>
                                <td class="  ">{{ $editor->title }}</td>
                                <td class="  ">{{ \Illuminate\Support\Str::limit($editor->description,50) }}</td>
                                <td>
                                    <form action="{{ route('requestEditor.destroy',$editor->id) }}" id="editor" method="post">
                                        @csrf @method('delete')
                                    </form>
                                    <button class="btn btn-success " type="button" onclick="confirm()"><i class="pe-7s-up-arrow "></i></button>

                                    <a href="{{ route('requestEditor.show',$editor->id) }}" class="btn btn-info "><i class="pe-7s-info"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center fw-bolder text-danger">
                                    <div class="my-4 ">
                                        No Editors Request
                                    </div>
                                </td>
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
                confirmButtonText: 'Yes, role upgrade it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#editor').submit();
                }
            })
        }
    </script>

@endsection
