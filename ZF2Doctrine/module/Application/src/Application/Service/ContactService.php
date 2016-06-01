<?php

namespace Application\Service;


use Application\Entity\Contact;
use Application\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use Zend\Hydrator\HydratorInterface;

class ContactService implements ContactServiceInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * ContactService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, HydratorInterface $hydrator)
    {
        $this->em = $em;
        $this->hydrator = $hydrator;
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

    public function insert(Array $data)
    {
        $contact = new Contact();
        $this->hydrator->hydrate($data, $contact);

        $this->em->persist($contact);
        $this->em->flush();
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