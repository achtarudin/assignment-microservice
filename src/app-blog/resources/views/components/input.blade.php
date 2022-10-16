@php
    $label          = $label        ?? null;
    $id             = $id           ?? null;
    $name           = $name         ?? null;
    $value          = $value        ?? null;
    $type           = $type         ?? 'text';
    $placeholder    = $placeholder  ?? null;
@endphp
<div class="mb-2">
    <label for="title" class="form-label text-info">{{$label}}</label>
    <input
        class="form-control form-control"
        type="{{$type}}"
        @if ($id)
            id="{{$id}}"
        @endif
        @if ($name)
            name="{{$name}}"
        @endif
        @if ($placeholder)
            placeholder="{{$placeholder}}"
        @endif
        @if ($value)
            value="{{$value}}"
        @endif
        aria-label=".form-control-lg {{$id}}">
</div>
