@php
    $value = $value ?? old($name);
@endphp

@if(!empty($id))
    <div class="flex items-center justify-center w-full flex-row px-2 pt-2">
        <span class="px-2">{{$slot}}</span>
        <input type="hidden" id="{{$id}}" name="{{$name}}" value="{{$value}}">
        <select id="{{$id}}-availability" >
            <option value=""></option>
            <option value="available" @selected('available' == $value)>{{ll('status_available')}}</option>
            <option value="pending" @selected('pending' == $value)>{{ll('status_pending')}}</option>
            <option value="sold" @selected('sold' == $value)>{{ll('status_sold')}}</option>
        </select>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('{{$id}}-availability');
            const hiddenInput = document.getElementById('{{$id}}');

            if(hiddenInput.value) hiddenInput.value = select.value;

            select.addEventListener('change', () => {
                hiddenInput.value = select.value;
            });
        });
    </script>
@endif

