<?php
  include('header.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  $(function(){
    $('#theater_name').on('change',function(){ 
      var selectedVal = $(this).val();
      $("div.tabelDiv").hide();
      $("div#"+selectedVal).show();
    });
  });
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      View Shows
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">View Shows</li>
    </ol>
  </section>
  <br>
  <a>
    <i class="fa fa-search" style='margin-left:15px; margin-right:5px;  '></i> <span>
      <select name="theater_name" class='theaterselect' id='theater_name'>
        <?php 
            $sql = "SELECT * FROM tbl_theatre";
            $all_categories = mysqli_query($con,$sql);
            while ($category = mysqli_fetch_array($all_categories)):; 
        ?>
            <option value="<?php echo $category["id"];
            ?>">
                <?php echo $category["name"];
                ?>
            </option>
        <?php 
            endwhile; 
        ?>
      </select>
    </span>
  </a>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Available Shows</h3>
      </div>
      <div class="box-body">
        <?php
          $array = array();
          $arrayName = array();
          $sql = "SELECT * FROM tbl_theatre";
          $allData = mysqli_query($con, $sql);
          while ($Data = mysqli_fetch_array($allData)){
            array_push($array, $Data['id']);
            array_push($arrayName, $Data['name']);
          }
          $len = count($array);
          $counter = 0;
          while ($len != 0){
            echo "<div id='".$array[$counter]."' style='display:none;' class='tabelDiv'>";
            echo "<h3>".$arrayName[$counter]."</h1>";
            $sw=mysqli_query($con,"select * from tbl_shows where st_id in(select st_id from tbl_show_time where screen_id in(select screen_id from  tbl_screens where t_id='".$array[$counter]."')) and status='1'");
            $counter += 1;
            $len -= 1;
            if(mysqli_num_rows($sw)){
        ?>
          <table class="table">
            <th class="col-md-1">
              Sl.no
            </th>
            <th class="col-md-2">
              Screen
            </th>
            <th class="col-md-3">
              Show Time
            </th>
            <th class="col-md-3">
              Movie
            </th>
            <th class="col-md-3">
              Options
            </th>
            <?php
            $sl=1;
            while($shows=mysqli_fetch_array($sw))
            {
            ?>
              <tr>
                <td>
                  <?php echo $sl; $sl++;?>
                </td>
                <?php
                $st=mysqli_query($con,"select * from tbl_show_time where st_id='".$shows['st_id']."'");
                $show_time=mysqli_fetch_array($st);
                $sr=mysqli_query($con,"select * from tbl_screens where screen_id='".$show_time['screen_id']."'");
                $screen=mysqli_fetch_array($sr);
                $mv=mysqli_query($con,"select * from tbl_movie where movie_id='".$shows['movie_id']."'");
                $movie=mysqli_fetch_array($mv);
                ?>
                <td>
                  <?php echo $screen['screen_name'];?>
                </td>
                <td>
                  <?php echo date('h:i A',strtotime($show_time['start_time']))." ( ".$show_time['name']." Show )";?>
                </td>
                <td>
                  <?php echo $movie['movie_name'];?>
                </td>
                <td>
                  <?php if($shows['r_status']==1)
                  {
                  ?><a href="change_running.php?id=<?php echo $shows['s_id'];?>&status=0"><button class="btn btn-danger">Stop Running</button></a>
                  <?php
                  }
                  else
                  {?><a href="change_running.php?id=<?php echo $shows['s_id'];?>&status=1"><button class="btn btn-success">Start Running</button></a>
                  <?php 
                  }?>
                  <a href="stop_running.php?id=<?php echo $shows['s_id'];?>"><button class="btn btn-warning">Stop Show</button></a>
                </td>
              </tr>
            <?php
              }
            ?>
          </table>
        <?php
          }
          else
          {
        ?>
        <h4>No Shows Added</h4>
        <?php
          }
          echo "</div>";
        }
        ?>
      </div> 
    </div>
  </section>
</div>
<?php
  include('footer.php');
?>