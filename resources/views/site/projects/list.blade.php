@extends('layouts.main')

@section('pageTitle', 'List Projects')
@section('pageDescription', "Here you can manage your project list")

@section('content')
<section class="list">
    <div class="container">
        <ul sortable>
            @foreach($projects as $project)
            <li class="item-single">
                <div class="flex flex-wrap">
                    <div class="w80">
                        <h4>{{ $project->name }}</h4>
                    </div>
                    <div class="w20 text-right">
                        <a href="{{ route('site.projects.edit', $project->reference) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a href="{{ route('site.projects.delete', $project->reference) }}"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
