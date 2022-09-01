<!-- Begin: Accorion Menu -->
<?php 
// Get Insta List media
//$insta_feeds = $this->model_instagram->get_media();

//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,'https://www.instagram.com/100belowglass/?__a=1');
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
$list = json_decode($result, true);
$insta_media = $list['graphql']['user']['edge_owner_to_timeline_media'];

// CHeck records exist
//if(array_filled($insta_feeds)){?>
<!-- <section class="accorionStle"> -->

<script src="<?php echo g('js_root');?>jquery.fancybox.v2.instagram.js"></script>
<link rel="stylesheet" href="<?php echo g('css_root');?>jquery.fancybox.v2.instagram.css" />

    <div class="for_heading">
        <section class="insta-sec inner_pages">
            <div class="container">
                <div class="row CarePackg">
                    <div class="main_heading heading_two">
                        <h1>#100belowglass</h1>
                    </div>
                </div>
            </div>

            <?php
            if($insta_media['count']>0){
                $media = $insta_media['edges'];
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        foreach ($media as $key=>$value):
                            $node = $value['node'];
                            ?>

                            <div class="col-md-3">
                                <div class="product insta-border">
                                    <a href="<?php echo $node['thumbnail_src'];?>" data-fancybox="quick-view-<?php echo $key;?>" data-type="image">
                                        <img src="<?php echo $node['display_url'];?>" class="img-responsive" alt="image" />
                                    </a>

                                    <div class="product-form">
                                        <h3><?php echo g('site_name');?></h3>
                                        <label for=""><?php echo date('Y-m-d',$node['taken_at_timestamp']);?></label>
                                        <p><?php echo $node['edge_media_to_caption']['edges'][0]['node']['text'];?></p>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach;
                        ?>

                    </div>
                </div>
            <?php }
            ?>
        </section>
    </div>
<?php //}

?>
                
<!-- END: Accorion Menu -->

<script>
    $('[data-fancybox^="quick-view"]').fancybox({
        animationEffect   : "fade",
        animationDuration : 300,
        margin : 0,
        gutter : 0,
        touch  : {
            vertical: false
        },
        baseTpl	:
            '<div class="fancybox-container" role="dialog" tabindex="-1">' +
            '<div class="fancybox-bg"></div>' +
            '<div class="fancybox-inner">' +
            '<div class="fancybox-stage"></div>' +
            '<div class="fancybox-form-wrap">' +
            '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' +
            '<svg viewBox="0 0 40 40">' +
            '<path d="M10,10 L30,30 M30,10 L10,30" />' +
            '</svg>' +
            '</button></div>' +
            '</div>' +
            '</div>',
        onInit: function(instance) {

            /*

                #1 Add product form
                ===================

            */

            // Find current form element ..
            var current = instance.group[instance.currIndex];
            instance.$refs.form = current.opts.$orig.parent().find('.product-form');

            // .. and move to the container
            instance.$refs.form.appendTo( instance.$refs.container.find('.fancybox-form-wrap') );

            /*

                #2 Create bullet navigation links
                =================================

            */
            var list = '',
                $bullets;

            for ( var i = 0; i < instance.group.length; i++ ) {
                list += '<li><a data-index="' + i + '" href="javascript:;"><span>' + ( i + 1 ) + '</span></a></li>';
            }

            $bullets = $( '<ul class="product-bullets">' + list + '</ul>' ).on('click touchstart', 'a', function() {
                var index = $(this).data('index');

                $.fancybox.getInstance(function() {
                    this.jumpTo( index );
                });

            });

            instance.$refs.bullets = $bullets.appendTo( instance.$refs.stage );

        },
        beforeShow : function( instance ) {

            // Mark current bullet navigation link as active
            instance.$refs.stage.find('ul:first')
                .children()
                .removeClass('active')
                .eq( instance.currIndex )
                .addClass('active');

        },
        afterClose: function(instance, current) {

            // Move form back to the place
            instance.$refs.form.appendTo( current.opts.$orig.parent() );

        }
    });
</script>