@can('manage santri')
    <div class="flex flex-col mt-12">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                    <!-- Header -->
                    <div class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                Daftar Ustadz
                            </h2>
                            <p class="text-sm text-gray-600">
                                Tambah ustadz, edit,dan hapus.
                            </p>
                        </div>
                        <div>
                            <div class="inline-flex">
                                <x-primary-button x-data=""
                                    x-on:click="$dispatch('open-modal', 'tambah-ustadz')">
                                    Tambah Ustadz
                                </x-primary-button>
                            </div>
                        </div>
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
                                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                            Nama Ustadz
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                            Akun
                                        </span>
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $user)
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
                                                        class="block text-sm font-semibold text-gray-800">{{ $user->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800">{{ $user->email }}</span>
                                            <span class="block text-sm text-gray-500">********</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5 flex justify-end gap-x-2">
                                            <x-primary-button x-data=""
                                                x-on:click="$dispatch('open-modal', 'ustadz-{{ $user->id }}')">
                                                Edit
                                            </x-primary-button>
                                            <x-danger-button x-data=""
                                                x-on:click="$dispatch('open-modal', 'delete-{{ $user->id }}')">
                                                Hapus
                                            </x-danger-button>
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
    @include('partials.modals_on_daftar_ustadz')
@endcan
