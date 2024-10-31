---
title: 'Asennetaan palvelimelle "perusohjelmat"'
slug: asennetaan-palvelimelle-perusohjelmat
status: published
published_at: 2012-11-01 19:16
updated_at: 2012-11-01 19:16
description: |
    ”Perusohjelmilla” tarkoitan tässä tapauksessa ohjelmia, joita tarvitsen saadakseni webbipuolen toimimaan. Sekä samalla asennellaan phpMyAdmin sekä Webmin ja muuta mukavaa. Kaikki komennot toimivat Ubuntussa ja pitäisi toimia muissakin koneissa missä on APT käytössä. Tämän on tarkoitus olla muistilista itselle ja muille, jotka tarvitsee tämänkaltaisia komentoja.
legacy: true
categories:
- Kotipalvelin
- Projekti
tags:
- apache
- boksi
- kotipalvelin
- MySQL
- ohjeet
- palvelin
- php
- PhpMyAdmin
- ssh
- Webmin
---

<p>&#8221;Perusohjelmilla&#8221; tarkoitan tässä tapauksessa ohjelmia, joita tarvitsen saadakseni webbipuolen toimimaan. Sekä samalla asennellaan phpMyAdmin sekä Webmin ja muuta mukavaa. Kaikki komennot toimivat Ubuntussa ja pitäisi toimia muissakin koneissa missä on APT käytössä.</p>
<p>Tämän on tarkoitus olla muistilista itselle ja muille, jotka tarvitsee tämänkaltaisia komentoja.</p>
<p><!--more--></p>
<h2>SSH</h2>
<p>Aloitetaan kuitenkin sillä, että asennetaan palvelimelle SSH. Tämä sen takia, jotta päästään palvelimeen käsiksi SSH:n yli ja itse tykkään hallita Linux koneita ennemmin päätteen kautta. Asennus on varsin simppeli, ajetaan vain päätteessä seuraava komento:</p>
<p><code>sudo apt-get install openssh-server</code></p>
<p>Tämän jälkeen voitkin yhdistää toiselta koneelta SSH:n yli palvelimesi IP:seen.</p>
<h2>Apache</h2>
<p>Toinen välttämättömyys itselle on Apache, tämä hoitaa webbipalvelinsoftan virkaa. Olen joskus myös käyttänyt hieman kevyemmissä setupeissa Lighttpd nimistä palvelinsoftaa. Asennus on taas simppeli komento:</p>
<p><code>sudo apt-get install apache2</code></p>
<p>Itselläni Apachen asennus antoi sitten vielä seuraavanlaisen &#8221;herjan&#8221; kun Apachea alettiin käynnistämään:</p>
<p><code>apache2: Could not reliably determine the server's fully qualified domain name, using 127.0.1.1 for ServerName</code></p>
<p>Tämän ratkaisin muokkaamalla apache2.conf filua:</p>
<p><code>sudo nano /etc/apache2/apache2.conf</code></p>
<p>Lisäämällä alkuun rivin:</p>
<p><code>ServerName boksi</code></p>
<p>Ctrl + o yhdistelmä tallentaa Nanossa (boksi on oman palvelimeni nimi)<br />
Ctrl + x yhdistelmä sulkee Nanon</p>
<p>Sen jälkeen rebootataan vielä Apache:</p>
<p><code>sudo /etc/init.d/apache2 restart</code></p>
<p>Näet Apachen toimivuuden menemällä selaimella koneesi ip-osoitteeseen (esim. http://192.168.0.66), sen pitäisi sanoa <strong>It works!</strong></p>
<h2>PHP</h2>
<p>Itse kehitän sovellukseni PHP:llä joten tämä on oikeastaan Apachen rinnalla niitä tärkeitä softia mitä pitää asentaa koneelle. PHP:n asentaminen on myöskin simppelin komennon takana:</p>
<p><code>sudo apt-get install php5</code></p>
<p>Tämän jälkeen asentelen vielä pari lisäpakettia:</p>
<p><code>sudo apt-get install php5-gd php5-cgi php5-curl</code></p>
<h2>MySQL</h2>
<p>Itse käytän tietokantana mieluiten MySQL tietokantaa ja senkin asennus on helppoa kuin heinänteko:</p>
<p><code>sudo apt-get install mysql-server php5-mysql libapache2-mod-auth-mysql</code></p>
<p>Asennus kysyy tietokannan salasanaa kahdesti.</p>
<p>Samalla asentuu myös PHP:n ja Apachen palikat MySQL tietokantaa varten.</p>
<h2>PhpMyAdmin</h2>
<p>Itse pidän siitä, että voin hallita MySQL tietokantaa helposti selaimen kautta ja PhpMyAdmin on se työkalu. Se asennetaan seuraavanlaisesti:</p>
<p><code>sudo apt-get install phpmyadmin</code></p>
<p>Asennus kysyy mikä webbipalvelin on käytössä ja siihen vastataan, että <strong>Apache 2</strong>.<br />
Asennus kysyy myös aiemmin asetettua tietokannan salasanaa sekä haluaa laittaa PhpMyAdminille oman salasanan.</p>
<p>PhpMyAdminin toimivuuden voit tarkistaa menemällä koneesiIP/phpmyadmin osoitteeseen (esim. http://192.168.0.66/phpmyadmin/). Sisään pääset tunnuksella root ja salasana on aiemmin määrittämäsi salasana.</p>
<h2>Webmin</h2>
<p>Webmin on pätevä selainpohjainen hallintasovellus palvelimelle. Sitä kautta voit näppärästi hallita käyttäjiä ja monia muitakin palvelimen asetuksia.</p>
<p>Aloitetaan lataamalla Webmin komennolla:</p>
<p><code>wget http://prdownloads.sourceforge.net/webadmin/webmin_1.600_all.deb</code></p>
<p>Sen jälkeen asennetaan paketti:</p>
<p><code>dpkg --install webmin_1.600_all.deb</code></p>
<p>Mikäli saat valituksia riippuvuuksista (depencies):</p>
<p><code>apt-get install perl libnet-ssleay-perl openssl libauthen-pam-perl libpam-runtime libio-pty-perl apt-show-versions python</code></p>
<p>Toimivuuden voit tarkistaa menemällä selaimella osoitteeseen https://omaip:10000 (esim https://192.168.0.66:10000). Tunnus on root ja salasana on oma salasanasi.</p>
<p>Seuraava huomio Webminin sivuilta:</p>
<blockquote><p>Some Debian-based distributions (Ubuntu in particular) don&#8217;t allow logins by the root user by default. However, the user created at system installation time can use sudo to switch to root. Webmin will allow any user who has this sudo capability to login with full root privileges</p></blockquote>
<p>Tässä on hyvin perussetti webbipalvelinta varten. Tulen kirjoittelemaan tämäntapaisia artikkeleita lisää sillä nämä toimivat myös hyvinä muistiinpanoina itselleni.</p>