<?php

namespace Paris5\Validator;

use Doctrine\Common\Annotations\Reader;
use Paris5\Annotation\StringLength;

class AnnotationValidator
{
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * AnnotationValidator constructor.
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function isValid($entity)
    {
        $className = get_class($entity);
        $class = new \ReflectionClass($className);

        $properties = $class->getProperties();

        $valid = true;

        foreach ($properties as $property) {
            /** @var StringLength $annot */
            $annot = $this->reader->getPropertyAnnotation($property, StringLength::class);
            $name = $property->getName();
            $val = $entity->{'get'.ucfirst($name)}();

            if ($val !== null && (strlen($val) < $annot->min || strlen($val) > $annot->max)) {
                $valid = false;
            }
        }

        return $valid;
    }

}