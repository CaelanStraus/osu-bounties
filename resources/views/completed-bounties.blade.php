<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($bounties->where('completed', true) as $bounty)
            <article class="p-4">
                <div class="p-4 text-white shadow rounded overflow-hidden h-full flex flex-col">
                    <img src="{{ asset('images/beatmaps/' . $bounty->beatmap_image) }}" 
                         alt="Beatmap Image" 
                         class="w-full h-48 object-cover rounded">
                    
                    <h2 class="mt-2 text-base font-semibold truncate flex justify-between items-center">
                        <span class="flex items-center space-x-3 overflow-hidden">
                            <span class="truncate">{{ $bounty->beatmap_title }}</span>
                            <span class="text-xs text-gray-400 font-normal whitespace-nowrap">by: {{ $bounty->artist }}</span>
                        </span>
                        <span class="text-xs text-gray-400 font-normal whitespace-nowrap"> Completed by: {{ $bounty->completed_by }}</span>    
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
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>
