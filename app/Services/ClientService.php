<?php

namespace App\Services;

use App\Models\Client;
use App\Transformers\Clients\ClientsResponse;
use App\Transformers\Clients\ClientResponse;
use Illuminate\Support\Facades\File;

class ClientService
{
    public function createClient($image)
    {
        if ($image) {
            $path = uploadImage($image, 'ClientsImages');

            $client = Client::create([
                'image' => $path,
            ]);
        }
        return success(ClientResponse::format($client), 'تم إضافة الزبون بنجاح', 201);
    }

    public function updateClient(Client $client, $image)
    {
        if ($image) {
            if (File::exists($client->image)) {
                File::delete($client->image);
            }

            $path = uploadImage($image, 'ClientsImages');

            $client->update([
                'image' => $path,
            ]);
        }
        return success(ClientResponse::format($client), 'تم تعديل الزبون بنجاح');
    }

    public function deleteClient(Client $client)
    {
        if (File::exists($client->image)) {
            File::delete($client->image);
        }
        $client->delete();

        return success(null, 'تم حذف الزبون بنجاح');
    }

    public function getClients (){
        $clients = Client::orderBy('created_at', 'desc')->get();

        return success(ClientsResponse::format($clients), 'عرض الزبائن');
    }

    public function getClient (Client $client){
        return success(ClientResponse::format($client), 'عرض الزبون');
    }
}
