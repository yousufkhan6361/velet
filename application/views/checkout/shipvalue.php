<?php
$abc = "<select>";
foreach($newArr as $key => $value)
{
    $abc .= "<option value='{$value['Service'][0]}' data-attr='{$value['Rate'][0]}'>{$value['Service'][0]}</option>";
}
$abc .= "</select>";

echo $abc;
?>