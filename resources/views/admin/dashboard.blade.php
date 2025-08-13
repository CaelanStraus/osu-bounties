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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($users as $user)
                <div class="border border-gray-300 rounded p-4 bg-white shadow-sm flex flex-col justify-between overflow-hidden h-full">
                    <div class="mb-4 break-words">
                        <div class="mb-2">
                            <span class="font-semibold text-gray-600">ID:</span>
                            {{ $user->id }}
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold text-gray-600">Name:</span>
                            <a href="{{ route('user.profile', $user->name) }}" class="text-blue-600 hover:underline">
                                {{ $user->name }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold text-gray-600">Email:</span>
                            {{ $user->email }}
                        </div>
                        <div>
                            <span class="font-semibold text-gray-600">Usertype:</span>
                            {{ $user->usertype }}
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 justify-center mt-auto">
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow text-xs">
                                    {{ $user->usertype === 'admin' ? 'Demote to User' : 'Promote to Admin' }}
                                </button>
                            </form>
                        @endif

                        @if($user->usertype !== 'admin')
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to remove this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-xs">
                                    Remove
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
