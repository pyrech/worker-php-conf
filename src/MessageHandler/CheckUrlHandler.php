<?php

namespace App\MessageHandler;

use App\Message\CheckUrl;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
final class CheckUrlHandler
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(CheckUrl $message)
    {
        $response = $this->httpClient->request('GET', $message->getUrl());

        $this->logger->alert(sprintf('Monitored url "%s", response status code is "%s"', $message->getUrl(), $response->getStatusCode()));
    }
}
