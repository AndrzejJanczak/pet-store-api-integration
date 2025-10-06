<?php

namespace App\Common\Form;

use App\Common\Sanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class petValidator
{
    private string $fieldPrefix;
    private array $upsertValidationRules;
    private array $upsertValidationMessages;
    private array $upsertValidationAttributes;

    public function __construct(string $fieldPrefix = '')
    {
        $this->fieldPrefix = $fieldPrefix;
        $this->upsertValidationRules = $this->getUpsertValidationRules();
        $this->upsertValidationMessages = $this->getUpsertValidationMessages();
        $this->upsertValidationAttributes = $this->getUpsertValidationAttributes();
    }


    public function validateGetPetRequest(Request $request): array
    {
        Sanitizer::xss_clean(); //ponieważ przekazujemy dane do zewnętrznego API, które nie wiadomo jak obsługuje xss
        return $request->validate([
            $this->fieldPrefix.'id' => 'required',
        ]);
    }

    public function validateUpsertRequest(Request $request): array
    {
        Sanitizer::xss_clean(); //ponieważ przekazujemy dane do zewnętrznego API, które nie wiadomo jak obsługuje xss

        $validator = Validator::make(
            $request->all(),
            $this->upsertValidationRules,
            $this->upsertValidationMessages,
            $this->upsertValidationAttributes
        );

        return $validator->validate();
    }


    private function getUpsertValidationRules(): array {
        return [
            $this->fieldPrefix.'id' => 'numeric|max:99999999999999999999',
            $this->fieldPrefix.'name' => 'required|string|max:32',
            $this->fieldPrefix.'category' => 'string|min:2|max:32',
            $this->fieldPrefix.'category-id' => 'numeric|max:9999999',
            $this->fieldPrefix.'photos' => 'string|max:500|regex:/^[A-Za-z0-9\/:\-_,&%=.#;]+$/',
            $this->fieldPrefix.'tags' => 'string|max:255|regex:/^[A-Za-z0-9\-#{}]+$/',
            $this->fieldPrefix.'status' => 'string|in:available,pending,sold|between:4,9|alpha',
        ];
    }


    private function getUpsertValidationMessages(): array {
        return [
            'in' => ll('validation_rule_in', [':attribute', ':values']),
            $this->fieldPrefix . 'photos.regex' => ll('validation_rule_links_and_semicolons', [':attribute']),
            $this->fieldPrefix . 'tags.regex' => ll('validation_rule_tags', [':attribute']),
        ];
    }


    private function getUpsertValidationAttributes(): array {
        return [
            $this->fieldPrefix . 'id' => 'id',
            $this->fieldPrefix . 'name' => ll('name'),
            $this->fieldPrefix . 'category' => ll('category'),
            $this->fieldPrefix . 'category' => ll('category_id'),
            $this->fieldPrefix . 'photos' => ll('photos'),
            $this->fieldPrefix . 'tags' => ll('tags'),
            $this->fieldPrefix . 'status' => ll('status'),
        ];
    }
}
