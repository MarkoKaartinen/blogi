---
title: '@Liikennetieto botti'
slug: liikennetieto-botti
status: published
published_at: 2012-07-07 10:06
updated_at: 2012-07-07 10:06
description: |
    Eilen innostuin koodailemaan ja testaamaan miten saisin tehtyä pätevän botin Twitteriin. Koska työkseni koodaan PHP:tä niin kielen valinta oli luonnollinen ja lähdin rakentamaan sillä bottia joka parsii liikennedataa. Selitän tuon @Liikennetieto botin toimintaa seuraavaksi ja kerron hieman miten se tekee sen ja mitä ominaisuuksia siinä käytännössä on. Joka viides minuutti skripti tarkastaan onko tullut uusia… Jatka lukemista @Liikennetieto botti
legacy: true
categories:
- Blogi
tags:
- botti
- koodaus
- liikenne
- liikennetiedotteet
- liikennetieto
- php
- Twitter
---

<p>Eilen innostuin koodailemaan ja testaamaan miten saisin tehtyä pätevän botin Twitteriin. Koska työkseni koodaan PHP:tä niin kielen valinta oli luonnollinen ja lähdin rakentamaan sillä bottia joka parsii liikennedataa.</p>
<p>Selitän tuon <a href="http://twitter.com/Liikennetieto" target="_blank">@Liikennetieto</a> botin toimintaa seuraavaksi ja kerron hieman miten se tekee sen ja mitä ominaisuuksia siinä käytännössä on.</p>
<p>Joka viides minuutti skripti tarkastaan onko tullut uusia liikennetiedotteita<a href="http://tieinfo.mustcode.fi/tieinfo/" target="_blank"> TieInfon Apista</a>. Mikäli on tullut uusia niin lisätään se kantaan ja tviitataan uusi tiedote. Tviitissä on myös linkki sivustolle <a href="http://liikenne.kaartinen.eu" target="_blank">liikenne.kaartinen.eu</a>, jonne tallentuu kaikki tviitatut tiedotteet ja sieltä näkee myös tiedotteen tarkemman kuvauksen, sijainnin kartalla sekä kelikameroita lähistöltä (mikäli niitä löytyy). Yksinkertaisuudessaan homma on siinä, koodia itse bottiin ei tarvittu paljoa. Sivuston teko ja datan parsiminen tuotti eniten koodirivejä.</p>
<p>Tulen kehittämään tuota bottia tarpeen mukaan ja lisäämään ainakin joitain säätietoja lähistöltä tai jotain muuta vastaavaa. Te voitte ehdottaa minulle mitä tuohon voisi lisätä, tuo on aika toimiva paketti noinkin (vaikka itse sen sanonkin).</p>
<p>Esimerkki botin tviitistä:</p>
<blockquote class="twitter-tweet" data-width="550" data-dnt="true">
<p lang="fi" dir="ltr">Tie 19, Lapua, Kauhava. ENSITIEDOTE LIIKENNEONNETTOMUUDESTA. <a href="https://twitter.com/hashtag/liikenne?src=hash&amp;ref_src=twsrc%5Etfw">#liikenne</a> <a href="https://twitter.com/hashtag/Lapua?src=hash&amp;ref_src=twsrc%5Etfw">#Lapua</a> <a href="http://t.co/QynHOxz6">http://t.co/QynHOxz6</a></p>
<p>&mdash; Liikennetieto (@Liikennetieto) <a href="https://twitter.com/Liikennetieto/status/221424560141107201?ref_src=twsrc%5Etfw">July 7, 2012</a></p></blockquote>
<p><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></p>