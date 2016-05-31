<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Service\ContactService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * ContactController constructor.
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function listAction()
    {
        $contacts = $this->contactService->findAll();

        return new ViewModel([
            'contacts' => $contacts
        ]);
    }
}
