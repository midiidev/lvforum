<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 5000)"
     x-show="show"
     @click="show = false"
     class="toast toast-end">
    <div class="alert alert-{{ $type }}">
        <div>
            <span>{{ $message }}</span>
        </div>
    </div>
</div>
