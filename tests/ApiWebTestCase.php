<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiWebTestCase extends WebTestCase
{
    protected function createAuthenticatedClient(string $username = 'user', string $password = 'password'): KernelBrowser
    {
        $client = static::createClient();
        $client->jsonRequest(
            'POST',
            '/api/login',
            [
                'email' => $username,
                'password' => $password,
            ]
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->restoreExceptionHandler();
    }

    protected function restoreExceptionHandler(): void
    {
        while (true) {
            $previousHandler = set_exception_handler(static fn () => null);

            restore_exception_handler();

            if (null === $previousHandler) {
                break;
            }

            restore_exception_handler();
        }
    }

    public function getClientForTestingUser(): KernelBrowser
    {
        return $this->createAuthenticatedClient('johndoe@example.com', 'SecurePassword123');
    }
}
