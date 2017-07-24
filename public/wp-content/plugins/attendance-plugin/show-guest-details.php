<?php
$guest_posts = get_posts(array(
	'post_type'	=> 'guest',
	'orderby'	=> 'ID',
	));

$events_posts = get_posts(array(
	'post_type'	=> 'event',
	'meta_key'	=> 'date',
	'orderby'	=> 'meta_value',
	'order'		=> 'ASC'
	));
?>
<body class="attendance-body">
	<div class="container">
		<br>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="dropdown">
  					<button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Event</button>
  					<div class="dropdown-menu" aria-labelledby="dropdown-menu-button">
  						<?php 
  							foreach ($events_posts as $event_post) {
						?>
    					<a class="dropdown-item" href="#" data-id="<?php echo $event_post->ID; ?>"><?php echo $event_post->post_title ?></a>
  						<?php 
  						} 
  						?>
  					</div>
				</div>
			</div>
		</div>
<br><br>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone No.</th>
							<th>Gender</th>
							<th>Status</th>
						</tr>
					</thead>
				<tbody>
				<?php 
					foreach ($guest_posts as $guest_post) {
					$id=$guest_post->ID;
					$name=$guest_post->post_title;
					$value=get_post_meta($id);
					$email=$value['email'][0];
					$status=$value['status'][0];
					$gender=$value['gender'][0];
					$phone=$value['phone'][0];
				?>	
					<tr class="table-success">
			        <td><?php echo $name ?></td>
			        <td><?php echo $email ?></td>
			        <td><?php echo $phone ?></td>
			        <td><?php echo $gender ?></td>
			        <td><?php echo $status ?></td>
			        </tr>
			    <?
			        }
			    ?>
			        </tbody>
			        </table>
			</div>
			</div>
			</div>
			</body>