<x-main>
    <div class="flex flex-col items-center space-y-2">
        @if(!empty($errorMessage) || !empty($petId))
            <div class="relative w-full max-w-3xl bg-gray-800 p-6 rounded shadow-md">
                @if(!empty($errorMessage))
                    <p class="text-2xl text-red-600 mb-2">{{$errorMessage}}</p>
                @endif
                @if(!empty($petId))
                    <p class="text-xl text-gray-300">{{ ll('your_pet_has_id', [$petId]) }}</p>
                @endif
            </div>
        @endif

        <div class="w-full max-w-2xl text-center text-gray-400 text-sm mt-1">
            <p>{{ ll('api_note') }}</p>
        </div>
    </div>

    <div class="flex items-center justify-evenly">
        <x-forms.forms></x-forms.forms>
    </div>

        @if(!empty($fullResponse))
            <div x-data="{ open: true }" x-cloak>
                <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 transition-opacity duration-200">
                    <div @click.stop class="bg-gray-900 text-gray-100 p-6 max-w-3xl w-[90%] shadow-xl relative rounded-lg">
                        <button @click="open = false"  class="absolute top-2 right-3 text-gray-400 hover:text-white text-2xl font-bold">
                            &times;
                        </button>

                        <h2 class="text-xl mb-4">{{ll('pet_data_server_response')}}</h2>
                        <pre class="bg-gray-800 text-green-500 text-sm p-4 rounded overflow-x-auto max-h-[70vh] whitespace-pre-wrap">{{ json_encode($fullResponse, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            </div>
        @endif
</x-main>
