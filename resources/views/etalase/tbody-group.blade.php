@foreach ($groups as $e)
    <tr>
        <td>{{ $loop->iteration }}.</td>
        <td>{{ $e->name }}</td>
        <td>{{ $e->etalase_count }} item</td>
        <td>
            <div class="btn-group float-end" data-id="{{ $e->id }}" data-name="{{ $e->name }}">
                <button class="btn btn-sm btn-warning btn-edit">
                    <i class="fa fs-6 fa-pencil"></i>
                </button>
                @if ($e->etalase_count > 0)
                    @php
                        $title = "Tidak dapat menghapus kategori ini karena terdapat {$e->etalase_count} buku didalamnya";
                    @endphp
                    <button title="{{ $title }}" class="btn btn-sm btn-danger" onclick="alert('{{ $title }}')">
                        <i class="fa fs-6 fa-trash"></i>
                    </button>
                @else
                    <x-link class="btn btn-sm btn-danger" classform="form-group-delete" :href="route('etalase.group.delete', [
                        'etalaseGroup' => $e->id,
                    ])" method="DELETE">
                        <i class="fa fs-6 fa-trash"></i>
                    </x-link>
                @endif
            </div>  
        </td>
    </tr>
@endforeach