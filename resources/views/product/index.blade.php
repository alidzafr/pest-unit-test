<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
            
                @if ($products->isEmpty())
                    <div>
                        No Product Found
                    </div>
                @else
                    <table class="table table-lg">
                        <thead class="font-bold text-xl">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Minimum Threshold</th>
                                <th>Expiry Date</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody class="font-light text-lg">
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->min_threshold }}</td>
                                <td>{{ $item->expiry_date }}</td>
                                <td>{{ $item->availability }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            
            </div>
        </div>
    </div>
</x-app-layout>
