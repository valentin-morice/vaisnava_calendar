<x-mail::message>
# Don't Forget!

Tomorrow is {{ $name }} Ekadashi.

<x-mail::button url="{{ $url }}">
Read the Story
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
