<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-secondary  " data-bs-toggle="modal" data-bs-target="#showVideo{{ $video->id }}">
    <i class="icofont icofont-video text-success"></i>
</button>

<!-- Modal -->
<div class="modal fade " id="showVideo{{ $video->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showVideo{{ $video->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header border-0 ">
                <h5 class="modal-title" id="showVideo{{ $video->id }}Label">Video Show Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="player" class="w-100"></div>

                <div class="w-100">
                    <video src="{{ asset('storage/video/'.$video->name) }}" preload="auto" controls style="width: 100%;height: 100%" ></video>
                </div>

            </div>
        </div>
    </div>
</div>


{{--<script>--}}
{{--    var player = new Clappr.Player({source: '{{ asset('storage/video/'.$video->name) }}', parentId: "#player"});--}}
{{--</script>--}}
