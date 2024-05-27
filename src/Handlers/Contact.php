<?php

namespace Project\Handlers;

class Contact
{
    public function execute(array $params = []): void
    {
        $username = $params['name'] ?? 'Guest';

        require_once __DIR__ . '/../../views/contact.php';
    }
}