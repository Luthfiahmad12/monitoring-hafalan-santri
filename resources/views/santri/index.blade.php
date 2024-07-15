<x-app-layout>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    @if (session()->has('success'))
                        <div id="alert"
                            class="p-4 mb-4 text-sm text-teal-800 bg-teal-100 border border-teal-200 rounded-lg dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500"
                            role="alert">
                            <span class="font-bold">Success</span>
                            {{ session('success') }}
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
                                                Daftar Santri
                                            </h2>
                                            <p class="text-sm text-gray-600">
                                                Tambah santri, edit,dan hapus.
                                            </p>
                                        </div>

                                        @can('manage santri')
                                            <div>
                                                <div class="inline-flex">

                                                    <a class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                        href="{{ route('santri.create') }}">
                                                        Tambah Santri
                                                    </a>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                    <!-- End Header -->

                                    <!-- Table -->
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3 ps-6 text-start">
                                                    <label for="hs-at-with-checkboxes-main" class="flex">
                                                        <input type="checkbox"
                                                            class="text-blue-600 border-gray-300 rounded shrink-0 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                            id="hs-at-with-checkboxes-main">
                                                        <span class="sr-only">Checkbox</span>
                                                    </label>
                                                </th>

                                                <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                            Santri
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                            Akun
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                            Kelas
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-start">
                                                    <div class="flex items-center gap-x-2">
                                                        <span
                                                            class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                            Alamat
                                                        </span>
                                                    </div>
                                                </th>

                                                <th scope="col" class="px-6 py-3 text-end"></th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-200">
                                            @foreach ($santris as $santri)
                                                <tr>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="py-3 ps-6">
                                                            <label for="hs-at-with-checkboxes-1" class="flex">
                                                                <input type="checkbox"
                                                                    class="text-blue-600 border-gray-300 rounded shrink-0 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                                                    id="hs-at-with-checkboxes-1">
                                                                <span class="sr-only">Checkbox</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                            <div class="flex items-center gap-x-3">
                                                                <div class="grow">
                                                                    <span
                                                                        class="block text-sm font-semibold text-gray-800">{{ $santri->name }}</span>
                                                                    <span class="block text-sm text-gray-500">
                                                                        {{ $santri->no_telp }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="px-6 py-3">
                                                            <span
                                                                class="block text-sm font-semibold text-gray-800">{{ $santri->user->email }}</span>
                                                            <span class="block text-sm text-gray-500">********</span>
                                                        </div>
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="px-6 py-3">
                                                            {{ $santri->kelas }}
                                                    </td>
                                                    <td class="size-px whitespace-nowrap">
                                                        <div class="px-6 py-3">
                                                            {{ $santri->alamat }}
                                                        </div>
                                                    </td>
                                                    @can('manage santri')
                                                        <td class="size-px whitespace-nowrap">
                                                            <div class="px-6 py-1.5 flex justify-end gap-x-2">
                                                                <x-primary-button x-data=""
                                                                    x-on:click="$dispatch('open-modal', 'edit-{{ $santri->id }}')">
                                                                    Edit
                                                                </x-primary-button>
                                                                <x-danger-button x-data=""
                                                                    x-on:click="$dispatch('open-modal', 'confirm-delete-{{ $santri->id }}')">
                                                                    Hapus
                                                                </x-danger-button>
                                                            </div>
                                                        </td>
                                                    @endcan
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- End Table -->
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('partials.daftar_ustadz')
                    <!-- End Card -->
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals_on_santri')

</x-app-layout>
