<? global $config;
$menu_links = array(
    array("title" => "Home", "icon" => "home", "action" => "home",
        "additionals" => array(
            array("link" => "", "title" => "Dashboard", "icon" => "bar-chart"),
        ),
    ),
    /*
    array("title"=>"Brides Catalog", "icon"=>"present" ,"action" => array("lookbook","trunkshows","real_brides","storelocator","press_data","collection","client") ,
        "additionals"=>array(
            array("link"=>"real_brides","title"=>"Real Brides", "icon"=>"diamond"),
            array("link"=>"storelocator","title"=>"Manage Store Locator", "icon"=>"magnifier"),
            array("link"=>"press_data","title"=>"Manage Press", "icon"=>"speech"),
            //array("link"=>"lookbook","title"=>"Manage Lookbook", "icon"=>"energy"),
            array("link"=>"trunkshows","title"=>"Manage Trunkshows", "icon"=>"energy"),
            array("link"=>"lookbook","title"=>"Manage Lookbook", "icon"=>"folder"),
            array("link"=>"collection","title"=>"Manage Collections", "icon"=>"present"),
            array("link"=>"client","title"=>"Manage Partners", "icon"=>"users"),
            //array("link"=>"category","title"=>"Manage Categories", "icon"=>"wallet"),
            //array("link"=>"package","title"=>"Manage Packages", "icon"=>"diamond"),
            //array("link"=>"feature","title"=>"Manage Features", "icon"=>"present"),
            //array("link"=>"product","title"=>"Manage Product", "icon"=>"handbag"),
        ),
    ),
    */


    array("title" => "Layout Design", "icon" => "docs", "action" => array("promotional_banner", "config", "cms_page", "faq", "logo", "news"),
        "additionals" => array(
            //array("link"=>"category/menu","title"=>"Menu Categories", "icon"=>"wallet"),
            //array("link"=>"promotional_banner","title"=>"Promotional Banners", "icon"=>"plus"),
            array("link" => "logo/add/1", "title" => "Manage Logo", "icon" => "folder"),
            array("link" => "cms_page", "title" => "Manage CMS Content", "icon" => "docs"),
            //array("link"=>"inner_banner","title"=>"Manage Inner Banner", "icon"=>"folder"),
            //array("link"=>"cms_content","title"=>"Manage PageContent", "icon"=>"speech"),
            //array("link"=>"faq","title"=>"Manage FAQ's", "icon"=>"question"),
            //array("link"=>"client","title"=>"Manage Partners", "icon"=>"users"),
            //array("link"=>"testimonial","title"=>"Manage Testimonials", "icon"=>"speech"),
            //array("link"=>"news","title"=>"Manage News", "icon"=>"note"),
            //array("link"=>"config/update","title"=>"Additional Options", "icon"=>"pencil"),
            array("link" => "config/update", "title" => "Additional Options", "icon" => "pencil"),
        ),
    ),

    array("title" => "Banner Management", "icon" => " fa fa-folder-open", "action" => array("banner"),
        "additionals" => array(
            array("link" => "banner", "title" => "Manage Banners", "icon" => " fa fa-picture-o"),
        ),
    ),
   /* array("title" => "Work Management", "icon" => " fa fa-superscript", "action" => array("work"),
        "additionals" => array(
            array("link" => "work", "title" => "Manage Work", "icon" => " fa fa-ravelry"),
        ),
    ),*/

//     array("title"=>"Product Management ", "icon"=>" fa fa-database" ,"action" => array("product","review") ,
//        "additionals"=>array(
//             array("link"=>"product","title"=>"Manage Product", "icon"=>" fa fa-cart-plus"),
//             array("link"=>"review","title"=>"Manage Reviews", "icon"=>" fa fa-comment-o"),
//             /*array("link"=>"size","title"=>"Manage Size (adshare)", "icon"=>"plus"),
//            array("link"=>"size_store","title"=>"Manage Size (store)", "icon"=>"plus"),
//             array("link"=>"quantity","title"=>"Manage Quantity", "icon"=>" fa fa-superscript"),
//             array("link"=>"print_side","title"=>"Manage Print Side", "icon"=>" fa fa-print"),
//             array("link"=>"paper_finish","title"=>"Manage Paper Finish", "icon"=>" fa fa-sticky-note"),
//             array("link"=>"round_corner","title"=>"Folding", "icon"=>" fa fa-th-large"),
//             array("link"=>"extra_option","title"=>"Extra Options", "icon"=>" fa fa-ravelry"),*/
//        ),
//    ),
   
     array("title"=>"Supplier Management", "icon"=>"plus" ,"action" => array("supplier","supported_supplier") ,
         "additionals"=>array(
             array("link"=>"supplier","title"=>" Dropshipping Supplier", "icon"=>" fa fa-th-large"),
             array("link"=>"supported_supplier","title"=>" Supported Supplier", "icon"=>" fa fa-th-large"),
         ),
     ),



    // array("title"=>"Print Management", "icon"=>"plus" ,"action" => array("print_page") ,
    //     "additionals"=>array(
    //         array("link"=>"print_page","title"=>" Manage print", "icon"=>"plus"),
    //     ),
    // ),

    // array("title"=>"Paper Type Management", "icon"=>"plus" ,"action" => array("paper_type") ,
    //     "additionals"=>array(
    //         array("link"=>"paper_type","title"=>" Paper Type ", "icon"=>"plus"),
    //     ),
    // ),

   /* array("title" => "E-Book Management", "icon" => " fa fa-book", "action" => array("item","category","special_book",
        "e_book","audio_book","interactive_activity","printable_sheet","pluralsight","quiz"),
        "additionals" => array(
            array("link" => "item", "title" => "Manage Item", "icon" => " fa fa-folder-open"),
            //array("link" => "item_content", "title" => "Manage Item Content", "icon" => " fa fa-check-square"),
            array("link" => "category", "title" => "Manage Category", "icon" => " fa fa-cubes"),
            array("title" => "Manage Item Content", "icon" => " fa fa-check-square", "action"=>array('a','b','c'),
                "sub_menu" => array(
                    // 1
                    array("link" => "e_book", "title" => "E-Book", "icon" => " fa fa-book"),
                    // 2,3
                    array("link" => "special_book", "title" => "Special E-Book", "icon" => " fa fa-arrow-right"),
                    // 4
                    array("link" => "audio_book", "title" => "Audio Book", "icon" => " fa fa-file-audio-o"),
                    // 5
                    array("link" => "interactive_activity", "title" => "Interactive Activity", "icon" => " fa fa-gamepad"),
                    // use printable status
                    array("link" => "printable_sheet", "title" => "Printable Sheet", "icon" => " fa fa-print"),
                    // 6
                    array("link" => "pluralsight", "title" => "Pluralsight", "icon" => " fa fa-video-camera"),
                    // 7
                    array("link" => "quiz", "title" => "Quiz", "icon" => " fa fa-clipboard"),
                ),
            ),
            array("link" => "sale_book", "title" => "Manage Sale Item", "icon" => " fa fa-folder-open"),
        ),
    ),*/

    /*array("title" => "Course Management", "icon" => " fa fa-folder-open", "action" => array("course"),
        "additionals" => array(
            array("link" => "course", "title" => "Manage Course", "icon" => " fa fa-picture-o"),
        ),
    ),*/

    /*
    array("title"=>"Educators Management", "icon"=>"plus" ,"action" => array("educator_feature") ,
        "additionals"=>array(
            array("link"=>"educator_feature","title"=>"Manage Features", "icon"=>"plus"),
            //array("link"=>"product","title"=>"Manage Products", "icon"=>"basket"),
        ),
    ),*/
   /* array("title"=>"Order Management", "icon"=>"basket" ,"action" => array("order") ,
        "additionals"=>array(
            array("link"=>"order","title"=>"Manage Order", "icon"=>"user"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),*/

    /*array("title"=>"Order Management", "icon"=>"basket" ,"action" => array("order") ,
        "additionals"=>array(
            array("link"=>"order","title"=>"Manage Orders", "icon"=>"bar-chart"),
        ),
    ),*/

    /*array("title"=>"Gallery Management", "icon"=>" fa fa-picture-o" ,"action" => array("gallery") ,
        "additionals"=>array(
            array("link"=>"gallery","title"=>"Manage Gallery", "icon"=>"camera"),
        ),
    ),*/
    array("title"=>"Feature Management", "icon"=>" fa fa-tasks" ,"action" => array("feature") ,
        "additionals"=>array(
            array("link"=>"feature","title"=>"Manage Features", "icon"=>" fa fa-cubes"),
        ),
    ),
    array("title" => "Support Management", "icon" => " fa fa-circle-o-notch", "action" => "support",
        "additionals" => array(
            array("link"=>"support","title"=>"Manage Support", "icon"=>" fa fa-external-link"),
        ),
    ),

    array("title"=>"Pricing Management", "icon"=>"plus" ,"action" => array("pricing") ,
        "additionals"=>array(
            array("link"=>"pricing","title"=>" Manage Price", "icon"=>" fa fa-dollar"),
        ),
    ),
    /*array("title"=>"Stock Management", "icon"=>"basket" ,"action" => array("category","product","coupon") ,
        "additionals"=>array(
            array("link"=>"category","title"=>"Manage Categories", "icon"=>" fa fa-folder-open"),
            array("link"=>"product","title"=>"Manage Products", "icon"=>"basket"),
            //array("link"=>"coupon","title"=>"Manage Coupon", "icon"=>"plus"),
        ),
    ),*/
    /*array("title"=>"Service Management", "icon"=>" fa fa-tasks" ,"action" => array("service_home","service") ,
        "additionals"=>array(
            array("link"=>"service_home","title"=>"Home Page Services", "icon"=>" fa fa-list-alt"),
            array("link"=>"service","title"=>"Service Page Services", "icon"=>" fa fa-bars"),
        ),
    ),*/

         /*array("title" => "Sundaes Perks", "icon" => " fa fa-user-circle-ofa fa-user-circle-o", "action" => array("sundaes_perks"),
        "additionals" => array(
            array("link" => "sundaes_perks", "title" => "Manage Sundaes Perks", "icon" => " fa fa-user-circle-o"),
        ),
    ),*/



    /*array("title"=>"Job Management", "icon"=>" fa fa-map-o" ,"action" => array("company","job","apply_job") ,
        "additionals"=>array(
            array("link"=>"company","title"=>"Manage Company", "icon"=>" fa fa-map-signs"),
            array("link"=>"job","title"=>"Manage Job", "icon"=>" fa fa-rss"),
            array("link"=>"apply_job","title"=>"Manage Applicant", "icon"=>" fa fa-address-card"),
        ),
    ),*/
    /*
    array("title"=>"We Are Wentachee", "icon"=>"folder" ,"action" => array("we_are_wenatchee") ,
        "additionals"=>array(
            array("link"=>"we_are_wenatchee","title"=>"Manage Wentachee", "icon"=>"folder"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    array("title"=>"Camp Gallery", "icon"=>"plus" ,"action" => array("velocity_camp") ,
        "additionals"=>array(
            array("link"=>"gallery_image","title"=>"Gallery Images", "icon"=>"camera"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    array("title"=>"Camp Features", "icon"=>"present" ,"action" => array("training_level") ,
        "additionals"=>array(
            array("link"=>"manage_feature","title"=>"Manage Features", "icon"=>"eye"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    array("title"=>"Trainers", "icon"=>"hourglass" ,"action" => array("trainer") ,
        "additionals"=>array(
            array("link"=>"trainer","title"=>"Manage Trainers", "icon"=>"link"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),

    array("title"=>"Schedule", "icon"=>"clock" ,"action" => array("schedule") ,
        "additionals"=>array(
            array("link"=>"schedule","title"=>"Manage Schedule", "icon"=>"clock"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    /*
    array("title"=>"Benefits & Sources", "icon"=>"plus" ,"action" => array("product_benefit","source") ,
        "additionals"=>array(
            array("link"=>"product_benefit","title"=>"Manage Benefits", "icon"=>"plus"),
            array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    */

    // Blog Management
    /*array("title"=>"Blog Management", "icon"=>"hourglass" ,"action" => array("blog_category","blog","comment") ,
        "additionals"=>array(
            array("link"=>"blog_category","title"=>"Manage Category", "icon"=>" fa fa-asterisk"),
            array("link"=>"blog","title"=>"Manage Blog", "icon"=>"note"),
            array("link"=>"comment","title"=>"Manage Comment", "icon"=>" fa fa-comment-o"),
        ),
    ),*/
    // Resource
    /*array("title" => "Resource", "icon" => " fa fa-map-signs", "action" => "resource",
        "additionals" => array(
            array("link"=>"resource","title"=>"Manage Resource", "icon"=>"fa fa-retweet"),
        ),
    ),
    // Testimonials
    array("title" => "Testimonial", "icon" => " fa fa-bullhorn", "action" => "testimonial",
        "additionals" => array(
            array("link"=>"testimonial","title"=>"Manage Testimonials", "icon"=>"speech"),
        ),
    ),*/
    // Clients
    /*array("title" => "Client", "icon" => " fa fa-hashtag", "action" => "client",
        "additionals" => array(
            array("link"=>"client","title"=>"Manage Clients", "icon"=>" fa fa-history"),
        ),
    ),*/
    /*// Help
    array("title" => "Help Link", "icon" => " fa fa-circle-o-notch", "action" => "help",
        "additionals" => array(
            array("link"=>"help","title"=>"Manage Links", "icon"=>" fa fa-external-link"),
        ),
    ),
    // Tag Cloud
    array("title" => "Tag Cloud", "icon" => " fa fa-tags", "action" => "tag_cloud",
        "additionals" => array(
            array("link"=>"tag_cloud","title"=>"Manage Tags", "icon"=>" fa fa-thumb-tack"),
        ),
    ),*/

    array("title" => "Inquiries", "icon" => "envelope", "action" => array("inquiry", "inform_restock", "newsletter"),
        "additionals" => array(
            array("link" => "inquiry", "title" => "View Inquiries", "icon" => " fa fa-comments"),
            //array("link"=>"newsletter","title"=>"View Newsletters", "icon"=>"envelope"),
        ),
    ),
    array("title" => "Subscribe", "icon" => " fa fa-bookmark", "action" => array("subscribe"),
        "additionals" => array(
            array("link" => "subscribe", "title" => "Manage Subscribe", "icon" => " fa fa-user-plus"),
            //array("link"=>"newsletter","title"=>"View Newsletters", "icon"=>"envelope"),
        ),
    ),

    /*array("title"=>"User Management", "icon"=>" fa fa-user-circle-o" ,"action" => "signup" ,
        "additionals"=>array(
            array("link"=>"signup","title"=>"Manage Users", "icon"=>"  fa fa-user-o"),
        ),
    ),*/

    array("title" => "Administrators", "icon" => "user", "action" => "admins",
        "additionals" => array(
            array("link" => "admins", "title" => "Manage Admin", "icon" => " fa fa-user"),
        ),
    ),


    /*
    /*array("title"=>"Statuses Management", "icon"=>"flag" ,"action" => "ostatus" ,
        "additionals"=>array(
            array("link"=>"ostatus","title"=>"Manage Statuses", "icon"=>"flag"),
        ),
    ),
    */
);
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu page-sidebar-menu-fixed" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

            <? foreach ($menu_links as $menu) {

            if (has_value($config['ci_class'], $menu['action']) || has_value($config['ci_index_page'], $menu['action'])) {
                $active = "active";
                $open = "open";
                $selected = '<span class="selected"></span>';
            } else {
                $open = "";
                $active = "";
                $selected = "";
            }
            ?>
            <li class="start <?= $active ?> <?= $open ?>">
                <a href="javascript:;" class="<?=($active!=null)?'left-menu-active':''?>">
                    <i class="icon-<?= $menu['icon'] ?>"></i>
                    <span class="title"><?= $menu['title'] ?></span>
                    <?= $selected ?>
                    <span class="arrow <?= $open ?>"></span>
                </a>
                <ul class="sub-menu">
                    <? foreach ($menu['additionals'] as $add) { ?>
                        <li class="<?= $active ?> <?= $open ?>">

                            <?if(isset($add['sub_menu'])){?>
                            <a href="javascript:;" class="sub-menu-anchor">
                                <i class="icon-<?= $add['icon'] ?>"></i>
                                <?= $add['title'] ?>
                                <span class="arrow"></span>
                            </a>
                                <? foreach($add['sub_menu'] as $key=>$value):?>
                                    <li class="child-menu" style="padding-left: 15px;display: none;">
                                        <a href="<?= $config['base_url'] . "admin/" . $value['link'] ?>">
                                            <i class="icon-<?= $value['icon'] ?>"></i>
                                            <span class="title"><?= $value['title'] ?></span>
                                            <?= $selected ?>
                                            <!--<span class="arrow <?/*= $open */?>"></span>-->
                                        </a>
                                    </li>
                                <? endforeach;
                            }else{?>
                                    <a href="<?= $config['base_url'] . "admin/" . $add['link'] ?>">
                                        <i class="icon-<?= $add['icon'] ?>"></i>
                                        <?= $add['title'] ?></a>
                                <?} ?>
                        </li>
                    <? } ?>
                </ul>
                <? } ?>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>

<script>
    $('.sub-menu-anchor').on('click', function(){
        if($(this).find('span').hasClass('open')){
            $(this).find('span').removeClass('open');
            $('.child-menu').hide();
        }
        else{
            $(this).find('span').addClass('open');
            $('.child-menu').show();
        }
    });
</script>