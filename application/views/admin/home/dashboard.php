<?global $config;?>
<!--<div class="row">

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat dashboard-stat-v2 red">
			<div class="visual">
				<i class="fa fa-cubes"></i>
			</div>
			<div class="details">
				<div class="number">
                    <span data-counter="counterup" data-value="<?/*=$unread_inquiry*/?>" class="counterup"><?/*=$unread_inquiry*/?></span>
				</div>
				<div class="desc">
                    Pending Inquiries
				</div>
			</div>
			<a class="more" href="<?/*=g('base_url')*/?>admin/inquiry">
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
                    <span data-counter="counterup" data-value="<?/*=$subscribe*/?>" class="counterup"><?/*=$subscribe*/?></span>
				</div>
				<div class="desc">
                    Subscribe
				</div>
			</div>
			<a class="more" href="<?/*=g('base_url')*/?>admin/subscribe">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-center">
              <h1 style="margin-top:60px;font-size: 60px;">Welcome To <?php /*echo g('admin_title')*/?></h1>
        </div>
    </div>


</div>-->

<!-- Dashboard Title start -->
<div class="row">
    <div class="col-md-12">
        <div class="inner-page-header">
            <h1>Dashboard <small>overview &amp; stats </small></h1>
        </div>
    </div>
</div>
<!-- Dashboard Title end -->

<!-- Blocks start -->
<div class="col_3">
    <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
            <i class="fa fa-mail-forward"></i>
            <div class="stats">
                <h5 data-counter="counterup" data-value="<?php echo $unread_inquiry;?>" class="counterup"><?php echo $unread_inquiry;?></h5>
                <div class="grow">
                    <p>Inquiry</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
            <i class="fa fa-users"></i>
            <div class="stats">
                <h5 data-counter="counterup" data-value="<?php echo $total_members;?>" class="counterup"><?php echo $total_members;?> </h5>
                <div class="grow grow1">
                    <p>Users</p>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="col-md-3 widget widget1">
        <div class="r3_counter_box">
            <i class="fa fa-eye"></i>
            <div class="stats">
                <h5>70 <span>%</span></h5>
                <div class="grow grow3">
                    <p>Visitors</p>
                </div>
            </div>
        </div>
    </div>-->
    <!--<div class="col-md-3 widget">
        <div class="r3_counter_box">
            <i class="fa fa-usd"></i>
            <div class="stats">
                <h5>70 <span>%</span></h5>
                <div class="grow grow2">
                    <p>Profit</p>
                </div>
            </div>
        </div>
    </div>-->
    <div class="clearfix"> </div>
</div>
<!-- Blocks end -->

<!-- Welcome title start -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="text-center">
          <h1 style="margin-top:60px;margin-bottom: 85px;font-size: 60px;">Welcome To <?php echo g('admin_title')?></h1>
    </div>
</div>
<!-- Welcome title end -->

<!-- start: FULL CALENDAR and User Agent PANEL -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-calendar"></i> Calendar
            </div>
            <div class="panel-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <!-- User stats -->
    <div class="m-b-2">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-user"></i> Users
                </div>
                <div class="panel-body">
                    <div class="hide-trial"></div>
                    <div class="card card-block">
                        <div id="users-device-doughnut-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User stats -->
</div>
<!-- End: FULL CALENDAR and User Agent PANEL -->

<!-- start: Subscriber chart -->
<!--<div class="row">
    <div class="m-b-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-user"></i> Subscribers
                </div>
                <div class="panel-body">
                    <div class="card shadow">
                        <div class="card-block">
                            <div class="hide-trial-subscriber"></div>
                            <div id="revenue-column-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- end: Subscriber chart -->

<!-- start: Inquiry chart -->
<div class="row">
    <div class="m-b-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-user"></i> Inquires
                </div>
                <div class="panel-body">
                    <div class="card shadow">
                        <div class="card-block">
                            <div class="hide-trial-subscriber"></div>
                            <div id="revenue-column-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: Inquiry chart -->

<!-- end: FULL CALENDAR PANEL -->

<!-- END DASHBOARD STATS -->
<div class="clearfix"></div>


<!-- Event modal start -->
<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Event Management</h4>
            </div>
            <div class="modal-body">
                Widget settings form goes here
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-light-grey">
                    Close
                </button>
                <button type="button" class="btn btn-danger remove-event no-display">
                    <i class='fa fa-trash-o'></i> Delete Event
                </button>
                <button type='submit' class='btn btn-success save-event'>
                    <i class='fa fa-check'></i> Save
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Event modal end -->

