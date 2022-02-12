<li>
    <div class="position-relative input-stack">
        <input class="px-2 py-3 border rounded bg-white mb-3 form-control" value="{{ $data->name }}">
        <button class="btn btn-sm position-absolute btn-delete-stack p-0" wire:click="delete">
            <i class="fa fa-trash-alt text-danger"></i>
        </button>
    </div>
</li>