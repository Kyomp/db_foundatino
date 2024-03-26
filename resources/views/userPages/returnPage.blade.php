<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ url('/returnCar') }}">
            @csrf

            <div>
                <x-label for="brand" value="{{ __('Brand') }}" />
                <x-input id="brand" class="block mt-1 w-full" type="text" name="brand" value="{{$car->brand}}" disabled/>
            </div>

            <div class="mt-4">
                <x-label for="model" value="{{ __('Model') }}" />
                <x-input id="model" class="block mt-1 w-full" type="text" name="model" value="{{$car->model}}" disabled />
            </div>

            <div class="mt-4 flex align-center justify-between space-x-3">
                <div>
                    <div>Color</div>
                    <div class="w-10 h-10 rounded border border-black" style="background-color: #{{$car->color}};">
                    </div>
                </div>
                <div>
                    <x-label for="start_date" value="{{ __('Start Date') }}" />
                    <x-input id="start_date" class="block mt-1 w-full" type="text" name="start_date" value="{{$car->start_date}}" disabled />
                </div>
                <div>
                    <x-label for="end_date" value="{{ __('End Date') }}" />
                    <x-input id="end_date" class="block mt-1 w-full" type="text" name="end_date" value="{{$car->end_date}}" disabled />
                </div>
            </div>

            <input id="contract_id" class="block mt-1 w-full" type="hidden" name="contract_id" value={{$car->id}} required/>
            <input id="car_id" class="block mt-1 w-full" type="hidden" name="car_id" value={{$car->car_id}} required/>
            
            <div class="flex items-center justify-center mt-4">
                <x-button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    {{ __('Return') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

