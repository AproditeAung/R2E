<!-- Button trigger modal -->
<button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                        <label for="" class="form-label">Phone</label>
                        <input type="tel" class="form-control  " name="phone"  >
                    </div>
                    <div class="form-group mb-3 ">
                        <label for="" class="form-label">Amount</label>
                        <input type="number" class="form-control  " name="amount" >
                    </div>

                   <div class="form-group mb-3 ">
                       <label for="" class="form-label">Select Option  </label>
                       <select class="form-select " name="type" aria-label="Default select example">
                           <option selected disabled>Open this select menu</option>
                           <option value="Kpay">Kpay </option>
                           <option value="PhoneBill">Phone Bill</option>
                           <option value="Charity">Charity</option>
                       </select>
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
