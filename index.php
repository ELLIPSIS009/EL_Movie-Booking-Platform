<html>
	<link rel="stylesheet" href="css/trailer.css">
	<body>
		<?php include('header.php'); ?>
		<div class="content" style='padding-bottom:0;'>
			<section class="section">
				<div class="slider">
					<h2 style="color:#555;">Movie Trailer</h2><br>
					<div class="slide">
						<input type="radio" name="radio-btn" id="radio1">
						<input type="radio" name="radio-btn" id="radio2">
						<input type="radio" name="radio-btn" id="radio3">
						<input type="radio" name="radio-btn" id="radio4">
						<input type="radio" name="radio-btn" id="radio5">
						<input type="radio" name="radio-btn" id="radio6">
						<?php 
							$qry4=mysqli_query($con,"SELECT * FROM tbl_movie ORDER BY rand() LIMIT 6");
							$count = 1;
							while($nm=mysqli_fetch_array($qry4)){
						?>
							<div class="st <?php if ($count == 1) {echo 'first';}?>">
								<iframe src="<?php echo $nm['video_url'];?>"></iframe>
							</div>
						<?php
								$count = 0;
							}
						?>
						<div class="nav-auto">
							<div class="a-b1"></div>
							<div class="a-b2"></div>
							<div class="a-b3"></div>
							<div class="a-b4"></div>
							<div class="a-b5"></div>
							<div class="a-b6"></div>
						</div>
					</div>
					<div class="nav-m">
						<label for="radio1" class="m-btn"></label>
						<label for="radio2" class="m-btn"></label>
						<label for="radio3" class="m-btn"></label>
						<label for="radio4" class="m-btn"></label>
						<label for="radio5" class="m-btn"></label>
						<label for="radio6" class="m-btn"></label>
					</div>
				</div>
			</section>
			<script type="text/javascript">
				counter = 1;
				setInterval(function(){
					document.getElementById('radio' + counter).checked = true;
					counter++;
					if(counter > 6){
						counter = 1;
					}
				}, 3000);
			</script>
			<div class="wrap">
				<div class="content-top">
					<div class="listview_1_of_3 images_1_of_3" style='margin-left:200px; margin-right:50px'>
						<h2 style="color:#555;">Upcoming Movies</h2><br>
						<?php 
							$qry3=mysqli_query($con,"SELECT * FROM tbl_news LIMIT 5");
							while($n=mysqli_fetch_array($qry3)){
						?>
						<div class="content-left">
							<div class="listimg listimg_1_of_2">
								<img src="admin/<?php echo $n['attachment'];?>">
							</div>
							<div class="text list_1_of_2">
								<div class="extra-wrap">
									<span style="text-color:#000" class="data"><strong><?php echo $n['name'];?></strong><br>
									<span style="text-color:#000" class="data"><strong>Cast :<?php echo $n['cast'];?></strong><br>
									<div class="data">Release Date :<?php echo $n['news_date'];?></div>
									<span class="text-top"><?php echo $n['description'];?></span>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<?php
						}
						?>
					</div>
					<?php include('movie_sidebar.php');?>		
				</div>
			</div>
			<?php include('footer.php');?>
		</div>
	</body>
</html>