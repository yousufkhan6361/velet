<ul class="breadcrumb">
            <li><a href="<?=g('base_url')?>account">Account</a></li>

            <?php if($this->uri->segment(2) == ""){ ?>
              <li class="active">Dashboard</li>
            <?php } ?>

            <?php if($this->uri->segment(2) == "info"){ ?>
              <li class="active">Account Setting</li>
            <?php } ?>

            <?php if($this->uri->segment(2) == "orderhistory"){ ?>
              <li class="active">Order History</li>
            <?php } ?>

            <?php if($this->uri->segment(2) == "change-password"){ ?>
              <li class="active">Change Password</li>
            <?php } ?>



        
        </ul>