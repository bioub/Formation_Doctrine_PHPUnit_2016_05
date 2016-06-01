<?php
namespace Application\Factory;

use Doctrine\Common\Cache\MemcachedCache;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineCacheMemcachedFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $cache = new MemcachedCache();

        $memcached = new \Memcached();
        $memcached->addServer('127.0.0.1', 11211);

        $cache->setMemcached($memcached);

        return $cache;
    }
}