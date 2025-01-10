<?php

namespace MangoPay;

/**
 * Manages API calls for the UBO declaration entity.
 */
class ApiUboDeclarations extends Libraries\ApiBase
{
    /**
     * Creates a new UBO Declaration for an user.
     * @param string $userId The ID of the user
     * @return \MangoPay\UboDeclaration|array|object UBO Declaration object returned from API
     */
    public function Create($userId)
    {
        return $this->CreateObject('ubo_declaration_create', null, '\MangoPay\UboDeclaration', $userId);
    }

    /**
     * Gets all UBO Declarations for an user.
     * @param string $userId The ID of the user
     * @param \MangoPay\Pagination $pagination Pagination object
     * @param \MangoPay\Sorting $sorting Sorting object
     * @return \MangoPay\UboDeclaration[]|array List of UBO Declarations returned from API
     * @throws \MangoPay\Libraries\Exception
     */
    public function GetAll($userId, $pagination = null, $sorting = null)
    {
        return $this->GetList("ubo_declaration_all", $pagination, '\MangoPay\UboDeclaration', $userId, null, $sorting);
    }

    /**
     * Gets an UBO Declaration.
     * @param string $userId The ID of the user
     * @param string $uboDeclarationId UBO Declaration identifier
     * @return UboDeclaration|array|object UBO Declaration object returned from API
     * @throws \MangoPay\Libraries\Exception
     */
    public function Get($userId, $uboDeclarationId)
    {
        return $this->GetObject('ubo_declaration_get', '\MangoPay\UboDeclaration', $userId, $uboDeclarationId);
    }

    /**
     * Gets an UBO Declaration directly by Id.
     * @param string $uboDeclarationId UBO Declaration identifier
     * @return UboDeclaration|array|object UBO Declaration object returned from API
     */
    public function GetById($uboDeclarationId)
    {
        return $this->GetObject('ubo_declaration_get_by_id', '\MangoPay\UboDeclaration', $uboDeclarationId);
    }

    /**
     * Creates a new UBO for the specified arguments
     * @param string $userId The ID of the user
     * @param string $uboDeclarationId The ID of the UBO declaration
     * @param Ubo $ubo The UBO object to be created
     * @return Ubo|array|object UBO object returned from API
     * @throws \MangoPay\Libraries\ResponseException
     */
    public function CreateUbo($userId, $uboDeclarationId, $ubo)
    {
        if (is_null($uboDeclarationId) or empty($uboDeclarationId)) {
            throw new \MangoPay\Libraries\ResponseException('Parameter uboDeclarationId is empty', 400);
        }
        return $this->SaveObject('ubo_create', $ubo, '\MangoPay\Ubo', $userId, $uboDeclarationId);
    }

    /**
     * Updates an UBO
     * @param string $userId The ID of the user
     * @param string $uboDeclarationId The ID of the UBO declaration
     * @param Ubo $ubo The UBO object to be updated
     * @return Ubo|array|object UBO object returned from API
     */
    public function UpdateUbo($userId, $uboDeclarationId, $ubo)
    {
        return $this->SaveObject('ubo_update', $ubo, '\MangoPay\Ubo', $userId, $uboDeclarationId);
    }

    /**
     * Gets an UBO
     * @param string $userId The ID of the user
     * @param string $uboDeclarationId The ID of the UBO declaration
     * @param string $uboId The ID of the UBO
     * @return \MangoPay\Ubo|array|object UBO object returned from API
     * @throws \MangoPay\Libraries\Exception
     */
    public function GetUbo($userId, $uboDeclarationId, $uboId)
    {
        return $this->GetObject('ubo_get', '\MangoPay\Ubo', $userId, $uboDeclarationId, $uboId);
    }

    /**
     * Updates an UBO Declaration with the status <code>VALIDATION_ASKED</code>.
     * @param string $userId The ID of the user
     * @param string $uboDeclarationId The ID of the UBO declaration
     * @return \MangoPay\UboDeclaration|array|object
     */
    public function SubmitForValidation($userId, $uboDeclarationId)
    {
        $entity = new UboDeclaration();
        $entity->Id = $uboDeclarationId;
        $entity->Status = UboDeclarationStatus::ValidationAsked;
        return $this->SaveObject('ubo_declaration_submit', $entity, '\MangoPay\UboDeclaration', $userId);
    }

    /**
     * Gets an UBO Declaration.
     * @param string $uboDeclarationId UBO Declaration identifier
     * @return \MangoPay\UboDeclaration|array|object UBO Declaration object returned from API
     * @throws \MangoPay\Libraries\Exception
     * @throws \Exception
     */
    public function GetUboDeclarationById($uboDeclarationId)
    {
        return $this->GetObject('ubo_declaration_get_by_id', '\MangoPay\UboDeclaration', $uboDeclarationId);
    }
}
