<?php

class Controller {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function create_dummy (){
        $this->model->create_dummy();
    }
    
   

}