<?php
/*$data['breadcrumb_title'] = 'My Orders';
$this->load->view('widgets/breadcrumb', $data);*/
?>

<br><br><br>

<? $this->load->view('account/header_main') ?>
<!--login-banner-->

<div class="col-md-9 col-sm-7">

    <div class="content-page">

        <div class="row">
            <div class="portlet grey-cascade box">
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // / debug(order_items);exit;
                            $x=1;
                            foreach ($result as $key => $value) {
                                ?>
                                <tr>
                                    <td><?= $x; ?></td>
                                    <td><?= $value['product_name']; ?></td>
                                    <td>
                                        <?= date('d M Y', strtotime($value['favorite_createdon'])) ?>
                                    </td>

                                    <td>
                                        <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" target="_blank" class="btn btn-success" style=" margin-top: 0;">View</a>
                                    </td>

                                </tr>
                                <?php
                                $x++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 99999;">
    <div class="modal-dialog" role="document" style="width: 1300px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="color:#000;">Invoice Detail</h4>
            </div>
            <div class="modal-body" id="bodyID" style="color:#000;">

                <? $this->load->view('account/footer_main') ?>
                <!--Signup-->


                <script>
                    $('.file_download').on('click',function () {
                        var sample_url = $(this).attr('data-url');
                        window.open(sample_url, '_self');
                        return false;
                    });
                </script>