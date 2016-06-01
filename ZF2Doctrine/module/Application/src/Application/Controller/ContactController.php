<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\ContactForm;
use Application\Service\ContactServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * @var ContactForm
     */
    protected $contactForm;

    /**
     * ContactController constructor.
     * @param ContactServiceInterface $contactService
     * @param ContactForm $contactForm
     */
    public function __construct(ContactServiceInterface $contactService, ContactForm $contactForm)
    {
        $this->contactService = $contactService;
        $this->contactForm = $contactForm;
    }

    public function listAction()
    {
        $contacts = $this->contactService->findAll();

        return new ViewModel([
            'contacts' => $contacts
        ]);
    }

    public function addAction()
    {
        if ($this->request->isPost()) {
            $data = (array) $this->request->getPost();
            $this->contactService->insert($data);

            $this->redirect()->toRoute('home');
        }

        return new ViewModel([
           'contactForm' => $this->contactForm
        ]);
    }
}
