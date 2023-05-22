@section('title', trans('translation.forgot_pass'))
<x-guest-layout>
    <x-validation-errors class="mb-4" />

    <div class="mb-4 text-sm text-gray-600">
        {{ trans('translation.forgot_pass_description') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="block">
            <x-label for="email" value="{{ trans('translation.email') }}" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ trans('translation.forgot_pass_rl') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
