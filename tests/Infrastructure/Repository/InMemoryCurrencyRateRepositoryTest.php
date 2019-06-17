<?php


namespace App\Tests\Infrastructure\Repository;


use App\Domain\Model\CurrencyRate;
use App\Domain\ValueObject\CurrencyPair;
use App\Infrastructure\Repository\InMemoryCurrencyRateRepository;
use PHPUnit\Framework\TestCase;
use App\Domain\Exception\CurrencyPairNotFoundException;

class InMemoryCurrencyRateRepositoryTest extends TestCase
{
    public function testGetCurrencyRate()
    {
        $pair = CurrencyPair::fromString('eurusd');
        $repo = new InMemoryCurrencyRateRepository();
        $this->assertTrue($repo->currencyPairExists($pair));
    }

    public function testAddNewCurrencyRate()
    {
        $repo = new InMemoryCurrencyRateRepository();
        $newPair = CurrencyPair::fromString('nzdjpy');
        $currencyRate = new CurrencyRate($newPair, 1.1);
        $repo->store($currencyRate);
        $this->assertTrue($repo->currencyPairExists($newPair));
        $this->assertInstanceOf(CurrencyRate::class, $repo->getRateByCurrency($newPair));
        $this->assertSame(1.1, $repo->getRateByCurrency($newPair)->getRateValue());
    }

    public function testRemoveCurrencyRate()
    {
        $repo = new InMemoryCurrencyRateRepository();
        $removePair = CurrencyPair::fromString('eurusd');
        $this->assertTrue($repo->currencyPairExists($removePair));
        $repo->remove($removePair);
        $this->assertFalse($repo->currencyPairExists($removePair));

    }

    public function testUpdateCurrencyRate()
    {
        $repo = new InMemoryCurrencyRateRepository();
        $updatePair = CurrencyPair::fromString('eurusd');
        $rate = $repo->getRateByCurrency($updatePair);
        $oldRateValue = $rate->getRateValue();

        $newRateValue = 2.2;
        $repo->update($updatePair, $newRateValue);
        $this->assertNotEquals($newRateValue, $oldRateValue);
        $this->assertSame(2.2, $repo->getRateByCurrency($updatePair)->getRateValue());

    }

    public function testGetCurrencyRateException()
    {
        $this->expectException(CurrencyPairNotFoundException::class);
        $repo = new InMemoryCurrencyRateRepository();
        $somePair = CurrencyPair::fromString('erwerwer');
        $repo->getRateByCurrency($somePair);
    }


}
