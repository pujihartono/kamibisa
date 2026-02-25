@props(['campaign'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-
gray-100 transition hover:shadow-md h-full flex flex-col">

    <!-- Gambar Campaign -->
    <div class="relative h-48 flex-shrink-0">
        <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/' . $campaign->image_path) }}"
             alt="{{ $campaign->title }}"
             class="w-full h-full object-cover">
        <!-- Badge Status (jika selesai) -->
        @if($campaign->status === 'finished')

            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <span class="bg-gray-800 text-white px-3 py-1 rounded-full
                text-sm font-bold tracking-wider uppercase">
                    Finished
                </span>
            </div>
        @endif
    </div>
    <!-- Konten Card -->
    <div class="p-5 flex flex-col flex-grow">
        <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">
            <a href="{{ route('campaigns.show', $campaign->slug) }}"
               class="hover:text-teal-600 transition">
                {{ $campaign->title }}
            </a>
        </h3>
        <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">
            {{ $campaign->short_description }}
        </p>
        <!-- Panggil Component Progress Bar -->
        <x-progress-bar :percentage="$campaign->progress_percentage" />
        <!-- Informasi Donasi & Target -->

        <div class="flex justify-between items-center mt-4">
            <div>

                <p class="text-xs text-gray-500 uppercase font-semibold">Terkumpul</p>

                <p class="text-sm font-bold text-teal-700">Rp {{number_format($campaign->current_amount, 0, ',', '.') }}</p>
            </div>
            <div class="text-right">

                <p class="text-xs text-gray-500 uppercase font-semibold">Target</p>

                <p class="text-sm font-bold text-gray-800">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
            </div>
        </div>
        <!-- Footer Card: Author & Waktu -->
        <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center">

            <span class="text-xs text-gray-500">Oleh <span class="font-medium text-gray-900">{{ $campaign->user->name }}</span></span>

            <span class="text-xs font-semibold {{ $campaign->deadline->isPast() ? 'text-red-500' : 'text-orange-500' }}">
                {{ $campaign->deadline->isPast() ? 'Berakhir' : $campaign->deadline->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
