<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Surah {{ $detailSurah['namaLatin'] }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-end justify-end mb-4">
                        <a href="{{ route('surah.index') }}"
                            class="inline-flex items-center px-4 py-3 text-sm font-semibold text-gray-500 border border-gray-200 rounded-lg gap-x-2 hover:border-blue-600 hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none">
                            Kembali
                        </a>
                    </div>
                    <div class="flex flex-col max-w-full divide-y divide-gray-200 text-end">
                        @foreach ($detailSurah['ayat'] as $ayat)
                            <div
                                class="flex flex-col items-end justify-end px-4 py-3 text-gray-800 whitespace-normal gap-y-1">
                                <span class="font-semibold text-md">
                                    {{ $ayat['teksArab'] }}
                                </span>
                                <span class="block text-sm text-gray-500">
                                    {{ $ayat['teksIndonesia'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
