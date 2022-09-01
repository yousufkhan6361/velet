<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?$this->load->view('account/header_main')?>

<!-- BEGIN CONTENT -->

<div class="col-md-9 col-sm-7">



    <div class="content-page">

        <h3>My Account</h3>

        <ul>

            <li><a href="<?= g('base_url') ?>account/info"> Edit your account information</a></li>

            <li><a href="<?= g('base_url') ?>account/change-password">Change your password</a></li>

        </ul>

        <hr>

    </div>

</div>

<!-- END CONTENT -->

<?$this->load->view('account/footer_main')?>