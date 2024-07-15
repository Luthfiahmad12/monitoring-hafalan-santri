@foreach ($santris as $santri)
    <x-modal name="confirm-delete-{{ $santri->id }}" focusable>
        <form method="post" action="{{ route('santri.destroy', $santri->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this santri ?') }}
                {{ $santri->name }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('This action cannot be undone.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button type="submit" class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="edit-{{ $santri->id }}" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('santri.update', $santri->id) }}" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                <div class="sm:col-span-3">
                    <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                        Nama
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name') ?? $santri->name" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-account-full-name" class="inline-block text-sm text-gray-800 mt-2.5">
                        Kelas
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                        :value="old('kelas') ?? $santri->kelas" />
                    <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                </div>

                <div class="sm:col-span-3">
                    <div class="inline-block">
                        <label for="af-account-phone" class="inline-block text-sm text-gray-800 mt-2.5">
                            No HP
                        </label>
                    </div>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="no_telp" class="block mt-1 w-full" type="text" name="no_telp"
                        :value="old('no_telp') ?? $santri->no_telp" />
                    <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="alamat" class="inline-block text-sm text-gray-800 mt-2.5">
                        Alamat
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <textarea id="alamat" name="alamat"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                        rows="6">{{ old('alamat') ?? $santri->alamat }} </textarea>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />

                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button type="submit" class="ms-3">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
@endforeach
