@php
    $value = $value ?? null;
@endphp
<div class="flex items-center justify-center w-full flex-row px-2 pt-2">
    <span class="px-2">{{$slot}}</span>
    <input class="border-1 border-gray-300 px-2" type="text" id="{{$id}}" name="{{$name}}" value="{{$value ?? old($name)}}" placeholder="{{$placeholder}}" @required($required)>
</div>
