<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4"
         x-data="{ submitted: @json(session('submitted', false)) }">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Admin Bounty Dashboard</h1>

        @if(session('success'))
            <div x-show="submitted" x-cloak class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow max-w-7xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <!-- Top row: Add Bounty + Requests -->
        <div class="flex flex-col md:flex-row md:space-x-8">
            <!-- Add New Bounty Form -->
            <div class="md:w-1/2 bg-white p-6 rounded-lg shadow mb-8 md:mb-0"
                 x-show="!submitted">
                <form action="{{ route('admin.requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
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
            </div>

            <!-- Success message & Add Another button -->
            <div x-show="submitted" x-cloak class="md:w-1/2 bg-white p-6 rounded-lg shadow space-y-4 text-center mb-8 md:mb-0">
                <p class="text-lg font-medium text-gray-700">Bounty added successfully!</p>
                <button @click="submitted = false" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                    Add Another
                </button>
            </div>

            <!-- Existing Requests List -->
            <div class="md:w-1/2">
                <h2 class="text-xl font-bold mb-4">User Requests</h2>
                @if($requests->count())
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">Beatmap URL</th>
                                <th class="border border-gray-300 p-2">Difficulty</th>
                                <th class="border border-gray-300 p-2">Reward</th>
                                <th class="border border-gray-300 p-2">Contact Info</th>
                                <th class="border border-gray-300 p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $req)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $req->beatmap_url }}</td>
                                    <td class="border border-gray-300 p-2">{{ $req->difficulty }}</td>
                                    <td class="border border-gray-300 p-2">{{ $req->reward }}</td>
                                    <td class="border border-gray-300 p-2">{{ $req->contact_info }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <form action="{{ route('admin.requests.user.destroy', $req->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this request?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-600">No user requests found.</p>
                @endif
            </div>
        </div>

        <!-- Bottom row: Bounties List -->
        <div class="mt-12">
            <!-- Filter form -->
            <form method="GET" action="{{ route('admin.requests') }}" class="mb-4 flex flex-wrap gap-2">
                <input type="text" name="title" value="{{ request('title') }}"
                       placeholder="Filter by title"
                       class="border border-gray-300 p-2 rounded">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Apply Filter
                </button>
                @if(request()->has('title'))
                    <a href="{{ route('admin.requests') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                        Clear
                    </a>
                @endif
            </form>

            @if($bounties->count())
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
            @else
                <p class="text-center text-gray-600 mt-4">No bounties found matching your filters.</p>
            @endif
        </div>
    </div>
</x-app-layout>
