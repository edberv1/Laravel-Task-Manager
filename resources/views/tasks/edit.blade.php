@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Task</h1>
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $task->title }}" required class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea name="description" required class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $task->description }}</textarea>
            </div>

            <div>
                <label for="priority" class="block text-lg font-medium text-gray-700">Priority</label>
                <select name="priority" class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
                    <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
                    <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Task</button>
        </form>
    </div>
@endsection
