<?php

namespace App\Repositories;

use App\Settlement;

class SettlementRepository extends RepositoryInterface
{
    protected $model;

    /**
     * SettlementRepository constructor
     * @param Settlement $settlement
     */
    public function __construct(Settlement $settlement)
    {
        $this->model = $settlement;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
