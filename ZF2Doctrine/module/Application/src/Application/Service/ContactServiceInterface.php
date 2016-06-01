<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 01/06/2016
 * Time: 12:09
 */

namespace Application\Service;


interface ContactServiceInterface
{
    public function findAll();
    public function count();
}