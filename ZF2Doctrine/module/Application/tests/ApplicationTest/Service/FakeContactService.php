<?php

namespace ApplicationTest\Service;

use Application\Service\ContactServiceInterface;

class FakeContactService implements ContactServiceInterface
{
    protected $contacts;

    public function __construct(Array $contacts)
    {
        $this->contacts = $contacts;
    }

    public function findAll()
    {
        return $this->contacts;
    }

    public function count()
    {
        return count($this->contacts);
    }
}