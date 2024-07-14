<x-app-layout>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="items-center min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                    Nama Surah</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                    Jenis Ayat</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                    Jumlah Ayat</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($DaftarSurah as $surah)
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                                        {{ $surah['namaLatin'] }} ({{ $surah['nama'] }})
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                        {{ $surah['tempatTurun'] }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                        {{ $surah['jumlahAyat'] }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                        <a href="{{ route('surah.show', $surah['nomor']) }}"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <div class="px-4 py-2">
                                        {{ $DaftarSurah->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('partials.modals_on_santri') --}}

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('alert');
                setTimeout(() => {
                    alert.style.transition = 'opacity 1s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 1000);
                }, 3000); // Menghilangkan alert setelah 3 detik
            });
        </script>
    @endpush
</x-app-layout>
