<? $this->load->view('account/header_main') ?>

<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">

    <div class="content-page">

        <div class="row">
            <table id="listing-data" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?
                if(array_filled($request)){
                    foreach($request as $key=>$value):?>
                        <tr>
                            <td><?= $value['kid_id'] ?></td>
                            <td><?= $value['kid_name'] ?></td>
                            <td><?= date('Y-m-d', strtotime($value['kpr_created'])) ?></td>
                            <td>
                                <a href="javascript:void(0)" class="btn-table-action btn-view-desc" data-id="<?=$value['kpr_id']?>"><span
                                        class="glyphicon glyphicon-eye-open" aria-hidden="true" title="View""></span></a>
                                <a href="javascript:void(0)" class="btn-table-action btn-update" data-id="<?=$value['kpr_id']?>"><span
                                        class="glyphicon glyphicon-ok" aria-hidden="true" title="Done"></span></a>
                            </td>
                        </tr>
                        <?
                    endforeach;
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- END CONTENT -->

<!-- Modal start -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="viewDescModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Description</h4>
            </div>
            <div class="modal-body" id="request-description">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<? $this->load->view('account/footer_main') ?>

<script type="application/javascript">
    $(document).ready(function(){
        // Init data tables
        $('#listing-data').DataTable();

        // Onclick to show modal start
        $('.btn-view-desc').on('click',function(){
            var id = $(this).attr('data-id');
            var data = {id: id};
            var action = '<?=g('base_url')?>' + 'kid/get-profile-info';

            var response = AjaxRequest.formrequest(action, data);
            // success
            if (response.status) {
                if(response.data!=null){
                    $('#request-description').html(response.data.kpr_description);
                    $('#viewDescModal').modal('show');
                }
                else{
                    $('#request-description').html('');
                }
            }
        });
        // Onclick to show modal end

        // Onclick post update status to complete start
        $('.btn-update').on('click',function(){
            var id = $(this).attr('data-id');
            var data = {id: id};
            var action = '<?=g('base_url')?>' + 'kid/update-profile-request';

            var response = AjaxRequest.fire(action, data);
            // success
            if (response.status) {
                location.reload();
            }
        });
        // Onclicpost update status to complete modal end

    });
</script>