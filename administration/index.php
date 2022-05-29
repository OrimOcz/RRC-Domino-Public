<?php
require_once("../config/main.php");
require_once("../class/init.php");
?> 
<?php

if(userAdmin($_SESSION['UserID']) != true){
	echo'<meta http-equiv="refresh" content="1;url='.$GLOBALS['Server_URL'].'"> ';
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <script src="https://cdn.tiny.cloud/1/0flf2b9x3xevgeftlowh3zfdc31yk7dehpvw3vuyagb219hy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
            selector: 'textarea',
			
			skin: "oxide-dark",
    		content_css: "dark",
            plugins: "media, link, lists, advlist, table, textpattern, textcolor",
        });</script>
<title><?=$GLOBALS['Server_Name']?> - Administrace</title>
	<style>
		@font-face {
  font-family: Second;
  src: url("../fonts/Franklin Gothic Book Regular.ttf");
}
        @font-face {
  font-family: Basic;
  src: url("../fonts/BebasNeue-Regular.ttf");
}
		        .successpanel{
            background-color: lightgreen;
            border-bottom: solid 3px green;
        }      
         .errorpanel{
            background-color: lightcoral;
            border-bottom: solid 3px red;
        }  
        .errorpanel, .successpanel{
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 20px auto;
        }
        .successpanel i, .errorpanel i{
            margin: 10px;
            font-size: 35px;
            vertical-align: middle;
            
        }
		body{padding: 0px; margin: 0px;background-color: #2c2c2c;}
		.adminMenu{
			font-family: Basic;
			transition: 0.5s;
			width: 300px;
			color: white;
			background: rgba(0,0,0,1.0);
			height: 100%;
			max-height: 100%;
			  position: fixed;
			z-index: 10;
			top: 0;
			left: 0;
		  	overflow-x: hidden;
			overflow-y: auto;
			font-size: 23px;
			line-height: 30px;
		}
		li{padding-right: 30px;}
		.adminMenu ul{
			list-style-type: none;
		}

		.sectionname{padding-left: -20px; color: gray; margin-top: 10px;}
		.logo{width: 80%; height: auto}
		.profilphoto{border-radius: 100%; width: 40px; height: 40px;}
		.head{vertical-align: middle;}
		.close-menu{float: right;cursor: pointer;}
		.openMenu{
			background: black;
			position: fixed;
			color: white;
			padding: 10px 10px 10px 15px;
			border-radius: 0 10px  10px 0;
		}
		.slide-in{
			animation: slide-in 0.5s forwards;
    		-webkit-animation: slide-in 0.5s forwards;
		}

		.openBox{
			margin-top: 20px;
			cursor: pointer;
			transform: translateX(-100%);
    		-webkit-transform: translateX(-100%);
		}
@keyframes slide-in {
    100% { transform: translateX(0%); }
}

@-webkit-keyframes slide-in {
    100% { -webkit-transform: translateX(0%); }
}
		.icon{
			padding: 0 20px 0 20px;
		}
		.menuicon{
			background: red;
			cursor: pointer;
			border-radius: 10px;
			font-size: 15px;
			padding: 5px;
			margin: 0 5px 0 10px;
			vertical-align: middle;
		}
		.icons{
			margin-top: 30px;
			margin-bottom: 10px;
			text-align: center;
			  display: grid;
  				grid-template-columns: 50% 50%;
		}

.tooltip {
	text-align: center;
	cursor: pointer;
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
	font-size: 15px;
	font-family: Second;
  visibility: hidden;
  background-color: red;
	width: 100px;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -70px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: red transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
		.content{
			transition: margin-left .5s;
  			padding: 16px;
		}
		.adminMenu a:link, .adminMenu a:checked, .adminMenu a:active, .adminMenu a:visited{
			color: white;
			text-decoration: none;
		}
		.adminMenu .link:hover{
			background: #2c2c2c;
			border-radius: 10px;
			padding: 5px;
			margin-right: 25px;
		}
		.adminMenu p {
			margin: 0;
		}
		        .successpanel{
            background-color: lightgreen;
            border-bottom: solid 3px green;
        }      
         .errorpanel{
            background-color: lightcoral;
            border-bottom: solid 3px red;
        }
        .errorpanel, .successpanel{
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 20px auto;
        }
        .successpanel i, .errorpanel i{
            margin: 10px;
            font-size: 35px;
            vertical-align: middle;
            
        }
	</style>
	<style>
	.unerlineh1{
		width: 50%;
		text-align: center;
	}
	h1 {
		text-align: center;
	}
	.button{
		border-radius: 10px;
		padding: 10px 20px;
		margin: 5px;
		border: none;
		cursor: pointer;
		font-family: Second;
	}
	.addbutton{
		background: green;
		color: white;
	}
	.button:hover{
		opacity: 0.7;
	}
		.photos{
			width: 200px;
		}
	.main{
		height: 30px;
		display: grid;
		margin-top: 15px;
		grid-column-gap: 1%;
		grid-template-columns: 80% 15%;
		width: 80%;
		max-width: 1024px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 1rem;
	}
		.main-picture{
		height: 50px;
			display: block;
		width: 80%;
			margin-right: auto;
			margin-left: auto;
		max-width: 1024px;
			margin-bottom: 6rem;
		}
	.search{
		background-image: url("https://img.icons8.com/material-rounded/24/000000/search.png");
  		background-color: #e4dede;
		background-repeat: no-repeat;
		background-position: 5px 5px; 
		color: #2c2c2c;
		border: none;
		outline: none;
		border-radius: 10px;
		padding-left: 40px;
		height: auto;
	}
	hr .unerlineh1{
		border: 0;
		border-top: 1px solid rgba(0,0,0,.1);
		margin-bottom: 30px;
	}
	h1{
		color: white;
		font-size: 48px;
		margin: 15px;
		font-family: Basic;
	}
	.input-box {
  		position: relative;
		margin-top: 30px;
	}
	#addForm {
		margin-top: 20px;
		width: 50%;
		padding: 5px 20px 40px 20px;
		background: black;
		border-radius: 10px;
		margin-right: auto;
		margin-left: auto;
		display: none;
	}
	#Form {
		margin-top: 20px;
		width: 50%;
		padding: 5px 20px 20px 20px;
		background: black;
		border-radius: 10px;
		margin-right: auto;
		margin-left: auto;
	}
		#Form textarea{
			width: 100%;
		}
	.input-box input, .input-box select {
		width: 100%;
		border-radius: 10px;
		border: none;
  		position: relative;
  		outline: none;
  		padding: 10px 20px;
  		color: #2c2c2c;
		background-color: #e4dede;
	}
	.input-box input[type=file]{
		border-radius: 10px;
  		padding: 10px 20px;
  		color: white;
    	background-color: black;
	}
	.input-box label {
	  	color: #2c2c2c;
	  	position: absolute;
		font-family: Second;
	  	padding: 10px 0;
		top: 0;
	  	left: 10px;
	  	pointer-events: none;
	  	transition: 0.5s;
	}
		.input-box p{
			color: white;
			font-family: Second;
		}
	.input-box input:focus ~ label,
	.input-box input:valid ~ label {
	  	color: white;
	  	top: -30px;
	  	transition: 0.5s;
	}
		.input-box label[for=File]{
			transition: 0.0s;
			top: -30px;
			left: 10px;
			color: white;
		}
	h2{
		color: white;
	}
	.form{
		width: 80%;
		display: block;
	}
	.submit{
		width:20%;
		margin-top: 20px;
		float: right;
		position: relative;
		vertical-align: middle;
		justify-content: center;
	}
	table{
		margin-left: 10%;
		margin-top: 20px;
		width: 80%;
		border-collapse: collapse;
	}
	th,td{
		border: 1px solid #ddd;
  		padding: 8px;
	}
	table th{ 
		border: none;
		padding: 10px 5px;
		color: #ca0018;
		background-color: rgba(0,0,0,0.88);
	}
	tr:nth-child(even) {
  		background-color: #f2f2f2;
	}
	tr{
		background-color: white;
	}
	.picture{
		height: 50px;
		width: auto;
		text-align: center;
	}
	.pictureIcon{
		font-size: 50px;
	}
	.up{
		position: relative;
		top:-30px;
	}
