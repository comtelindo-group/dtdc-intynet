<div class="modal fade" id="kt_modal_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="fw-bolder">Foto Rumah</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 my-7">
                <img id="img" src="" alt="" class="w-100" style="max-height: 500px;">
            </div>
        </div>
    </div>
</div>

<script>
    let totalPerangkat = 1;

    const imageTrigger = (data) => {
        $('#img').attr('src', '{{asset("storage/volunteer/")}}/' + data.photo);
    }
</script>
