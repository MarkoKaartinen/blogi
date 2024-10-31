---
title: 'Lyhytosoite postauksesta'
slug: lyhytosoite-postauksesta
status: published
published_at: 2010-02-13 13:29
updated_at: 2013-08-05 15:04
description: |
    Löysin kivan koodinpätkän jolla saa aikaan tämänkin blogiviestin alapuolella olevan ”Tämän blogauksen lyhytosoite on xxx”. Koodi käyttää TinyURL sivustoa avukseen. Aluksi laita seuraava koodinpätkä teemakansiossa olevaan functions.php tiedostoon (jos ei ole niin luo ko. tiedosto) <?php function getTinyUrl($url) { $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url); return $tinyurl; } ?> Kyseinen funktio hakee tinyurlin osoitteesta lyhytosoitteen postistasi kun käytät… Jatka lukemista Lyhytosoite postauksesta
legacy: true
categories:
- Blogi
tags:
- koodi
- php
- vinkit
- wordpress
---

<p>Löysin kivan koodinpätkän jolla saa aikaan tämänkin blogiviestin alapuolella olevan &#8221;Tämän blogauksen lyhytosoite on xxx&#8221;.<br />
Koodi käyttää TinyURL sivustoa avukseen.</p>
<p>Aluksi laita seuraava koodinpätkä teemakansiossa olevaan functions.php tiedostoon (jos ei ole niin luo ko. tiedosto)</p>
<pre>&lt;?php
function getTinyUrl($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}
?&gt;</pre>
<p>Kyseinen funktio hakee tinyurlin osoitteesta lyhytosoitteen postistasi kun käytät sitä esimerkiksi single.php tiedostossa seuraavalla tavalla:</p>
<pre>T&amp;auml;m&amp;auml;n blogauksen lyhytosoite on &lt;a href="&lt;?php echo getTinyUrl(get_permalink($post-&gt;ID)); ?&gt;"&gt;&lt;?php echo getTinyUrl(get_permalink($post-&gt;ID)); ?&gt;&lt;/a&gt;.</pre>
<p>Samaa getTinyUrl() funktiota voit käyttää muuallakin sivustollasi kun annat sille urlin menemään niin se luo mistä tahansa osoitteesta lyhytosoitteen. Mutta muista, että funktiota pitää käyttää WordPress <a href="http://codex.wordpress.org/The_Loop" target="_blank">loopin</a> sisällä.</p>