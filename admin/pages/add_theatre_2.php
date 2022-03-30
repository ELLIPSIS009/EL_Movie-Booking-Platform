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
      Add Screen Timings
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="add_theater.php">Add Theater</a></li>
      <li class="active">Add Screen Timings</li>
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
            <h3 class="box-title">Screen Details</h3>
          </div>
      <!-- <div class="box-body" id="screendtls"> -->
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
          echo "<div class='box-body' id='screendtls".$array[$counter]."'>";
          echo "<div id='".$array[$counter]."' style='display:none;' class='tabelDiv'>";
          echo "<h3>".$arrayName[$counter]."</h1>";
          $sr=mysqli_query($con,"select * from tbl_screens where t_id='".$array[$counter]."'");
          if(mysqli_num_rows($sr))
          {
        ?>
          <table class="table table-bordered table-hover">
            <th class="col-md-1">Slno</th>
            <th class="col-md-3">Screen Name</th>
            <th class="col-md-1">Seats</th>
            <th class="col-md-1">Charge</th>
            <th class="col-md-3">Show Time</th>
            <?php echo '<th class="text-right col-md-3"><button data-toggle="modal" data-target="#view-modal" id="getUser'.$array[$counter].'" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Screen</button></th>'?>
              <?php 
              $sl=1;
              while($screen=mysqli_fetch_array($sr))
              {
                ?>
                <tr>
                  <td><?php echo $sl;?></td>
                  <td><?php echo $screen['screen_name'];?></td>
                  <td><?php echo $screen['seats'];?></td>
                  <td><?php echo $screen['charge'];?></td>
                  <?php 
                    $st=mysqli_query($con,"select * from tbl_show_time where screen_id='".$screen['screen_id']."'");
                  ?>
                  <td><?php if(mysqli_num_rows($st)) { while($stm=mysqli_fetch_array($st))
                  { echo date('h:i a',strtotime($stm['start_time']))." ,";}}
                  else
                  {echo "No Show Time Added";}
                  ?></td>
                  <td class="text-right"><button data-toggle="modal" data-id="<?php echo $screen['screen_id'];?>" data-target="#view-modal2" id="getUser2<?php echo $array[$counter]?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add Show Times</button></td>
                </tr>
                <?php
                $sl++;
              }
              ?>
          </table>
          <?php
          }
          else
          {
          ?>
          <button data-toggle="modal" data-target="#view-modal" id="getUser<?php echo $array[$counter]?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Screen</button>
          <?php
            }
            echo "</div>";
            $counter += 1;
            $len -= 1;
          }
          ?>
      </div> 
    </div>
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog"> 
          <div class="modal-content"> 
            <div class="modal-header"> 
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                <i class="fa fa-plus"></i> Add Screen
              </h4> 
            </div> 
            <div class="modal-body"> 
              <div id="modal-loader" style="display: none; text-align: center;">
              <img src="ajax-loader.gif">
              </div>                   
              <div id="dynamic-content"></div>
            </div> 
            <div class="modal-footer"></div> 
          </div> 
        </div>
      </div>
      <div id="view-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog"> 
              <div class="modal-content"> 
                <div class="modal-header"> 
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">
                    <i class="fa fa-plus"></i> Add Show Time
                  </h4> 
                </div> 
                <div class="modal-body"> 
                    <div class="form-group">
                      <label class="control-label">Select Show</label>
                      <select name="s_name" id="s_name" class="form-control">
                        <option value="0">Select Show</option>
                        <option>Noon</option>
                        <option>Matinee</option>
                        <option>First</option>
                        <option>Second</option>
                        <option>Others</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Show Starting Time</label>
                      <input type="time" id="s_time" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <button class="btn btn-success" id="savetime">Save</button>
                  </div>
                </div> 
                <div class="modal-footer"> 
                </div> 
              </div> 
          </div>
      </div>
  </section>
</div>
<?php
  include('footer.php');
?>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
  var screenid;
  var id = document.getElementById('theater_name').value;
  function loadScreendtls(){
    var id = document.getElementById('theater_name').value;
    $.ajax({
      url: 'get_screen_dtls.php',
      type: 'POST',
      data: 'id='+id,
      dataType: 'html'
    })
    .done(function(data){
      $('#screendtls'+id).html(data);    
    });
  }  
  $(document).on('click', '#savescreen', function(){
    var id = document.getElementById('theater_name').value;
    name=$('#sname').val();
    seats=$('#sseats').val();
    charge=$('#scharge').val();
    console.log(id);
      $.ajax({
          url: 'save_screen.php',
          type: 'POST',
          data: 'theatre='+id+'&name='+name+'&charge='+charge+'&seats='+seats,
          dataType: 'html'
        })
        .done(function(data){
          loadScreendtls();
          $('#view-modal').modal('toggle');
        })
        .fail(function(){
          loadScreendtls();
          $('#view-modal').modal('toggle');
        });
  });
  $('#savetime').click(function(){
  s_time=$('#s_time').val();
  s_name=$('#s_name').val();
    $.ajax({
  		url: 'save_time.php',
  		type: 'POST',
  		data: 'screen='+screenid+'&time='+s_time+'&sname='+s_name,
  		dataType: 'html'
  	})
  	.done(function(data){
  		loadScreendtls();
  		$('#s_time').val('');
  		$('#s_name').val('0');
  		$('#view-modal2').modal('toggle');
  	})
  	.fail(function(){
  		loadScreendtls();
  		$('#view-modal2').modal('toggle');
  	});
  });
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
  $(document).ready(function(){
	  $(document).on('click', '#getUser".$array[$counter]."', function(e){
  		e.preventDefault();
  		$('#dynamic-content').html(''); 
  		$('#modal-loader').show();
  		$.ajax({
  			url: 'add_screen_form.php',
  			type: 'POST',
  			data: 'id='+id,
  			dataType: 'html'
  		})
  		.done(function(data){
  			$('#dynamic-content').html('');    
  			$('#dynamic-content').html(data);
  			$('#modal-loader').hide();
  		});
  	});
  });
$(document).on('click', '#getUser2".$array[$counter]."', function(e){
  screenid=$(this).data('id');
});
";
$counter += 1;
$len -= 1;
}
?>
</script>