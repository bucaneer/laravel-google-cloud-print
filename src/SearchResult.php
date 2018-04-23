<?php

namespace Bnb\GoogleCloudPrint;

class SearchResult
{
    public function __construct($result)
    {
        $this->data = $result;
    }


    public function __get($attribute)
    {
        if (isset($this->data->{$attribute})) {
            return $this->data->{$attribute};
        }

        return null;
    }
}