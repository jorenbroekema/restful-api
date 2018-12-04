@extends('layouts.app')

@section('content')
    <h1 class="title">{{ $project->title }}</h1>
    <div class="content">{{ $project->description }}</div>
    @if ($project->tasks->count())
    <div>
        @foreach ($project->tasks as $task)
        <div>
            <form method="POST" action="/tasks/{{ $task->id }}">
                @method('PATCH')
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
    <small>{{ $project->updated_at }}</small>
    <div>
        <a href="/projects/{{ $project->id }}/edit">
            <button type="submit" class="button is-link">Edit</button>
        </a>
    </div>
@endsection