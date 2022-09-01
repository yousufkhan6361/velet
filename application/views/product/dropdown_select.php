<?php
// Print Page
if(array_filled($print_page)){?>
    <select name="adshare[adshare_print_page]" class="extra-options" data-model="print_page" data-last-selection="0">
        <option value="">Select Print Page</option>
        <?foreach($print_page as $key=>$value):?>
            <option value="<?php echo $key?>"><?php echo $value?></option>
        <? endforeach;?>
    </select>

<?}
// Print Speed
if(array_filled($print_speed)){?>
    <select name="adshare[adshare_printing_speed]" class="extra-options" data-model="print_speed" data-last-selection="0">
        <option value="">Select Print Speed</option>
        <?foreach($print_speed as $key=>$value):?>
            <option value="<?php echo $key?>"><?php echo $value?></option>
        <? endforeach;?>
    </select>

<?}
// Print Side
if(array_filled($print_side)){?>
    <select name="adshare[adshare_print_side]" class="extra-options" data-model="print_side" data-last-selection="0">
        <option value="">Select Print Side</option>
        <?foreach($print_side as $key=>$value):?>
            <option value="<?php echo $value['print_side_id']?>"><?php echo $value['print_side_name'] . '- $' . $value['print_side_cost']?></option>
        <? endforeach;?>
    </select>

<?}
// Paper Finish
if(array_filled($paper_finish)){?>
    <select name="adshare[adshare_paper_finish]" class="extra-options" data-model="paper_finish" data-last-selection="0">
        <option value="">Select Paper Finish</option>
        <?foreach($paper_finish as $key=>$value):?>
            <option value="<?php echo $value['paper_finish_id'];?>"><?php echo $value['paper_finish_name'] . '- $' . $value['paper_finish_cost'];?></option>
        <? endforeach;?>
    </select>

<?}
// Paper Type
if(array_filled($paper_type)){?>
    <select name="adshare[adshare_paper_type]" class="extra-options" data-model="paper_type" data-last-selection="0">
        <option value="">Select Paper Type</option>
        <?foreach($paper_type as $key=>$value):?>
            <option value="<?php echo $key?>"><?php echo $value?></option>
        <? endforeach;?>
    </select>

<?}
// Round Corner
if(array_filled($round_corner)){?>
    <select name="adshare[adshare_round_corner]" class="extra-options" data-model="round_corner" data-last-selection="0">
        <option value="">Folding</option>
        <?foreach($round_corner as $key=>$value):?>
            <option value="<?php echo $value['round_corner_id'];?>"><?php echo $value['round_corner_name'] . '- $' . $value['round_corner_cost'];?></option>
        <? endforeach;?>
    </select>

<?}
// Digital Proof
if(array_filled($digital_proof)){?>
    <select name="adshare[adshare_digital_proof]" class="extra-options" data-model="digital_proof" data-last-selection="0">
        <option value="">Select Digital Proof</option>
        <?foreach($digital_proof as $key=>$value):?>
            <option value="<?php echo $key?>"><?php echo $value?></option>
        <? endforeach;?>
    </select>

<?}
// Extra Options
if(array_filled($extra_option)){?>
    <select name="adshare[adshare_extra_option]" class="extra-options" data-model="extra_option" data-last-selection="0">
        <option value="">Select Extra Option</option>
        <?foreach($extra_option as $key=>$value):?>
            <option value="<?php echo $key?>"><?php echo $value?></option>
        <? endforeach;?>
    </select>

<?}
// No. of adshare
//if(array_filled()){?>
    <!--<select name="adshare[adshare_print_page]" class=extra-options" datamodeli=">
        <?/*foreach($extra_option as $key=>$value):*/?>
            <option value="<?php /*echo $key*/?>"><?php /*echo $value*/?></option>
        <?/* endforeach;*/?>
    </select>-->

<? //} ?>

