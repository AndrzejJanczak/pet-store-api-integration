@php
    $id = $id ?? null
@endphp

<form @if(!empty($id)) id="{{$id}}" @endif method="POST" action="{{$action}}" class="m-5 border-1 border-gray-300 flex justify-center items-center flex-col">
    {{$formName}}
    @csrf
    {{$slot}}
</form>
