@extends('main')
@section('meta')

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="{{ $blog->title }}"/>
    <meta property="og:image" content="{{ asset('Image/'.$blog->ImageRec) }}"/>
    <meta property="og:url" content="{{ \Illuminate\Support\Facades\URL::full() }}"/>
    <meta property="og:site_name" content="{{ $blog->title }}"/>
    <meta property="og:description" content="{{ $blog->sample }}"/>
    <meta property="og:type"          content="website" />


@endsection
@section('blog_active','active')
@section('contant')


    <div class="col-md-9 mt-3  mb-5  position-relative">
            <div class="   px-md-3   d-flex flex-column justify-content-between" >
                <div class="mt-4 mt-md-0  " data-aos="zoom-in" data-aos-duration="1000">
                    <h3 class="fw-bolder h2 text-capitalize text-center" > {{ $blog->title }}  </h3>
                    <div class="d-flex align-content-center justify-content-center  ">
                        <p class="small me-2  me-md-4 "> <i class="icofont icofont-calendar me-2 "></i> {{ $blog->created_at->diffForHumans() }}</p>
                        <p class="small me-2  me-md-4 "> <i class="icofont icofont-heart me-2 "></i> {{ $blog->countUser }} like</p>
                        <p class="small me-2  me-md-4"> <i class="icofont icofont-layers me-2 "></i> {{ $blog->categoryName->name }} </p>
                        <p class="small"> <i class="icofont icofont-user me-2 "></i> {{ $blog->user->name }} </p>
                    </div>
                    <div class="my-3 text-center">
                        <img src="{{ asset('storage/blog_photos/'.$blog->ImageRec) }}"  width="90%" class="rounded " alt="">
                    </div>

                    <div class="card bg-transparent border-0 ">
                        <div class="card-body ">
                            {!! $blog->body !!}
                        </div>
                    </div>

                </div>

            </div>
             <span class="position-absolute top-30 p-2 text-primary bg-transparent  border rounded  " style="right: 10px;top:100px">
                <span id="minute"> 00 </span> : <span id="second"> 00 </span>
            </span>



    </div>
    <div class="col-md-3 my-3 my-md-5  ">
        <h1 class="mb-5 mb-md-4 h3 "> <i class="icofont icofont-news me-3 "></i> Related News </h1>
        @forelse($relatedNews as $relatedNew)
            <div  class=" ">
                <div class=" px-4  px-md-3 mb-3 ">
                    <h3 class="fw-bolder h6 text-capitalize "> {{ $relatedNew->title }}  </h3>

                    <div class="mt-4 mt-md-0 ">
                        <div class="my-3 d-flex align-items-center justify-content-between  ">
                            <img src="{{ asset('storage/blog_photos/'.$relatedNew->ImageRec) }}" data-aos="zoom-in" data-aos-duration="1000" class="rounded " width="50%" alt="">
                            <div >
                                <p class="small mb-2   "> <i class="icofont icofont-calendar me-2 "></i> {{ $relatedNew->created_at->format('d M Y') }}</p>
                                <p class="small mb-2   "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $relatedNew->countUser }} views</p>
                                <p class="small mb-2 "> <i class="icofont icofont-layers me-2 "></i> {{ $relatedNew->categoryName->name }} </p>
                            </div>
                        </div>

                        <p style="text-align: justify" class="mt-3  fw-lighter ">
                            {{ \Illuminate\Support\Str::words($relatedNew->body,20) }}

                        </p>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('guest.blog.detail',$relatedNew->slug) }}" class="link-secondary  ">Read More</a>
                    </div>
                </div>
                <hr >
            </div>

        @empty
            <div  class=" ">
                <div class=" px-4  px-md-3 mb-3 ">
                    <h3 class="fw-bolder h6  "> No Related Title  </h3>

                    <div class="mt-4 mt-md-0 ">
                        <div class="my-3 d-flex align-items-center justify-content-between  ">
                            <img src="{{ asset('storage/blog_mini_photo') }}" data-aos="zoom-in" data-aos-duration="1000" class="rounded " width="50%" alt="">
                            <div >
                                <p class="small mb-2   "> <i class="icofont icofont-calendar me-2 "></i> 12 May 22</p>
                                <p class="small mb-2   "> <i class="icofont icofont-ui-user-group me-2 "></i> 132 views</p>
                                <p class="small mb-2 "> <i class="icofont icofont-layers me-2 "></i> Spot </p>
                            </div>
                        </div>

                        <p style="text-align: justify" class="mt-3  fw-lighter ">
                           No Related Description
                        </p>
                    </div>

                </div>
                <hr >
            </div>

        @endforelse
    </div>

@endsection

@section('script')
    <script>
        let showSecond = document.getElementById('second');
        let showMinute = document.getElementById('minute');
        let showAlert = 0;
        window.addEventListener('load',function (){
            let second = 0;
            let minute = 0;
            setInterval(()=>{
                second++;
                if(second === 60){
                    second = 0;
                    minute++;
                    showMinute.innerText = minute < 10 ? '0'+minute : minute;
                    if(showAlert < 1){
                        giveFeedBack();
                    }
                }
                showSecond.innerText = second < 10 ? '0'+second : second;
            },1000);
        });


        function showMessage()
        {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to earn money before 1 min",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#a41111',
                cancelButtonColor: '#0f9d67',
                confirmButtonText: 'GO Back',
                cancelButtonText: 'Still Here',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('welcome') }}';
                }
            })
        }

        function giveFeedBack(){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Like Or Dislike?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, I love it!',
                cancelButtonText: "I don't like it!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = '{{ route('user.feedback') }}';
                    let data = {
                        '_token' : '{{ csrf_token() }}',
                        'isLike' : 'ok',
                        'blog_id' : {{ $blog->id }}
                    }
                    $.ajax({
                        type : "POST",
                        url : url,
                        data : data,
                        success : function (res){
                            console.log(res)

                            if(res.status == 'success'){
                                swalWithBootstrapButtons.fire(
                                    'Thanks!',
                                    res.message,
                                    'success'
                                )
                                showAlert++;

                            }
                        }
                    })

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    let url = '{{ route('user.feedback') }}';
                    let data = {
                        '_token' : '{{ csrf_token() }}',
                        'isLike' : 'not',
                        'blog_id' : {{ $blog->id }}
                    };

                    $.ajax({
                        type : "POST",
                        url : url,
                        data : data,
                        success : function (res){
                            console.log(res);
                            if(res.status == 'success'){

                                swalWithBootstrapButtons.fire(
                                    'Thanks!',
                                    res.message,
                                    'success'
                                )
                                showAlert++;

                            }
                        }
                    })


                }
            })
        }
    </script>
    @endsection
