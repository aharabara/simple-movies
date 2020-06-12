<?php

namespace App\MovieCatalog\Adapter;

use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class Hydrator
{
    /** @var Serializer */
    private $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            [
                new ArrayDenormalizer(),
                new PropertyNormalizer(null, null, new PropertyInfoExtractor()), new ObjectNormalizer()
            ],
        );
    }

    /**
     * @param string $class
     * @param $data
     * @return array|object
     * @throws ExceptionInterface
     */
    public function hydrate(string $class, array $data)
    {
        if (!class_exists($class)) {
            throw new \RuntimeException("Class '$class' does not exist.");
        }
        return $this->serializer->denormalize($data, $class);
    }

    /**
     * @param object $data
     * @return array|\ArrayObject|bool|\Countable|float|int|mixed|string|\Traversable|null
     * @throws ExceptionInterface
     */
    public function extract(object $data): array
    {
        return $this->serializer->normalize($data);
    }

}