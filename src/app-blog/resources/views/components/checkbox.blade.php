@php
    $id         = $id ?? null;
    $value      = $value ?? null;
    $name       = $name ?? null;
    $isCheck    = $isCheck ?? false;
    $label      = $label ?? null;
@endphp

<div class="form-check">
    <input class="form-check-input" type="checkbox"

        {{$id ? "id={$id}" : null}}

        {{$value ? "value={$value}" : null}}

        {{$name ? "name={$name}" : null}}

        {{$isCheck ? "checked" : null}}>
        
        @if ($label)
             <label class="form-check-label" for="flexCheckDefault">
                {{ $label }}
            </label>
        @endif
</div>
