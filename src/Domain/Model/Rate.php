<?php


namespace App\Domain\Model;


use App\Domain\ValueObject\CurrencyPair;

class Rate
{
    private $id;

    /** @var CurrencyPair $currencyPair */
    private $currencyPair;

    /** @var float $rate */
    private  $rateValue;

    public function __construct(CurrencyPair $currencyPair, float $rateValue)
    {

    }
}
