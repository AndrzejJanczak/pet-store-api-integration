@php
    $id = $id ?? '';
    $nameV = !empty($fv = $fieldValues[$id.'-name'] ?? null) ?$fv :null;
    $categoryV = !empty($fv = $fieldValues[$id.'-category'] ?? null) ?$fv :null;
    $photosV = !empty($fv = $fieldValues[$id.'-photos'] ?? null) ?$fv :null;
    $tagsV = !empty($fv = $fieldValues[$id.'-tags'] ?? null) ?$fv :null;
    $statusV = !empty($fv = $fieldValues[$id.'-status'] ?? null) ?$fv :null;
@endphp

<x-forms.form :id="$id" :formName="$slot" action="/">
    @if(!empty($fMethod))
        @method($fMethod)
    @endif

    @if(!empty($fieldValues))
        @php
            dump($fieldValues);
        @endphp
    @endif
        <x-forms.field-block name="{{$id}}-id" placeholder="123456" type="input" :value="$nameV" :required="true">{{ll('id_of_pet')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-name" placeholder="{{ll('example_pet_name')}}" type="input" :value="$nameV" :required="true">{{ll('pet_name')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-category" placeholder="{{ll('example_dogs')}}" type="input" :value="$categoryV">{{ll('category_label')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-category-id" placeholder="42" type="input" :value="$categoryV">{{ll('category_id_label')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-photos" id="{{$id}}-photos" separator=";;;" :value="$photosV" placeholder="https://img.pl/labrador.webp" type="adding-area">{{ll('photo_paths_label')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-tags" id="{{$id}}-tags" separator="#" :value="$tagsV" :value="$tagsV" placeholder="{{ll('example_pet_tags')}}" type="adding-area-dual">{{ll('tags_label')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-status" id="{{$id}}-status" type="option" :value="$statusV">{{ll('availability_status_label')}}</x-forms.field-block>
        <x-forms.field-block name="{{$id}}-submit" type="button-submit">{{$bText}}</x-forms.field-block>
</x-forms.form>
