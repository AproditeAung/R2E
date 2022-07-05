@extends('Backend.layout.app')
@section('title') Editor @endsection
@section('editor_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Editor Lists </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 ">
        <div class="col-12">
            <div class="card">
                <div class="icon-gradient bg-mean-fruit card-header">
                    Editor Lists
                </div>
                <div class="card-body">
                    <table class="table  able-responsive table-hover ">
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
                                <td class="icon-gradient bg-mean-fruit  ">{{ $key+1 }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ $editor->user->name }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ $editor->title }}</td>
                                <td class="icon-gradient bg-mean-fruit  ">{{ \Illuminate\Support\Str::limit($editor->description,50) }}</td>
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
