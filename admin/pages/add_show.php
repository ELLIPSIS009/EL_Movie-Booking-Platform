<?php
  include('header.php');
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
<?php
  include('../../form.php');
  $frm=new formBuilder;      
?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  $(function(){
    $('#theater_name').on('change',function(){ 
      var selectedVal = $(this).val();
      $("div.tabelDiv").hide();
      $("div#"+selectedVal).show();
      $(".SelThe").val(selectedVal);
    });
  });
</script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add Show
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Add Show</li>
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
      <div class="box-body">
        <?php include('../../msgbox.php');?>
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
            echo '
            <form action="process_addshow.php" method="post" id="form'.$array[$counter].'">
              <div class="form-group">
                <input type="text" name="id" id = "SelThe" class="form-control SelThe" style="display:none;"/>
                <label class="control-label">Select Movie</label>
                <select name="movie" class="form-control">
                  <option value>Select Movie</option>'?>
                  <?php
                    $mv=mysqli_query($con,"select * from tbl_movie where status='0'");
                    while($movie=mysqli_fetch_array($mv))
                    {
                      ?><?php echo'
                      <option value="'?><?php echo $movie["movie_id"];?><?php echo'">'?><?php echo $movie["movie_name"]; ?><?php echo'</option>
                      '?><?php
                    }
                  ?><?php echo'
                </select>'?>
                <?php $frm->validate("movie",array("required","label"=>"Movie"));?>
              <?php echo'
              </div>
              <div class="form-group">
                <label class="control-label">Select Screen</label>
                <select name="screen" class="form-control" id="screen'.$array[$counter].'">
                  <option value>Select Screen</option>'?>
                  <?php
                    $sc=mysqli_query($con,"select * from tbl_screens where t_id='".$array[$counter]."'");
                    while($screen=mysqli_fetch_array($sc))
                    {
                      ?>
                      <?php echo'
                      <option value="'?><?php echo $screen["screen_id"]; ?><?php echo'">'?><?php echo $screen["screen_name"]; ?><?php echo'</option>
                      '?><?php
                    }
                  ?><?php echo'
                </select>'?>
                <?php $frm->validate("screen",array("required","label"=>"Screen"));?>
                <?php echo'
              </div>
              <div class="form-group">
                <label class="control-label">Select Show Times</label>
                <select name="stime[]" class="form-control" id="stime'.$array[$counter].'" multiple>
                  <option value="0">Select Show Times</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Start Date</label>
                <input type="date" name="sdate" class="form-control"/>
                '?>
                <?php $frm->validate("sdate",array("required","label"=>"Start Date"));?>
                <?php echo'
              </div>
              <div class="form-group">
                <button class="btn btn-success">Add Show</button>
              </div>
            </form>
            </div>';
            $counter += 1;
            $len -= 1;
          }
        ?>
      </div> 
    </div>
  </section>
</div>
<?php
  include('footer.php');
?>
<script type="text/javascript">
  <?php
  $array = array();
  $sql = "SELECT * FROM tbl_theatre";
  $allData = mysqli_query($con, $sql);
  while ($Data = mysqli_fetch_array($allData)){
    array_push($array, $Data['id']);
  }
  $len = count($array);
  $counter = 0;
  while ($len != 0){
    echo "
    $('#screen".$array[$counter]."').change(function(){
      screen=$(this).val();
      console.log(screen);
      $.ajax({
        url: 'get_showtime.php',
        type: 'POST',
        data: 'screen='+screen,
        dataType: 'html'
      })
      .done(function(data){
        $('#stime".$array[$counter]."').html(data);    
      })
    });
    ";
    $counter += 1;
    $len -= 1;
  }
  ?>
</script>
<script>
  <?php 
    $array = array();
    $sql = "SELECT * FROM tbl_theatre";
    $allData = mysqli_query($con, $sql);
    while ($Data = mysqli_fetch_array($allData)){
      array_push($array, $Data['id']);
    }
    $len = count($array);
    $counter = 0;
    while ($len != 0){
      $frm->applyvalidations("form".$array[$counter]);
      $counter += 1;
      $len -= 1;
    }
  ?>
</script>