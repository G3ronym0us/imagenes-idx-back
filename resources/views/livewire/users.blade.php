<div class="container" style="padding-top: 30px">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Usuarios</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary align-left">Crear Usuario</a>
            <table class="table mt-10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()[0] }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm"
                                    wire:click="editUser({{ $user->id }})">Editar</button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteUser({{ $user->id }})">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
