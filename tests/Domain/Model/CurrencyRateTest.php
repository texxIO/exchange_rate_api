<?php


namespace App\Tests\Domain\Model;


use App\Domain\Model\CurrencyRate;
use App\Domain\ValueObject\CurrencyPair;
use PHPUnit\Framework\TestCase;

class CurrencyRateTest extends TestCase
{
    public function testCreateCurrencyRate()
    {
        $currencyPair = CurrencyPair::fromString('eurusd');
        $rateValue = 1.21;
        $currencyRate = new CurrencyRate($currencyPair, $rateValue);
        $this->assertSame($currencyPair, $currencyRate->getCurrencyPair());
        $this->assertSame($rateValue, $currencyRate->getRateValue());
        $this->assertInstanceOf(\DateTime::class, $currencyRate->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $currencyRate->getUpdatedAt());

        $this->assertNull($currencyRate->getDeletedAt());

    }

}
