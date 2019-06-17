<?php


namespace App\Domain\Repository;


use App\Domain\Model\Rate;
use App\Domain\ValueObject\CurrencyPair;

interface CurrencyRateRepositoryInterface
{
    public function store(Rate $rate);
    public function update(CurrencyPair $currencyPair, Rate $rate);

}
