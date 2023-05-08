<x-guest-layout>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <p>El compte escollit no está registrada.</p>

    <a id="return" href="{{ route('login') }}">Volver</a>

</x-guest-layout>
