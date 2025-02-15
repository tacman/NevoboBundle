<?php

namespace Punch\NevoboBundle\Tests\Service;

use Punch\NevoboBundle\PunchNevoboBundle;
use Punch\NevoboBundle\Service\NevoboClient;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use PHPUnit\Framework\TestCase;

class PunchNevoboBundleTestingKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new PunchNevoboBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }

    public function getCacheDir(): string
    {
        return __DIR__.'/cache/'.spl_object_hash($this);
    }
}


class NevoboClientTest extends TestCase
{
    public function testGetWords(): void
    {
        $kernel = new PunchNevoboBundleTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        $client = $container->get('punch_nevobo.service.nevobo_client');
        $this->assertInstanceOf(NevoboClient::class, $client);

        $client->getTeamsForVereniging('ckl9m4l');
        $client->getTeam('ckl9m4l-hs-1');
        $client->getSporthallenForVereniging('ckl9m4l');
        $client->getVereniging('ckl9m4l');
        $client->getPouleIndelingen('regio-west-h1f-7');
        $client->getWedstrijdenForPoule('regio-west-h1f-7');
        $client->getWedstrijdenForVereniging('ckl9m4l');
        $client->getWedstrijdResultaatForVereniging('ckl9m4l');
        $client->getWedstrijdProgrammaForVereniging('ckl9m4l');
    }
}
