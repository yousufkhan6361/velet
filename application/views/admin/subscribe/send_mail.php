<?global $config;
$model_heads = explode("," , $dt_params['dt_headings'] );
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i><?=humanize($class_name)?>
                    <small>Send Email </small>

                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="cmxform form-horizontal tasi-form" id="banner-form-id" method="post" action="<?=g('base_url')?>admin/subscribe/send_mail" enctype="multipart/form-data" novalidate="novalidate">
                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-2 ">
                                    Subject<span class="required">* </span>
                                </label>
                                <div class="col-md-3">
                                    <input class=" form-control " id="subject" name="subject" type="text" value="">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-md-2 ">
                                    Description<span class="required">* </span>
                                </label>
                                <div class="col-md-8">
                                    <textarea class=" form-control " name="message" rows="15" cols="30"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" name="submit" value="Send" class="btn green">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <!-- END FORM-->
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        Metronic.init(); // init metronic core components
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        UIAlertDialogApi.init(); //UI Alert API
        <?if(isset($error))
            echo "AdminToastr.error('".str_replace("\n","",validation_errors('<div>', '</div></br>'))."');";
        ?>
    });
</script>

