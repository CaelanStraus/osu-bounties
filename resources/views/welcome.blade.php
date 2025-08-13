<x-app-layout>
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 mb-8 mt-8">
        <main class="flex w-full flex-col-reverse lg:flex-row justify-center items-center">
            <iframe
                style="width:75vw; height:75vh;"
                class="rounded-lg shadow-lg"
                src="https://www.youtube.com/embed/0V5GwzmMhpU"
                allowfullscreen
            ></iframe>
        </main>
    </div>

    <div class="w-full max-w-lg mx-auto mb-8">
        <form method="GET" action="{{ url('/') }}" class="flex">
            <input
                type="text"
                name="name"
                value="{{ request('name') }}"
                placeholder="Search users by name"
                class="flex-grow border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                autocomplete="off"
            />
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-r px-4 py-2"
            >
                Search
            </button>
        </form>
    </div>

    @if(request('name'))
        @if(isset($users) && $users->count())
            <div class="w-full max-w-4xl mx-auto mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($users as $user)
                    <a
                        href="{{ url('/user/' . $user->name) }}"
                        class="block border border-gray-300 rounded p-4 bg-white shadow hover:shadow-md transition-shadow duration-200"
                    >
                        <div class="font-semibold text-lg text-gray-800 truncate">{{ $user->name }}</div>
                        <div class="text-gray-600 truncate">{{ $user->email }}</div>
                        <div class="text-sm text-gray-500">Usertype: {{ $user->usertype }}</div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600 mt-6 max-w-lg mx-auto text-center">
                No users found matching "{{ request('name') }}"
            </p>
        @endif
    @endif
</x-app-layout>