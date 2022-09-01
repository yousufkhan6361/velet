<?php
if(array_filled($result)){
    foreach($result as $key=>$value):?>
        <option value="<?php echo $key?>"><?php echo $value?></option>
    <? endforeach;
}
?>