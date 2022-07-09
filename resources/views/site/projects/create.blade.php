@extends('layouts.main')

@section('pageTitle', 'Add Projects')
@section('pageDescription', "Here you can add projects to your list")

@section("content")
<section class="creation">
    <div class="container">
        @foreach($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
        @endforeach
        <form method="POST" action="{{ route('site.projects.store') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Create">
            </div>
        </form>
    </div>
</section>
@endsection
