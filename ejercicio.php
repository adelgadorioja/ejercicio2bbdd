<html>
 <head>
 <meta charset="utf-8">
  <title>Exemple de lectura de dades a MySQL</title>
  <style>
     table,td {
      border: 1px solid black;
      border-spacing: 0px;
    }
  </style>
 </head>
 
	 <body>
	  <h1>Menu listado Continentes</h1>  
	    <?php
	       try {
	        $hostname = "localhost";
	        $dbname = "world";
	        $username = "root";
	        $pw = "123abc123";
	        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	      } catch (PDOException $e) {
	        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	        exit;
	      }

	      $query = $pdo->prepare(" SELECT Name, Population FROM country WHERE Continent = '".$_POST["continente"]."' ");
	      $query->execute();
	      
	      echo"<table>";
	      		echo "\t<tr>\n"; 
		 			echo "\t\t<td>Países</td>\n";
		 			echo "\t\t<td>Población</td>\n";			 					 			
		 		echo "\t</tr>\n";

	            $row = $query->fetch();
	            while ( $row ) 
	            { 
		 			echo "\t<tr>\n"; 
			 			echo "\t\t<td>".$row["Name"]."</td>\n";
			 			echo "\t\t<td>".$row["Population"]."</td>\n";
			 			$row = $query->fetch(); 					 			
		 			echo "\t</tr>\n";
		 		} 
	          
	      echo"</table>"; 

	      $query = $pdo->prepare(" SELECT SUM(Population)AS total FROM country WHERE Continent = '".$_POST["continente"]."' ");
	      $query->execute();
	      $row = $query->fetch();
	      echo "\t\t<h5>Total Población: ".$row["total"]."</h5>\n";	

	      unset($pdo); 
	      unset($query)
	      ?>
	      
	</body>
</html>
