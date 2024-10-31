---
title: 'jQuery WordPressissä'
slug: jquery-wordpressissa
status: published
published_at: 2010-10-11 13:23
updated_at: 2013-08-05 15:10
description: |
    Tässä teemaa tehdessäni ja tutkiessani paria jQuery skriptiä – kävi ilmi, että WordPressissä onkin jQuery jo valmiiksi. Itsehän aluksi teemaan laitoin suoraan teema kansiosta jQueryn skriptin. Mutta tutkittuani jQueryn voikin laittaa suoraan teeman header tiedostoon ilman, että sinulla tarvitsee olla teeman sisällä omaa jQuery skripti tiedostoa. Hommahan onnistuu hyvinkin helposti. Avaa header.php -tiedosto editorissa. Etsi… Jatka lukemista jQuery WordPressissä
legacy: true
categories:
- Blogi
tags:
- header
- HTML
- jQuery
- koodivinkki
- php
- wordpress
---

<p>Tässä teemaa tehdessäni ja tutkiessani paria jQuery skriptiä &#8211; kävi ilmi, että WordPressissä onkin jQuery jo valmiiksi. Itsehän aluksi teemaan laitoin suoraan teema kansiosta jQueryn skriptin.<br />
Mutta tutkittuani jQueryn voikin laittaa suoraan teeman header tiedostoon ilman, että sinulla tarvitsee olla teeman sisällä omaa jQuery skripti tiedostoa.</p>
<p>Hommahan onnistuu hyvinkin helposti. Avaa <strong>header.php</strong> -tiedosto editorissa. Etsi kohta missä PHP funktio <strong>wp_head();</strong> kutsutaan. Lisää ennen sitä PHP funktion kutsu: <strong>wp_enqueue_script(&#8221;jquery&#8221;);</strong> ja näin jQuery on otettu teemaan ja voitkin käyttää sitä hyödyksi!</p>
<p>Ja tähän vielä pieni pala omaa <strong>header.php</strong> tiedostoani:</p>
<pre>&lt;?php wp_enqueue_script("jquery"); ?&gt;
&lt;?php wp_head(); ?&gt;
&lt;script type="text/javascript" src="&lt;?php bloginfo('template_directory'); ?&gt;/MarkoInTheBox.js"&gt;&lt;/script&gt;
&lt;/head&gt;</pre>
<p><strong>HOX HOX</strong></p>
<p>Tutkiskelin lisää ja jQuery toimii ns. &#8221;no conflict&#8221; -modessa. Ja tämä muuttaa hieman jQuery koodin tekemistä. Lisää siitä WordPressin Codexissa: <a href="http://codex.wordpress.org/Function_Reference/wp_enqueue_script#jQuery_noConflict_wrappers" target="_blank">Linkki</a></p>