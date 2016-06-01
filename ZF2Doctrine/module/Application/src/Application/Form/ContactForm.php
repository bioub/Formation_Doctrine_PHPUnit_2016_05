<?php

namespace Application\Form;

use Application\Entity\Societe;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\Form\Element\DateSelect;
use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class ContactForm extends Form implements ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function init()
    {
        $this->add([
            'type' => Text::class,
            'name' => 'prenom',
            'options' => [
                'label' => 'Prénom',
            ]
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'nom',
            'options' => [
                'label' => 'Nom',
            ]
        ]);

        $this->add([
            'type' => Email::class,
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ]
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'telephone',
            'options' => [
                'label' => 'Téléphone',
            ]
        ]);

        $this->add([
            'type' => DateSelect::class,
            'name' => 'dateNaissance',
            'options' => [
                'label' => 'Date de naissance',
            ]
        ]);

        $this->add(
            array(
                'type' => ObjectSelect::class,
                'name' => 'societe',
                'options' => array(
                    'object_manager'     => $this->getObjectManager(),
                    'target_class'       => Societe::class,
                    'property'           => 'nom',
                    'display_empty_item' => true,
                    'empty_item_label'   => '-- Pas de société --',
                ),
            )
        );

        $this->add(
        array(
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'groupes',
            'options' => array(
                'object_manager'     => $this->getObjectManager(),
                'target_class'       => \Application\Entity\Groupe::class,
                'property'           => 'nom',
            ),
//                'attributes' => array(
//                    'multiple' => true
//                ),
        )
    );

        $this->add([
            'type' => Submit::class,
            'name' => 'valider',
            'attributes' => [
                'value' => 'Valider',
            ]
        ]);
    }
}