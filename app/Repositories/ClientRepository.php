<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function __construct(private Client $client)
    {
    }

    public function getClientByUuid($uuid)
    {
    }
    public function storeClient(array $data)
    {
        return $this->client->create($data);
    }
}
