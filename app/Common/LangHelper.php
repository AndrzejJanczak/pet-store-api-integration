<?php

//get langline
if(!function_exists('ll')) {
    function ll(string $key, array $replacements = []): string {
        //Udawany plik z configa lub zasób z db z tłumaczeniami
        $translations = [
            'sorry_simple_request_failed' => [
                'pl' => 'Przepraszamy, coś poszło nie tak! Wygląda na to, że nawet prostego requestu HTTP zrobić nie umiemy :(',
                'en' => 'We’re sorry, something went wrong. It seems we can’t even perform a simple HTTP request :(',
            ],
            'sorry_connection_failed' => [
                'pl' => 'Przepraszamy, coś poszło nie tak! Wystąpił problem z połączeniem. Spróbuj ponownie później',
                'en' => "We're sorry, something went wrong. A connection error occurred. Please try again later.",
            ],
            'sorry_server_returned_error' => [
                'pl' => 'Przepraszamy, coś poszło nie tak! Serwer zwrócił {1} - {2}. Spróbuj ponownie później (chociaż to nic nie da).',
                'en' => 'We’re sorry, something went wrong. The server returned {1} - {2}. Please try again later (though it probably won’t help).',
            ],
            'name' => [
                'pl' => 'nazwa',
                'en' => 'name',
            ],
            'category' => [
                'pl' => 'kategoria',
                'en' => 'category',
            ],
            'photos' => [
                'pl' => 'zdjęcia',
                'en' => 'photos',
            ],
            'tags' => [
                'pl' => 'tagi',
                'en' => 'tags',
            ],
            'status' => [
                'pl' => 'status',
                'en' => 'status',
            ],
            'validation_rule_in' => [
                'pl' => 'Pole {1} musi składać się z jednej z następujących wartości: {2}',
                'en' => 'The {1} must be one of the following types: {2}',
            ],
            'validation_rule_links_and_semicolons' => [
                'pl' => 'Pole {1} może zawierać jedynie linki oraz myślniki',
                'en' => 'The {1} can contain only links and colons',
            ],
            'validation_rule_tags' => [
                'pl' => 'Pole {1} może zawierać jedynie litery, cyfry oraz znaki: #}{.',
                'en' => 'The {2} can contain only letters, numbers, and: #}{ characters.',
            ],
            'form_button_add_pet' => [
                'pl' => 'Dodaj zwierzaka',
                'en' => 'Add a pet',
            ],
            'form_title_add_pet' => [
                'pl' => 'Dodawanie zwierzęcia:',
                'en' => 'Adding a pet:',
            ],
            'form_title_pet_get' => [
                'pl' => 'Pobieranie zwierzęcia:',
                'en' => 'Getting a pet:',
            ],
            'id_of_pet' => [
                'pl' => 'Id zwierzęcia:',
                'en' => 'Pet id:',
            ],
            'form_button_show_pet' => [
                'pl' => 'Pokaż zwierzaka',
                'en' => 'Show pet',
            ],
            'form_button_edit_pet' => [
                'pl' => 'Edytuj zwierzaka',
                'en' => 'Edit a pet',
            ],
            'form_title_pet_edit' => [
                'pl' => 'Edycja zwierzęcia:',
                'en' => 'Pet edition:',
            ],
            'form_title_pet_deletion' => [
                'pl' => 'Usuwanie zwierzęcia:',
                'en' => 'Pet deletion:',
            ],
            'form_button_delete_pet' => [
                'pl' => 'Usuń zwierzaka :(',
                'en' => 'Delete a pet :(',
            ],
            'example_pet_name' => [
                'pl' => 'Reksio',
                'en' => 'Rex',
            ],
            'pet_name' => [
                'pl' => 'Nazwa zwierzęcia:',
                'en' => 'Pet name:',
            ],
            'example_pet_tags' => [
                'pl' => 'pies rasowy suka przyjazny słodki',
                'en' => 'dog purebred female_dog friendly sweet',
            ],
            'category_label' => [
                'pl' => 'Kategoria:',
                'en' => 'Category:',
            ],
            'photo_paths_label' => [
                'pl' => 'Linki do zdjęć:',
                'en' => 'Photo paths:',
            ],
            'tags_label' => [
                'pl' => 'Tagi:',
                'en' => 'Tags:',
            ],
            'availability_status_label' => [
                'pl' => 'Status dostępności:',
                'en' => 'Available status:',
            ],
            'pet_data_server_response' => [
                'pl' => 'Dane zwierzaka (odpowiedź z serwera):',
                'en' => 'Pet data (from server):',
            ],
            'your_pet_has_id' => [
                'pl' => 'Twój zwierzak ma id: {1}',
                'en' => 'Your pet has an id: {1}',
            ],
            'status_available' => [
                'pl' => 'Dostępny',
                'en' => 'Available',
            ],
            'status_pending' => [
                'pl' => 'Oczekiwanie na dostawę',
                'en' => 'Pending',
            ],
            'status_sold' => [
                'pl' => 'Sprzedany',
                'en' => 'Sold',
            ],
            'field_contains_forbidden_characters' => [
                'pl' => 'Pole zawiera niedozwolone znaki!',
                'en' => 'The field contains forbidden characters!',
            ],
            'add' => [
                'pl' => 'Dodaj',
                'en' => 'Add',
            ],
            'example_dogs' => [
                'pl' => 'Psy',
                'en' => 'Dogs',
            ],
            'sorry_server_returned_404' => [
                'pl' => 'Serwer zwrócił {1} - {2}. Odświeżanie danych czasem trwa chwilę. Spróbuj ponownie za kilka minut!',
                'en' => 'The server returned {1} - {2}. Refreshing data may take a moment. Please try again in few minutes.',
            ],
            'category_id_label' => [
                'pl' => 'Id kategorii:',
                'en' => 'Category id:',
            ],
            'api_note' => [
                'pl' => 'Uwaga: petstore API działa z opóźnieniami. Potrafi zwracać dane z cache. W związku z tym, wyświetlane dane nie zawsze są aktualne. Dodatkowo zaleca się używanie skomplikowanych numerów id, w celu ograniczenia ryzyka konfliktu z innymi użytkowanikami API',
                'en' => 'Note: The petstore API operates with delays. It may return data from the cache. Therefore, the data displayed is not always up to date. Additionally, it is recommended to use complex ID numbers to reduce the risk of conflict with other API users.',
            ],
        ];

        $langIso = substr(app()->getLocale(), 0, 2);

        if(!empty($replacements)) {
            $temp = $translations[$key][$langIso] ?? $key;
            $i = 1;
            foreach($replacements as $key => $replacement) {
                $temp = str_replace('{'."$i".'}', $replacement, $temp);
                $i++;
            }

            return $temp;
        }

        return $translations[$key][$langIso] ?? $key;
    }
}
