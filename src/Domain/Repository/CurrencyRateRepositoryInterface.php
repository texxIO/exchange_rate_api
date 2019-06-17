<?php


namespace App\Domain\Repository;


use App\Domain\Model\CurrencyRate;
use App\Domain\ValueObject\CurrencyPair;

interface CurrencyRateRepositoryInterface
{
    public function store(CurrencyRate $rate);

    public function update(CurrencyPair $currencyPair, float $rateValue): CurrencyRate;

    public function remove(CurrencyPair $currencyPair): bool;

    public function getRateByCurrency(CurrencyPair $currencyPair): CurrencyRate;

}
