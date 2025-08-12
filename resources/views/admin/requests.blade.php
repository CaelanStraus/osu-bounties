<x-app-layout>
    <div class="max-w-2xl mx-auto py-8" 
         x-data="{ submitted: @json(session('submitted', false)) }">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Add New Bounty</h1>

        @if(session('success'))
            <div x-show="submitted" x-cloak class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <form x-show="!submitted" action="{{ route('admin.requests.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-5">
        @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Beatmap Title</label>
                <input type="text" name="beatmap_title" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Beatmap URL</label>
                <input type="url" name="beatmap_url" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Artist</label>
                <input type="text" name="artist" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                <input type="text" name="difficulty" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Required Mods</label>
                <input type="text" name="required_mods" value="NM" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Beatmap Image</label>
                <input type="file" name="beatmap_image" class="w-full border border-gray-300 p-2 rounded" accept="image/*">
                @error('beatmap_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 p-2 rounded" rows="3"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Donators</label>
                <input type="text" name="donators" value="Anonymous" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reward</label>
                <input type="text" name="reward" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    Add Bounty
                </button>
            </div>
        </form>

        <div x-show="submitted" x-cloak class="bg-white p-6 rounded-lg shadow space-y-4 text-center">
            <p class="text-lg font-medium text-gray-700">Bounty added successfully!</p>
            <button @click="submitted = false" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Add Another
            </button>
        </div>

        @if($bounties->count())
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Existing Bounties</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2">Image</th>
                    <th class="border border-gray-300 p-2">Title</th>
                    <th class="border border-gray-300 p-2">Artist</th>
                    <th class="border border-gray-300 p-2">Difficulty</th>
                    <th class="border border-gray-300 p-2">Reward</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bounties as $bounty)
                    <tr>
                        <td class="border border-gray-300 p-2">
                            @if($bounty->beatmap_image)
                                <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" alt="Beatmap Image" class="w-16 h-16 object-cover">
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2">{{ $bounty->beatmap_title }}</td>
                        <td class="border border-gray-300 p-2">{{ $bounty->artist }}</td>
                        <td class="border border-gray-300 p-2">{{ $bounty->difficulty }}</td>
                        <td class="border border-gray-300 p-2">{{ $bounty->reward }}</td>
                        <td class="border border-gray-300 p-2">
                            <form action="{{ route('admin.requests.destroy', $bounty->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bounty?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
    </div>
</x-app-layout>
