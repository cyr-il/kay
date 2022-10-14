<?php

namespace App\Classe;

class Search
{
    /**
     * @var string
     */
    public $name = '';

    public function __toString()
    {
        return $this->name ? : "nothing to show";
    }

}