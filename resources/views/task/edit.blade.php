@extends('layouts.app')

@section('content')
<div class="container">
    <a  href="{{ route('taskgroup.show', $task->TaskGroup->id) }}">Return to {{ $task->TaskGroup->name }}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ route('task.update', $task->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="card-header"><input name="title" type="text" value="{{$task->title}}" /></div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row mb-3">
                            <textarea name="description" style="height: 300px;">{{ $task->description }}</textarea>
                                
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
