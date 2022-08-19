@props(['user', 'alt', 'class'])
<img src="{{ $user->icon ?? '/images/nopfp.png' }}" alt="{{ $alt ?? '' }}" class="{{ $class ?? '' }}">
