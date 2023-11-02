<!--<div class="container-fluid c-specs">
	<div class="row">
		<form class="flex s-form col-md-12" action="/search/" method="get" >
    		<input class="search col-md-8" type="text" id="query" name="query" />
			<input class="enter" type="submit" value="➙" />
		</form>
	</div>
</div>

<div class="container-fluid"> -->

<?php
    $a=0;

    if (preg_match('/ponuda.*/', $url)==true){  
        $query= $title;
        $a=1;
    }
    else{
        $query = $_GET['query']; 
    }

    $min_length = 1; // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($connection, $query);

        if ($a==1){

        $raw_results = mysqli_query($connection, "SELECT * FROM zanimljivosti
        WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysqli_error($connection));
        
        }

        else{
            echo "<h2 class='search-h'>Rezultati za pretragu pojma ".$query."</h2>";
            $raw_results = mysqli_query($connection, "SELECT * FROM najnovije
            WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysqli_error($connection));

        }
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
            $text=(strlen($results['text']) > 13) ? substr($results['text'],0,550).'...' : $results['text'];
             
                echo "<div class='container s-con'><a href='/ponuda/".$results['id']."/".slugify($results['title'])."'><h3>".$results['title']."</h3></a><div class='container flex'><img class='search-i' src='".$results['src']."' /><div class='col-md-6'>".$text."</div></div></div>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
        }
        else{ // if there is no matching rows do following
            echo "Nema rezultata";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimalna duljina upita je ".$min_length;
    }
?>
</div>