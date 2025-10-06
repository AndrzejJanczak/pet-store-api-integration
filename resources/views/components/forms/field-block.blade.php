@php
    $id = $id ?? null;
    $name = $name ?? null;
    $placeholder = $placeholder ?? null;
    $label = $label ?? null;
    $value = $value ?? null;
    $required = $required ?? false;
    $type = $type ?? 'input';
    $separator = $separator ?? '';
@endphp

@if($type == 'input')
    <x-forms.fields.input :id="$id" :name="$name" :placeholder="$placeholder" value="{{$value ?? old($name)}}" :required="$required">{{$slot}}</x-forms.fields.input>
@elseif($type == 'textarea')
    <x-forms.fields.textarea :id="$id" :name="$name" :placeholder="$placeholder" value="{{$value ?? old($name)}}" :required="$required">{{$slot}}</x-forms.fields.textarea>
@elseif($type == 'adding-area')
    <x-forms.fields.adding-area :id="$id" :name="$name" :separator="$separator" :placeholder="$placeholder" value="{{$value ?? old($name)}}" :required="$required">{{$slot}}</x-forms.fields.adding-area>
@elseif($type == 'adding-area-dual')
    <x-forms.fields.adding-area-dual :id="$id" :name="$name" :separator="$separator" :placeholder="$placeholder" value="{{$value ?? old($name)}}" :required="$required">{{$slot}}</x-forms.fields.adding-area-dual>
@elseif($type == 'option')
    <x-forms.fields.option :id="$id" :name="$name" :placeholder="$placeholder" value="{{$value ?? old($name)}}" :required="$required">{{$slot}}</x-forms.fields.option>
@elseif($type == 'button-submit')
    <x-forms.fields.button-submit>{{$slot}}</x-forms.fields.button-submit>
@endif

<x-forms.error-label :name="$name">@error($name) {{ $message }} @enderror</x-forms.error-label>
