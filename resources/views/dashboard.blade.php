@php
    $user = auth()->user();
    $santri = \App\Models\Santri::where('name', $user->name)->first() ?? null;
    if ($santri) {
        $hafalans = \App\Models\Hafalan::with('comments', 'santri', 'surah')
            ->where('santri_id', $santri->id)
            ->get();
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <span class="text-xl font-bold">Selamat Datang, {{ $user->name ?? $santri->name }}</span>
                </div>
                @can('view own hafalan')
                    @if (isset($hafalans) && !$hafalans->isEmpty())
                        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
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
                                                        Daftar Hafalan Anda
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
                                                            <td
                                                                class="px-6 py-4 text-sm font-medium text-end whitespace-nowrap">
                                                                <div class="px-6 py-1.5 flex justify-end gap-x-2">
                                                                    @canany(['add comment', 'view own hafalan'])
                                                                        <x-primary-button x-data=""
                                                                            x-data=""
                                                                            x-on:click="$dispatch('open-modal', 'show-{{ $hafalan->id }}')">
                                                                            Detail
                                                                        </x-primary-button>
                                                                    @endcanany
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
                    @else
                        <span class="text-xl font-bold text-gray-800 text-center">Belum ada hafalan</span>
                    @endif
                @endcan
            </div>
        </div>
    </div>
    @if (isset($hafalans) && !$hafalans->isEmpty())
        @foreach ($hafalans as $hafalan)
            <x-modal name="show-{{ $hafalan->id }}" focusable>
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
                </div>
            </x-modal>
        @endforeach
    @endif
</x-app-layout>
