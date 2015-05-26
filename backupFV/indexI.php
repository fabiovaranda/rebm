
<html>
	<body>
		
		<?php
			$dsn = 'mysql:dbname=empregab_rebm;host=localhost';
			
			$user = "empregab_rumo";
			$pwd = "zx5w3(%qx07.";
			
			try {
				
				$dbh=new PDO($dsn,$user,$pwd); 
				
				$sth = $dbh->prepare('SELECT * from tecnicos');
				$sth->execute();
				$result = $sth->fetch(PDO::FETCH_ASSOC);
				echo $result->id;
				
				$dbh = null;
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		
		?>
	</body>
</html>