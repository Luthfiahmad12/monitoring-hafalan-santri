<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('laporan') }}" method="get">
                        <div class="sm:col-span-3">
                            <label for="surah" class="inline-block text-sm text-gray-800 mt-2.5">
                                Nama Santri
                            </label>
                        </div>
                        <!-- End Col -->
                        <div class="sm:col-span-9">
                            <select name="santri_id"
                                class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                <option value="" selected>Pilih Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}">
                                        {{ $santri->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-center mt-5">
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                @if (isset($hafalans) && $hafalans->count() > 0)
                    <div id="cetak" class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                        <!-- Card -->
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                                        <!-- Header -->
                                        <div
                                            class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center">
                                            <div>
                                                <h2 class="text-xl font-semibold text-gray-800">
                                                    Daftar hafalan santri {{ $hafalans[0]->santri->name }}
                                                </h2>
                                            </div>
                                        </div>
                                        <!-- End Header -->

                                        <!-- Table -->
                                        <table class="items-center min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                        Nama Surah</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                        Status</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                        Nilai</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach ($hafalans as $hafalan)
                                                    <tr>
                                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                            {{ $hafalan->surah->nama_surah }}
                                                        </td>
                                                        <td class="px-6 py-4 text-md text-gray-800 whitespace-nowrap">
                                                            <span
                                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-sm font-medium border {{ $hafalan->status == 1 ? 'border-green-500 text-green-500' : 'border-red-500 text-red-500' }}">
                                                                {{ $hafalan->status == 1 ? 'Selesai' : 'Belum Selesai' }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                                            {{ $hafalan->penilaian ?? 'Belum Dinilai' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- End Table -->
                                    </div>
                                </div>
                                <div id="print-button" class="flex justify-center mt-4">
                                    <x-secondary-button onclick="printLaporan()"
                                        class="hover:bg-gray-500 hover:text-white">
                                        cetak laporan
                                    </x-secondary-button>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                @else
                    <span class="flex justify-center text-md font-semibold mb-4 text-gray-800 items-center">Data tidak
                        ditemukan</span>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function printLaporan() {
                // Clone the content to be printed
                var printContents = document.getElementById('cetak').cloneNode(true);
                var originalContents = document.body.innerHTML;

                // Remove the print button from the cloned content
                var printButton = printContents.querySelector('#print-button');
                printButton.parentNode.removeChild(printButton);

                // Create a new div to contain the content
                var printDiv = document.createElement('div');
                printDiv.id = 'print-area';
                printDiv.style.visibility = 'hidden';
                printDiv.appendChild(printContents);
                document.body.appendChild(printDiv);

                // Print the new div content
                var printArea = document.getElementById('print-area').innerHTML;
                document.body.innerHTML = printArea;
                window.print();

                // Restore the original content
                document.body.innerHTML = originalContents;
                location.reload();
            }
        </script>
    @endpush

</x-app-layout>
