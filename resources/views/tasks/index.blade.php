@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @if(session('success'))
            <div id="success-message" class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div id="error-message" class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6">Your Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="inline-block mb-6 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Create New Task</a>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-6" id="filter-form">
            <label for="priority" class="block text-lg font-medium text-gray-700">Filter by Priority:</label>
            <select name="priority" id="priority" class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="document.getElementById('filter-form').submit();">
                <option value="">All</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>High</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>Low</option>
            </select>
        </form>

        <div class="grid grid-cols-2 gap-4">
            <!-- Not Completed Tasks -->
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-red-700">Not Completed</h2>
                @if($tasks->where('status', false)->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach($tasks->where('status', false) as $task)
                            <li class="p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md overflow-hidden">
                                <div class="flex justify-between items-start">
                                    <span class="text-sm text-gray-500">Priority: {{ $task->priority == 1 ? 'High' : ($task->priority == 2 ? 'Medium' : 'Low') }}</span>
                                    <form action="{{ route('tasks.toggleCompletion', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-blue-500 hover:text-blue-700">Mark as Completed</button>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    <strong class="text-xl font-semibold text-black truncate">{{ $task->title }}</strong>
                                    <p class="mt-2 text-gray-700 overflow-hidden overflow-ellipsis">{{ $task->description }}</p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No tasks found.</p>
                @endif
            </div>

            <!-- Completed Tasks -->
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-green-500">Completed</h2>
                @if($tasks->where('status', true)->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach($tasks->where('status', true) as $task)
                            <li class="p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md overflow-hidden">
                                <div class="flex justify-between items-start">
                                    <span class="text-sm text-gray-500">Priority: {{ $task->priority == 1 ? 'High' : ($task->priority == 2 ? 'Medium' : 'Low') }}</span>
                                    <form action="{{ route('tasks.toggleCompletion', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-blue-500 hover:text-blue-700">Mark as Not Completed</button>
                                    </form>
                                </div>
                                <div class="mt-2">
                                    <strong class="text-xl font-semibold text-black truncate">{{ $task->title }}</strong>
                                    <p class="mt-2 text-gray-700 overflow-hidden overflow-ellipsis">{{ $task->description }}</p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No tasks found.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Function to hide the message after 5 seconds
        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000);
    </script>
@endsection