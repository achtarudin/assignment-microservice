
@php
    $label          = $label        ?? null;
    $id             = $id           ?? null;
    $name           = $name         ?? null;
    $value          = $value        ?? null;
@endphp
<div class="mb-2">
    <label for="content" class="form-label text-info">{{$label}}</label>
    <textarea class="form-control" rows="10"
        {{$id ? 'id=' . $id : ''}}
        {{$name ? 'name=' . $name : ''}}>{{ $value }}</textarea>
</div>
