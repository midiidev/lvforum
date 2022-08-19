@props(['user', 'alt', 'class', 'size'])
<img src="{{ $user->icon ?? '/images/nopfp.png' }}"
     alt="{{ $alt ?? '' }}"
     class="{{ $class ?? '' }}"
     width="{{ $size ?? '100' }}"
     height="{{ $size ?? '100' }}"
>
