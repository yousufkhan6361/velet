<!-- Confirmation modal start -->
<div class="acces_modal">
    <div class="modal fade" id="myModal_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Review</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <p>It look like you already taken this practice test do you want to review the test or retake the test? </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" onclick="document.getElementById('form-summary').submit(); return false" class="button_1" data-dismiss="modal"> Review</a>
                    <a href="javascript:void(0)" onclick="document.getElementById('form-exam').submit(); return false" class="button_1"> Retake </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<!-- Confirmation modal end -->


<form action="<?php echo g('base_url_portal');?>exam" method="post" id="form-exam">
    <input type="hidden" name="oi_id" value="<?php echo $oi_id;?>">
    <input type="hidden" name="exam_e_list_id" value="<?php echo $exam_e_list_id;?>">
</form>

<form method="post" action="<?php echo g('base_url_portal');?>summary" id="form-summary">
    <input type="hidden" name="oi_id" value="<?php echo $oi_id;?>">
    <input type="hidden" name="exam_e_list_id" value="<?php echo $exam_e_list_id;?>">
</form>

<script>

    $(document).ready(function(){
        $('#myModal_confirm').modal('show');
    });
</script>
            