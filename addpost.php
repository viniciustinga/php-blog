<?php
	require('config/config.php');
	require('config/db.php');
	require('modelpost.php');

	// Message vars
	$msg = '';
	$msgClass = '';

	// Check for submit
	if (isset($_POST['submit'])) {
		// Get form data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		//Check Required Fields
		if (!empty($title) && !empty($author) && !empty($body)) {
			// Passed
			if (insertPost($conn, $title, $author, $body)) {
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
?>

	<?php include('inc/header.php'); ?>
		<div class="container">
			<h1>Add Post</h1>
			<?php if($msg != ''): ?>
				<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
			<?php endif; ?>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control" id="title">
				</div>
				<div class="form-group">
					<label for="author">Author</label>
					<input type="text" name="author" class="form-control" id="author">
				</div>
				<div class="form-group">
					<label for="body">Body</label>
					<textarea name="body" class="form-control" id="body"></textarea>
				</div>
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			</form>
		</div>
	<?php include('inc/footer.php'); ?>	