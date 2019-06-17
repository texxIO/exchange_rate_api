<?php


namespace App\Infrastructure\Decorator;


use App\Domain\Model\CurrencyRate;

class CurrencyRateDecorator
{
    /** @var CurrencyRate $currencyRate */
    private $currencyRate;

    /**
     * CurrencyRateDecorator constructor.
     * @param CurrencyRate $currencyRate
     */
    public function __construct(CurrencyRate $currencyRate)
    {
        $this->currencyRate = $currencyRate;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'currency' => $this->currencyRate->getCurrencyPair()->toString(),
            'rate' => $this->currencyRate->getRateValue(),
            'updated_at' => $this->currencyRate->getUpdatedAt()->format('Y-m-d H:i:s')
        ];
    }

}
