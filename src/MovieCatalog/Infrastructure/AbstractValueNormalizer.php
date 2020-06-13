<?php

namespace Application\MovieCatalog\Infrastructure;


use Application\MovieCatalog\Domain\AbstractValue\AbstractIntValue;
use Application\MovieCatalog\Domain\AbstractValue\AbstractStringValue;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerAwareInterface;

class AbstractValueNormalizer extends AbstractNormalizer implements SerializerAwareInterface
{

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $class = (new \ReflectionClass($type));
        $instance = $class->newInstanceWithoutConstructor();
        $parent = $class;
        while ($parent = $parent->getParentClass()){
            if ($parent->hasProperty('value')){
                $value = $parent->getProperty('value');
                $value->setAccessible(true);
                $value->setValue($instance, $data);
                return $instance;
            }
        }
        throw new \RuntimeException("Cannot get parent class property for '{$type}'.");
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return is_subclass_of($type, AbstractStringValue::class) || is_subclass_of($type, AbstractIntValue::class);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        if ($object instanceof AbstractStringValue) {
            return (string)$object;
        }
        if ($object instanceof AbstractIntValue) {
            return $object->value();
        }
        throw new \UnexpectedValueException('Cannot normalize instance of ' . get_class($object));
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof AbstractStringValue || $data instanceof AbstractIntValue;
    }
}