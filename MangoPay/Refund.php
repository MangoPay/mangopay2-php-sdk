<?php

namespace MangoPay;

/**
 * Refund entity
 */
class Refund extends Transaction
{
    /**
     * Initial transaction Id
     * @var string
     */
    public $InitialTransactionId;

    /**
     * Initial transaction Type {PAYIN, PAYOUT, TRANSFER}
     * @var string
     */
    public $InitialTransactionType;

    /**
     * Debited wallet Id
     * @var string
     */
    public $DebitedWalletId;

    /**
     * Credited wallet Id
     * @var string
     */
    public $CreditedWalletId;

    /**
     * Contains info about the reason for refund
     * @var \MangoPay\RefundReasonDetails
     */
    public $RefundReason;

    /**
     * Message related to the refund
     * @var string
     */
    public $RefundReasonMessage;

    /**
     * @var string
     */
    public $Reference;

    /**
     * @var string
     */
    public $StatementDescriptor;

    /**
     * Get array with mapping which property is object and what type of object
     *
     * @return array
     */
    public function GetSubObjects()
    {
        $subObjects = parent::GetSubObjects();
        $subObjects['RefundReason'] = '\MangoPay\RefundReasonDetails';

        return $subObjects;
    }
}
