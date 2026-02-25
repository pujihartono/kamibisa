<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Campaigns') }}
            </h2>
            <a href="{{ route('dashboard.campaigns.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-900 transition ease-in-out duration-150">
                New Campaign
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                            <tr class="text-gray-400 text-xs uppercase tracking-wider border-b border-gray-100">
                                <th class="pb-4 font-semibold">Campaign</th>
                                <th class="pb-4 font-semibold">Goal</th>
                                <th class="pb-4 font-semibold">Raised</th>
                                <th class="pb-4 font-semibold text-center">Progress</th>
                                <th class="pb-4 font-semibold">Status</th>
                                <th class="pb-4 font-semibold text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                            @forelse($campaigns as $campaign)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <div class="h-12 w-12 flex-shrink-0">
                                                <img class="h-12 w-12 rounded-lg object-cover"
                                                     src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/' . $campaign->image_path) }}"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 leading-tight">{{ $campaign->title }}</div>
                                                <div class="text-xs text-gray-400 mt-1">Ends {{ $campaign->deadline->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 font-medium text-sm text-gray-900">
                                        Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 font-bold text-sm text-teal-600">
                                        Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 w-32">
                                        <div class="flex flex-col items-center">
                                            <x-progress-bar :percentage="$campaign->progress_percentage" />
                                            <span class="text-[10px] text-gray-400 mt-1">{{ $campaign->progress_percentage }}%</span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        @if($campaign->status === 'active')
                                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full bg-blue-100 text-blue-700 border border-blue-200">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full bg-red-100 text-red-500 border border-red-200">Finished</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('campaigns.show', $campaign->slug) }}" class="p-2 text-gray-400 hover:text-teal-600 transition" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('dashboard.campaigns.edit', $campaign->id) }}" class="p-2 text-gray-400 hover:text-blue-600 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('dashboard.campaigns.destroy', $campaign->id) }}" method="POST" onsubmit="return confirm('Delete this campaign?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <p class="text-gray-500 mb-4">You haven't created any campaigns yet.</p>
                                        <a href="{{ route('dashboard.campaigns.create') }}" class="text-teal-600 font-bold hover:underline">Start your first campaign</a>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
