<?php

namespace MangoPay;

/**
 * PayOut entity
 */
class PayOut extends Transaction
{
    /**
     * The unique identifier of the bank account.
     *
     * @var string
     */
    public $BankAccountId;

    /**
     * Custom description to appear on the user’s bank statement along with the platform name.
     * The recommended length is 12 characters – strings longer than this may be truncated depending on the bank.
     * @var string
     */
    public $BankWireRef;

    /**
     * Debited wallet Id
     * @var string
     */
    public $DebitedWalletId;

    /**
     * PaymentType (BANK_WIRE, MERCHANT_EXPENSE, AMAZON_GIFTCARD)
     * @var string
     */
    public $PaymentType;

    /**
     * One of PayOutPaymentDetails implementations, depending on $PaymentType
     * @var object
     */
    public $PayoutPaymentDetails;

    /**
     * One of PayOutPaymentDetails implementations, depending on $PaymentType
     * @var object
     */
    public $MeanOfPaymentDetails;

    /**
     * Payout mode requested, default is 'STANDARD', Allowed values are
     * 'STANDARD', 'INSTANT_PAYMENT', 'INSTANT_PAYMENT_ONLY'
     * @var string
     */
    public $PayoutModeRequested;

    /**
     * Get array with mapping which property depends on other property
     * @return array
     */
    public function GetDependsObjects()
    {
        return [
            'PaymentType' => [
                '_property_name' => 'MeanOfPaymentDetails',
                PayOutPaymentType::BankWire => '\MangoPay\PayOutPaymentDetailsBankWire',
                // ...and more in future...
            ]
        ];
    }

    /**
     * Get array with read-only properties
     * @return array
     */
    public function GetReadOnlyProperties()
    {
        $properties = parent::GetReadOnlyProperties();
        array_push($properties, 'PaymentType');

        return $properties;
    }
}
