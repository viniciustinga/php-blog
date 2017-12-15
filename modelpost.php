<?php 
// Fetch all posts from database
function showPosts($conn) {
	// Create Query
	$query = 'SELECT * FROM posts ORDER BY created_at DESC';

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch data
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $posts;
}

// Insert post into database
function insertPost($conn, $title, $author, $body) {
	$query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";
	return mysqli_query($conn, $query);
}

// Edit post id
function updatePost($conn, $update_id, $title, $author, $body) {
	$query = "UPDATE posts SET title = '$title', author = '$author', body = '$body' WHERE id = {$update_id}";
	return mysqli_query($conn, $query);
}

// Get post id from database
function getPost($conn, $id) {
	// Create Query
	$query = 'SELECT * FROM posts WHERE id = '.$id;

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch data
	$post = mysqli_fetch_assoc($result);

	return $post;
}

// Delete post id
function deletePost($conn, $delete_id) {
	$query = "DELETE FROM posts WHERE id = {$delete_id}";
	return mysqli_query($conn, $query);
}