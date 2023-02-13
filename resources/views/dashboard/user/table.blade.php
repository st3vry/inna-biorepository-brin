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
                    <a href="/dashboard/users/{{$user->id}}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></span></a>
                    <form action="/dashboard/users/{{$user->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><i class="bi bi-x-circle"></i></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
{{$users->links()}}