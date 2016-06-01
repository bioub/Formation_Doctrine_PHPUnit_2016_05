<?php

namespace Application\Service;


use Application\Entity\Contact;
use Application\Repository\ContactRepository;
use Doctrine\DBAL\Query\Expression\ExpressionBuilder;
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

    /**
     * @return ContactRepository
     */
    protected function getRepository()
    {
        return $this->em->getRepository(Contact::class);
    }

    public function findAll()
    {
        return $this->getRepository()->findAllWithSociete();
    }

    public function count()
    {
        $conn = $this->em->getConnection();

        $qb = $conn->createQueryBuilder();
        $qb->select('COUNT(id)')
            ->from('contact');

        $stmt = $qb->execute();
        $count = $stmt->fetchColumn();

        return $count;
    }
}