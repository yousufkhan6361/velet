<? global $config;
$menu_links = array(
    array("title" => "Website", "icon" => "clip-world", "action" => "", "link"=>"",
        "additionals" => array(
            //array("link" => "", "title" => "Dashboard", "icon" => "bar-chart"),
        ),
    ),
    array("title" => "Dashboard", "icon" => "clip-home-3", "action" => "home", "link"=>"home",
        "additionals" => array(
            //array("link" => "", "title" => "Dashboard", "icon" => "bar-chart"),
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


    array("title" => "Layout", "icon" => "clip-screen", "action" => array("testimonial", "faq", "cms_page", "cms_title", "logo"),
        "additionals" => array(
            //array("link"=>"category/menu","title"=>"Menu Categories", "icon"=>"wallet"),
            //array("link"=>"promotional_banner","title"=>"Promotional Banners", "icon"=>"plus"),
            array("link" => "logo/add/1", "title" => "Logo", "icon" => "folder"),
            array("link" => "cms_page", "title" => "CMS Content", "icon" => "docs"),
            //array("link" => "ads", "title" => "Ads Forms", "icon" => "speech"),
            //array("link"=>"inner_banner","title"=>"Manage Inner Banner", "icon"=>"folder"),
            //array("link"=>"cms_content","title"=>"Manage PageContent", "icon"=>"speech"),
            // array("link"=>"faq","title"=>"Manage FAQ's", "icon"=>"question"),
            //array("link"=>"client","title"=>"Manage Partners", "icon"=>"users"),
            // array("link"=>"testimonial","title"=>"Manage Testimonials", "icon"=>"speech"),
            //array("link"=>"news","title"=>"Manage News", "icon"=>"note"),
            //array("link"=>"config/update","title"=>"Additional Options", "icon"=>"pencil"),
            // array("link" => "config/update", "title" => "Configuration", "icon" => "pencil"),
            //array("link"=>"channel","title"=>"Channel Config", "icon"=>"speech"),
        ),
    ),

    array("title" => "Banner", "icon" => " fa fa-image", "action" => array("banner","inner_banner"),
        "additionals" => array(
            array("link" => "banner", "title" => "Home Page Slider", "icon" => " fa fa-picture-o"),
            //array("link"=>"inner_banner","title"=>"Inner Banner", "icon"=>"folder"),
        ),
    ),

    // array("title" => "Manage Assets", "icon" => " fa fa-image", "action" => array("assets","inner_banner"),
    //     "additionals" => array(
    //         array("link" => "assets", "title" => "Assets", "icon" => " fa fa-picture-o"),
    //     ),
    // ),

    array("title"=>"Ads Management", "icon"=>"clip-transfer" ,"action" => array("category","product","ads","ads_inactive","blog_category") ,
        "additionals"=>array(
            //array("link"=>"category_parent","title"=>"Manage Parant Categories", "icon"=>" fa fa-folder-open"),
            // array("link"=>"brand","title"=>"Brand", "icon"=>" fa fa-folder-open"),
            // array("link"=>"style","title"=>"Style", "icon"=>" fa fa-folder-open"),
            //array("link"=>"blog_category","title"=>"Blog Category", "icon"=>" fa fa-folder-open"),
            array("link"=>"blog_category","title"=>"Add Towns", "icon"=>" fa fa-folder-open"),
             array("link"=>"category","title"=>"Add Category", "icon"=>" fa fa-folder-open"),
            array("link" => "ads", "title" => "Ads Listing", "icon" => "speech"),
           // array("link" => "ads_inactive", "title" => "Ads Inactive", "icon" => "speech"),
            //array("link"=>"product","title"=>"Product", "icon"=>"basket"),
            // array("link"=>"color","title"=>"Color", "icon"=>" fa fa-folder-open"),
            //array("link"=>"coupon","title"=>"Coupons", "icon"=>" fa fa-tag"),
            // array("link"=>"comment","title"=>"Comment", "icon"=>" fa fa-comment-o"),
            //array("link"=>"pricing","title"=>"Pricing", "icon"=>"dollar"),
            //array("link"=>"kit","title"=>"Kit", "icon"=>" fa fa-eercast"),
            //array("link"=>"prep_size","title"=>"Prep Size", "icon"=>" fa fa-eercast"),
            //array("link"=>"coupon","title"=>"Manage Coupon", "icon"=>"plus"),
            //array("link"=>"exam_list","title"=>"Exam List", "icon"=>"  fa fa-retweet"),
            //array("link"=>"exam","title"=>"Exam Assigment", "icon"=>"  fa fa-clipboard"),
        ),
    ),

    // array("title" => "Service Management", "icon" => " fa fa-image", "action" => array("service"),
    //     "additionals" => array(
    //         array("link"=>"service","title"=>"Service", "icon"=>"folder"),
    //     ),
    // ),
    // array("title" => "Brand Management", "icon" => " fa fa-image", "action" => array("brand"),
    //     "additionals" => array(
    //         array("link"=>"brand","title"=>"Brand", "icon"=>"folder"),
    //     ),
    // ),

    array("title" => "Package Management", "icon" => " fa fa-folder-open", "action" => array("packages"),
        "additionals" => array(
            array("link"=>"packages","title"=>"Packages", "icon"=>"folder"),
        ),
    ),


    array("title" => "Affiliate Management", "icon" => " fa fa-folder-open", "action" => array("affiliate"),
        "additionals" => array(
            array("link"=>"affiliate","title"=>"Affiliate Users", "icon"=>"folder"),
        ),
    ),


    /*array("title" => "Step", "icon" => " fa fa-step-forward", "action" => array("step"),
        "additionals" => array(
            array("link" => "step", "title" => "Step", "icon" => " fa fa-picture-o"),
            //array("link"=>"inner_banner","title"=>"Inner Banner", "icon"=>"folder"),
        ),
    ),*/

    // array("title" => "Banner Management", "icon" => " fa fa-image", "action" => array("banner" , "inner_banner"),
    //     "additionals" => array(
    //         array("link" => "banner", "title" => "Manage Banners", "icon" => " fa fa-picture-o"),
    //         array("link" => "inner_banner", "title" => "Manage Inner Banners", "icon" => " fa fa-picture-o"),
    //     ),
    // ),

    
    // array("title" => "Game Poster", "icon" => "clip-transfer", "action" => array("game-poster"),
    //     "additionals" => array(
    //         array("link" => "game-poster", "title" => "Manage Game Posters", "" => " fa fa-picture-o"),
    //     ),
    // ),

    // array("title" => "Popular Games", "icon" => "clip-transfer", "action" => array("popular-games"),
    //     "additionals" => array(
    //         array("link" => "popular-games", "title" => "Manage Popular Games", "" => " fa fa-picture-o"),
    //     ),
    // ),
    
    // array("title" => "Game Slider", "icon" => "clip-transfer", "action" => array("game-slider"),
    //     "additionals" => array(
    //         array("link" => "game-slider", "title" => "Manage Game Slider", "" => " fa fa-picture-o"),
    //     ),
    // ),

    // array("title" => "Tournaments", "icon" => "clip-transfer", "action" => array("tournaments"),
    //     "additionals" => array(
    //         array("link" => "tournaments", "title" => "Manage Tournaments", "" => " fa fa-picture-o"),
    //     ),
    // ),

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
   
     /*array("title"=>"Supplier", "icon"=>"clip-transfer" ,"action" => array("supplier","supported_supplier") ,
         "additionals"=>array(
             array("link"=>"supplier","title"=>" Dropshipping", "icon"=>" fa fa-th-large"),
             array("link"=>"supported_supplier","title"=>" Supported", "icon"=>" fa fa-th-large"),
         ),
     ),*/



// Testimonials
    // array("title" => "Portfolio", "icon" => " fa fa-bullhorn", "action" => "portfolio",
    //     "additionals" => array(
    //         array("link"=>"portfolio","title"=>"Manage Portfolio", "icon"=>"speech"),
    //     ),
    // ),
    
    // // Telescap Technology
    // array("title" => "Telescap Technology", "icon" => " fa fa-bullhorn", "action" => "telescap_technology",
    //     "additionals" => array(
    //         array("link"=>"telescap_technology","title"=>"Manage Telescap Technology", "icon"=>"speech"),
    //     ),
    // ),

    // // Astronomy
    // array("title" => "Astronomy", "icon" => " fa fa-bullhorn", "action" => "astronomy",
    //     "additionals" => array(
    //         array("link"=>"astronomy","title"=>"Manage Astronomy", "icon"=>"speech"),
    //     ),
    // ),

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



    /*array("title"=>"Gallery Management", "icon"=>" fa fa-picture-o" ,"action" => array("gallery") ,
        "additionals"=>array(
            array("link"=>"gallery","title"=>"Manage Gallery", "icon"=>"camera"),
        ),
    ),*/
   /* array("title"=>"Feature", "icon"=>" fa fa-tasks" ,"action" => array("feature") ,"link"=>"feature",
        "additionals"=>array(
            //array("link"=>"feature","title"=>"Features", "icon"=>" fa fa-cubes"),
        ),
    ),
    array("title" => "Support", "icon" => " fa fa-circle-o-notch", "action" => "support","link"=>"support",
        "additionals" => array(
            //array("link"=>"support","title"=>"Support", "icon"=>" fa fa-external-link"),
        ),
    ),*/

    // array("title"=>"Packages", "icon"=>" fa fa-usd" ,"action" => array("packages") ,"link"=>"Packages",
    //     "additionals"=>array(
    //         array("link"=>"packages","title"=>" Packages", "icon"=>" fa fa-dollar"),
    //     ),
    // ),

    /*array("title"=>"Services", "icon"=>" fa fa-handshake-o" ,"action" => array("service") ,
        "additionals"=>array(
            // array("link"=>"service_home","title"=>"Home Page Services", "icon"=>" fa fa-list-alt"),
            array("link"=>"service","title"=>"Service", "icon"=>" fa fa-bars"),
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
     // array("title"=>"Blog", "icon"=>" fa fa-circle-o-notch" ,"action" => array("blog_category","blog","comment") ,
     //     "additionals"=>array(
     //         // array("link"=>"blog_category","title"=>"Category", "icon"=>" fa fa-asterisk"),
     //         array("link"=>"blog","title"=>"Blog", "icon"=>"fa fa-newspaper-o"),
     //          // array("link"=>"comment","title"=>"Comment", "icon"=>" fa fa-comment-o"),
     //     ),
     // ),

    // News Management
    array("title"=>"News", "icon"=>" fa fa-newspaper-o" ,"action" => array("news") ,
        "additionals"=>array(
            // array("link"=>"blog_category","title"=>"Manage Category", "icon"=>" fa fa-asterisk"),
            array("link"=>"news","title"=>"News", "icon"=>"fa fa-newspaper-o"),
            // array("link"=>"comment","title"=>"Manage Comment", "icon"=>" fa fa-comment-o"),
        ),
    ),
//     array("title"=>"Blog Management", "icon"=>" fa fa-play-circle" ,"action" => array("blog") ,
//         "additionals"=>array(
//             array("link"=>"blog","title"=>"Blog", "icon"=>" fa fa-question-circle-o
// "),
//         ),
//     ),
    // array("title"=>"FAQ", "icon"=>" fa fa-question-circle-o" ,"action" => array("faq") ,
    //     "additionals"=>array(
    //         array("link"=>"faq","title"=>"FAQ'S", "icon"=>" fa fa-question-circle-o"),
    //     ),
    // ),

    // array("title"=>"States Management", "icon"=>" fa fa-shopping-basket" ,"action" => array("state") ,
    //     "additionals"=>array(
    //         array("link"=>"state","title"=>"Manage States", "icon"=>"bar-chart"),
    //     ),
    // ),

    array("title"=>"Order Management", "icon"=>" fa fa-shopping-basket" ,"action" => array("order","subscription") ,
        "additionals"=>array(
            array("link"=>"order","title"=>"Manage Orders", "icon"=>"bar-chart"),
            array("link"=>"subscription","title"=>"Manage Auto Renewal Subscriptions", "icon"=>"bar-chart"),
        ),
    ),


     array("title"=>"Coupon Management", "icon"=>" fa fa-shopping-basket" ,"action" => array("coupon") ,
        "additionals"=>array(
           array("link"=>"coupon","title"=>"Coupons", "icon"=>" fa fa-tag"),

        ),
    ),


     array("title"=>"Report Ads Management", "icon"=>" fa fa-shopping-basket" ,"action" => array("reportads") ,
        "additionals"=>array(
           array("link"=>"reportads","title"=>"Report Ad", "icon"=>" fa fa-tag"),

        ),
    ),

    


    /*array("title"=>"Order", "icon"=>" fa fa-shopping-cart" ,"action" => array("order") ,
        "additionals"=>array(
            array("link"=>"order","title"=>"Payment Order", "icon"=>"user"),
            //array("link"=>"source","title"=>"Manage Sources", "icon"=>"link"),
        ),
    ),
    // Technical Document
    array("title" => "Technical Document", "icon" => " fa fa-map-signs", "action" => "technical_document",
        "additionals" => array(
            array("link"=>"technical_document","title"=>"Document", "icon"=>"fa fa-retweet"),
        ),
    ),
    // Resource Download
    array("title" => "Resource Download", "icon" => " fa fa-bullhorn", "action" => "resource_download",
        "additionals" => array(
            array("link"=>"resource_download","title"=>"Download", "icon"=>"fa fa-retweet"),
        ),
    ),*/
    // Testimonials
    // array("title" => "Testimonial", "icon" => " fa fa-bullhorn", "action" => "testimonial",
    //     "additionals" => array(
    //         array("link"=>"testimonial","title"=>"Manage Testimonials", "icon"=>"speech"),
    //     ),
    // ),

    // Recent Work
    // array("title" => "Recent Work", "icon" => " fa fa-bullhorn", "action" => "recent_work",
    //     "additionals" => array(
    //         array("link"=>"recent_work","title"=>"Work", "icon"=>"speech"),
    //     ),
    // ),
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
    /*array("title"=>"Resources", "icon"=>" fa fa-bullhorn
" ,"action" => array("resources") ,
        "additionals"=>array(
            array("link"=>"resources","title"=>"Resources", "icon"=>" fa fa-bullhorn   
"),
        ),
    ),*/
    /*array("title"=>"Yeastech 101", "icon"=>" fa fa-tags
" ,"action" => array("yeastech_101") ,
        "additionals"=>array(
            array("link"=>"yeastech_101","title"=>"Yeastech 101", "icon"=>" fa fa-question-circle-o
"),
        ),
    ),*/
    array("title" => "Inquiries", "icon" => "fa fa-envelope-o", "action" => array("inquiry", "inform_restock", "newsletter", "event_subscribe", "subscribe", "quote"), "link"=>"inquiry",
        "additionals" => array(
            array("link" => "inquiry", "title" => "Inquiry", "icon" => " fa fa-comments"),
            array("link"=>"newsletter","title"=>"Newsletter", "icon"=>"envelope"),
            // array("link"=>"newsletter","title"=>"Newsletter", "icon"=>"envelope"),
            //array("link"=>"quote","title"=>"Quote", "icon"=>" fa fa-address-card-o"),
            //array("link"=>"event_subscribe","title"=>"Event Subscribers", "icon"=>" fa fa-address-card-o"),
        ),
    ),
    // array("title" => "Subscribe", "icon" => " fa fa-bookmark", "action" => array("subscribe"),"link"=>"subscribe",
    //     "additionals" => array(
    //         array("link" => "subscribe", "title" => "User", "icon" => " fa fa-user-plus"),
    //         //array("link"=>"newsletter","title"=>"View Newsletters", "icon"=>"envelope"),
    //     ),
    // ),

    array("title"=>"User Management", "icon"=>" fa fa-user-circle-o" ,"action" => "signup" ,
        "additionals"=>array(
            array("link"=>"signup","title"=>"Manage Users", "icon"=>"  fa fa-user-o"),
        ),
    ),

    
    array("title"=>"Setting", "icon"=>" fa fa-edit" ,"action" => array("config") ,

        "additionals"=>array(

              array("link" => "config/update", "title" => "General", "icon" => " fa fa-edit"),
              //array("link" => "config/update", "title" => "Manage Contact Info", "icon" => " fa fa-edit"),

        ),

    ),
    // array("title"=>"Merchant", "icon"=>" fa fa-money" ,"action" => array("merchant") ,
    //     "additionals"=>array(
    //         array("link"=>"merchant/add/1","title"=>"Manage Merchant", "icon"=>" fa fa-handshake-o"),           
    //     ),
    // ),

    // array("title"=>"User", "icon"=>" fa fa-user-circle-o" ,"action" => "signup" ,
    //     "additionals"=>array(
    //         array("link"=>"signup","title"=>"Users", "icon"=>"  fa fa-user-o"),
    //     ),
    // ),

    array("title" => "Administrator", "icon" => "clip-users-3", "action" => "admins",
        "additionals" => array(
            array("link" => "admins", "title" => "Admin", "icon" => " fa fa-user"),
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

<div class="navbar-content">
<!-- start: SIDEBAR -->
<div class="main-navigation navbar-collapse collapse">
<!-- start: MAIN MENU TOGGLER BUTTON -->
<div class="navigation-toggler">
    <i class="clip-chevron-left"></i>
    <i class="clip-chevron-right"></i>
</div>
<!-- end: MAIN MENU TOGGLER BUTTON -->
<!-- start: MAIN NAVIGATION MENU -->
<ul class="main-navigation-menu">
    <?
    foreach ($menu_links as $key=> $menu) {
        if (has_value($config['ci_class'], $menu['action']) || has_value($config['ci_index_page'], $menu['action'])) {
            $active = "active";
            $open = "open";
            //$selected = '<span class="selected"></span>';
        } else {
            $open = "";
            $active = "";
            //$selected = "";
        }
    ?>
        <?php
        if($key==0){?>
            <li class="">
                <a href="<?php echo $config['base_url']?>" target="_blank"><i class="<?= $menu['icon'] ?>"></i>
                    <span class="title"> <?= $menu['title'] ?> </span><?php if(array_filled($menu['additionals'])){?> <i class="icon-arrow"></i> <?php }?>
                    <span class="selected"></span>
                </a>
                <?php
                if(array_filled($menu['additionals'])){
                    ?>
                    <ul class="sub-menu">
                        <?php
                        foreach ($menu['additionals'] as $add) {
                            if(has_value($config['ci_class'], $add['link']) || ($config['ci_class']=='logo' && $add['link']=='logo/add/1') || ($config['ci_class']=='config' && $add['link']=='config/update')){
                                $active1 = "active";
                                $open1 = "open";
                            }
                            else{
                                $active1 = "";
                                $open1 = "";
                            }
                            ?>
                            <li class="<?php echo $active1; ?> <?php echo $open1; ?>">
                                <a href="<?php echo $config['base_url'] . "admin/" . $add['link']; ?>">
                                    <span class="title"> <?php echo $add['title']; ?> </span>
                                    <!--<span class="badge badge-new">new</span>-->
                                </a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                <?php }
                ?>
            </li>
        <?php }
        else{?>
            <li class="<?php echo $active; ?> <?php echo $open; ?>">
                <a href="<?php echo (array_filled($menu['additionals'])) ? 'javascript:void' : $config['base_url'] . "admin/" . $menu['link']?>"><i class="<?= $menu['icon'] ?>"></i>
                    <span class="title"> <?= $menu['title'] ?> </span><?php if(array_filled($menu['additionals'])){?> <i class="icon-arrow"></i> <?php }?>
                    <span class="selected"></span>
                </a>
                <?php
                if(array_filled($menu['additionals'])){
                    ?>
                    <ul class="sub-menu">
                        <?php
                        foreach ($menu['additionals'] as $add) {
                            if(has_value($config['ci_class'], $add['link']) || ($config['ci_class']=='logo' && $add['link']=='logo/add/1') || ($config['ci_class']=='config' && $add['link']=='config/update')){
                                $active1 = "active";
                                $open1 = "open";
                            }
                            else{
                                $active1 = "";
                                $open1 = "";
                            }
                            ?>
                            <li class="<?php echo $active1; ?> <?php echo $open1; ?>">
                                <a href="<?php echo $config['base_url'] . "admin/" . $add['link']; ?>">
                                    <span class="title"> <?php echo $add['title']; ?> </span>
                                    <!--<span class="badge badge-new">new</span>-->
                                </a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                <?php }
                ?>
            </li>
        <?php }
        ?>
    <?php }
    ?>


</ul>
<!-- end: MAIN NAVIGATION MENU -->
</div>
<!-- end: SIDEBAR -->
</div>

<script>
    var $windowWidth;
    var $windowHeight;
    var $pageArea;
    var isMobile = false;
    $(function(){
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            isMobile = true;
        }
        runElementsPosition();
        runNavigationToggler();
    });
    $('.main-navigation-menu li.active').addClass('open');
    $('.main-navigation-menu > li a').on('click', function() {
        if($(this).parent().children('ul').hasClass('sub-menu') && ((!$('body').hasClass('navigation-small') || $windowWidth < 767) || !$(this).parent().parent().hasClass('main-navigation-menu'))) {
            if(!$(this).parent().hasClass('open')) {
                $(this).parent().addClass('open');
                $(this).parent().parent().children('li.open').not($(this).parent()).not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200);
                $(this).parent().children('ul').slideDown(200, function() {
                    runContainerHeight();
                });
            } else {
                if(!$(this).parent().hasClass('active')) {
                    $(this).parent().parent().children('li.open').not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200, function() {
                        runContainerHeight();
                    });
                } else {
                    $(this).parent().parent().children('li.open').removeClass('open').children('ul').slideUp(200, function() {
                        runContainerHeight();
                    });
                }
            }
        }
    });

    //function to adapt the Main Content height to the Main Navigation height
    var runContainerHeight = function() {
        mainContainer = $('.main-content > .container');
        mainNavigation = $('.main-navigation');
        if($pageArea < 760) {
            $pageArea = 760;
        }
        if(mainContainer.outerHeight() < mainNavigation.outerHeight() && mainNavigation.outerHeight() > $pageArea) {
            mainContainer.css('min-height', mainNavigation.outerHeight());
        } else {
            mainContainer.css('min-height', $pageArea);
        }
        if($windowWidth < 768) {
            mainNavigation.css('min-height', $windowHeight - $('body > .navbar').outerHeight());
        }
        //$("#page-sidebar .sidebar-wrapper").css('height', $windowHeight - $('body > .navbar').outerHeight()).scrollTop(0).perfectScrollbar('update');
    };

    //function to adjust the template elements based on the window size
    var runElementsPosition = function() {
        $windowWidth = $(window).width();
        $windowHeight = $(window).height();
        $pageArea = $windowHeight - $('body > .navbar').outerHeight() - $('body > .footer').outerHeight();
        if(!isMobile) {
            $('.sidebar-search input').removeAttr('style').removeClass('open');
        }
        runContainerHeight();

    };

    //function to reduce the size of the Main Menu
    var runNavigationToggler = function() {
        $('.navigation-toggler').on('click', function() {
            if(!$('body').hasClass('navigation-small')) {
                $('body').addClass('navigation-small');
            } else {
                $('body').removeClass('navigation-small');
            };
        });
    };

</script>