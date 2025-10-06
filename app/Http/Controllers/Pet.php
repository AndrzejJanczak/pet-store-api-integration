<?php
namespace App\Http\Controllers;

use App\Common\Dto\UpsertPet;
use App\Common\Form\petValidator;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class Pet extends Controller
{
    private string $url = "https://petstore.swagger.io/v2/pet";
    private string $fieldPrefix;
    private string $apiKey;
    private petValidator $petValidator;


    public function __construct(string $fieldPrefix = '')
    {
        app()->setLocale(session('langIso') ?? config('app.locale'));
        $this->fieldPrefix = $fieldPrefix;
        $this->apiKey = config('app.pets_api_key');
        $this->petValidator = new PetValidator($fieldPrefix);
    }

    public function index() {
        return view('index', [
            'petId' => session('petId') ?? null,
            'errorMessage' => session('errorMessage') ?? null,
            'fullResponse' => session('fullResponse') ?? null,
        ]);
    }


    public function getPet(Request $request)
    {
        $petId = $this->petValidator->validateGetPetRequest($request)[$this->fieldPrefix.'id'] ?? null;
        [$body, $errorMessage] = $this->handleHttpRequest( method: 'GET', urlExtension: "$petId");

        return to_route('index')->with([
            'fullResponse' => $body ?? null, 'petId' => $body['id'] ?? null, 'errorMessage' => $errorMessage
        ]);
    }

    public function deletePet(Request $request)
    {
        $petId = $this->petValidator->validateGetPetRequest($request)[$this->fieldPrefix.'id'] ?? null;
        [$body, $errorMessage] = $this->handleHttpRequest( method: 'DELETE', urlExtension: "$petId", authorize: true);

        return to_route('index')->with([
            'fullResponse' => $body ?? null, 'petId' => $body['id'] ?? null, 'errorMessage' => $errorMessage
        ]);
    }


    public function createPet(Request $request) {
        return $this->upsertPet($request, 'POST');
    }


    public function updatePet(Request $request) {
        return $this->upsertPet($request, 'PUT');
    }


    private function upsertPet(Request $request, string $method)
    {
        $data = $this->petValidator->validateUpsertRequest($request);
        $jsonData = $this->applyUpsertSchema($data);
        [$body, $errorMessage] = $this->handleHttpRequest($jsonData, $method);

        return to_route('index')->with(['petId' => $body['id'] ?? null, 'errorMessage' => $errorMessage]);
    }



    private function applyUpsertSchema(array $data): string
    {
        $pet = new UpsertPet($this->fieldPrefix, $data);

        $data = array_filter([
            'id' => $pet->petId,
            'category' => $pet->category,
            'name'     => $pet->petName,
            'photoUrls'=> $pet->photoUrls ?: null,
            'tags'     => $pet->tags ?: null,
            'status'   => $pet->status,
        ]);

        return json_encode($data);
    }

    private function handleHttpRequest(?string $data = null, string $method = 'POST', string $urlExtension = '', bool $authorize = false): array
    {
        $method = strtoupper($method);
        $errorMessage = '';
        try {
            $data = ($data) ?['body' => $data] :[]; //do prostych requestów wystarczy, zawsze można rozbudować
            $response = Http::withOptions(['verify' => storage_path('certs\cacert.pem')])
                ->withHeaders($this->getHeaders($authorize))
                ->send($method, $this->url.($urlExtension ?"/$urlExtension" :''), $data);

            if($response->failed()) {
                //Tutaj możemy udać, że zalogowaliśmy informację o problemie jako warning do logów
                if($response->status() === 404) {
                    $errorMessage = ll('sorry_server_returned_404', [$response->status(), $response->getReasonPhrase()]);
                } else {
                    $errorMessage = ll('sorry_server_returned_error', [$response->status(), $response->getReasonPhrase()]);
                }
            }

            return [json_decode($response->getBody()->getContents(), true) ?? null, $errorMessage];
        } catch (ConnectionException $ex) {
            //Tutaj udajmy, że dodaliśmy exception do logów
            $errorMessage = ll('sorry_connection_failed');
        } catch (Throwable $ex) {
            //Tutaj udajmy, że dodaliśmy exception do logów
            $errorMessage = ll('sorry_simple_request_failed');
        }
        return [false, $errorMessage];
    }

    private function getHeaders(bool $authorize)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ];

        if($authorize) {
            $headers['api_key'] = $this->apiKey;
        }

        return $headers;
    }


}
