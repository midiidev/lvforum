<input type="checkbox" id="{{ $id }}" class="modal-toggle" />
<label for="{{ $id }}" class="modal modal-bottom sm:modal-middle cursor-pointer">
    <label class="modal-box <?php if(isset($width)){echo $width;} ?> relative" for="">
        <label for="{{ $id }}" class="btn btn-ghost btn-sm btn-circle absolute right-2 top-2">✕</label>
        {!! $slot !!}
    </label>
</label>
