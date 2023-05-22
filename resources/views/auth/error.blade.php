@section('title', trans('translation.email_error'))

<x-guest-layout>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <p>{{ trans('translation.email_error_description') }}</p>

    <a id="return" href="{{ route('login') }}">{{ trans('translation.back') }}</a>

</x-guest-layout>
