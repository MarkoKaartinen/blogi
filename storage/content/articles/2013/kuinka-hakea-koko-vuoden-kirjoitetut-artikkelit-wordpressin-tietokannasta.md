---
title: 'Kuinka hakea koko vuoden kirjoitetut artikkelit WordPressin tietokannasta?'
slug: kuinka-hakea-koko-vuoden-kirjoitetut-artikkelit-wordpressin-tietokannasta
status: published
published_at: 2013-01-02 15:33
updated_at: 2013-01-02 15:33
description: |
    Tutkin taas tätä ongelmaa, kun kirjoittelin vuosittaista katsaustani ja ajattelin pistää tämän ongelman ratkaisun tänne jakoon ja itselleni muistutukseksi. Saat haettua kaikki haluttuna vuonna kirjoitetut artikkelit yhdellä simppelillä SQL-lauseella, jonka voit sitten esim. PhpMyAdminin kautta ajaa. SELECT count(*) as kpl FROM `wp_posts` WHERE post_status = ’publish’ AND YEAR(post_date) = 2012 AND post_type = ’post’ Tämä… Jatka lukemista Kuinka hakea koko vuoden kirjoitetut artikkelit WordPressin tietokannasta?
legacy: true
categories:
- Blogi
tags:
- artikkelit
- määrä
- PhpMyAdmin
- tietokanta
- vinkki
- wordpress
---

<p>Tutkin taas tätä ongelmaa, kun kirjoittelin vuosittaista katsaustani ja ajattelin pistää tämän ongelman ratkaisun tänne jakoon ja itselleni muistutukseksi.</p>
<p>Saat haettua kaikki haluttuna vuonna kirjoitetut artikkelit yhdellä simppelillä SQL-lauseella, jonka voit sitten esim. PhpMyAdminin kautta ajaa.</p>
<blockquote><p>SELECT count(*) as kpl FROM `wp_posts` WHERE post_status = &#8217;publish&#8217; AND YEAR(post_date) = 2012 AND post_type = &#8217;post&#8217;</p></blockquote>
<p>Tämä lause palauttaa suoraan määrän montako artikkelia olet kirjoittanut vuonna 2012. Mikäli haluat vaihtaa vuotta niin voit muuttaa aivan vapaasti vuoden 2012 haluamaksesi. Mikäli taas haluat kaiken nähdä ihan kaiken datan mitä tietokanta palauttaa näistä artikkeleista niin korvaa count(*) pelkällä tähdellä *.</p>
<blockquote><p>SELECT * as kpl FROM `wp_posts` WHERE post_status = &#8217;publish&#8217; AND YEAR(post_date) = 2012 AND post_type = &#8217;post&#8217;</p></blockquote>
<p>Tässäkin vuosi on muutettavissa haluamaksesi, tässä saat listattuna omat artikkelisi ja kaiken tiedon mitä WordPress niistä haluaakaan näyttää posts taulussa.</p>
<p>Molemmat kyselyt ottavat huomioon vain julkaistut (post_status = &#8217;publish) artikkelit sekä tyypiltään artikkelit (post_type = &#8217;post&#8217;).</p>