<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">All Users</h1>

        {{-- Add New User Form --}}
        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New User</h2>
            <form method="POST" action="{{ route('admin.users.store') }}" 
                class="flex flex-wrap gap-3"
                autocomplete="off">
                @csrf
                <input type="text" name="name" placeholder="Name"
                    class="border border-gray-300 p-2 rounded min-w-[150px]" 
                    required autocomplete="new-name">

                <input type="email" name="email" placeholder="Email"
                    class="border border-gray-300 p-2 rounded min-w-[150px]" 
                    required autocomplete="new-email">

                <input type="password" name="password" placeholder="Password"
                    class="border border-gray-300 p-2 rounded min-w-[150px]" 
                    required autocomplete="new-password">

                <select name="usertype" class="border border-gray-300 p-2 rounded" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Create User
                </button>
            </form>
        </div>

        {{-- Filter Form --}}
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
                            <button type="button"
                                onclick="openDeleteModal({{ $user->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow text-xs">
                                Remove
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Confirm Deletion</h2>
            <p class="mb-6 text-gray-600">Are you sure you want to remove this user?</p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" 
                    class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                    Cancel
                </button>
                <form id="deleteUserForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Remove
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(userId) {
            const form = document.getElementById('deleteUserForm');
            form.action = `/admin/users/${userId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
