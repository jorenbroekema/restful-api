@extends('layouts.app')

@section('content')
    <h1 class="title">{{ $project->title }}</h1>
    <div class="content">{{ $project->description }}</div>
    @if ($project->tasks->count())
    <div class="box">
        @foreach ($project->tasks as $task)
        <div>
            <form method="POST" action="/tasks/{{ $task->id }}">
                @method('PATCH')
                @if ($task->completed)
                    @method('DELETE')
                @endif

                @csrf
                <label class="checkbox {{ $task->completed ? 'is-complete' : '' }}" for="completed">
                    <input
                        type="checkbox"
                        name="completed"
                        onchange="this.form.submit()"
                        {{ $task->completed ? 'checked' : '' }}
                    >
                    {{ $task->description }}
                </label>
            </form>
        </div>
        @endforeach
    </div>
    @endif
    @if ($project->owner_id == auth()->id())
    <form method="POST" action="/projects/{{ $project->id }}/tasks" class="box">
        @csrf
        <div class="field">
            <label class="label" for="description">New Task</label>
            <div class="control">
                <input type="text" class="input" name="description" placeholder="New Task">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Task</button>
            </div>
        </div>

    </form>
    @endif
    <small>{{ $project->updated_at }}</small>
    @if ($project->owner_id == auth()->id())
    <div>
        <a href="/projects/{{ $project->id }}/edit">
            <button type="submit" class="button is-link">Edit</button>
        </a>
    </div>
    @endif
@endsection
