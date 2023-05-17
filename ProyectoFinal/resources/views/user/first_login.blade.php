@section('title', trans('translation.create_password'))

<x-guest-layout>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('first_login', Auth::user()->id) }}">
        @csrf
        <div class="mt-4">
            <x-label for="password" value="{{ trans('translation.password') }}" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>
        <div class="mt-4">
            <x-label for="confirm-password" value="{{ trans('translation.confirm_password') }}" />
            <x-input id="confirm-password" class="block mt-1 w-full" type="password" name="confirm-password" required autocomplete="new-password" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ trans('translation.create_password') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>