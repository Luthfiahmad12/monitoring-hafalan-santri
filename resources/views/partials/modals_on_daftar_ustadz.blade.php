<x-modal name="tambah-ustadz" :show="$errors->CreateData->isNotEmpty()" focusable>
    <div class="bg-white rounded-xl shadow p-4 sm:p-7">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800">
                Tambah Data Ustadz
            </h2>
        </div>

        <form action="{{ route('ustadz.store') }}" method="POST">
            @csrf
            @method('POST')
            <!-- Grid -->
            <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                <div class="sm:col-span-3">
                    <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                        Nama
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" autofocus />
                    <x-input-error :messages="$errors->CreateData->get('name')" class="mt-2" />
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-account-email" class="inline-block text-sm text-gray-800 mt-2.5">
                        Email
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" />
                    <x-input-error :messages="$errors->CreateData->get('email')" class="mt-2" />
                </div>
                <!-- End Col -->

                <div class="sm:col-span-3">
                    <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                        Password
                    </label>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9">
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        :value="old('password')" />
                    <x-input-error :messages="$errors->CreateData->get('password')" class="mt-2" />
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->

            <div class="mt-5 flex justify-end gap-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">
                    kembali
                </x-secondary-button>
                <x-primary-button>
                    Submit
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>

@foreach ($users as $user)
    <x-modal name="delete-{{ $user->id }}" focusable>
        <form method="post" action="{{ route('destroyUstadz', $user->id) }}" class="p-6">
            @csrf
            {{-- @method('delete') --}}

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this santri ?') }}
                {{ $user->name }}
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

    <x-modal name="ustadz-{{ $user->id }}" :show="$errors->errorBag->isNotEmpty()" focusable>
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">
                    Data Ustadz {{ $user->name }}
                </h2>
            </div>

            <form action="{{ route('updateUstadz', $user->id) }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                    <div class="sm:col-span-3">
                        <label for="name" class="inline-block text-sm text-gray-800 mt-2.5">
                            Nama
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name') ?? $user->name" autofocus />
                        <x-input-error :messages="$errors->updateData->get('name')" class="mt-2" />
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-email" class="inline-block text-sm text-gray-800 mt-2.5">
                            Email
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email') ?? $user->email" />
                        <x-input-error :messages="$errors->updateData->get('email')" class="mt-2" />
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-password" class="inline-block text-sm text-gray-800 mt-2.5">
                            Password
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            :value="old('password')" />
                        <x-input-error :messages="$errors->updateData->get('password')" class="mt-2" />
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->

                <div class="mt-5 flex justify-end gap-x-2">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        kembali
                    </x-secondary-button>
                    <x-primary-button>
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
@endforeach
