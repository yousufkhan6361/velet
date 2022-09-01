<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?
global $config;


//debug($form_input);

$par['where']['ads_id'] = $form_input['reportads_adid'];
$ads = $this->model_ads->find_one($par);

// $par1['where']['signup_id'] = $form_input['reportads_userid'];
// $user = $this->model_signup->find_one($par1);

//debug($user);


?>
<html>
	<head>
	</head>
	<body>
		<p>Hello Admin</p>

<h2>Welcome to <?=g('site_name')?>,</h2>
<p> Following ad reported</p>
        <p> Report ad details below</p>

<table class="table table-bordered" border=1>
  <thead>
    <tr>
    	<th style="padding: 10px;text-align: center;">Ad Title</th>
      <th scope="col" style="padding: 10px;text-align: center;">Email</th>
      <!-- <th scope="col">Name</th> -->
      <th style="padding: 10px;text-align: center;" scope="col">Subject</th>
      <th style="padding: 10px;text-align: center;" scope="col">Reason</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding: 10px;text-align: center;"><?=$ads['ads_title']?></td>
      <td style="padding: 10px;text-align: center;"><?=$form_input['reportads_email']?></td>
     
      <td style="padding: 10px;text-align: center;"><?=$form_input['reportads_subject']?></td>
      <td style="padding: 10px;text-align: center;"><?=$form_input['reportads_msg']?></td>
    </tr>
   
  </tbody>
</table>

<p><a href="<?=g('base_url')?>ad/<?=$ads['ads_slug']?>">Go To Ad Page</a></p>

<p>Thank you,</p>
<!--<p>Market Native</p>-->

<p><?=g('site_name')?></p>

	</body>
</html>