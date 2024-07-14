<x-modal name="create-data" :show="$errors->isNotEmpty()" focusable>
    <div class="p-4 bg-white shadow rounded-xl sm:p-7">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800">
                Tambah Data Hafalan
            </h2>
        </div>

        <form action="{{ route('hafalan.store') }}" method="POST">
            @csrf
            @method('POST')
            <!-- Grid -->
            <div class="grid gap-2 sm:grid-cols-12 sm:gap-6">

                <div class="sm:col-span-3">
                    <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                        Nama Santri
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <select name="santri_id"
                        class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option selected="">Open this select menu</option>
                        @foreach ($santris as $santri)
                            <option value="{{ $santri->id }}">{{ $santri->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-account-email" class="inline-block text-sm text-gray-800 mt-2.5">
                        Nama Surah
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <select name="nama_surah"
                        class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option selected="">Open this select menu</option>
                        @foreach ($daftarSurah as $item)
                            <option value="{{ $item['namaLatin'] }}">
                                {{ $item['namaLatin'] }} ({{ $item['nama'] }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <!-- End Grid -->

            <div class="flex justify-end mt-5 gap-x-2">
                <x-danger-button type="button" x-on:click="$dispatch('close')">
                    Kembali
                </x-danger-button>
                <x-primary-button>
                    Submit
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@foreach ($hafalans as $hafalan)
    <x-modal name="delete-{{ $hafalan->id }}" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('hafalan.destroy', $hafalan->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this hafalan ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('This action cannot be undone.') }}
            </p>

            <div class="flex justify-end mt-6">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button type="submit" class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="show-{{ $hafalan->id }}" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">

            <!-- Timeline -->
            <div>
                <!-- Item -->
                @forelse ($hafalan->comments as $comment)
                    <div class="flex gap-x-3">
                        <!-- Left Content -->
                        <div class="w-16 text-end">
                            <span class="text-xs text-gray-500">
                                {{ $comment->created_at->isoFormat('dddd, D MMMM Y H:mm') }} WIB
                            </span>
                        </div>
                        <!-- End Left Content -->

                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200">
                            <div class="relative z-10 flex items-center justify-center size-7">
                                <div class="bg-gray-400 rounded-full size-2"></div>
                            </div>
                        </div>
                        <!-- End Icon -->

                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8">
                            <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                {{ $comment->comment }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                Finally! You can check it out here.
                            </p>
                            <button type="button"
                                class="inline-flex items-center p-1 mt-1 text-xs text-gray-500 border border-transparent rounded-lg -ms-1 gap-x-2 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700">
                                <img class="flex-shrink-0 rounded-full size-4"
                                    src="https://images.unsplash.com/photo-1659482633369-9fe69af50bfb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80"
                                    alt="Image Description">
                                {{ $comment->user->name }}
                            </button>
                        </div>
                        <!-- End Right Content -->
                    </div>
                @empty
                    <div class="flex justify-center">
                        <p class="text-gray-600 text-md dark:text-neutral-400">
                            Belum Ada Catatan
                        </p>
                    </div>
                @endforelse
                <!-- End Item -->
            </div>
            <!-- End Timeline -->
            @if ($hafalan->status !== 1)
                <form action="{{ route('hafalan.update', $hafalan->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mt-8">
                        <x-input-label for="catatan" :value="__('Tambah Catatan')" />
                        <x-text-input id="catatan" class="block w-full mt-1" type="text" name="comment"
                            :value="old('catatan')" />
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>
                    <div class="mt-3">
                        <div class="flex text-medium">
                            <input type="checkbox" name="status" value="1"
                                class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                id="hs-default-checkbox">
                            <label for="hs-default-checkbox"
                                class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Selesai</label>
                        </div>
                    </div>
                    <div class="flex justify-end mt-3 gap-x-2">
                        <x-danger-button type="button" x-on:click="$dispatch('close')">
                            Close
                        </x-danger-button>
                        <x-primary-button>
                            Submmit
                        </x-primary-button>
                    </div>
                </form>
            @endif
        </div>
    </x-modal>
@endforeach
