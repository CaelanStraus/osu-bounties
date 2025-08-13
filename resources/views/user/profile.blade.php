<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">
        <div class="flex flex-col items-center">
            @if($user->profile_picture)
                <img src="{{ asset('images/profiles/' . $user->profile_picture) }}" 
                     alt="{{ $user->name }}'s Profile Picture" 
                     class="w-32 h-32 rounded-full mb-4 object-cover">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center mb-4">
                    <span class="text-gray-600 text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>

            @if($user->about_me)
                <p class="text-gray-700 text-center mb-2">{{ $user->about_me }}</p>
            @endif

            @if($user->dob)
                <p class="text-gray-500">Date of Birth: {{ \Carbon\Carbon::parse($user->dob)->format('F j, Y') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>
