<?php
namespace App\DTO;

class Car
{
    public $brand;
    public $color;
    public $seats = [];
    private $model;

    public function getModel() : string
    {
        return $this->model;
    }

    public function setModel(string $model)
    {
        $this->model = $model;
    }
}
