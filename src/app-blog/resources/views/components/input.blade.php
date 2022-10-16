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
        {{$id ? 'id=' . $id : ''}}
        {{$placeholder ? 'placeholder=' . $placeholder : ''}}
        {{$name ? 'name=' . $name : ''}}
        {{$value ? 'value=' . $value : ''}}
        aria-label=".form-control-lg {{$id}}">
</div>
