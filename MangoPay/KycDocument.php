<?php

namespace MangoPay;

/**
 * KYC document entity.
 */
class KycDocument extends Libraries\Document
{
    /**
     * The type of the document for the user verification.
     *
     * @var string
     *
     * @see \MangoPay\KycDocumentType
     * @see https://mangopay.com/docs/endpoints/kyc-documents#kyc-document-object
     */
    public $Type;

    /**
     * The label of KYC document type.
     *
     * @var string
     * @phpstan-var \MangoPay\KycDocumentStatus::*
     */
    public $TypeLabel;

    /**
     * The status of the KYC document.
     *
     * @var string
     *
     * @see KycDocumentStatus
     */
    public $Status;

    /**
     * The label of KYC document status.
     *
     * @var string
     */
    public $StatusLabel;

    /**
     * The unique identifier of the user.
     *
     * @var string
     */
    public $UserId;

    /**
     * The series of codes providing more precision regarding the reason why the identity proof document was refused.
     * You can review the explanations for each code in the Flags list.
     *
     * @var array
     *
     * @see KycDocumentRefusedReasonType
     * @see https://mangopay.com/docs/concepts/users/verification/document-process#flags-list
     */
    public $Flags;
}
