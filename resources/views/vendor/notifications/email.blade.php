<x-mail::message>

{{-- Intro Lines --}}
<div style="width: 100%; text-align:center;">
    <img src="https://ghanimo.com/img/mpower_text_logo.png" alt="MPower Health logo" style="width: 100px">
    <br>
    <h1 style="color: #aa206b; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;">MPOWER
        <br>
    <span style="color: #08919b; text-align: center; font-family: Verdana, Geneva, Tahoma, sans-serif;">YOURSELF</span></h1>
    <p style="color: #08919b; text-align: center; font-size: 11px;">
    @foreach ($introLines as $line)
    {{ $line }}
    @endforeach
    </p>
</div>

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" style="background-color: #aa206b; border-radius: 30px;">
{{ $actionText }}
</x-mail::button>
<div>
    <p style="color: #08919b; font-size: 11px; text-align: center;">
        or copy this link to your browser
    </p>
    <p style="color: #08919b; font-size: 11px; text-align: center;">
        <span class="break-all">{{ $actionUrl }}</span>
    </p>
</div>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<p style="color: darkgray; font-size: 13px;">
@lang('Regards'),<br>
{{ config('app.name') }}
@endif
</p>


</x-mail::message>