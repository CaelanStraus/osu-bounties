<x-app-layout>
    <div class="max-w-2xl mx-auto py-8" 
         x-data="{ submitted: @json(session('submitted', false)) }">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Bounty Request</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div x-show="submitted" x-cloak class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Request Form --}}
        <form x-show="!submitted" action="{{ route('bounty-request.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Beatmap URL</label>
                <input type="url" name="beatmap_url" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('beatmap_url') }}" required>
                @error('beatmap_url') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                <input type="text" name="difficulty" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('difficulty') }}" required>
                @error('difficulty') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Required Mods</label>
                <input type="text" name="required_mods" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('required_mods', 'NM') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Donators</label>
                <input type="text" name="donators" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('donators', 'Anonymous') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reward</label>
                <input type="text" name="reward" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('reward') }}" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Info</label>
                <input type="text" name="contact_info" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('contact_info') }}" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    Submit Request
                </button>
            </div>
        </form>

        {{-- Buttons after submission --}}
        <div x-show="submitted" x-cloak class="bg-white p-6 rounded-lg shadow space-y-4 text-center">
            <p class="text-lg font-medium text-gray-700">Bounty submitted successfully!</p>
            <div class="flex justify-center gap-4">
                <button @click="submitted = false" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                    Add Another Bounty
                </button>
                <a href="{{ route('bounties') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                    Go to Bounties
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