<?php
// Set year
$year = date('Y');
// Set all months data
if(array_filled($inquiries)){
    $months_data = array_column($inquiries,'month');
    // Remove 0 key name.
    array_unshift($months_data,"");
    unset($months_data[0]);

    $jan = (array_search('1',$months_data)) ? $inquiries[array_search('1',$months_data)-1]['count'] : 0;
    $feb = (array_search('2',$months_data)) ? $inquiries[array_search('2',$months_data)-1]['count'] : 0;
    $mar = (array_search('3',$months_data)) ? $inquiries[array_search('3',$months_data)-1]['count'] : 0;
    $apr = (array_search('4',$months_data)) ? $inquiries[array_search('4',$months_data)-1]['count'] : 0;
    $may = (array_search('5',$months_data)) ? $inquiries[array_search('5',$months_data)-1]['count'] : 0;
    $jun = (array_search('6',$months_data)) ? $inquiries[array_search('6',$months_data)-1]['count'] : 0;
    $jul = (array_search('7',$months_data)) ? $inquiries[array_search('7',$months_data)-1]['count'] : 0;
    $aug = (array_search('8',$months_data)) ? $inquiries[array_search('8',$months_data)-1]['count'] : 0;
    $sep = (array_search('9',$months_data)) ? $inquiries[array_search('9',$months_data)-1]['count'] : 0;
    $oct = (array_search('10',$months_data)) ? $inquiries[array_search('10',$months_data)-1]['count'] : 0;
    $nov = (array_search('11',$months_data)) ? $inquiries[array_search('11',$months_data)-1]['count'] : 0;
    $dec = (array_search('12',$months_data)) ? $inquiries[array_search('12',$months_data)-1]['count'] : 0;
}
else{
    $jan = 0;
    $feb = 0;
    $mar = 0;
    $apr = 0;
    $may = 0;
    $jun = 0;
    $jul = 0;
    $aug = 0;
    $sep = 0;
    $oct = 0;
    $nov = 0;
    $dec = 0;
}
?>

<script>
    $(function () {

        // CanvasJS column chart to show revenue from Jan 2015 - Dec 2015
        var revenueColumnChart = new CanvasJS.Chart("revenue-column-chart", {
            animationEnabled: true,
            backgroundColor: "transparent",
            theme: "theme2",
            axisX: {
                labelFontSize: 14,
                valueFormatString: "MMM YYYY"
            },
            axisY: {
                labelFontSize: 14,
                prefix: ""
            },
            toolTip: {
                borderThickness: 0,
                cornerRadius: 0
            },
            data: [
                {
                    type: "column",
                    yValueFormatString: "###,###.##",
                    dataPoints: [
                        { x: new Date('Jan <?php echo $year;?>'), y: <?php echo $jan;?> },
                        { x: new Date('Feb <?php echo $year;?>'), y: <?php echo $feb;?> },
                        { x: new Date('Mar <?php echo $year;?>'), y: <?php echo $mar;?> },
                        { x: new Date('Apr <?php echo $year;?>'), y: <?php echo $apr;?> },
                        { x: new Date('May <?php echo $year;?>'), y: <?php echo $may;?> },
                        { x: new Date('Jun <?php echo $year;?>'), y: <?php echo $jun;?> },
                        { x: new Date('Jul <?php echo $year;?>'), y: <?php echo $jul;?> },
                        { x: new Date('Aug <?php echo $year;?>'), y: <?php echo $aug;?> },
                        { x: new Date('Sep <?php echo $year;?>'), y: <?php echo $sep;?> },
                        { x: new Date('Oct <?php echo $year;?>'), y: <?php echo $oct;?> },
                        { x: new Date('Nov <?php echo $year;?>'), y: <?php echo $nov;?> },
                        { x: new Date('Dec <?php echo $year;?>'), y: <?php echo $dec;?> }
                    ]
                }
            ]
        });

        revenueColumnChart.render();

    });

    // Box counter animate
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

    // Set calendar events
    var calendar_event = <?php echo json_encode($events);?>;

    // Set User Widget variable
    var activeUsers = '<?php echo $agent['user_counts'];?>';
    var desktopUsers = '<?php echo $agent['desk_users'];?>';
    var mobileUsers = '<?php echo $agent['mob_users'];?>';
    // Use real-time.js

</script>