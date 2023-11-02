<div class="container-fluid c-specs">
	<div class="row">
		<form class="flex s-form col-md-12" action="/search/" method="get" >
    		<input class="search col-md-8" type="text" id="query" name="query" />
			<input class="enter" type="submit" value="➙" />
		</form>
	</div>
</div>

<div class="container-fluid">
	<div class="container">
		<h2>Novo u ponudi</h2>
		<div class="row home-box-large">
		<?php
				$results = mysqli_query($connection, "SELECT * FROM najnovije ORDER BY `date` ASC") or die(mysqli_error($connection));
				$t=0;
				$i=0;
				while(($red=mysqli_fetch_assoc($results)) && ($i<=5)){
					$src=$red['src'];
					$title=$red['title'];
					$text=$red['text'];
					$cijene=$red['cijene'];
					$id=$red['id'];
					$preview=$red['preview'];
					$slugy = slugify($title);
					$content =  "<div class='gr col-md-";
					$content1="<a class='resa' href='/ponuda/".$id."/".$slugy."'><img class='img-responsive center-block' src=".$src." alt='".$title."'></a>
					<a href='/ponuda/".$id."/".$slugy."'>".$title."</a>
						</div>";
					if ($preview==0){
					if ($i<2){
						echo $content."6 flex'>".$content1;
						$i==$i++;
					}
					elseif ($t==0){
						echo "</div> <div class='row home-box'>".$content."3 flex'>".$content1;
						$t=1;
						$i==$i++;
					}
					else{
						echo $content."3 flex'>".$content1;
						$i==$i++;
					}
				}
				}
			?>
		</div>
	    </div>
    </div>
</div>

<div class="container-fluid c-specs">
	<h2>Izdvojeno: Duhovna putovanja</h2>
	<div class="container">
		<div class="row home-box">
	<?php
	
	$results = mysqli_query($connection, "SELECT * FROM najnovije") or die(mysqli_error($connection));
	$i=0;
	while(($red=mysqli_fetch_assoc($results))&&($i<=7)){
		$src=$red['src'];
		$title=$red['title'];
		$text=$red['text'];
		$cijene=$red['cijene'];
		$big=$red['big'];
		$id=$red['id'];
		$preview=$red['preview'];
		$izdvojeno=$red['izdvojeno'];
		$slugy = slugify($title);
		if (($preview==0) && ($izdvojeno==1)){
		echo "<div class='col-md-3 flex'><a class='resa' href='/ponuda/".$id."/".$slugy."'><img class='img-responsive center-block' src=".$src." alt='".$title."'></a>
		<a href='/ponuda/".$id."/".$slugy."'>".$title."</a>
		</div>";
		$i==$i++;
		}
	}
	?>
	</div>
	</div>
</div>
<div class="container-fluid zan flex">
	<img src="/images/zanimljivosti.png" />
	
	<p>Zanimaju vas atraktivne i nesvakidašnje lokacije i događaji? </p>
		<a href='/zanimljivosti'><p>Posjetite zanimljivosti</p></a> 
			</div>