</style>
			<style>
				.btn{
					cursor: pointer;
					border: 0px;
					border-radius: 10px;
					padding: 10px;
					text-decoration: none;
					color: white;
					font-size: 15px;
					margin: 5px;			
				}
				.delete{
					background-color: red;
				}
				.edit{
					background-color: orange;
				}
				.addc{
					background-color: blue;
				}
				.resend{
					background-color: darkgoldenrod;
				}
				.buttons{
					text-align: center;
				}
				.modal{
					display: block; /* Hidden by default */
					  position: fixed; /* Stay in place */
					  z-index: 1; /* Sit on top */
					  padding-top: 100px; /* Location of the box */
					  left: 0;
					  top: 0;
					  width: 100%; /* Full width */
					  height: 100%; /* Full height */
					  overflow: auto; /* Enable scroll if needed */
					  background-color: rgb(0,0,0); /* Fallback color */
					  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
				}
				.modal-content {
				  	background-color: black;
				  	margin: auto;
				  	padding: 20px;
					text-align: center;
					border-radius: 10px;
				  	width: 80%;
					box-shadow: 0 10px rgba(167, 5, 16, 1);
				}
				.modal-footer{
					width:100%;
    				text-align: center;

				}
				.yes{
					background: green;
				}
				.no{
					background: red;
				}
				.inner
				{
					display: inline-block;
				}
				.inputs-box{
					color: white;
					margin: 10px;
					font-family: Second;
				}
			</style>
	<script src="https://kit.fontawesome.com/f307a5f3a4.js" crossorigin="anonymous"></script>
