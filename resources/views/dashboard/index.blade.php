<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border-b-4 border-teal-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Campaigns</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $campaignsCount }}</p>
                        </div>
                        <div class="p-3 bg-teal-50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border-b-4 border-teal-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Donations Received</p>
                            <p class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($totalDonationsReceived, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-teal-50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border-b-4 border-teal-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Contributed</p>
                            <p class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($totalContributed, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 bg-teal-50 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('dashboard.campaigns.create') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-teal-50 transition border border-gray-100 group">
                            <div class="p-3 bg-white rounded-lg shadow-sm group-hover:bg-teal-600 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-bold text-gray-900">Start New Campaign</p>
                                <p class="text-sm text-gray-500">Share your cause with the world</p>
                            </div>
                        </a>

                        <a href="{{ route('landing') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-teal-50 transition border border-gray-100 group">
                            <div class="p-3 bg-white rounded-lg shadow-sm group-hover:bg-teal-600 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-bold text-gray-900">Explore Campaigns</p>
                                <p class="text-sm text-gray-500">Find causes to support</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
