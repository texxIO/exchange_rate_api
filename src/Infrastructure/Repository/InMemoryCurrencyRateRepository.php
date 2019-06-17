<?php


namespace App\Infrastructure\Repository;


use App\Domain\Exception\CurrencyPairExistsException;
use App\Domain\Exception\CurrencyPairNotFoundException;
use App\Domain\Model\CurrencyRate;
use App\Domain\Repository\CheckCurrencyPairExistsInterface;
use App\Domain\Repository\CurrencyRateRepositoryInterface;
use App\Domain\ValueObject\CurrencyPair;

final class InMemoryCurrencyRateRepository implements CurrencyRateRepositoryInterface, CheckCurrencyPairExistsInterface
{

    /** @var CurrencyRate[] */
    private $currencyRate;

    public function __construct()
    {
        $this->loadRates();
    }

    public function currencyPairExists(CurrencyPair $currencyPair): bool
    {
        return (isset($this->currencyRate[$currencyPair->toString()])?true:false);
    }

    /**
     * @param CurrencyRate $rate
     * @return CurrencyRate
     * @throws CurrencyPairExistsException
     */
    public function store(CurrencyRate $rate):CurrencyRate
    {
        if ( !$this->currencyPairExists($rate->getCurrencyPair()) )
        {
            $this->currencyRate[$rate->getCurrencyPair()->toString()] = $rate;
            return $rate;
        }

        throw new CurrencyPairExistsException();

    }

    /**
     * @param CurrencyPair $currencyPair
     * @return bool
     * @throws CurrencyPairNotFoundException
     */
    public function remove(CurrencyPair $currencyPair): bool
    {
        if ( $this->currencyPairExists($currencyPair) )
        {
            unset($this->currencyRate[$currencyPair->toString()]);
            return true;
        }

        throw new CurrencyPairNotFoundException();
    }

    /**
     * @param CurrencyPair $currencyPair
     * @param float $rateValue
     * @return CurrencyRate
     * @throws CurrencyPairNotFoundException
     */
    public function update(CurrencyPair $currencyPair, float $rateValue): CurrencyRate
    {
        if ( $this->currencyPairExists($currencyPair) )
        {
            $rate = $this->currencyRate[$currencyPair->toString()];
            $rate->setRateValue($rateValue);
            $this->currencyRate[$currencyPair->toString()] = $rate;
            return $this->currencyRate[$currencyPair->toString()];
        }

        throw new CurrencyPairNotFoundException();
    }

    /**
     * Load some pairs to simulate the database
     */
    protected function loadRates()
    {
        $currencyPairs = ['EURGBP', 'EURUSD', 'GBPJPY', 'USDJPY'];

        $currencyRates = [];
        foreach ( $currencyPairs as $pair )
        {
            $pairObject = CurrencyPair::fromString($pair);
            $aRandomValue = mt_rand() / mt_getrandmax();
            $currencyRates[$pair] = new CurrencyRate($pairObject, $aRandomValue );
        }
    }

    /**
     * @param CurrencyPair $currencyPair
     * @return CurrencyRate
     * @throws CurrencyPairNotFoundException
     */
    public function getRateByCurrency(CurrencyPair $currencyPair): CurrencyRate
    {
        if ( $this->currencyPairExists($currencyPair) )
        {
            return $this->currencyRate[$currencyPair->toString()];
        }

        throw new CurrencyPairNotFoundException();
    }


}
