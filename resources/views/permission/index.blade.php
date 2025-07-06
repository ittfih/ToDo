@extends('layouts.app')

@section('content')
<div class="container">

    <a class="btn btn-primary" href="{{ route('permission.create', $id) }}">Add new authroized user</a> <br>
    Authorized users: <br>
    <table>
        <tr>
            <th>User</th>
            <th>Add task</th>
            <th>Edit task</th>
            <th>Remove task</th>
            <th>Change status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->user->name }}</td>
            <td><input type="checkbox" disabled  {{ $permission->add_task ? 'checked' : '' }} /></td>
            <td><input type="checkbox" disabled  {{ $permission->edit_task ? 'checked' : '' }} /></td>
            <td><input type="checkbox" disabled  {{ $permission->remove_task ? 'checked' : '' }} /></td>
            <td><input type="checkbox" disabled  {{ $permission->change_status ? 'checked' : '' }} /></td>
            <td><a href="{{ route('permission.edit', [ 'taskGroupId' => $id, 'permission' => $permission]) }}" class="btn btn-warning" >Edit</a>  </td>
            <td>
                <form class="d-inline-block" method="POST" action="{{ route('permission.destroy', [ 'taskGroupId' => $id, 'permission' => $permission->id ]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection