{{-- ...existing code... --}}
@php
    $className = $details['className'] ?? 'your class';
    $rawDateTime = $details['classDateTime'] ?? null;
    $classDateTime = $rawDateTime
        ? \Illuminate\Support\Carbon::parse($rawDateTime)->format('l, F j, Y \a\t g:i A')
        : 'the scheduled time';
@endphp

<p>Hello,</p>

<p>
    We are sorry to let you know that <strong>{{ $className }}</strong> scheduled for
    <strong>{{ $classDateTime }}</strong> has been canceled.
</p>

<p>
    If you would like to rebook another class, please visit your account and select a new time.
</p>

<p>
    Thank you for your understanding,<br>
    {{ config('app.name') }} Team
</p>

