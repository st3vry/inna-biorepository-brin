@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

<table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">UserName</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Lab</th>
                <th scope="col">Center</th>
                <th scope="col">Role</th>
                <th scope="col">IsActivated</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
            <tr>
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->lab->name }}</td>
                <td>{{ $user->lab->center->name }}</td>
                <td>{{ $user->role->name }}</td>
                <td>@if ($user->is_activated) Active @else Inactive @endif</td>
                <td>
                    <a href="/dashboard/users/{{$user->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/users/{{$user->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
{{$users->links()}}

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endpush