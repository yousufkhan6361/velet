<script>
    var is_login = '<?php echo $this->userid;?>';
    $('.btn-fav').on('click', function () {
        if(is_login>0){
            // Get action and form data
            var id = $(this).attr('data-id');
            //var cid = $(this).attr('data-cid');
            //var data = {fav_vid_id:vid, fav_cat_id:cid};
            var data = {id:id};
            var url = base_url + 'favorite/store';

            Loader.show();
            setTimeout(function () {
                // Submit action
                var response = AjaxRequest.fire(url, data);
                // Register success
                if (response.status) {
                    // Reset form
                }
            },1000);
        }
        else{
            AdminToastr.error('Login required', 'Error');
        }

        return false;
    });
</script>