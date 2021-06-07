<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Api;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{

    public function testIndex(): string
    {
        $client = self::createClient();
        $client->request('POST', '/it/api/login_check', [], [], ['HTTP_ACCEPT' => 'application/json'], json_encode([
            "username" => "jane_admin",
            "password" => "kitten"
        ]));
        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertEquals(200, $response->getStatusCode(), "Not 200 Response -> ". $response->getStatusCode());
        $this->assertJson($responseContent, "Invalid Json response");
        $responseObject = json_decode($responseContent);
        $this->assertObjectHasAttribute("token", $responseObject, "Missing JWT Token");
        return $responseObject->token;
    }

    /**
     * @param string $token
     * @depends testIndex
     */
    public function testCreatePost(string $token) : void
    {
        $client = self::createClient();
        $client->request(
            'POST',
            '/it/api/blogs',
            [],
            [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer '.$token
            ],
            json_encode([
                "title" => "Kobe Bryant",
                "summary" => "Ciao Kobe bryant",
                "content" => "Ciao Kobe bryant Ciao Kobe bryantkiasdsadasdtten",
                "publishedAt" => (new \DateTime("now"))->format('Y-m-d H:i:s'),
                "tags" => 'tag0,tab1,tav3'
            ])
        );

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertEquals(200, $response->getStatusCode(), "Not 200 Response -> ". $response->getStatusCode());
        $this->assertJson($responseContent, "Invalid Json response");
        $responseObject = json_decode($responseContent);
        $this->assertObjectHasAttribute("id", $responseObject, "Missing ID");
        $this->assertObjectHasAttribute("title", $responseObject, "Missing Title");
    }

}
