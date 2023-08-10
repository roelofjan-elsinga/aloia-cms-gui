<?php


namespace AloiaCms\GUI\Requests;

interface PersistableFormRequest
{
    /**
     * Persist the data from this request to the file system
     */
    public function save(): void;
}
