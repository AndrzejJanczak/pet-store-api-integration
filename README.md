## O Pets Store API Integration:

Niniejsze repozytorium jest jedynie repozytorium testowym na potrzeby zadania rekrutacyjnego.

## Instalacja:

Upewnij się, że posiadasz PHP w wersji 8.4, zainstalowany Node.js oraz Composer.
W przeciwnym razie możesz skorzystać z instrukcji: <a href="https://laravel.com/docs/12.x/installation">Installation - Laravel 12.x</a>


Sklonuj repozytorium:
```
git clone https://github.com/AndrzejJanczak/pet-store-api-integration .
```

<p style="font-size: 15px; padding-top: 15px;"><b>WAŻNE:</b></p>
Utwórz plik <span style="color: red;"><b>.env</b></span> w głownym katalogu projektu i skopiuj do niego zawartość pliku <span style="color: red;"><b>.env.example</b></span>
(ponieważ nie ma tutaj żadnych prawdziwych sekretów, dopuszczamy taką możliwość).

<br/>
Uruchom w katalogu projektu:

```
npm install
npm run build
composer install
php artisan migrate
```


## Użycie:

Jeśli operacje z sekcji instalacja przebiegły pomyślnie, możesz teraz uruchomić aplikację w trybie deweloperskim.
<br/>Wykonaj w katalogu projektu:
```
composer run dev
```


Możesz odwiedzić aplikację Pet Store API Integration pod adresem:
```
http://localhost:8000
```

To wszystko! Testuj do woli!
