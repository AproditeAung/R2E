<!-- Button trigger modal -->
<button type="button" class="btn btn-sm " data-bs-toggle="modal" data-bs-target="#upgradeRole">
    <i class="icofont icofont-arrow-up text-success"></i>
</button>

<!-- Modal -->
<div class="modal fade " id="upgradeRole" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="upgradeRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title" id="upgradeRoleLabel">Request Editor Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requestEditor.store') }}" method="post" >
                    @csrf
                    <div class="form-group mb-3 ">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control " name="title" >
                    </div>
                    <div class="form-group mb-3 ">
                        <label for="" class="form-label">Sample Blog</label>
                        <textarea name="description" id="" cols="30" class="form-control " rows="10"></textarea>
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
