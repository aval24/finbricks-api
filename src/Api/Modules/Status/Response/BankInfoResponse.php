<?php

namespace Api\Modules\Status\Response;

use Api\ApiResponseInterface;
use Api\ResponseInterface;

class BankInfoResponse implements ResponseInterface
{
    public function __construct(protected ApiResponseInterface $apiResponse)
    {
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->apiResponse->getData();
    }
}
