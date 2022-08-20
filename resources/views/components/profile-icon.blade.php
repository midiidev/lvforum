@props(['user', 'alt', 'class', 'size'])
<img src="{{ $user->icon ?? '/storage/avatars/_nopfp.png' }}"
     alt="{{ $alt ?? '' }}"
     class="{{ $class ?? '' }}"
     width="{{ $size ?? '100' }}"
     height="{{ $size ?? '100' }}"
>
