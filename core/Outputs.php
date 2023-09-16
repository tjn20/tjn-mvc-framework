<?php
namespace app\core;

 class Outputs{
    public Model $model;

    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function getFirstError($attribute){
        return $this->model->getFirstError($attribute);

    }

    public function hasError($attribute){
        return $this->model->hasError($attribute);

    }

    public function getValue($attribute){
        return $this->model->getValue($attribute);

    }

}



?>