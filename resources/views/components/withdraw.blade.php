<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    withdraw
</button>

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title" id="staticBackdropLabel">Happy Withdraw</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('withdraw.store') }}" method="post" >
                    @csrf
                    <div class="form-group mb-3 ">
                        <label for="" class="form-label">Gmail</label>
                        <input type="email" class="form-control  " name="gmail" >
                    </div>
                    <div class="form-group mb-3 ">
                        <label for="" class="form-label">Amount</label>
                        <input type="number" class="form-control  " name="amount" >
                    </div>

                    <div class="form-group text-end ">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button  class="btn btn-success ">Request</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
