<?php

namespace MangoPay;

/**
 * UBO Declaration entity.
 */
class UboDeclaration extends Libraries\EntityBase
{
    /**
     * The Declaration process date.
     * @var int Unix timestamp, Date of the process
     */
    public $ProcessedDate;

    /**
     * Declaration status.
     * @var string
     * @see \MangoPay\UboDeclarationStatus
     */
    public $Status;

    /**
     * The output status of Declaration status.
     * @var string
     */
    public $OutputStatus;

    /**
     * List of reasons why the declaration was refused.
     * @var string
     * @see \MangoPay\UboDeclarationRefusedOrIncompleteReasonType
     */
    public $Reason;

    /**
     * Explanation of why the declaration was refused.
     * @var string
     */
    public $Message;

    /**
     * The id of the user
     * @var string
     */
    public $UserId;

    /**
     * Listed representations of natural users declared as UBOs.
     * When transmitting a UBO declaration (POST / PUT), must be an array of
     * IDs (string) of the users to be declared as UBOs.
     * In a received UBO declaration (GET), will be an array of representations
     * of the natural users declared as UBOs (\MangoPay\Ubo).
     * @var Ubo[]
     */
    public $Ubos;

    public function GetReadOnlyProperties()
    {
        $readOnly = parent::GetReadOnlyProperties();

        array_push($readOnly, "ProcessedDate");
        array_push($readOnly, "Reason");
        array_push($readOnly, "Message");

        return $readOnly;
    }

    public function GetSubObjects()
    {
        $subObjects = parent::GetSubObjects();
        $subObjects['Ubos'] = '\MangoPay\Ubo';
        return $subObjects;
    }
}
