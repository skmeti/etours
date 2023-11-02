<?php 
$id = $_GET["id"];
$results = mysqli_query($connection, "SELECT * FROM najnovije WHERE id = $id") or die(mysqli_error($connection));
$red=mysqli_fetch_assoc($results);
    $i=1;
    $src=explode(", ",$red['src_slider']);
    $title=$red['title'];
    $text=$red['text'];
    $cijene=$red['cijene'];
    $big=$red['big'];

?>

<script src="/assets/js/responsiveslides.min.js"></script>
<script>
  $(function() {
    $(".rslides").responsiveSlides({
  auto: true,             // Boolean: Animate automatically, true or false
  speed: 500,            // Integer: Speed of the transition, in milliseconds
  timeout: 6000          // Integer: Time between slide transitions, in milliseconds
  

});
  });
</script>
<!-- image -->
<div class="mainImageContainer">
	<div class="mainImage">
		<ul class="rslides">
        <?php
            foreach ($src as $value){
                echo "<li>
				<img src='/images/slider/".$value."' alt=''>
				</li>";
            }	
		?>	
		</ul>
	</div>
</div>

<div class="container-fluid c-specs">
	<div class="row">
		<form class="flex s-form col-md-12" action="/search/" method="get" >
    		<input class="search col-md-8" type="text" id="query" name="query" />
			<input class="enter" type="submit" value="➙" />
		</form>
	</div>
</div>


<div class='container'>
    <h2><?php echo $title; ?></h2>
    <div class="box">
        <div class="tab flex">
            <div class="fill"></div>
            <button class="tablinks tab-first" onclick="openCity(event, 'Opis')" id="defaultOpen">Opis</button>
            <button class="tablinks" onclick="openCity(event, 'Cijene')">Cijene</button>
            <button class="tablinks" onclick="openCity(event, 'Zanimljivosti')">Zanimljivosti</button>
            <div class="fill"></div>
        </div>

<!-- Tab content -->
        
        <div id="Opis" class="tabcontent">
        <h3>Opis</h3>
        <p><?php echo $text ?></p>

        </div>

        <div id="Cijene" class="tabcontent">
        <h3>Cijene</h3>
        <p><?php echo $cijene ?></p>
        </div>

        <div id="Zanimljivosti" class="tabcontent">
        <h3>Zanimljivosti</h3>
        <?php 
        include("pages/search.php");
        
        ?>
        </div>
    </div>
</div>

<script>
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>