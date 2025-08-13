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

        @if($user->claimedBounties->count())
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Claimed Bounties</h2>
                <ul class="space-y-4">
                    @foreach($user->claimedBounties as $claimed)
                        <li class="border p-4 rounded shadow-sm">
                            <h3 class="text-xl font-bold">
                                {{ $claimed->bounty->beatmap_title ?? 'Unknown Beatmap' }}
                            </h3>
                            <p>Artist: {{ $claimed->bounty->artist ?? 'Unknown' }}</p>
                            <p>Difficulty: {{ $claimed->bounty->difficulty ?? 'Unknown' }}</p>
                            <p>Reward: {{ $claimed->bounty->reward ?? 'N/A' }}</p>
                            <p>Status: 
                                @if($claimed->verified)
                                    <span class="text-green-600 font-semibold">Verified</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Pending approval</span>
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
