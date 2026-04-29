<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                @if ($products->isEmpty()) {
                    <div>
                        No Product Found
                    </div>
                } @else {
                    <table class="table-auto w-full text-left">
                        <thead class="font-bold text-xl">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="font-light text-lg">
                            @foreach ($products as $item)
                            <tr>
                                <td class="text-center">1</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                }
                @endif

                
                {{-- <div class="p-6 text-gray-900">
                    {{ __("blabla") }}
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
