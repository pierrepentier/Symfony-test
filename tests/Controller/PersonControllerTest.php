<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;

class PersonControllerTest extends WebTestCase
{
    use FixturesTrait;

    private $client;

    /**
     * Prepare the tests
     * @before
     * @return void
     */
    protected function setUpTest(){
        $this->client = static::createClient();
    }

    public function testRedirectToLoginWhenNotAuthenticated(){

        $this->client->request('GET','/personnes');

        $this->assertResponseRedirects('/login');
    }

    public function testDisplayHomeIsSuccessful(){

        $this->client->request('GET','/');

        $this->assertResponseRedirects('/login');
    }

    public function testAccessToPersonneRouteWithAuth(){
        $this->loadFixtures([UserFixtures::class]);
        $user = self::$container->get(UserRepository::class)->find(1);
        $session = $this->client->getContainer()->get('session');
        $sessionToken = new UsernamePasswordToken($user, null, "main", $user->getRoles());
        $session->set("_security_main", serialize($sessionToken));
        $session->save();
        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
        $this->client->request('GET', '/personnes');
        $this->assertResponseIsSuccessful();
    }
}