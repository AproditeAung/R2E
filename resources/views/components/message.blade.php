@if(session('message'))

    <script>
    let data = {{ \Illuminate\Support\Js::from(session('message')) }}
    console.log(data);
        Swal.fire({
            position: 'top-end',
            icon: data['icon'],
            title: data['text'],
            showConfirmButton: false,
            timer: 1500
        })
    </script>

    @endif
