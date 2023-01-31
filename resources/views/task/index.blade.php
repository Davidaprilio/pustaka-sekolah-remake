@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table border rounded table-sm" id="task-table">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>Judul</th>
                                <th>DeadLine</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (range(1,9) as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#task-table').DataTable({

        })
    </script>
@endsection