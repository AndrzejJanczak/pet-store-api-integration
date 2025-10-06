@php
    $value = $value ?? null;
@endphp


@if(!empty($id) || empty($separator))
    <div class="flex flex-col w-full px-2 pt-2 space-y-2">
        <span class="px-2">{{$slot}}</span>
        <input type="text" id="{{$id}}-preview" class="bg-gray-300 w-full px-2 py-1" name="{{$name}}--preview" value="{{$value ?? old($name)}}" disabled>

        <div class="flex items-center space-x-2">
            <input type="text" id="{{$id}}-text" class="flex-1 border border-gray-300 px-2 py-1" value="{{$value ?? old($name)}}" placeholder="{{$placeholder}}">
            <button type="button" id="{{$id}}-add" class="px-3 py-1 border-2 border-green-500 text-green-700 hover:bg-green-300 transition whitespace-nowrap">{{ll('add')}}</button>
        </div>

        <input type="hidden" id="{{$id}}" name="{{$name}}" value="{{$value ?? old($name)}}">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('{{$id}}-text');
            const hiddenInput = document.getElementById('{{$id}}');
            const previewInput = document.getElementById('{{$id}}-preview');
            const addButton = document.getElementById('{{$id}}-add');

            // dirty hack - temp
            @if(str_contains($id, 'tags'))
            const validPattern = /^[A-Za-z0-9\-{}]+$/;
            @else
            const validPattern = /^[A-Za-z0-9\/:\-_,&%=.#;]+$/;
            @endif

            addButton.addEventListener('click', () => {
                const nameVal = nameInput.value.trim();

                if(!nameVal) return;

                if(nameVal && !validPattern.test(nameVal)) {
                    nameInput.setCustomValidity('{{ll('field_contains_forbidden_characters')}}');
                    nameInput.reportValidity();
                    return;
                }
                nameInput.setCustomValidity('');

                let newEntry = '';
                if(nameVal) {
                    newEntry = nameVal;
                }

                hiddenInput.value = hiddenInput.value ? hiddenInput.value+'{{$separator}}'+newEntry : newEntry;
                previewInput.value = hiddenInput.value;

                nameInput.value = '';
                idInput.value = '';
            });

            nameInput.addEventListener('keydown', e => {
                if(e.key === 'Enter') {
                    e.preventDefault();
                    addButton.click();
                }
            });
        });
    </script>
@endif
