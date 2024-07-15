<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    @if (session()->has('success'))
                        <div id="alert"
                            class="p-4 mb-4 text-sm text-teal-800 bg-teal-100 border border-teal-200 rounded-lg"
                            role="alert">
                            <span class="font-bold mr-1">Success</span>
                            {{ session('success') }}
                        </div>
                    @elseif (session()->has('warning'))
                        <div id="alert">
                            <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-lg"
                                role="alert">
                                <span class="font-bold mr-1">Warning</span>
                                {{ session('warning') }}
                            </div>
                        </div>
                    @endif
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
                                                Daftar Hafalan Santri
                                            </h2>
                                            <p class="text-sm text-gray-600">
                                                Tambah hafalan santri, edit,dan hapus.
                                            </p>
                                        </div>

                                        @can('manage hafalan')
                                            <div>
                                                <div class="inline-flex">
                                                    <x-primary-button x-data=""
                                                        x-on:click="$dispatch('open-modal', 'create-data')">
                                                        Tambah Hafalan Santri
                                                        </x-primary->
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                    <!-- End Header -->

                                    <!-- Table -->
                                    <table class="items-center min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">
                                                    Nama Santri</th>
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
                                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($hafalans as $hafalan)
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                                        {{ $hafalan->santri->name }}
                                                    </td>
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
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-end whitespace-nowrap">
                                                        <div class="px-6 py-1.5 flex justify-end gap-x-2">
                                                            @canany(['add comment', 'manage hafalan'])
                                                                <x-primary-button x-data=""
                                                                    x-data=""
                                                                    x-on:click="$dispatch('open-modal', 'show-{{ $hafalan->id }}')">
                                                                    Detail
                                                                </x-primary-button>
                                                            @endcanany
                                                            @can('manage hafalan')
                                                                <x-danger-button type="button" x-data=""
                                                                    x-on:click="$dispatch('open-modal', 'delete-{{ $hafalan->id }}')">
                                                                    Hapus Hafalan
                                                                </x-danger-button>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals_on_hafalan')
</x-app-layout>
