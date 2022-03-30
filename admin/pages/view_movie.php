<?php
  include('header.php');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Movies List
    </h1>
    <ol class="breadcrumb">
      <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Movies List</li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
          <div class="box box-primary">
            <div class="box-body">
              <?php include('../../msgbox.php');?>
              <ul class="todo-list">
                <?php 
                  $qry7=mysqli_query($con,"select * from tbl_movie");
                  if(mysqli_num_rows($qry7))
                  {
                  while($c=mysqli_fetch_array($qry7))
                  {
                ?>
                <li>
                  <span class="handle">
                    <i class="fa fa-film"></i>
                  </span>
                  <span class="text"><?php echo $c['movie_name'];?></span>
                  <div class="tools">
                    <button class="fa fa-trash-o" onclick="del(<?php echo $c['movie_id'];?>)"></button>
                  </div>
                </li>
                <?php
                  }}
                ?>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </section>
</div>
<?php
  include('footer.php');
?>
<script>
  function del(m)
    {
      if (confirm("Are you want to delete this movie") == true) 
      {
        window.location="del_movie.php?mid="+m;
      } 
    }
</script>