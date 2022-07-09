@extends('layouts.main')

@section('pageTitle', 'List Tasks')
@section('pageDescription', "Here you can manage your task list")

@section('content')
<section class="filter">
    <div class="container">
        <select project>
            <option value="0">All ({{ count($tasks) }})</option>
            @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }} ({{ count($project->tasks) }})</option>
            @endforeach
        </select>
    </div>
</section>
<section class="list">
    <div class="container">
        <ul sortable>
            @foreach($tasks as $key => $task)
            <li task_id="{{ $task->id }}" class="item-single">
                <div class="flex flex-wrap">
                    <div class="w80">
                        <h4>{{ $task->name }}</h4>
                    </div>
                    <div class="w20 text-right">
                        <a href="{{ route('site.tasks.edit', $task->reference) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a href="{{ route('site.tasks.delete', $task->reference) }}"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection

@section('scripts')

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("[sortable]").sortable({

            update: function(e, ui) {
                let sortingItems = []
                $(this).children().each(function (i, elem) {
                    var li = $(elem)
                    sortingItems.push(li.attr('task_id'))
                });

                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: {
                        sortingItems: sortingItems
                    },
                    url: "{{ route('site.tasks.reorder') }}"
                })
            }
        });

        $('select[project]').on('change', function() {
            $.ajax({
                url: "{{ route('site.tasks.changeProject') }}",
                method:'post',
                dataType:'json',
                data: {
                    project: $('select[project]').val()
                },
                success: data => {
                    if(data['status']) {
                        $('ul[sortable]').html(data['tasks']).hide().fadeIn()
                    }
                }
            })
        })
    });
</script>
@endsection
