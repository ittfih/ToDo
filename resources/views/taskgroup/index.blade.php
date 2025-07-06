@extends('layouts.app')

@section('content')
<div class="container">

    <a class="btn btn-primary" href="{{ route('taskgroup.create') }}">Add new task group</a> <br>
    My task lists: <br>
    <table>
    @foreach ($taskGroups as $taskGroup)
    <tr>
        <th> <a href="{{ route('taskgroup.show', $taskGroup->id) }}">{{$taskGroup->name}}</a> </th>
        <th><a href="{{ route('taskgroup.edit', $taskGroup->id) }}" class="btn btn-warning" >Edit</a>  </th>
        <th><a href="{{ route('permission.index', $taskGroup->id) }}" class="btn btn-warning" >Permissions</a>  </th>
        <th>
        <form class="d-inline-block" method="POST" action="{{ route('taskgroup.destroy', $taskGroup->id) }}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </th>
    </tr>
    @endforeach
    
    </table>

    Shared task lists: <br>
    <ul>
    @foreach ($sharedTaskGroups as $sharedTaskGroup)
        <li> <a href="{{ route('taskgroup.show', $sharedTaskGroup->id) }}">{{$sharedTaskGroup->name}}</a> </li>
    @endforeach
    </ul>
</div>
@endsection