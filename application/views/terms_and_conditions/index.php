<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<section class="terms-section all-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h3 class="terms-intro"><?=$sec8['cms_page_name']?></h3>
					<div class="abt-content">
						<?php echo html_entity_decode($sec8['cms_page_content'])?>
					</div>
			</div>
		</div>
	</div>
	</section>