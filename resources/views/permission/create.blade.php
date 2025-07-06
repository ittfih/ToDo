@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>

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
                    <form method="POST" action="{{ route('permission.store', $id) }}">
                        @csrf

                        <input name="task_group_id" type="hidden" value="{{ $id }}" />

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">user</label>
                            <div class="col-md-6">
                                <select name="user_id">
                                    @foreach ($users as $key => $value)
                                        <option value="{{ $value }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Add task</label>
                            <input name="add_task" class="form-check-input" style="height: 30px;" type="checkbox">
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Edit task</label>
                            <input name="edit_task" class="form-check-input" style="height: 30px;" type="checkbox">
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Remove task</label>
                            <input name="remove_task" class="form-check-input" style="height: 30px;" type="checkbox">
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Change Status</label>
                            <input name="change_status" class="form-check-input" style="height: 30px;" type="checkbox">
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
