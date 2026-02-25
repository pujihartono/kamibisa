<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Explore Campaigns') }}
            </h2>
            <a href="{{ route('dashboard.campaigns.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Start Fundraising') }}
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-teal-700 rounded-3xl overflow-hidden shadow-xl mb-12">
                <div class="px-8 py-16 md:px-16 flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 text-white">
                        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                            Small Actions, <br>Big Impact.
                        </h1>
                        <p class="text-lg text-teal-50 mb-8 max-w-md">
                            Join thousands of donors making the world a better place. Start a campaign or support a cause you believe in.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#featured" class="bg-white text-teal-700 px-8 py-3 rounded-full font-bold hover:bg-teal-50 transition">
                                Start Donating
                            </a>
                            <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-teal-700 transition">
                                Join Us
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2 mt-12 md:mt-0">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="Charity"
                             class="rounded-2xl shadow-2xl transform md:rotate-3 rotate-0">
                    </div>
                </div>
            </div>
            <!-- Featured Campaigns -->
            <div id="featured" class="mb-12">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Campaign
                            Pilihan</h2>
                        <p class="text-gray-600">Bantu mereka yang membutuhkan uluran
                            tangan Anda.</p>
                    </div>

                    <a href="#" class="text-teal-600 font-semibold hover:text-teal-800">Lihat Semua &rarr;</a>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($featuredCampaigns as $campaign)
                        <!-- Menggunakan Component yang sudah dibuat -->
                        <x-campaign-card :campaign="$campaign" />
                    @empty

                        <div class="col-span-full text-center py-12 bg-gray-50 rounded-lg">

                            <p class="text-gray-500">Belum ada campaign aktif saat ini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
