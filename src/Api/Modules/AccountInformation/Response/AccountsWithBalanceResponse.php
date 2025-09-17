<?php

declare(strict_types=1);

namespace Api\Modules\AccountInformation\Response;

use Api\ApiResponseInterface;
use Api\Modules\AccountInformation\Response\Dto\AccountDtoFactory;
use Api\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class AccountsWithBalanceResponse implements ResponseInterface
{
    public function __construct(
        protected ApiResponseInterface $apiResponse,
        protected array $accounts = [],
        protected ?LoggerInterface $logger = null,
    ) {
        $this->logger = $this->logger ?? new NullLogger();

        foreach ($this->apiResponse->getData() as $item) {
            try {
                $this->accounts[] = AccountDtoFactory::fromArray($item);
            } catch (\Throwable $th) {
                $this->logger->error($th->getMessage(), ['exception' => $th]);
            }
        }
    }

    /**
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
}
