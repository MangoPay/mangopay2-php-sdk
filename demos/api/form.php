<?php
namespace MangoPay\Demo;
require_once '../../vendor/autoload.php';
require_once 'htmlHelper.php';
require_once 'config.php';

$module = @$_GET['module'];
if (!isset($module))
    return;

HtmlHelper::getHeader($module);

$details = explode('_', $module);
$entityName = @$details[0];
$subApiName = @$details[1];
$operation = @$details[2];
$subEntityName = @$details[3];
$filterName = @$details[4];
$subSubEntityName = @$details[5];
$entityId = (int)@$_POST['Id'];
$subEntityId = (int)@$_POST['IdSubEntity'];

if (isset($_POST['_postback']) && $_POST['_postback'] == '1') {

    try {
        $api = new \MangoPay\MangoPayApi();
        $api->Config->ClientId = MangoPayDemo_ClientId;
        $api->Config->ClientPassword = MangoPayDemo_ClientPassword;
        $api->Config->TemporaryFolder = MangoPayDemo_TemporaryFolder;

        $module = @$_GET['module'];
        if (isset($module) && strpos($module, '$Sort') !== false) {
            if (isset($_POST["_sort_"]) && !empty($_POST["_sort_"])){
                $sortFields = explode(":", $_POST["_sort_"]);
                $sortFieldName = @$sortFields[0];
                $sortDirection = @$sortFields[1];
                $sorting = new \MangoPay\Tools\Sorting();
                $sorting->AddField($sortFieldName, $sortDirection);
            }
        }

        // normal cases
        switch ($operation) {
            case 'Create':
                $entity = HtmlHelper::getEntity($entityName);
                $apiResult = $api->$subApiName->Create($entity);
                break;
            case 'Get':
                $apiResult = $api->$subApiName->Get($entityId);
                break;
            case 'Save':
                $entity = HtmlHelper::getEntity($entityName, $entityId);
                $apiResult = $api->$subApiName->Update($entity);
                break;
            case 'All':
                $pagination = HtmlHelper::getEntity('Types\\Pagination');
                $filter = null;
                if (isset($filterName) && $filterName != "")
                    $filter = HtmlHelper::getEntity($filterName);

                if (isset($filter) && !isset($sorting))
                    $apiResult = $api->$subApiName->GetAll($pagination, $filter);
                else if (!isset($filter) && isset($sorting))
                    $apiResult = $api->$subApiName->GetAll($pagination, $sorting);
                else if (isset($filter) && isset($sorting))
                    $apiResult = $api->$subApiName->GetAll($pagination, $filter, $sorting);
                else
                    $apiResult = $api->$subApiName->GetAll($pagination);

                print '<pre>';print_r($pagination);print '</pre>';
                if (isset($sorting))
                    print '<pre>Sort: ';print_r($_POST["_sort_"]);print '</pre>';

                break;
            case 'CreateSubEntity':
                $entity = HtmlHelper::getEntity($subEntityName);
                $methodName = 'Create'. $subEntityName;
                $apiResult = $api->$subApiName->$methodName($entityId, $entity);
                break;
            case 'CreateSubSubEntity':
                $entity = HtmlHelper::getEntity($subEntityName);
                $methodName = 'Create' . $subEntityName;
                $apiResult = $api->$subApiName->$methodName($entityId, $subEntityId, $entity);
                break;
            case 'GetSubEntity':
                $methodName = 'Get' . $subEntityName;
                $apiResult = $api->$subApiName->$methodName($entityId, $subEntityId);
                break;
            case 'SaveSubEntity':
                $entity = HtmlHelper::getEntity($subEntityName);
                $methodName = 'Update' . $subEntityName;
                $apiResult = $api->$subApiName->$methodName($subEntityId, $entity);
                break;
            case 'ListSubEntity':
                $pagination = HtmlHelper::getEntity('Types\\Pagination');
                $methodName = $subEntityName;
                $filter = null;
                if (isset($filterName) && $filterName != "")
                    $filter = HtmlHelper::getEntity($filterName);

                if (isset($filter) && !isset($sorting))
                    $apiResult = $api->$subApiName->$methodName($entityId, $pagination, $filter);
                else if (!isset($filter) && isset($sorting))
                    $apiResult = $api->$subApiName->$methodName($entityId, $pagination, $sorting);
                else if (isset($filter) && isset($sorting))
                    $apiResult = $api->$subApiName->$methodName($entityId, $pagination, $filter, $sorting);
                else
                    $apiResult = $api->$subApiName->$methodName($entityId, $pagination);

                print '<pre>';print_r($pagination);print '</pre>';
                if (isset($sorting))
                    print '<pre>Sort: ';print_r($_POST["_sort_"]);print '</pre>';

                break;
            case 'CreateKycPageByFile':
                $apiResult = $api->$subApiName->CreateKycPageFromFile($entityId, $subEntityId, $_FILES['kyc_page']);
                break;
        }

        print '<pre>';print_r($apiResult);print '</pre>';

    } catch (\MangoPay\Types\Exceptions\ResponseException $e) {

        echo '<div style="color: red;">\MangoPay\Types\Exceptions\ResponseException: Code: ' . $e->getCode();
        echo '<br/>Message: ' . $e->getMessage();

       $details = $e->GetErrorDetails();
        if (!is_null($details))
            echo '<br/><br/>Details: '; print_r($details);
        echo '</div>';

    } catch (\MangoPay\Types\Exceptions\Exception $e) {

        echo '<div style="color: red;">\MangoPay\Types\Exceptions\Exception: ' . $e->getMessage() . '</div>';

    }

} else {
    HtmlHelper::renderForm($entityName, $operation, array($subEntityName, $subSubEntityName), $filterName);
}
