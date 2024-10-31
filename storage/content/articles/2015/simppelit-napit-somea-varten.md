---
title: 'Simppelit napit SoMea varten'
slug: simppelit-napit-somea-varten
status: published
published_at: 2015-06-08 16:22
updated_at: 2015-06-08 16:15
description: |
    Kirjoittelin tässä koodia ja en löytänyt sopivaa lisäosaa WordPressiin, jolla saisin hyvin simppelit sosiaalisen median jakonapit näkyviin siihen kohtaan mihin haluan ne. En halunnut mitään hienoja laskureita tai mitään vaan yksinkertaisen ikonin, jota klikkaamalla voi jakaa artikkelin. Enkä halunnut isoa kasaa erilaisia ikoneita vaan nämä neljä: Faceboo, Twitter, G+ ja LinkedIn. Alla on jotakuinkin lopputulos… Jatka lukemista Simppelit napit SoMea varten
legacy: true
categories:
- Blogi
tags:
- CSS
- facebook
- Gplus
- linkedin
- napit
- php
- SoMe
- teema
- Twitter
- ulkoasu
- vinkki
- wordpress
---

<p>Kirjoittelin tässä koodia ja en löytänyt sopivaa lisäosaa WordPressiin, jolla saisin hyvin simppelit sosiaalisen median jakonapit näkyviin siihen kohtaan mihin haluan ne. En halunnut mitään hienoja laskureita tai mitään vaan yksinkertaisen ikonin, jota klikkaamalla voi jakaa artikkelin. Enkä halunnut isoa kasaa erilaisia ikoneita vaan nämä neljä: Faceboo, Twitter, G+ ja LinkedIn. Alla on jotakuinkin lopputulos tai ainakin se tulos miltä se tällä hetkellä näyttää &#8211; ainakin nuo somenapit jäänee tuommoisiksi. Tätä ohjetta voi kyllä soveltaa mille vain alustalle, mutta WordPress on nyt esimerkkinä sillä sille itse sen tein.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2015/06/Screenshot-2015-06-08-08.49.53.png"><img loading="lazy" decoding="async" class="aligncenter size-large wp-image-5711" src="https://cdn.markokaartinen.net/uploads/2015/06/Screenshot-2015-06-08-08.49.53-1200x729.png" alt="" width="600" height="365" /></a>Eli tätä varten tarvitset hieman ymmärrystä ohjelmoinnista ja muutenkin miten WordPressin teemat pelittää. Et paljoa, mutta sen verran kuitenkin, että koet kykeneväsi tähän hommaan. Onhan nyt peloiteltu tarpeeksi?</p>
<p>Ensinnäkin itse käytin <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a> ikoneja tätä varten, joten hanki ne tai vastaavat ikonit. Voit toki käyttää kuviakin, mutta muokkaa sitten itse funktiota ja CSS koodia sinulle sopivaksi.</p>
<h2>PHP-funktio</h2>
<p>Otetaan oman teeman <code>functions.php</code> auki (ellei sitä ole niin sen voit luoda). Liitä sinne alla oleva funktio:</p>
<pre lang="php">function someJako($url, $title){
	$url 		= urlencode($url);
	$title 		= urlencode($title);
	$source		= urlencode("https://markokaartinen.net"); //kotisivusi osoite
	$twnick		= "MarkoK"; //Twitter nimimerkkisi
	$facebook	= '<a class="somenappi" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank"><i class="fa fa-facebook"></i></a>';
	$twitter 	= '<a class="somenappi" href="https://twitter.com/share?text='.$title.'&amp;url='.$url.'&amp;via='.$twnick.'" target="_blank"><i class="fa fa-twitter"></i></a>';
	$gplus		= '<a class="somenappi" href="https://plus.google.com/share?url='.$url.'" target="_blank"><i class="fa fa-google-plus"></i></a>';
	$linkedin	= '<a class="somenappi" href="https://www.linkedin.com/shareArticle?mini=true&#038;url='.$url.'&#038;title='.$title.'&#038;summary=&#038;source='.$source.'" target="_blank"><i class="fa fa-linkedin"></i></a>';
	echo $facebook.$twitter.$linkedin.$gplus; //tulostetaan tuossa järjestyksessä
}
</pre>
<p>Tämä funktio on suhteellisen simppeli. Se ottaa parametrinä osoitteen (url) ja otsikon (title). Tämän jälkeen syötät vielä kotisivusi osoitteen source muuttujaan ja Twitter nimimerkkisi twnick muuttujaan. Mikäli haluat muuttaa järjestystä niin muuta echottavien muuttujien järjestystä. </p>
<h2>Funktion kutsuminen</h2>
<p>Itse halusin tämän yhteen paikkaan joten käytin jakonapit id:llä diviä, mutta sinähän voit muuttaa tuon miten haluat. Sen sisään laitoin tuon funktio kutsun. Otathan huomioon, että tämän pitää olla WordPressin loopin sisällä, jotta saadaan linkki ja osoite haettua. Kannattaa tutustua WordPressin dokumentointiin näissä asioissa.</p>
<pre lang="php">
<div id="jakonapit">
	<?php someJako(get_permalink(), get_the_title()); ?>
</div>
</pre>
<h2>Tyylittelyä</h2>
<p>Itse halusin tämän keskitettynä ja kaikki napit vierekkäin &#8211; kuten kuvassakin näkyy. Alla onkin suhteellisen simppeli CSS-koodi.</p>
<pre lang="css">
#jakonapit {
	text-align: center;
	margin-top: 20px;
}

.somenappi {
	font-size: 25px;
	line-height: 40px;
	height: 40px;
	width: 40px;
	text-align: center;
	display: inline-block;
	background:#404040;
	margin: 5px;
	color: #FFF;
}

.somenappi:hover {
	color:#A4CF2E;
	text-decoration: none;
}
</pre>
<p>Tässähän ei sinänsä mitään ihmeellistä ole. Tuolle jakonapit diville määritetään keskitys ja hieman marginia ylös. Itse napeille taas annetaan koot ja värit.</p>
<h2>Lopuksi</h2>
<p>Ei tuo muuta vaadi. Tallenna tiedostot ja katso menikö se nyt ihan niin miten halusitkaan. Bugit, kommentit, kysymykset ja muut voi pistää tuonne kommenttiboxiin tai keskustelualueen puolelle. </p>