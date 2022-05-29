	<section id="sponzors">
        <h1>SPONZOŘI</h1>
        <hr>
        
        <div class="parent">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
<?php

	$statement = $conn->prepare("SELECT * FROM Sponzors");
	$statement->execute();
	$rows = $statement->fetchAll();
    
    foreach($rows as $row){
        echo "<a href='$row[3]' target='_blank'><img src='./data/uploads/sponzors/$row[2]' alt='$row[2]'></a>";
        
        
    }
?>
        </div>
	</section>
	<footer>
        <p>© RRC Domino 2021. Všechna práva vyhrazena. - Vytvořeno a navrženo Jaroslavem Maňo</p>
	</footer>