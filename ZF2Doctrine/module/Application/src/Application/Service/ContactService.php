<?php

namespace Application\Service;


use Application\Entity\Contact;
use Doctrine\ORM\EntityManager;

class ContactService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ContactService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    protected function getRepository()
    {
        return $this->em->getRepository(Contact::class);
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }
}