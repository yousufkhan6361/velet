<?
global $config;
// $email_data

// $id  = 2;


$data  = $this->model_form->find_by_pk($id);




?>

<style type="text/css">
	td{
		text-align: center;
	}
</style>
<html>
	<head>
	</head>
	<body>
	<center>
		<h2>COMMERCIAL DRIVER APPLICATION</h2>
	
	<table style="border: 1px solid; width: 80%;" >
		<tr >
			<th style="border: 1px solid;" >Company</th>
			<th style="border: 1px solid;" >Address</th>
			<th style="border: 1px solid;" >City</th>
			<th style="border: 1px solid;" >State</th>
			<th style="border: 1px solid;" >Zip</th>
			<th style="border: 1px solid;" >Package</th>
		</tr>

		<tr>
			<td style="border: 1px solid;"><?=$data['form_driver_company']?></td>
			<td style="border: 1px solid;"><?=$data['form_driver_address']?></td>
			<td style="border: 1px solid;"><?=$data['form_driver_city']?></td>
			<td style="border: 1px solid;"><?=$data['form_driver_state']?></td>
			<td style="border: 1px solid;"><?=$data['form_driver_zip']?></td>
			<td style="border: 1px solid;"><?=$data['form_package']?></td>
		</tr>

	</table>
	
		<h2>APPLICANT INFORMATION</h2>
	
	<table style="border: 1px solid; width: 80%;" >
		<tr >
			<th style="border: 1px solid;" >Date</th>
			<th style="border: 1px solid;" >Name</th>
			<th style="border: 1px solid;" >Age</th>

			<th style="border: 1px solid;" >DATE OF BIRTH</th>
			<th style="border: 1px solid;" >DATE OF DAY</th>

			<th style="border: 1px solid;" >DATE OF YEAR</th>
			<th style="border: 1px solid;" >PHYSICAL EXAM EXPIRATION DATE#</th>

		</tr>

		<tr>
			<td style="border: 1px solid;"><?=$data['form_application_date']?></td>
			<td style="border: 1px solid;"><?=$data['form_application_name']?></td>
			<td style="border: 1px solid;"><?=$data['form_application_age']?></td>

			<td style="border: 1px solid;"><?=$data['form_application_date_of_birth']?></td>
			<td style="border: 1px solid;"><?=$data['form_application_date_of_day']?></td>

			<td style="border: 1px solid;"><?=$data['form_application_date_of_year']?></td>
			<td style="border: 1px solid;"><?=$data['form_physical_exp_date']?></td>
		</tr>





	</table>

	<h2>CURRENT & PREVIOUS THREE YEARS ADDRESSES</h2>

	<table style="border: 1px solid; width: 80%;" >
		<tr >
			<th style="border: 1px solid;" >Address</th>
			<th style="border: 1px solid;" >From</th>
			<th style="border: 1px solid;" >To</th>
		

		</tr>

		<tr>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_add_1']?></td>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_frm_1']?></td>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_to_1']?></td>

		</tr>


		<tr>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_add_2']?></td>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_frm_2']?></td>
			<td style="border: 1px solid;"><?=$data['form_cur_prev_to_2']?></td>

		</tr>



		

	</table>

	<h2>HAVE YOU WORKED FOR THIS COMPANY BEFORE?  :   ( <strong> <?=$data['form_worked_before']?> </strong> ) </h2>


		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >From</th>
					<th style="border: 1px solid;" >To</th>
					<th style="border: 1px solid;" >Reason</th>
				</tr>

				<tr>
					<td style="border: 1px solid;"><?=$data['form_worked_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_worked_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_worked_leaving']?></td>

				</tr>
		</table>



		<h2>EDUCATION HISTORY:</h2>


		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >Highest grade rom</th>
					<th style="border: 1px solid;" >College </th>
					<th style="border: 1px solid;" >Post Graduate</th>
				</tr>

				<tr>
					<td style="border: 1px solid;"><?=$data['form_edu_completed']?></td>
					<td style="border: 1px solid;"><?=$data['form_edu_college']?></td>
					<td style="border: 1px solid;"><?=$data['form_edu_postgraduate']?></td>

				</tr>
		</table>

		<h2>EMPLOYMENT HISTORY:</h2>



		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >From</th>
					<th style="border: 1px solid;" >To </th>
					<th style="border: 1px solid;" >Present or Last Employer</th>
					<th style="border: 1px solid;" >Position</th>
					
					<th style="border: 1px solid;" >Reason</th>
					<th style="border: 1px solid;" >Phone</th>

					<th style="border: 1px solid;" >Subject to the FMCSRs</th>
					<th style="border: 1px solid;" >Job designated</th>
				</tr>

		<?php 
		for ($i=1; $i < 8 ; $i++) { 
			?>

			<tr>
					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_frm']?></td>
					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_to']?></td>

					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_name']?></td>

					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_position']?></td>

					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_leaving']?></td>
					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_phone']?></td>
					<td style="border: 1px solid;"><?=$data['form_emph_'.$i.'_subject']?></td>
					<td style="border: 1px solid;"><?=$data['form_emph_safety_'.$i.'']?></td>
				</tr>

		<?php 
			$i+1;
		}
		?>
		</table>




		<h2>DRIVING EXPERIENCE</h2>


		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >Class of Equipment</th>
			        <th style="border: 1px solid;" >From</th>
			        <th style="border: 1px solid;" >To</th>
			        <th style="border: 1px solid;" >Approximate Number of Miles</th>
				</tr>


				<tr>
					<td style="border: 1px solid;"><strong>Straight Truck</strong></td>
					<td style="border: 1px solid;"><?=$data['form_striaght_truck_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_striaght_truck_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_striaght_truck_apprx']?></td>

				</tr>



				<tr>
					<td style="border: 1px solid;"><strong>Tractor & Semitrailer</strong></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_semi_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_semi_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_semi_apprx']?></td>

				</tr>


				<tr>
					<td style="border: 1px solid;"><strong>Tractor & two trailers</strong></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_trailer_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_trailer_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_trailer_apprx']?></td>

				</tr>


				<tr>
					<td style="border: 1px solid;"><strong>Tractor & triple trailers</strong></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_triple_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_triple_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_triple_apprx']?></td>

				</tr>


				<tr>
					<td style="border: 1px solid;"><strong>Other</strong></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_other_from']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_other_to']?></td>
					<td style="border: 1px solid;"><?=$data['form_tractor_other_apprx']?></td>

				</tr>


				



		</table>

		<table style="width: 80%; border: 1px solid;">
		
				<tr>
					<td  style="border: 1px solid;"><strong>List states operated in, for the last five (5) years:</strong></td>
					<td    style="border: 1px solid;"><?=$data['form_list_states_operate']?></td>
					

				</tr>


				<tr>
					<td  style="border: 1px solid;"><strong>List special courses/training completed (PTD/DDC, HAZMAT, ETC)</strong></td>
					<td    style="border: 1px solid;"><?=$data['form_list_states_operate']?></td>
					

				</tr>

				<tr>
					<td  style="border: 1px solid;"><strong>List any Safe Driving Awards you hold and from whom: </strong></td>
					<td    style="border: 1px solid;"><?=$data['form_special_course']?></td>
					

				</tr>


				<tr>
					<td  style="border: 1px solid;"><strong>List any Safe Driving Awards you hold and from whom: </strong></td>
					<td    style="border: 1px solid;"><?=$data['form_safe_driving_award']?></td>
					

				</tr>

		</table>

			<h2>Accident Record for past three (3) years: (attach sheet if more space is needed):</h2>


		<table style="width: 80%; border: 1px solid;">
			
				<tr>
					<th style="border: 1px solid;" >Date of Accident</th>
			        <th style="border: 1px solid;" >Nature of Accidents(Head on, rear end, etc)</th>
			        <th style="border: 1px solid;" >Location of Accident</th>
			        <th style="border: 1px solid;" ># of Fatalities</th>
			        <th style="border: 1px solid;" ># of People Injured</th>
				</tr>

		<?php 
		for ($j=1; $j < 5 ; $j++) { 
			?>


				<tr>
					<td style="border: 1px solid;"><?=$data['form_date_of_accident_'.$j.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_nature_of_accident_'.$j.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_location_of_accident_'.$j.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_fatalities_of_accident_'.$j.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_people_of_accident_'.$j.'']?></td>

				</tr>
		<?php 
		$j + 1; 
		}
			?>


		</table>



		<h2>Traffic Convictions and Forfeitures for the last three (3) years (other than parking violations) :</h2>


		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >Date</th>
					<th style="border: 1px solid;" >Location </th>
					<th style="border: 1px solid;" >Charge Penalty</th>
					<th style="border: 1px solid;" >Driver(s)</th>
				</tr>


		<?php 
			for ($k=1; $k < 6 ; $k++) { 
		?>
				
				<tr>
					<td style="border: 1px solid;"><?=$data['form_traffic_date_'.$k.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_traffic_location_'.$k.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_traffic_penalty_'.$k.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_traffic_driver_'.$k.'']?></td>

				</tr>

		<?php 
		$k + 1; 
		}
			?>

		</table>





		<h2>Driver’s License (list each drivers license held in the past three(3) years: </h2>


		<table style="width: 80%; border: 1px solid;">

				<tr>
					<th style="border: 1px solid;" >State</th>
					<th style="border: 1px solid;" >License </th>
					<th style="border: 1px solid;" >Type </th>
					<th style="border: 1px solid;" >Endorsements</th>
					<th style="border: 1px solid;" >Expiration Date</th>
				</tr>


		<?php 

			for ($l=1; $l < 6 ; $l++) { 

		?>
				
				<tr>
					<td style="border: 1px solid;"><?=$data['form_license_state_'.$l.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_license_license_'.$l.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_license_type_'.$l.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_license_ender_'.$l.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_license_exp_'.$l.'']?></td>
				</tr>

		<?php 

		$l + 1; 

		}
			?>

		</table>






		<table style="width: 80%; border: 1px solid;">

				<tr>
					<th style="border: 1px solid;" >Have you ever been denied a license, permit or privilege to operate a motor vehicle?</th>
					<td style="border: 1px solid;" ><?=$data['form_ever_denied']?></td>
					
				</tr>



				<tr>
					<th style="border: 1px solid;" >Has any license, permit or privilege ever been suspended or revoked?</th>
					<td style="border: 1px solid;" ><?=$data['form_ever_suspended']?></td>
					
				</tr>


				<tr>
					<th style="border: 1px solid;" >Is there any reason you might be unable to perform the functions of the job for which you have applied (as described in the job description)?</th>
					<td style="border: 1px solid;" ><?=$data['form_unable_perform']?></td>
					
				</tr>

				<tr>
					<th style="border: 1px solid;" >Have you ever been convicted of a felony? </th>
					<td style="border: 1px solid;" ><?=$data['form_felony']?></td>
					
				</tr>



				<tr>
					<th style="border: 1px solid;" >If the answers to any questions listed above are “yes”, give details? </th>
					<td style="border: 1px solid;" ><?=$data['form_give_details']?></td>
					
				</tr>


			
				


		</table>



		<h2>Job References  :</h2>


		<table style="width: 80%; border: 1px solid;">
				<tr>
					<th style="border: 1px solid;" >Name</th>
					<th style="border: 1px solid;" >Address </th>
					<th style="border: 1px solid;" >Form</th>
				</tr>


				<?php 

			for ($m=1; $m < 4 ; $m++) { 

		?>
				
				<tr>
					<td style="border: 1px solid;"><?=$data['form_ref_name_'.$m.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_ref_add_'.$m.'']?></td>
					<td style="border: 1px solid;"><?=$data['form_ref_phone_'.$m.'']?></td>
				</tr>

		<?php 

		$m + 1; 

		}
			?>
		</table>










	</center>


<h3>Date  : <?=$data['form_date']?> </h3>

<p>Thank you</p>
<p>Regards,</p>

<p><?=g('site_name')?></p>





	</body>
</html>