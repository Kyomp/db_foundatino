<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ url('/citizen') }}">
            @csrf

            <div>
                <x-label for="citizen_no" value="{{ __('Identification No.') }}" />
                <x-input id="citizen_no" class="block mt-1 w-full" type="text" name="citizen_no" :value="old('email')" required  />
            </div>

            <div class="mt-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" required  />
            </div>

            <div class="mt-4 flex items-center space-x-10 space-between">
                <div>
                    <x-label for="issue_date" value="{{ __('Issue Date') }}" />
                    <x-input id="issue_date" class="block mt-1 w-full" type="date" name="issue_date" required  />
                </div>
    
                <div>
                    <x-label for="expiry_date" value="{{ __('Expiry Date') }}" />
                    <x-input id="expiry_date" class="block mt-1 w-full" type="date" name="expiry_date" required  />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

