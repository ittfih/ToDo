@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($taskGroup->Tasks as $task)
        <div class="card m-2">
            @php
                switch ($task->status) {
                    case 'on hold':
                        $newStyle = "bg-secondary";
                        break;
                    case 'in progress':
                        $newStyle = "bg-info";
                        break;
                    case 'done':
                        $newStyle = "bg-success";
                        break;
                    default:
                        $newStyle = "";
                        break;
                }
            @endphp

            <div class="card-header {{ $newStyle }}">{{$task->title}}
                @can('changeStatus', $task)

                    <form class="d-inline-block" method="POST" action="{{ route('task.status', ['task' => $task]) }}">
                        @csrf
                        @method('PATCH')
                        <select class="form-select" name="status" onchange="this.form.submit()" >
                            <option value="not done" {{ $task->status === 'not done' ? 'selected' : '' }} >Not done</option>
                            <option value="on hold" {{ $task->status === 'on hold' ? 'selected' : '' }} >On hold</option>
                            <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }} >In progress</option>
                            <option value="done" {{ $task->status === 'done' ? 'selected' : '' }} >Done</option>
                        </select>
                    </form>
                @endcan
                @can('edit', $task)
                    <a class="btn btn-warning" href="{{ route('task.edit', $task->id) }}">Edit</a>
                @endcan
                @can('remove', $task)
                    <form class="d-inline-block" method="POST" action="{{ route('task.destroy', $task) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endcan
            </div>
            <div class="card-body" style="white-space: pre-wrap">{{ $task->description  }}</div>
        </div>
    @endforeach

    @can('add', $taskGroup)
        <div class="card m-2">
            <form method="POST" action="{{ route('task.store') }}">
                @csrf
                <input type="hidden" name="task_group_id" value="{{ $taskGroup->id }}" />
                <div class="card-header"><input name="title" type="text"/></div>
                <div class="card-body"><textarea name="description" class="w-100" style="height: 100px;"></textarea></div>
                <button class="btn btn-primary mx-4 my-2" type="submit">Send</button>
            </form>
        </div>
    @endcan
</div>
    
@endsection