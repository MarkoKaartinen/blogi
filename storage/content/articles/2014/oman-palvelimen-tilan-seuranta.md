---
title: 'Oman palvelimen tilan seuranta'
slug: oman-palvelimen-tilan-seuranta
status: published
published_at: 2014-10-29 13:33
updated_at: 2014-10-29 13:33
description: |
    Oman palvelimen tilan seuranta auttaa sinua saamaan selville milloin palvelin on ollut saavuttamattomissa ja saat siitä vielä halutessasi ilmoituksen.
legacy: true
categories:
- Blogi
- Kotipalvelin
tags:
- kotipalvelin
- palvelin
- seuranta
- status
- tila
---

<p>Rolle kirjoitteli omassa englanninkielisessä <a href="http://problemsolv.in/admin-labs-notifies-websites-go/" target="_blank">blogissaan</a> tästä ja päätin vinkata tämän eteenpäin teillekkin. Admin Labs on simppeli palvelu oman palvelimen tilan seurantaan.</p>
<p>Rekisteröityminen on ilmaista ja saat aluksi vielä viiden euron arvosta krediittejä. Krediittejä kuluu sitä mukaa miten paljon ajat tarkastuksia. Jos ajat minuutin välein tarkastusta, että palvelin on pystyssä tulee niitä 1440 kappaletta päivän aikana ja näin krediittejä menee 0,14 per päivä. Voisit siis noin 35 päivää tuolla viidellä eurolla skannata palvelintasi.</p>
<p>Itselläni on aluksi tuolla kaksi palvelinta skannattavana. Tämä oma virtuaalipalvelin missä pyörii MarkoKaartinen.net sivusto ja muita sivujani sekä meidän firman Hades testipalvelin. Laitoin Admin Labsin tarkastamaan palvelimia kerran tunnissa, joten tarkastuksia tulee yhteensä 48 kappaletta. Yksi tarkastus maksaa 0,0001 krediittiä eli päivässä 0,0048 krediittiä &#8211; ainakin jos oikein laskeskelin. Näin siis tuolla viiden euron krediiteillä voin pyöritellä tarkastuksia 1041 päivää eli pyöreästi vajaa kolme vuotta. Kyse ei siis ole todellakaan kalliista palvelusta!</p>
<p>Tarkemman listan ominaisuuksista voit lukea palvelun omilta <a href="https://www.adminlabs.com/index/monitor-features" target="_blank">sivuilta</a>. Mainitsen nyt kuitenkin, että voit saada hälytyksiä sähköpostiin, tekstiviestillä tai pushover sovelluksen kautta mikäli palvelin on alhaalla. Voit myös lisätä huoltoajat jolloin palvelu tietää, että voi olla katkoja ja halutessasi ei ilmoita näistä erikseen sähköpostiisi. Samaten sinulla on mahdollisuus laittaa sivuillesi näkyviin palvelinten tila. Laitoinkin esimerkiksi tähän alas näkyviin Hadeksen ja oman VPS:n tilat. Uptime ei täysin pidä paikkaansa sillä Admin Labs aloitti seurannan äskettäin ja oma VPS:ni on ollut pystyssä 56 päivää ja Hades on ollut 8 päivää.</p>
<p><iframe src="https://www.adminlabs.com/status/show/id/0c94c29d-5dac-11e4-8471-ce6124683663" frameborder="0" style="width:100%; height:500px;"></iframe></p>
<p>Tulen varmaan laajentamaan käyttöä töiden lomaan ja laittelen meidän firman hallinnassa olevia palvelimia myös seurantaan tämän sovellutuksen kautta. Tämä helpottaa hieman meidän työtä, kun saadaan ilmoitus jos asiakkaan palvelin ei toimikaan.</p>