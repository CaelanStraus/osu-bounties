<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Bounty</h1>

        <form action="{{ route('admin.requests.update', $bounty->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Beatmap Title</label>
                <input type="text" name="beatmap_title" value="{{ old('beatmap_title', $bounty->beatmap_title) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Beatmap URL</label>
                <input type="url" name="beatmap_url" value="{{ old('beatmap_url', $bounty->beatmap_url) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Artist</label>
                <input type="text" name="artist" value="{{ old('artist', $bounty->artist) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Difficulty</label>
                <input type="text" name="difficulty" value="{{ old('difficulty', $bounty->difficulty) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Required Mods</label>
                <input type="text" name="required_mods" value="{{ old('required_mods', $bounty->required_mods) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $bounty->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Donators</label>
                <input type="text" name="donators" value="{{ old('donators', $bounty->donators) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Reward</label>
                <input type="text" name="reward" value="{{ old('reward', $bounty->reward) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Beatmap Image</label>
                <input type="file" name="beatmap_image" class="w-full border p-2 rounded" accept="image/*">
                @if($bounty->beatmap_image)
                    <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" class="w-20 mt-2">
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium">Completed By</label>
                <input type="text" name="completed_by" value="{{ old('completed_by', $bounty->completed_by) }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Completed At</label>
                <input type="date" name="completed_at" value="{{ old('completed_at', optional($bounty->completed_at)->format('Y-m-d')) }}" class="w-full border p-2 rounded">
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="completed" id="completed" value="1" {{ old('completed', $bounty->completed) ? 'checked' : '' }}>
                <label for="completed" class="text-sm font-medium">Completed</label>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.requests') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</x-app-layout>
