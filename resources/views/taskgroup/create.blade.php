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
                    <form method="POST" action="{{ route('taskgroup.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Task group name</label>

                            <div class="col-md-6">
                                <input name="name" type="text" class="form-control" required autofocus>
                            </div>
                                
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Private</label>

                            <input name="private" class="form-check-input" style="height: 30px;" type="checkbox" id="checkDefault">
                                
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
