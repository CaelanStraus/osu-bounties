<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-4">{{ $user->name }}'s Profile</h1>
        <p class="text-gray-700">User ID: {{ $user->id }}</p>
    </div>
</x-app-layout>
