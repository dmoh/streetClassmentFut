<button type="submit" class="btn @isset($color){{ ' btn-' . $color }}@else btn-primary @endisset btn-block @isset($marg) margin-b-2 @endisset">
    {{ $slot }}
</button>