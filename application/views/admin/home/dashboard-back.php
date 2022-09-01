<?global $config;?>
<div class="row">
	<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-v2 blue">
			<div class="visual">
				<i class="fa fa-users"></i>
			</div>
			<div class="details">
				<div class="number">
                    <span data-counter="counterup" data-value="<?/*=$total_members*/?>" class="counterup"><?/*=$total_members*/?></span>
				</div>
				<div class="desc">
                    Members
				</div>
			</div>
			<a class="more" href="<?/*=g('base_url')*/?>admin/signup">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>-->
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-v2 red">
			<div class="visual">
				<i class="fa fa-cubes"></i>
			</div>
			<div class="details">
				<div class="number">
                    <span data-counter="counterup" data-value="<?=$unread_inquiry?>" class="counterup"><?=$unread_inquiry?></span>
				</div>
				<div class="desc">
                    Pending Inquiries
				</div>
			</div>
			<a class="more" href="<?=g('base_url')?>admin/inquiry">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-v2 purple">
			<div class="visual">
				<i class="fa fa-id-badge"></i>
			</div>
			<div class="details">
				<div class="number">
                    <span data-counter="counterup" data-value="<?=$subscribe?>" class="counterup"><?=$subscribe?></span>
				</div>
				<div class="desc">
                    Subscribe
				</div>
			</div>
			<a class="more" href="<?=g('base_url')?>admin/subscribe">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-v2 red-intense">
			<div class="visual">
				<i class="fa fa-id-badge"></i>
			</div>
			<div class="details">
				<div class="number">
                    <span data-counter="counterup" data-value="<?/*=number_format($total_company)*/?>"><?/*=number_format($total_company)*/?></span>
				</div>
				<div class="desc">
                    Company
				</div>
			</div>
			<a class="more" href="<?/*=g('base_url')*/?>admin/company">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>-->

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-center">
              <h1 style="margin-top:60px;font-size: 60px;">Welcome To <?php echo g('admin_title')?></h1>
        </div>
    </div>


</div>
<!-- END DASHBOARD STATS -->
<div class="clearfix">
</div>

<script>
    $('.counterup').each(function () {
        var $this = $(this);
        jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
            duration: 1000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
</script>
