<?php 

//function pour la caroousel--Modifier par DMK
  if(!function_exists('caroousel')){
    function caroousel($image=[],$text=[],$brand=[],$navigate){
  ?>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" >
      <ol class="carousel-indicators">
	  <?php
	  for($i=0;$i<sizeof($image);$i++){
		  ?>
		  <li class="<?php echo $i==0?'active':'';?>" style="z-index:102" data-target="#myCarousel" data-slide-to ="<?php echo $i;?>"></li>
		  <?php
	  }
	  ?>
        
        <!--<li class="" style="z-index:102" data-target="#myCarousel" data-slide-to ="1"></li>
        <li class="" style="z-index:102" data-target="#myCarousel" data-slide-to ="2"></li>-->
      </ol>
      <div class="carousel-inner" >
	  <?php
	  for($i=0;$i<sizeof($image);$i++){
		  ?>
        <div class="carousel-item <?php echo $i==0?'active':'';?>">
        <a  <?php echo $brand[$i]>0?" href='#' class='nav_marque' mid='".$brand[$i]."'":'';?>> <img class="imgFilter first-slide" alt="First image" src="<?= $image[$i]?>" alt="" width="100%" style="max-height:"/></a>

          <div class="container"><div class="carousel-caption text-left text-black bold"><?= (isset($text[$i]) && !empty($text[$i]))?"":""?></div></div>
        </div>
		 <?php
	  }
	  ?>
      </div>
      <?php 
          if ($navigate == true) {
      ?>
      <a href="#myCarousel" style="z-index:101" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a href="#myCarousel" style="z-index:101" class="carousel-control-next" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <?php 
        }
      ?>
    </div>
  <?php
    }
  }
?>
<main role="main" id="get_caroussel">
	
	<?php include_once("caroussel_model.php")?>
	
</main>