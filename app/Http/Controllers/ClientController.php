<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    //Create Client Function
    public function store (ClientRequest $clientRequest){
        return $this->clientService->createClient($clientRequest->image);
    }

    //Update Client Function
    public function update (Client $client, ClientRequest $clientRequest){
        return $this->clientService->updateClient($client, $clientRequest->image);
    }

    //Delete Client Function
    public function destroy (Client $client){
        return $this->clientService->deleteClient($client);
    }

    //Get Clients Function
    public function view (){
        return $this->clientService->getClients();
    }

    //Get Client Function
    public function show (Client $client){
        return $this->clientService->getClient($client);
    }
}
