<div class="flex flex-wrap justify-center items-start gap-2">
    <x-forms.upsert-form id="add" :bText="ll('form_button_add_pet')">{{ll('form_title_add_pet')}}</x-forms.upsert-form>

    <x-forms.form formName="{{ll('form_title_pet_get')}}" action="/get-pet">
        <x-forms.field-block name="get-id" placeholder="123456" type="input" :required="true">{{ll('id_of_pet')}}</x-forms.field-block>
        <x-forms.field-block name="get-submit" type="button-submit">{{ll('form_button_show_pet')}}</x-forms.field-block>
    </x-forms.form>

    <x-forms.upsert-form id="edit" bText="{{ll('form_button_edit_pet')}}" fMethod="PATCH">{{ll('form_title_pet_edit')}}</x-forms.upsert-form>

    <x-forms.form formName="{{ll('form_title_pet_deletion')}}" action="/delete-pet">
        <x-forms.field-block name="delete-id" placeholder="123456" type="input" :required="true">{{ll('id_of_pet')}}</x-forms.field-block>
        <x-forms.field-block name="delete-submit" type="button-submit">{{ll('form_button_delete_pet')}}</x-forms.field-block>
    </x-forms.form>
</div>
