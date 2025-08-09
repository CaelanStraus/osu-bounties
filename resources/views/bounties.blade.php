<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($bounties as $bounty)
            <article class="p-4">
                <div class="p-4 text-white shadow rounded overflow-hidden h-full flex flex-col">
                    <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" 
                            alt="Beatmap Image" 
                            class="w-full h-48 object-cover rounded">
                    
                    <h2 class="mt-2 text-base font-semibold truncate">{{ $bounty->beatmap_title }}</h2>
                    
                    <dl class="text-sm space-y-1 mt-1">
                        <div><span class="font-medium">Diff:</span> {{ $bounty->difficulty }}</div>
                        <div><span class="font-medium">Mods:</span> {{ $bounty->required_mods }}</div>
                        <div><span class="font-medium">Reward:</span> 
                            <span class="text-green-400 font-semibold">{{ $bounty->reward }}</span>
                        </div>
                    </dl>
                    
                    <p class="text-xs text-gray-400 truncate mt-1">{{ $bounty->description }}</p>
                    
                    <a href="{{ $bounty->beatmap_url }}" target="_blank" 
                        class="px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 mt-auto text-center">
                        View
                    </a>
                </div>
            </article>
        @empty
            <div class="text-center text-gray-500 py-8 col-span-full">
                No bounties available at the moment.
            </div>
        @endforelse
    </div>
</x-app-layout>
