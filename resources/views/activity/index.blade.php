@extends('layouts.adminlte.main', [
    'pageName' => 'Aktifitas Literasi',
    'breadcrumb' => 'Panel'
])

@section('content')
<div class="row">
    <div class="col-10">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>name</td>
                            <td>status</td>
                            <td>terakhir</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($most_frequently_read_user as $sesion_user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sesion_user->user->name }} ({{ $sesion_user->user->kelas }})</td>
                            <td>{{ $sesion_user->on_reading ? 'membaca' : 'online' }}</td>
                            <td title="{{ $sesion_user->updated_at->isoFormat('LLL') }}">
                                {{ $sesion_user->updated_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection