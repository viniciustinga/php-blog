<?php
	require('config/config.php');
	require('config/db.php');
	require('modelpost.php');

	// Check for submit
	if (isset($_POST['delete'])) {
		// Get id
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
		
			if (deletePost($conn, $delete_id)) {
				header('Location: '.ROOT_URL.'');
			} else {
				$msg = 'Error: '. mysqli_error($conn);
				$msgClass = 'alert-danger';
			}
	}

	// Get Query Id
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// Get post id from database
	$post = getPost($conn, $id);
?>

	<?php include('inc/header.php'); ?>
		<div class="container">
			<div>
				<a href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
				<h1><?php echo $post['title']; ?></h1>
				<small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
				<p><?php echo $post['body']; ?></p>
				<hr>
				<form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
					<input type="submit" name="delete" value="Delete" class="btn btn-danger">
				</form>
				<a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-default">Edit</a>
			</div>
		</div>	
	<?php include('inc/footer.php'); ?>	