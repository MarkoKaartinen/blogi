---
title: 'Ylimääräinen salasanasuojaus WordPressin hallintaan'
slug: ylimaarainen-salasanasuojaus-wordpressin-hallintaan
status: published
published_at: 2013-10-17 16:35
updated_at: 2013-10-17 16:35
description: |
    Olen omille sivuilleni asettanut ylimääräisen salasanasuojauksen htaccessin avulla WordPressin hallintaan. Tämä sen takia, koska aika moni koitti pommittaa tuota kirjautumista ja koitti kirjautua milloin milläkin tunnuksilla sisälle. Koska tähän blogiin ei voi rekisteröityä ja kommentointi onnistuu sosiaalisten medioiden tunnuksilla niin koin turhaksi pitää tuota kirjautumissivua avoimena kaikille – säädin siis htaccess suojauksen tuohon ja tässä… Jatka lukemista Ylimääräinen salasanasuojaus WordPressin hallintaan
legacy: true
categories:
- Blogi
tags:
- htaccess
- htpasswd
- salasanasuojaus
- turvallisuus
- wordpress
- wp-login
---

<p>Olen omille sivuilleni asettanut ylimääräisen salasanasuojauksen htaccessin avulla WordPressin hallintaan. Tämä sen takia, koska aika moni koitti pommittaa tuota kirjautumista ja koitti kirjautua milloin milläkin tunnuksilla sisälle. Koska tähän blogiin ei voi rekisteröityä ja kommentointi onnistuu sosiaalisten medioiden tunnuksilla niin koin turhaksi pitää tuota kirjautumissivua avoimena kaikille &#8211; säädin siis htaccess suojauksen tuohon ja tässä artikkelissa kerron miten se tapahtuu.</p>
<p>Itse prosessihan on suhteellisen yksinkertainen, sinun pitää muokata yhtä tiedostoa ja luoda toinen tiedosto. Tämän jälkeen kun menee WordPressin kirjautumiseen tulee selaimeesi ikkuna, joka kysyy tunnusta ja salasanaa, mikäli haluat useamman tunnuksen ja salasanan niin sekin onnistuu &#8211; kerron myös tästä.</p>
<p>Aloitetaan luomalla <em>.htpasswd</em> niminen tiedosto (huomioi piste alussa!). Tähän tiedostoon tulee tunnus ja salasana, voit luoda tunnuksen ja salasanan minun tekemällä lomakkeella. Mikäli haluat useita tunnuksia niin teet niitä niin monta kuin haluat ja jokainen tunnus ja salasana tulee omalle riville &#8211; alla onkin esimerkki .htpasswd tiedostosta.</p>
<blockquote><p><code>marko:$apr1$FZLBhENO$3UcsZmxpl3Rf7cyjoknop0</code></p></blockquote>
<p>Mikäli haluat usean tunnuksen niin alla on esimerkki siitäkin:</p>
<blockquote><p><code>tunnus1:$apr1$oA2hjvFS$fTu94t3KiTq6ZwdGZEUMF/<br />
tunnus2:$apr1$TK6Tr.O4$T0OloN8anV/Pe42a3HMkz0</code></p></blockquote>
<p>Seuraavaksi siirrät .htpasswd tiedoston webbipalvelimelle, jos et tätä siis jo tehnyt. Itse jätin tämän juureen enkä laittanut www tai public_html kansion sisään.</p>
<p>Tämän siirron jälkeen muokkaa WordPressin .htaccess tiedostoa ja lisää loppuun seuraavanlainen tekstinpätkä:</p>
<blockquote><p><code>&lt;Files wp-login.php&gt;<br />
AuthUserFile /home/marko/.htpasswd<br />
AuthName "Private access"<br />
AuthType Basic<br />
require valid-user<br />
&lt;/Files&gt;<br />
</code></p></blockquote>
<p>Muokkaa polku oikeaksi, itselläni tämä on /home/marko/ &#8211; mikäli et tiedä niin voit katsoa verkkosivusi palveluntarjoajan hallinnasta tai sitten kysyä palveluntarjoajaltasi tätä polkua.</p>
<p>Tämän jälkeen kun menet omasivusi.fi/wp-admin osoitteeseen (huom. vaihda omasivusi.fi) niin pitäisi tulla ikkuna joka kysyy tunnusta ja salasanaa.</p>