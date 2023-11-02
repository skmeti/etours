<div class="container-fluid c-specs">
	<div class="row">
		<form class="flex s-form col-md-12" action="/search/" method="get" >
    		<input class="search col-md-8" type="text" id="query" name="query" />
			<input class="enter" type="submit" value="➙" />
		</form>
	</div>
</div>

<div class="naslovsivo">
	<div class="container">
		<h1>Emanuel Tours: Putovanja duhovne obnove</h1>
		<div class="col-md-4 ponuda-box">
			<a href="u-ponudi" class="ponuda flex">
				<p>Ponuda</p>
			</a>
			<a href="zanimljivosti" class="lokacije flex">
				<p>Zanimljivosti</p>
			</a>
		</div>
		<div class="col-md-8">
			<p class="home-text">Hodočašće ili duhovno putovanje integralan je dio većine religija svijeta te mnogima predstavlja unikatno spiritualno iskustvo. U krščanstvu malo je poglavlja tako bogatih poviješću, tradicijom i spiritualnošću.  Idjea hodočašća ima snažne temelje i u Starom i u Novom Zavjetu te se često prikazuje kroz putovanja poput Abrahamovog i misionarskih poduhvata kao što je onaj Svetog Pavla. Moderno doba nasljedilo je ovu tradiciju u obliku putovanja na mjesta od velike religijske važnosti. Neka od najpoznatijih odredišta, kao npr. Vatikan, dnevno prosječno vide čak 17 000 posjetitelja. Hrvatska je također dom jednom takvom odredištu - Mariji Bistrici koja godišnje zabilježi preko milijun posjeta. Diljem svijeta postoje mnoge hodočasnićke lokacije koje arhitekturalno i povijesno zadivljuju - Vatikan, Iona, Asiz i Santiago de Compostela samo su neke od mnogo lokacija na koje ćete naiči tokom posjeta ovoj stranici. Putujte s nama!</p>
		</div>
	</div>
</div>

<div class="container-fluid c-spec">
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
					$content =  "<div class='col-md-";
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
<div class="container-fluid bg-white">
	<h2>Kontakt</h2>
<?php include ("pages/contact-form.php"); ?>
</div>