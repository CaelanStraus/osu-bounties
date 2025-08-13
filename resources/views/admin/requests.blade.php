<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4" x-data="{ submitted: @json(session('submitted', false)) }">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Admin Bounty Dashboard</h1>

        @if(session('success'))
            <div x-show="submitted" x-cloak class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow max-w-7xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:space-x-8">
            <div class="md:w-1/2 bg-white p-6 rounded-lg shadow mb-8 md:mb-0" x-show="!submitted">
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

            <div x-show="submitted" x-cloak class="md:w-1/2 bg-white p-6 rounded-lg shadow space-y-4 text-center mb-8 md:mb-0">
                <p class="text-lg font-medium text-gray-700">Bounty added successfully!</p>
                <button @click="submitted = false" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                    Add Another
                </button>
            </div>

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

        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Claim Requests</h2>
            @php
                $unverifiedClaims = $claimedBounties->where('verified', false);
            @endphp

            @if($unverifiedClaims->count())
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2">Bounty Title</th>
                            <th class="border border-gray-300 p-2">Claimed By</th>
                            <th class="border border-gray-300 p-2">Contact Info</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unverifiedClaims as $bounty)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ $bounty->bounty->beatmap_title }}</td>
                                <td class="border border-gray-300 p-2">{{ $bounty->user->name }}</td>
                                <td class="border border-gray-300 p-2">{{ $bounty->contact_info }}</td>
                                <td class="border border-gray-300 p-2 flex space-x-2">
                                    <form action="{{ route('admin.claimed-bounties.destroy', $bounty->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Delete
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.claimed-bounties.verify', $bounty->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                            Verify
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-gray-600">No unverified claimed bounties</p>
            @endif
        </div>

        <div class="mt-12">
            <form method="GET" action="{{ route('admin.requests') }}" class="mb-4 flex flex-wrap gap-2">
                <input type="text" name="title" value="{{ request('title') }}"
                    placeholder="Filter by title"
                    class="border border-gray-300 p-2 rounded flex-grow min-w-[150px]">
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
                <div class="hidden md:grid grid-cols-[auto_1fr_1fr_auto_auto_auto] gap-4 bg-gray-100 p-3 rounded font-semibold text-gray-700">
                    <div>Image</div>
                    <div>Title</div>
                    <div>Artist</div>
                    <div>Difficulty</div>
                    <div>Reward</div>
                    <div>Actions</div>
                </div>

                @foreach($bounties as $bounty)
                    <div class="grid grid-cols-1 md:grid-cols-[auto_1fr_1fr_auto_auto_auto] gap-4 border border-gray-300 rounded p-3 items-center mb-3 bg-white dark:bg-gray-800">
                        <div class="flex justify-center md:justify-start">
                            @if($bounty->beatmap_image)
                                <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" alt="Beatmap Image" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded"></div>
                            @endif
                        </div>

                        <div>
                            <span class="md:hidden font-semibold block mb-1 text-gray-600">Title</span>
                            {{ $bounty->beatmap_title }}
                        </div>

                        <div>
                            <span class="md:hidden font-semibold block mb-1 text-gray-600">Artist</span>
                            {{ $bounty->artist }}
                        </div>

                        <div>
                            <span class="md:hidden font-semibold block mb-1 text-gray-600">Difficulty</span>
                            {{ $bounty->difficulty }}
                        </div>

                        <div>
                            <span class="md:hidden font-semibold block mb-1 text-gray-600">Reward</span>
                            {{ $bounty->reward }}
                        </div>

                        <div class="flex justify-center md:justify-start space-x-2 mt-2 md:mt-0">
                            <a href="{{ route('admin.requests.edit', $bounty->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.requests.destroy', $bounty->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-gray-600 mt-6">No bounties found.</p>
            @endif
        </div>
    </div>
</x-app-layout>