<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <a href="{{ route('landing') }}" class="hover:text-teal-600">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-medium">Campaign Detail</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8 border border-gray-100">
                        <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/' . $campaign->image_path) }}"
                             alt="{{ $campaign->title }}"
                             class="w-full h-96 object-cover">

                        <div class="p-8">
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $campaign->title }}</h1>

                            <div class="flex items-center space-x-4 mb-8 pb-8 border-b border-gray-100">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($campaign->user->name) }}&color=0D9488&background=CCFBF1" alt="">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $campaign->user->name }}</p>
                                    <p class="text-xs text-gray-500">Verified Fundraiser</p>
                                </div>
                            </div>

                            <div class="prose prose-teal max-w-none text-gray-700">
                                {!! nl2br(e($campaign->description)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Recent Donations -->
                    <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Recent Donations ({{ $campaign->donations->count() }})</h2>

                        <div class="space-y-6">
                            @forelse($recentDonations as $donation)
                                <div class="flex space-x-4 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold">
                                            {{ substr($donation->donor_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start">
                                            <h4 class="font-bold text-gray-900">{{ $donation->donor_name }}</h4>
                                            <span class="text-sm font-extrabold text-teal-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                        </div>
                                        @if($donation->comment)
                                            <p class="text-sm text-gray-600 mt-1 italic italic italic">"{{ $donation->comment }}"</p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-2">{{ $donation->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Be the first to donate!</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sticky Sidebar -->
                <div class="lg:w-1/3">
                    <div class="sticky top-8 space-y-6">
                        <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-teal-600">
                            <div class="mb-6">
                                <span class="text-sm text-gray-500 uppercase font-bold">Raised</span>
                                <div class="flex items-baseline space-x-1 mt-1">
                                    <span class="text-3xl font-extrabold text-teal-600">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-400">/ Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <x-progress-bar :percentage="$campaign->progress_percentage" />

                            <div class="grid grid-cols-2 gap-4 mt-8 mb-8 text-center border-y border-gray-50 py-4">
                                <div>
                                    <p class="text-lg font-bold text-gray-900">{{ $campaign->donations->count() }}</p>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Donors</p>
                                </div>
                                <div class="border-l border-gray-50">
                                    <p class="text-lg font-bold text-gray-900">{{ $campaign->deadline->isPast() ? 0 : $campaign->deadline->diffInDays(now()) }}</p>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Days left</p>
                                </div>
                            </div>

                            <div x-data="{ open: false }">
                                <button @click="open = true"
                                        {{ $campaign->deadline->isPast() ? 'disabled' : '' }}
                                        class="w-full bg-teal-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-teal-700 transition flex items-center justify-center space-x-2 disabled:bg-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $campaign->deadline->isPast() ? 'Fundraising Closed' : 'Donate Now' }}</span>
                                </button>

                                <!-- Donation Modal -->
                                <div x-show="open"
                                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
                                     x-cloak>
                                    <div @click.away="open = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden animate__animated animate__zoomIn">
                                        <div class="bg-teal-600 px-6 py-4 flex justify-between items-center">
                                            <h3 class="text-lg font-bold text-white">Make a Donation</h3>
                                            <button @click="open = false" class="text-white hover:text-teal-200">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <form action="{{ route('donations.store', $campaign->id) }}" method="POST" class="p-6">
                                            @csrf
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                                                    <input type="text" name="donor_name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required
                                                           class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                                    <input type="email" name="donor_email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required
                                                           class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount (IDR)</label>
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                                        </div>
                                                        <input type="number" name="amount" required min="1000" step="1"
                                                               class="w-full rounded-lg border-gray-300 pl-10 focus:border-teal-500 focus:ring-teal-500"
                                                               placeholder="0">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Message (Optional)</label>
                                                    <textarea name="comment" rows="3"
                                                              class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                                                              placeholder="Add a word of encouragement..."></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-8">
                                                <button type="submit" class="w-full bg-teal-600 text-white font-bold py-3 rounded-lg shadow-md hover:bg-teal-700 transition">
                                                    Complete Donation
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="bg-teal-50 rounded-2xl p-6 border border-teal-100">
                            <h4 class="font-bold text-teal-900 mb-2">Secure Giving</h4>
                            <p class="text-sm text-teal-700">Your donation is securely processed and goes directly to the fundraiser. Thank you for your kindness!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
