<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$logs = GetLogs($page);
?>
<div class="admin-card">
  <div class="admin-header">
    <h1>Admin</h1>
  </div>
  <div class="admin-wrapper">
    <?php
    include('_sidebar.php');
    ?>
    <div class="admin-content">
      <h1>Logs</h1>
      <p>Logs of all actions taken by staff.</p>
      <hr>
      <div class="ellipsis">
        <?php
        if ($page > 1) {
          echo '<a id="prev" style="float: left" href="?page=' . ($page - 1) . '">
        <i class="fas fa-angle-double-left"></i>
        Previous
        </a>';
        }
        echo '<a id="next" style="float: right" href="?page=' . ($page + 1) . '">Next
      <i class="fa fa-angle-double-right"></i></a>';
        ?>
      </div>
      <hr>
      <?php
      foreach ($logs as $log) {
        $user = GetUserByID($conn, $log['log_user_id']);
      ?>
        <div class="wrapper">
          <br>
          <div class="row">
            <div class="col-1">
              <center>
                <?php echo $user['user_name']; ?>
              </center>
              <img src="/Avatar?id=<?php echo $user['user_id']; ?>" class="avatar" width="150">
            </div>
            <hr>
            <div class="col-10">
              <?php echo $log['log_action']; ?>
            </div>
          </div>
          <div style="float: right;">
            <?php
            echo HandleDate($log['time_logged']);
            ?>
            |
            <?php 
              echo time_elapsed_string($log['time_logged']);
            ?>
          </div>
          <br>
          <hr>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>