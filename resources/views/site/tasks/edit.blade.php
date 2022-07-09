@extends('layouts.main')

@section('pageTitle', 'Edit Tasks')
@section('pageDescription', "Here you can edit tasks to your list")

@section("content")
<section class="creation">
    <div class="container">
        @foreach($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
        @endforeach
        <form method="POST" action="{{ route('site.tasks.update') }}">
            @csrf
            <input type="hidden" name="reference" value="{{ $task->reference }}">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $task->name) }}">
            </div>
            <div class="form-group">
                <label>Project</label>
                <select name="project">
                    <option value="0">None</option>
                    @foreach($projects as $project)
                    <option {{ $project->id == old('project', $task->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Edit">
            </div>
        </form>
    </div>
</section>
@endsection
