<?php

namespace MangoPay;

/**
 * Pay-in entity
 */
class PayIn extends Transaction
{
    /**
     * Credited wallet Id
     * @var string
     */
    public $CreditedWalletId;

    /**
     * The mode applied for the 3DS protocol for CB, Visa, and Mastercard.
     * Default values: DEFAULT. Allowed values: DEFAULT, FORCE, NO_CHOICE
     *
     * @var string
     */
    public $SecureMode;

    /**
     * The 3DS protocol version to be applied to the transaction. Allowing values: V1, V2_1
     *
     * @see https://mangopay.com/docs/concepts/payments/payment-methods/card/3ds
     * @see https://mangopay.com/docs/endpoints/direct-card-payins#direct-card-payin-object
     * @var string
     */
    public $Requested3DSVersion;

    /**
     * PaymentType {CARD, BANK_WIRE, DIRECT_DEBIT, PAYPAL, PAYCONIQ }
     * @var string
     */
    public $PaymentType;

    /**
     * One of PayInPaymentDetails implementations, depending on $PaymentType
     * @var object
     */
    public $PaymentDetails;

    /**
     * ExecutionType { WEB, TOKEN, DIRECT, PREAUTHORIZED, RECURRING_ORDER_EXECUTION }
     * @var string
     */
    public $ExecutionType;

    /**
     * One of PayInExecutionDetails implementations, depending on $ExecutionType
     * @var object
     */
    public $ExecutionDetails;

    /**
     * Recurring PayIn Registration Id
     * @var string
     */
    public $RecurringPayinRegistrationId;

    /**
     * The IP address of the end user initiating the transaction, in IPV4 or IPV6 format.
     * @var string
     */
    public $IpAddress;

    /**
     * Information about the browser used by the end user (author) to perform the payment.
     * @var BrowserInfo
     */
    public $BrowserInfo;

    /**
     * Information about the end user billing address. If left empty, the default values will be automatically taken into account.
     * Default values: FirstName, LastName, and Address information of the Shipping object if any, otherwise the user (author).
     * @var Billing
     */
    public $Billing;

    /**
     * Information about the end user’s shipping address. If left empty, the default values will be automatically taken into account.
     * Default values: FirstName, LastName, and Address information of the Billing object, if supplied, otherwise of the user (author).
     * @var Shipping
     */
    public $Shipping;

    /**
     * Allowed values: ECommerce (default), TelephoneOrder
     *
     * The channel through which the user provided their card details, used to indicate mail-order and telephone-order (MOTO) payments.
     * @var string
     */
    public $PaymentCategory;

    /**
     * Get array with mapping which property depends on other property
     * @return array
     */
    public function GetDependsObjects()
    {
        return [
            'PaymentType' => [
                '_property_name' => 'PaymentDetails',
                PayInPaymentType::Card => '\MangoPay\PayInPaymentDetailsCard',
                PayInPaymentType::Preauthorized => '\MangoPay\PayInPaymentDetailsPreAuthorized',
                PayInPaymentType::BankWire => '\MangoPay\PayInPaymentDetailsBankWire',
                PayInPaymentType::DirectDebit => '\MangoPay\PayInPaymentDetailsDirectDebit',
                PayInPaymentType::DirectDebitDirect => '\MangoPay\PayInPaymentDetailsDirectDebitDirect',
                PayInPaymentType::PayPal => '\MangoPay\PayInPaymentDetailsPaypal',
                PayInPaymentType::ApplePay => 'MangoPay\PayInPaymentDetailsApplePay',
                PayInPaymentType::GooglePay => 'MangoPay\PayInPaymentDetailsGooglePay',
                PayInPaymentType::GooglePayV2 => 'MangoPay\PayInPaymentDetailsGooglePay',
                PayInPaymentType::Payconiq => 'MangoPay\PayInPaymentDetailsPayconiq',
                PayInPaymentType::Mbway => 'MangoPay\PayInPaymentDetailsMbway',
                PayInPaymentType::Multibanco => 'MangoPay\PayInPaymentDetailsMultibanco',
                PayInPaymentType::Satispay => 'MangoPay\PayInPaymentDetailsSatispay',
                PayInPaymentType::Blik => 'MangoPay\PayInPaymentDetailsBlik',
                PayInPaymentType::Klarna => 'MangoPay\PayInPaymentDetailsKlarna',
                PayInPaymentType::Ideal => 'MangoPay\PayInPaymentDetailsIdeal',
                PayInPaymentType::Giropay => 'MangoPay\PayInPaymentDetailsGiropay',
                PayInPaymentType::Bancontact => 'MangoPay\PayInPaymentDetailsBancontact',

                // ...and more in future...
            ],
            'ExecutionType' => [
                '_property_name' => 'ExecutionDetails',
                PayInExecutionType::Web => '\MangoPay\PayInExecutionDetailsWeb',
                PayInExecutionType::Direct => '\MangoPay\PayInExecutionDetailsDirect',
                PayInExecutionType::ExternalInstruction => '\MangoPay\PayInExecutionDetailsExternalInstruction',
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
        array_push($properties, 'ExecutionType');

        return $properties;
    }
}
