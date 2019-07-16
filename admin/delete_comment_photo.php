<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php
$id = $_GET['id'];
if(empty($id)) {
    redirect("comments.php");
}
$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $comment->delete();
    redirect("comment_photo.php?id={$id}");
} else {
    redirect("comments.php");
}

?>
