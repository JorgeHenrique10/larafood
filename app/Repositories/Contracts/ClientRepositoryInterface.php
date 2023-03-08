<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function getClientByUuid($uuid);
    public function storeClient(array $data);
}
