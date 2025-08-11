<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($bounties->where('completed', false) as $bounty)
            <article class="p-4">
                <div class="p-4 text-white shadow rounded overflow-hidden h-full flex flex-col">
                    <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" 
                         alt="Beatmap Image" 
                         class="w-full h-48 object-cover rounded">
                    
                    <h2 class="mt-2 text-base font-semibold truncate">
                        <span class="flex items-center space-x-3 overflow-hidden">
                            <span class="truncate">{{ $bounty->beatmap_title }}</span>
                            <span class="text-xs text-gray-400 font-normal whitespace-nowrap">
                                by: {{ $bounty->artist }}
                            </span>
                        </span>
                    </h2>
                    
                    <dl class="text-sm space-y-1 mt-1">
                        <div><span class="font-medium">Diff:</span> {{ $bounty->difficulty }}</div>
                        <div><span class="font-medium">Mods:</span> {{ $bounty->required_mods }}</div>
                        <div><span class="font-medium">Reward:</span> 
                            <span class="text-green-400 font-semibold">{{ $bounty->reward }}</span>
                        </div>
                        <div><span class="font-medium">Donators:</span> {{ $bounty->donators }}</div>
                    </dl>
                    
                    <p class="text-xs text-gray-400 truncate mt-1">{{ $bounty->description }}</p>
                    
                    <div class="flex gap-2 mt-auto">
                        <a href="{{ $bounty->beatmap_url }}" target="_blank" 
                           class="flex-grow px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 text-center">
                            View
                        </a>
                        <a href="{{ $bounty->beatmap_url }}" target="_blank"
                           class="flex-grow px-2 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600 text-center">
                            Claim
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="text-center text-gray-500 py-8 col-span-full">
                No bounties available at the moment.
            </div>
        @endforelse

        <article class="p-4">
            <a href="{{ url('bounty-request') }}" 
            class="p-4 text-white shadow rounded overflow-hidden h-full flex flex-col items-center justify-center border-2 border-dotted border-gray-400 hover:border-blue-500 hover:text-blue-500 transition-colors">
                <div class="flex items-center justify-center w-16 h-16 border-2 border-dotted border-gray-400 rounded-full">
                    <span class="text-3xl font-bold">+</span>
                </div>
                <span class="mt-4 font-medium">Request New Bounty</span>
            </a>
        </article>
    </div>
</x-app-layout>
