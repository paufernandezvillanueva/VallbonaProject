@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/logo-vallbona.png') }}" class="logo" alt="Vallbona Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
