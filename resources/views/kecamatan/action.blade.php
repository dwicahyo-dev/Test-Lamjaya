<div class="btn-group">
    <button title="Edit" type="button" class="btn btn-icon btn-outline-primary edit-btn"
        @click.prevent="$store.kecamatan.edit({{ json_encode($object) }})">

        Edit
    </button>

    <button title="Delete" type="button" class="btn btn-icon btn-outline-danger delete-btn"
        @click.prevent="$store.kecamatan.delete({{ json_encode($object) }})">

        Delete
    </button>

</div>