<?php

declare(strict_types=1);

namespace App;

use Temporal\DataConverter\DataConverterInterface;
use Temporal\DataConverter\DataConverter;
use Temporal\Api\Common\V1\Payload;
use Temporal\DataConverter\Type;
use Temporal\DataConverter\EncodingKeys;

class Converter implements DataConverterInterface
{
    private DataConverterInterface $dataConverter;

    public function __construct()
    {
        $this->dataConverter = DataConverter::createDefault();
    }

    public function toPayload($value): Payload
    {
        $payload = $this->dataConverter->toPayload($value);

        $encrypted = new Payload();
        $encrypted->setMetadata([EncodingKeys::METADATA_ENCODING_KEY => 'binary/encrypted']);
        $encrypted->setData(base64_encode($payload->serializeToString()));

        return $encrypted;
    }

    public function fromPayload(Payload $payload, $type): mixed
    {
        $decrypted = new Payload();
        $decrypted->mergeFromString(base64_decode($payload->getData()));


        return $this->dataConverter->fromPayload($payload, new Type(TYPE::TYPE_ANY));
    }
}
