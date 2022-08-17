<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 5000)"
     x-show="show"
     @click="show = false"
     class="fixed bottom-5 w-full text-center md:text-left md:w-fit md:bottom-10 md:right-10
            bg-slate-800 p-2 rounded-xl border-b-2 border-b-green-600">
    {{ $text }}
</div>
