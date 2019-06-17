<?php


namespace App\Domain\Repository;


use App\Domain\ValueObject\CurrencyPair;

interface CheckCurrencyPairExistsInterface
{
    public function currencyPairExists(CurrencyPair $currencyPair):bool;
}