</head>

<body id="loader"><?php
		    if (isset($_SESSION["successmsg"])){
                	echo '<div class="successpanel">';
					echo $_SESSION["successmsg"];
                	echo '</div>';
			}
            if (isset($_SESSION["errormsg"])){
                	echo '<div class="errorpanel">';
					echo '<i class="fas fa-exclamation" style="color: darkred;"></i> ';
					echo $_SESSION["errormsg"];
                	echo '</div>';
	
            }
            unset($_SESSION["successmsg"]);
            unset($_SESSION["errormsg"]);
	?>
	<div class="openBox slide-in" id="OpenBox" style="display: none;">
		<a class="openMenu" onclick="openNav()"><i class="fas fa-bars"></i></a>
	</div>
	<header class="adminMenu" id="mySidenav">
		<ul>
			<li><img class="logo head" src="../data/logos/neon-rrcdomino.png" alt="logo"> <a class="head close-menu" onclick="closeNav()"><i class="fas fa-times"></i></a></li>
			<li><hr></li>
			<li><i class="fas fa-user icon"></i> <?=$_SESSION['FName']?> <?=$_SESSION['LName']?></li>
			<li class="icons">
				<a href="<?=$GLOBALS['Server_URL']?>"><div class="tooltip"><i class="fas fa-caret-square-left"></i><span class="tooltiptext">Zpět na web</span></div></a>
				<a href="<?=$GLOBALS['Server_URL']?>log_out"><div class="tooltip"><i class="fas fa-sign-out-alt"></i><span class="tooltiptext">Odhlásit se</span></div></a>
			</li>
			<li><hr></li>
			<li class="sectionname"><p>Obecná administrace</p></li>
			<a href="?s=dashboard"><li class="link"><i class="fas fa-tachometer-alt menuicon"></i>Dashboard</li></a>
			<a href="?s=news"><li class="link"><i class="fas fa-newspaper menuicon"></i></i>Novinky</li></a>
			<a href="?s=sponzors"><li class="link"><i class="fas fa-money-bill-wave menuicon"></i>Sponzoři</li></a>
			<a href="?s=contact"><li class="link"><i class="fas fa-phone menuicon"></i>Kontakty</li></a>
			<a href="?s=plans"><li class="link"><i class="fas fa-calendar-alt menuicon"></i></i>Plánované akce</li></a>
			<a href="?s=actions"><li class="link"><i class="fas fa-calendar-day menuicon"></i></i>Pořádané akce</li></a>
			<a href="?s=history"><li class="link"><i class="fas fa-history menuicon"></i>Historie oddílu</li></a>
			<li class="sectionname"><p>Kategorie</p></li>
			<a href="?s=doping"><li class="link"><i class="fas fa-prescription-bottle-alt menuicon"></i>Doping</li></a>
			<a href="?s=category"><li class="link"><i class="fas fa-users menuicon"></i>Kategorie</li></a>
			<a href="?s=catnews"><li class="link"><i class="fas fa-newspaper menuicon"></i></i>Informace kategorií</li></a>
			<li class="sectionname"><p>Tréninky</p></li>
			<a href="?s=tplace"><li class="link"><i class="fas fa-store menuicon"></i>Tréniková místa</li></a>
			<a href="?s=tranings"><li class="link"><i class="fas fa-running menuicon"></i>Tréninky</li></a>
			<a href="?s=attendance"><li class="link"><i class="fas fa-book menuicon"></i>Docházka</li></a>
			<a href="?s=apology"><li class="link"><i class="fas fa-sticky-note menuicon"></i>Omluvenky</li></a>
			<li class="sectionname"><p>Uživatelé</p></li>
			<a href="?s=hire"><li class="link"><i class="fas fa-user-plus menuicon"></i>Nábor</li></a>
			<a href="?s=users"><li class="link"><i class="fas fa-users menuicon"></i>Uživatelé</li></a>
			<a href="?s=approval"><li class="link"><i class="fas fa-user-edit  menuicon"></i>Úprava profilu</li></a>
			<a href="?s=staff"><li class="link"><i class="fas fa-user-shield menuicon"></i>Trenéři</li></a>
			<li class="sectionname"><p>Galerie</p></li>
			<a href="?s=albums"><li class="link"><i class="fas fa-folder menuicon"></i>Alba</li></a>
			<a href="?s=photos"><li class="link"><i class="fas fa-images menuicon"></i>Obrázky</li></a>
		</ul>
		<div class="menufooter">
			
		</div>
	</header>
	<?php

		switch ($_GET['s']){
			case dashboard:
				include('./sections/dashboard.php');
			break;
			case news:
				include('./sections/news.php');
			break;
			case category:
				include('./sections/category.php');
			break;
			case plans:
				include('sections/plans.php');
			break;
			case users:
				include('./sections/users.php');
			break;
			case sponzors:
				include('./sections/sponzors.php');
			break;
			case history:
				include('./sections/history.php');
			break;
			case tplace:
				include('./sections/treningsplace.php');
			break;
			case staff:
				include('sections/staff.php');
			break;
			case hire:
				include('sections/hire.php');
			break;
			case approval:
				include('sections/approval.php');
			break;
			case tranings:
				include('sections/tranings.php');
			break;
			case doping:
				include('sections/doping.php');
			break;
			case contact:
				include('./sections/contact.php');
			break;
			case catnews:
				include('./sections/categoryinfo.php');
			break;
			case actions:
				include('./sections/actions.php');
			break;
			case albums:
				include('./sections/albums.php');
			break;
			case photos:
				include('./sections/photos.php');
			break;
			case attendance:
				include('./sections/attendance.php');
			break;
			case apology:
				include('./sections/apology.php');
			break;
		  	default:
				include('./sections/dashboard.php');

		}
	?>
	<script>
function openNav() {
	document.getElementById('OpenBox').style.display='none';
	document.getElementById('OpenBox').className.replace("slide-in", "slide-out");
	
	setTimeout(function(){
		document.getElementById("mySidenav").style.width="300px";
	}, 100);
}

function closeNav() {
  	document.getElementById("mySidenav").style.width = "0";
	setTimeout(function(){
		document.getElementById('OpenBox').style.display='block';
		document.getElementById('OpenBox').className.replace("slide-out", "slide-in");
	}, 500);
}
</script>
</body>
</html>