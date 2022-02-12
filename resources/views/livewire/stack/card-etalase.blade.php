<div class="col-4">
    <div class="bg-light mb-3 p-4 rounded position-relative">
        <button class="btn btn-sm position-absolute" wire:click="delete" style="top: 0; right: -5px">
            <i class="fa fa-trash-alt text-danger"></i>
        </button>
        <h6 class="mb-5">
            <input type="text" value="{{ $data->name }}" class="form-control border-0 bg-transparent">
        </h6>
        <ul class="list-unstyled">
            @foreach ($data->etalase as $item)
            @livewire('stack.card-stack', ['etalaseBook' => $item], key($item->id))
            @endforeach
        </ul>
    </div>
</div>