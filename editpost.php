<?php
	require('config/config.php');
	require('config/db.php');
	require('modelpost.php');

	// Message vars
	$msg = '';
	$msgClass = '';

	// Check for submit update
	if (isset($_POST['update'])) {
		// Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		//Check Required Fields
		if (!empty($title) && !empty($author) && !empty($body)) {
			// Passed
			if (updatePost($conn, $update_id, $title, $author, $body)) {
				header('Location: '.ROOT_URL.'');
			} else {
				$msg = 'Error: '. mysqli_error($conn);
				$msgClass = 'alert-danger';
			}
		} else {
			// Failed
			$msg = 'Por favor, preencha todos os campos.';
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
			<h1>Edit Post</h1>
			<?php if($msg != ''): ?>
				<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
			<?php endif; ?>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control" id="title" value="<?php echo $post['title']; ?>">
				</div>
				<div class="form-group">
					<label for="author">Author</label>
					<input type="text" name="author" class="form-control" id="author" value="<?php echo $post['author']; ?>">
				</div>
				<div class="form-group">
					<label for="body">Body</label>
					<textarea name="body" class="form-control" id="body"><?php echo $post['body']; ?></textarea>
				</div>
				<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="update" value="Submit" class="btn btn-primary">
			</form>
		</div>
	<?php include('inc/footer.php'); ?>	