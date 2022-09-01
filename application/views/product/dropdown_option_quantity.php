<?php
if(array_filled($result)){
    foreach($result as $key=>$value):?>
        <option value="<?php echo $value['quantity_id']?>"><?php echo $value['quantity_qty'] . " - $" . $value['quantity_cost']?></option>
    <? endforeach;
}
?>