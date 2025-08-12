<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">All Users</h1>

        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 flex flex-wrap gap-2 justify-center">
            <input
                type="text"
                name="name"
                value="{{ request('name') }}"
                placeholder="Filter by name"
                class="border border-gray-300 p-2 rounded min-w-[150px]"
            />
            <input
                type="text"
                name="email"
                value="{{ request('email') }}"
                placeholder="Filter by email"
                class="border border-gray-300 p-2 rounded min-w-[150px]"
            />
            <select name="usertype" class="border border-gray-300 p-2 rounded">
                <option value="">All User Types</option>
                <option value="admin" {{ request('usertype') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('usertype') === 'user' ? 'selected' : '' }}>User</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Apply Filter
            </button>
            @if(request()->hasAny(['name', 'email', 'usertype']) && (request('name') || request('email') || request('usertype')))
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                    Clear
                </a>
            @endif
        </form>

        @if($users->count())
            <div class="hidden md:grid grid-cols-[auto_1fr_1fr_auto_auto] gap-4 bg-gray-100 p-3 rounded font-semibold text-gray-700">
                <div>ID</div>
                <div>Name</div>
                <div>Email</div>
                <div>Usertype</div>
                <div>Actions</div>
            </div>

            @foreach($users as $user)
                <div
                    class="grid grid-cols-1 md:grid-cols-[auto_1fr_1fr_auto_auto] gap-4 border border-gray-300 rounded p-3 items-center mb-3 bg-white"
                >
                    <div>
                        <span class="md:hidden font-semibold block mb-1 text-gray-600">ID</span>
                        {{ $user->id }}
                    </div>

                    <div>
                        <span class="md:hidden font-semibold block mb-1 text-gray-600">Name</span>
                        {{ $user->name }}
                    </div>

                    <div>
                        <span class="md:hidden font-semibold block mb-1 text-gray-600">Email</span>
                        {{ $user->email }}
                    </div>

                    <div>
                        <span class="md:hidden font-semibold block mb-1 text-gray-600">Usertype</span>
                        {{ $user->usertype }}
                    </div>

                    <div class="flex justify-center md:justify-start">
                        @if($user->usertype !== 'admin')
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-xs">
                                    Remove
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-600 mt-4">No users found.</p>
        @endif
    </div>
</x-app-layout>
