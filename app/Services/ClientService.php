<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientService
{
    private $repository;


    public function __construct(ClientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getClientByUuid($uuid)
    {
    }

    public function storeClient(array $data)
    {
        return $this->repository->storeClient($data);
    }
}
