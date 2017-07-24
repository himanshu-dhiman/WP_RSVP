<?php

	$event_post_args=array(
	    'post_type' => 'event',
	    'meta_key'  => 'date',
	    'orderby'   => 'meta_value',
	    'order'     => 'ASC'
	);
	$event_query = new WP_Query($event_post_args);
	$guest_post_args=array(
	    'post_type' => 'guest',
	    'orderby'   => 'meta_value',
	);
	$guest_query = new WP_Query($guest_post_args);
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
  							if ($event_query->have_posts()){
				                while($event_query->have_posts()){
				                $event_query->the_post();
				        ?>
    					<a class="dropdown-item" href="#" data-id="<?php echo $event_post->ID; ?>"><?php echo get_the_title(); ?></a>
  						<?php 
  						}
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
            	if ($guest_query->have_posts()){
                	while($guest_query->have_posts()){
                	$guest_query->the_post();
                	$phone=get_field('phone');
                	$name=get_the_title();
                    $email=get_field('email');
                    $status=get_field('status');
                    $gender=get_field('gender');
				?>	
					<tr class="table-success">
				        <td class="capitalize"><?php echo $name ?></td>
				        <td><?php echo $email ?></td>
				        <td><?php echo $phone ?></td>
				        <td class="capitalize"><?php echo $gender ?></td>
				        <td class="capitalize"><?php echo $status ?></td>
				    </tr>
			    <?
			        }
			    }
			    ?>
			        </tbody>
		        </table>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Status</th>
						</tr>
					</thead>
				<tbody>
				<?php 
					if ($guest_query->have_posts()){
                	while($guest_query->have_posts()){
                	$guest_query->the_post();
                	$name=get_the_title();
                    $email=get_field('email');
                    $status=get_field('status');
                    if($status=="waiting for approval")
                    {
				?>	
						<tr class="table-success">
					        <td class="capitalize"><?php echo $name ?></td>
					        <td><?php echo $email ?></td>
					        <td class="capitalize"><?php echo $status ?></td>
					    </tr>
			    <?
			        	}
			       	}
			    }
			    ?>
			        </tbody>
		        </table>
			</div>
		</div>
	</div>
</body>