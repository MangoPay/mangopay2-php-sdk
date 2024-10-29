<?php

namespace MangoPay;

class VirtualAccountAvailability extends Libraries\EntityBase
{
    /**
     * ISO 3166-1 alpha-2 format is expected
     * * @var string
     */
    public $Country;

    /**
     * Whether international bank wires can be made to this account
     * @var Boolean
     */
    public $Available;

    /**
     * List of currencies supported by the account
     * @var CurrencyIso[]
     * */
    public $Currencies;

    /**
     * Get array with mapping which property is object and what type of object
     * @return array
     */
    public function GetSubObjects()
    {
        $subObjects = parent::GetSubObjects();

        $subObjects['Currencies'] = '\MangoPay\CurrencyIso';

        return $subObjects;
    }
}