<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Donasi Saya') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                            <tr class="text-gray-400 text-xs uppercase tracking-wider border-b border-gray-100">

                                <th class="pb-4 font-semibold">Campaign</th>

                                <th class="pb-4 font-semibold">Nominal</th>

                                <th class="pb-4 font-semibold">Tanggal</th>

                                <th class="pb-4 font-semibold">Status</th>

                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-50">
                            @forelse($donations as $donation)
                                <tr>
                                    <td class="py-4">
                                        <a href="{{ route('campaigns.show', $donation->campaign->slug) }}" class="font-bold text-gray-900 hover:text-teal-600">
                                            {{ $donation->campaign->title }}
                                        </a>
                                    </td>

                                    <td class="py-4 font-bold text-teal-600">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 text-sm text-gray-600">
                                        {{ $donation->created_at->format('d M Y H:i') }}
                                    </td>

                                    <td class="py-4">
                                        @if($donation->is_paid)
                                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full bg-green-100 text-green-700">Berhasil</span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-500">
                                        Kamu belum pernah berdonasi.
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
