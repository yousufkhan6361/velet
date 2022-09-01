<?php
if(array_filled($result)){
    foreach($result as $key=>$value):
        // For Online store
        if(empty($value['size_no_adshare'])){?>
            <option value="<?php echo $value['size_id']?>" data-adshare="<?php echo $value['size_no_adshare'];?>"><?php echo $value['size_name']?></option>
        <?}
        // Create adshare
        else{?>
            <option value="<?php echo $value['size_id']?>" data-adshare="<?php echo $value['size_no_adshare'];?>"><?php echo $value['size_name'] . " - (" . $value['size_no_adshare']. " Adshares)"?></option>
        <?}
        ?>
    <? endforeach;
}
?>