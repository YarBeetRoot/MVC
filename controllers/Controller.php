<?php

class Controller
{
    protected $view;

    function __construct()
    {
        $this->view = new View();
    }


    public function redirect($url){
        header("Location: ".$url);
    }
}