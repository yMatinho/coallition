@extends('layouts.main')

@section('pageTitle', 'Add Tasks')
@section('pageDescription', "Here you can add tasks to your list")

@section("content")
<section class="creation">
    <div class="container">
        @foreach($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
        @endforeach
        <form method="POST" action="{{ route('site.tasks.store') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>Project</label>
                <select name="project">
                    <option value="0">None</option>
                    @foreach($projects as $project)
                    <option {{ $project->id == old('project') ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Create">
            </div>
        </form>
    </div>
</section>
@endsection
