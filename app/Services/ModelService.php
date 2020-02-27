<?php

namespace App\Services;

class ModelService
{
    public function __construct($model)
    {
        $this->model = $model;
    }
    
    /**
     * Creates a new num from last model
     * @return str
     */ 
    public function getNewNum()
    {
        $id = 1;
        $lastModel = $this->model->withTrashed()->latest()->first();

        if ($lastModel) {
            $id = strval($lastModel->id + 1);
        }

        $num = str_pad($id, 8, "0", STR_PAD_LEFT);

        return $num;
    }

    /**
     * Return multiple nums for N models
     * @param int total
     * @return array 
     */
    public function getNums(int $total)
    {
        $num = $this->getNewNum();
        $nums = Array(
            $num
        );

        $lastOne = (int)$num + 1;
        for ($n = 0; $n < $total; $n++) {
            $newNum = $lastOne + $n;        
            $invoiceNum = str_pad($newNum, 8, "0", STR_PAD_LEFT);

            array_push($nums, $invoiceNum);
        }
        return $nums;
    }
}
