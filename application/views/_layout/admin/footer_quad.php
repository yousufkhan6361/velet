<!-- Menu ___ Abdul Samad START-->
<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  
                 <?php foreach ($menu as $key => $value)
                   { ?>
                    <li class="sub_menu <?=strpos($value['p_url'], $config['ci_class']) ? "active":$value['p_url'];?>">
                          <a href="javascript:;" >
                            <i class="icon-sitemap"></i>
                            <span><?=$key?></span>
                          </a>
                          <?php if(!empty($value['sub_menu'])){ ?>
                          <ul class="sub">
                   <?php
                     $sub_menuItems = explode(',',$value['sub_menu']);
                      foreach ( $sub_menuItems as $k )
                      {
                        $sub_item = explode(':',$k);
                        $sub_item_id = $sub_item[0];
                        $sub_item_name = $sub_item[1];
                        $sub_item_url = $sub_item[2];
                        ?>
                          <li><a href="<?php echo site_url($sub_item_url)?>"><span  class="sub_item"><?=$sub_item_name?></span></a></li>   
                        <?php
                      }
                      ?>
                          </ul>
                      <?php
                    }
                   } 
                 ?>
                </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
<!-- Menu ___ Abdul Samad END-->     