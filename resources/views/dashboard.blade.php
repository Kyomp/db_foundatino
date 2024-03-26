<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight text-center m-2">
            {{ __('Dashboard') }}
        </div>
        @if ($hasExistingContract)
            <div>
                <a href="{{url('/return')}}">
                    <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Return Car</button>
                </a>
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Model
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Transmission
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fuel Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Capacity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price Rate
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car_types as $car_type)
                                <tr class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$car_type->brand}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$car_type->model}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$car_type->transmission}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$car_type->fuel_type}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$car_type->capacity}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$car_type->price_rate}}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{url('/book/'.$car_type->id)}}" class="font-medium text-blue-600 hover:underline">
                                            <button type="button" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Select
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
