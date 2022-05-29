<?php
require_once("pages/header.php");
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$GLOBALS['Server_Name']?> - GDPR</title>
</head>
<body>

<div class="bg-image" style="background-image: url('data/photos/parta.jpg');"></div>
	<div class="bg-text">
		<h1 class="">GDPR</h1>
		<hr>
	</div>
	<div class="sections-menu">
		<div class="button-sections">
			<button class="tablink btn" onclick="openPage('default', this)" id="defaultOpen">Základní ustanovení</button>
			<button class="tablink btn" onclick="openPage('category', this)">Zpracovávaných údajů</button>
			<button class="tablink btn" onclick="openPage('save', this)">Uchovávané Informace</button>
			<button class="tablink btn" onclick="openPage('time', this)">Délka uchovávání</button>
			<button class="tablink btn" onclick="openPage('share', this)">Sdílení informací</button>
			<button class="tablink btn" onclick="openPage('jus', this)">Vaše práva</button>
			<button class="tablink btn" onclick="openPage('safe', this)">Podmínky zabezpečení</button>
			<button class="tablink btn" onclick="openPage('end', this)">Závěrečné ustanovení</button>
		</div>
	</div>
	<section class="box">
		<div id="default" class="tabcontent">
			<h2>Základní ustanovení</h2>
			<div class="blockInTab">
			<p>
				<ul>
					<li class="text">Správcem osobních údajů podle čl. 4 bod 7 nařízení Evropského parlamentu a Rady (EU) 2016/679 o ochraněfyzických osob v souvislosti se zpracováním osobních údajů a o volném pohybu těchto údajů (dále jen:„GDPR”) je TJ Sokol Jinonice, z.s.. IČO: 14893835, se sídlem Butovická 100/33, 158 00 Praha 5, zapsanýve spolkovém rejstříku vedeném Městským soudem v Praze, pod sp. zn. L 1389</li>
					<li class="text">TJ Sokol Jinonice, z.s. dále jen: „správce“</li>
					<li class="text">Kontaktní údaje správce je adresa Butovická 100/33, 158 00 Praha 5, nebo email: rrcdomino@seznam.cz</li>
					<li class="text">Osobními údaji se rozumí veškeré informace o identifikované nebo identifikovatelné fyzické osobě;identifikovatelnou fyzickou osobou je fyzická osoba, kterou lze přímo či nepřímo identifikovat, zejménaodkazem na určitý identifikátor, například jméno, identifikační číslo, lokační údaje, síťový identifikátor nebona jeden či více zvláštních prvků fyzické, fyziologické, genetické, psychické, ekonomické, kulturní nebospolečenské identity této fyzické osoby.</li>
					<li class="text">Správce nejmenoval pověřence pro ochranu osobních údajů.</li>
				</ul>

			</p>
			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="category" class="tabcontent">
			<h2>Zdroje a kategorie zpracovávaných osobních údajů</h2>
			<div class="blockInTab">
			<p>
				<ul>
					<li class="text">Správce zpracovává osobní údaje, které jste mu poskytl/a nebo osobní údaje, které správce získal na základě plnění Vaší registrace, či objednávky.</li>
					<li class="text">Správce zpracovává Vaše identifikační a kontaktní údaje a údaje nezbytné pro plnění smlouvy.</li>
				</ul>

			</p>
			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="save" class="tabcontent">
			<h2>Jaké údaje o Vás ukládáme</h2>
			<div class="blockInTab">
			<p>
				<ul>
					<li class="text">Shromažďujeme pouze takové osobní údaje, které nám sami dobrovolně poskytnete nebo které získáme prostřednictvím našich internetových stránek nebo prostřednictvím písemné či telefonické komunikace s Vámi.</li>
					<br/>
					<ol>
						<li class="text">Vaše identifikační a adresní údaje (např. titul, jméno, příjmení, bydliště, datum narození, fotka);</li>
						<li class="text">Vaše kontaktní údaje (např. kontaktní adresa, e-mail a telefon);</li>
						<li class="text">Elektronické údaje (např. IP adresa, soubory cookie, typ prohlížeče);</li>
						<li class="text">Údaje potřebné k vyřízení Vaší objednávky, uzavření a plnění smlouvy mezi Vámi a námi a poskytování objednaných služeb;</li>
						<li class="text">Další údaje, které nám předáte nebo které shromáždíme v souvislosti s vyřizováním Vaší objednávky/registrace,uzavřením a plněním smlouvy mezi Vámi a námi a poskytováním objednaných služeb.</li>
					</ol>
					
				</ul>

			</p>
			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="time" class="tabcontent">
			<h2>Jak dlouho informace uchováváme</h2>
			<div class="blockInTab">
			<p>
				<ul>
					<li class="text">Údaje zákazníků udržujeme a zpracováváme do doby smazání jejich profilu, nebo do doby než je zaktualizují.</li>
					<li class="text">Daňové doklady vystavené na základě údajů získaných, které jsou potřebné pro vyřízení platby a dodání daňového dokladu, udržujeme po dobu 10 let.</li>
					<li class="text">Obchodní sdělení a informační zprávy o trenikách/akcích jsou zasílány ve všech případech pouze do chvíle, kdy odvoláte příslušný souhlas, nebo do doby odhlášení odběru novinek.</li>
				</ul>

			</p>
			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="share" class="tabcontent">
			<h2>S kým tyto informace sdílíme</h2>
			<div class="blockInTab">
				<p>Veškeré osoby, které pracují ve společnosti nebo spolupracují se společností TJ Sokol Jinonice, z.s., které s osobními údaji pracují, jsou vázány mlčenlivostí.</p>
			<p class="text">Dále využíváme pro zpracování osobních údajů a práci s nimi tzv. zpracovatele. Tyto osoby mohou údaje zpracovávat pouze pro účely a způsobem, který určujeme a nemůžeme je za žádných okolností rozšiřovat. Zpracovávatelům předáváme pouze údaje nezbytné pro vykonání jejich pracovních povinností, které jsou nutné k splnění služby. Jako zpracovatele využíváme:</p><br />
				<ul>
					<li class="text">Google LLC (nástroje pro webovou analytiku a on-line marketing)</li>
					<li class="text">Facebook Inc. (nástroje pro usnadnění komunikace, včetně messenger chatu (dále jen livechatu) umožňující rychlejší komunikaci);</li>
				</ul>

			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="jus" class="tabcontent">
			<h2>Vaše práva</h2>
			<div class="blockInTab">
				<p class="text">Za podmínek stanovených v GDPR máteoprávo</p><br />
				<ul>
					<li class="text">právo na přístup ke svým osobním údajům dle čl. 15 GDPR.</li>
					<li class="text">právo opravu osobních údajů dle čl. 16 GDPR, popřípadě omezení zpracování dle čl. 18 GDPR.</li>
					<li class="text">právo na výmaz osobních údajů dle čl. 17 GDPR.</li>
					<li class="text">právo vznést námitku proti zpracování dle čl. 21 GDPR a</li>
					<li class="text">právo na přenositelnost údajů dle čl. 20 GDPR.</li>
					<li class="text">právo odvolat souhlas se zpracováním písemně nebo elektronicky na adresu nebo email správce uvedený v "Základní ustanovení".</li>
					<li class="text">Pokud zpracováváme Vaše osobní údaje na základě oprávněných zájmů TJ Sokol Jinonice, z.s., máte právo vznést námitku proti zpracování osobních údajů, které se Vás týkají. Dále nás můžete požádat, abychom Vám, či třetí osobě předali osobní údaje, které o Vás na základě smlouvy či Vašeho souhlasu zpracováváme v elektronické podobě. Vezměte prosím na vědomí, že na výkon těchto práv se vztahují určité výjimky, a protoje nebude možné uplatnit ve všech situacích.</li>
				</ul><br />
				<p class="text">Dále máte právo podat stížnost u Úřadu pro ochranu osobních údajů v případě, že se domníváte, že bylo porušeno Vaší právo na ochranu osobních údajů.</p>

			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="safe" class="tabcontent">
			<h2>Podmínky zabezpečení osobních údajů</h2>
			<div class="blockInTab">
				<ol>
					<li class="text">Správce prohlašuje, že přijal veškerá vhodná technická a organizační opatření k zabezpečení osobních údajů.</li>
					<li class="text">Správce přijal technická opatření k zabezpečení datových úložišť a úložišť osobních údajů v listinné podobě.</li>
					<li class="text">Správce prohlašuje, že k osobním údajům mají přístup pouze jím pověřené osoby.</li>
				</ol>
			</div>
						    <?php
				include('./pages/footer.php');
				?>
		</div>
		<div id="end" class="tabcontent">
			<h2>Závěrečná ustanovení</h2>
			<div class="blockInTab">
				<ol>
					<li class="text">Odesláním registrace z internetového registračního/objednávkového formuláře potvrzujete, že jste seznámen/a s podmínkami ochrany osobních údajů a že je v celém rozsahu přijímáte./li>
					<li class="text">S těmito podmínkami souhlasíte zaškrtnutím souhlasu prostřednictvím internetového formuláře. Zaškrtnutím souhlasu potvrzujete, že jste seznámen/a s podmínkami ochrany osobních údajů a že je v celém rozsahu přijímáte.</li>
					<li class="text">Správce je oprávněn tyto podmínky změnit. Novou verzi podmínek ochrany osobních údajů zveřejní na svých internetových stránkách a zároveň Vám zašle novou verzi těchto podmínek Vaši e-mailovou adresu, kterou jste správci poskytl/a.</li>
				</ol>
				<br />
				<p class="text">Tyto podmínky nabývají účinnosti dnem 01.1.2022.</p>
			</div>
			    <?php
				include('./pages/footer.php');
				?>
		</div>
	</section>
	<script>
function openPage(pageName,elmnt) {
  var i, tabcontent, tablinks, color;
	color = "#808080";
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>