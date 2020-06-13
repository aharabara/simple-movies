<?php

namespace Application\MovieCatalog\Infrastructure;

use Application\MovieCatalog\Domain\ReleaseDate;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class DateNormalizer extends DateTimeNormalizer
{
    private const DOMAIN_DATE_CLASSES = [ReleaseDate::class];

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return parent::supportsDenormalization($data, $type, $format) || in_array($type, self::DOMAIN_DATE_CLASSES);
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if (is_numeric($data)){
            /** format timestamp as a date*/
            $data = date(\DateTimeInterface::ATOM, $data);
        }
        $dateTime = parent::denormalize($data, $type, $format, $context);
        if (!empty($dateTime)){
            return new ReleaseDate($dateTime->format(\DateTimeInterface::ATOM));
        }
        return $dateTime;
    }
}