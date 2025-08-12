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
                <input type="url" name="beatmap_url" placeholder="https://osu.ppy.sh/beatmapsets/41823#osu/131891" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('beatmap_url') }}" required>
                @error('beatmap_url') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                <input type="text" name="difficulty" placeholder="WHO'S AFRAID OF THE BIG BLACK" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('difficulty') }}" required>
                @error('difficulty') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Required Mods</label>
                <input type="text" name="required_mods" placeholder="DTHDHR, NM, any" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('required_mods') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" placeholder="DT FC, good luck lmao :)" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Donators</label>
                <input type="text" name="donators" placeholder="Anonymous, BMC" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('donators') }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Reward</label>
                <input type="text" name="reward" placeholder="$100, 2 months of supporter, a signed T-shirt" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('reward') }}" required>
            </div>

            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                Contact Info
                <span class="relative group cursor-help">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/>
                    </svg>
                    <div class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-700 rounded opacity-0 group-hover:opacity-100 pointer-events-none whitespace-nowrap">
                            Please put your Discord handle or your email so we can contact you about your request.
                    </div>
                </span>
            </label>
            <input type="text" name="contact_info" placeholder="john.smith@mail.com" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('contact_info') }}" required>
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
