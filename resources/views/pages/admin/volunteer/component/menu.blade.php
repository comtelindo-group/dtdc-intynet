<div class="d-flex justify-content-center align-items-center gap-2">
    <div onclick="imageTrigger({{$query}})">
        <a href="#kt_modal_image" data-bs-toggle="modal" class="btn btn-sm btn-icon btn-success w-30px h-30px">
            <span class="fa-solid fa-image"></span>
        </a>
    </div>
    <button class="btn btn-sm btn-icon btn-danger w-30px h-30px"
        onclick="onDelete('{{ $query->id }}')">
        <span class="fa fa-times"></span>
    </button>
</div>
