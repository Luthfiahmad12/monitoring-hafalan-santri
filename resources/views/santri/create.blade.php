<x-app-layout>
    <!-- Card Section -->
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">
                    Tambah Data Santri
                </h2>
            </div>

            <form action="{{ route('santri.store') }}" method="POST">
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
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
                            :value="old('kelas')" />
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
                            :value="old('no_telp')" />
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
                            rows="6">{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />

                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->

                <div class="mt-5 flex justify-end gap-x-2">
                    <a href="{{ route('santri.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Kembali
                    </a>
                    <x-primary-button>
                        Simpan
                    </x-primary-button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
</x-app-layout>
