@extends('layouts.main')

@section('pageTitle', 'Edit '.$project->name)
@section('pageDescription', "Here you can edit ".$project->name)

@section("content")
<section class="creation">
    <div class="container">
        @foreach($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
        @endforeach
        <form method="POST" action="{{ route('site.projects.update') }}">
            @csrf
            <input type="hidden" name="reference" value="{{ $project->reference }}">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}">
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Edit">
            </div>
        </form>
    </div>
</section>
@endsection
