<?php

namespace App\Message;

final class CheckUrl
{
    public function __construct(
         private string $url,
     ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
