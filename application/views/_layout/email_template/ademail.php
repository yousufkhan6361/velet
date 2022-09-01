<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?
global $config;


$par['where']['ads_id'] = $insertedid;
$ads = $this->model_ads->find_one($par);

$par1['where']['signup_id'] = $form_input['ads_user_id'];
$user = $this->model_signup->find_one($par1);

//debug($user);


?>
<html>
	<head>
	</head>
	<body>

<p>Hello Admin</p>

<h2>Welcome to <?=g('site_name')?>,</h2>

<p> <?=$user['signup_firstname']?> posted a new Ad.</p>
<p> Click here to review Ad </p>

<!-- <table class="table table-bordered">
  <thead>
    <tr>
    	<th>Ad Title</th>
      <th scope="col">Email</th>
      
      <th scope="col">Subject</th>
      <th scope="col">Reason</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$ads['ads_title']?></td>
      <td><?=$form_input['reportads_email']?></td>
      
      <td><?=$form_input['reportads_subject']?></td>
      <td><?=$form_input['reportads_msg']?></td>
    </tr>
   
  </tbody>
</table> -->

<p><a href="<?=g('base_url')?>ad/<?=$ads['ads_slug']?>">Go To Ad Page</a></p>

<p>Thank you,</p>
<!--<p>Market Native</p>-->

<p><?=g('site_name')?></p>

	</body>
</html>