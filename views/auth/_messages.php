<?php
$UserID = $_SESSION['UserID'];
$messages = ViewUnseenMessages($UserID);
if(isset($_GET['note'])) {
  HandleNote($_GET['note']);
}
if(isset($_GET['error'])) {
  HandleError($_GET['error']);
}

?>

<div class="card users">
  <div class="card-header">
    Messages
  </div>
  <div class="card-body message">
    <?php
      ListMessages($messages);
    ?>
    <form action="/config/forms/messages_seen.php" method="post">
      <button type="submit" name="submit">Mark All Messages As Seen</button>
    </form>
    <hr>
    <a href="/markdown">Markdown Tutorial</a>
    |
    <a href="/messages/seen">Look at Previous Messages (<?php if(GetNumberOfSeenMessages($_SESSION['UserID']) != 0) {
     echo GetNumberOfSeenMessages($_SESSION['UserID']); } else {
     echo '0';}?>)</a>
  </div>
</div>