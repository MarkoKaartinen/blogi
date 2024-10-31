---
title: 'Palvelimen hurinaa'
slug: palvelimen-hurinaa
status: published
published_at: 2010-09-11 13:14
updated_at: 2010-09-11 13:14
description: |
    Osa tietääkin, että olen pyörittänyt omaa virtuaalipalvelinta jo parisen vuotta ja ajattelin hieman kertoa kokemuksiani ja mietteitäni. Ensinnäkin selitetään teille sana palvelin: Palvelimella (ark. serveri, servu) tarkoitetaan tietoliikenteen yhteydessä tietokoneessa suoritettavaa palvelinohjelmistoa  sekä tällaista ohjelmistoa suorittavaa tietokonetta. Palvelinohjelmistojen tehtävänä on tarjota erilaisia palveluja muille ohjelmille joko tietokoneverkon välityksellä tai paikallisesti samassa tietokoneessa. Palvelinta käyttävää sovellusta… Jatka lukemista Palvelimen hurinaa
legacy: true
categories:
- Blogi
tags:
- Elämä
- mietteitä
- palvelin
- säätäminen
- serveri
- virtuaalipalvelin
---

<p>Osa tietääkin, että olen pyörittänyt omaa virtuaalipalvelinta jo parisen vuotta ja ajattelin hieman kertoa kokemuksiani ja mietteitäni.</p>
<p>Ensinnäkin selitetään teille sana palvelin:</p>
<blockquote>
<p>Palvelimella (ark. serveri, servu) tarkoitetaan tietoliikenteen yhteydessä tietokoneessa suoritettavaa palvelinohjelmistoa  sekä tällaista ohjelmistoa suorittavaa tietokonetta. Palvelinohjelmistojen tehtävänä on tarjota erilaisia palveluja muille ohjelmille joko tietokoneverkon välityksellä tai paikallisesti samassa tietokoneessa. Palvelinta käyttävää sovellusta tai tietokonetta nimitetään asiakkaaksi. (<a href="http://fi.wikipedia.org/wiki/Palvelin" target="_blank">wikipedia</a>)</p>
</blockquote>
<p>Seuraavaksi selitetään teille sana virtuaalipalvelin:</p>
<blockquote>
<p>Virtuaalipalvelin vastaa tavallista palvelinta  sillä erotuksella, että virtuaalipalvelimessa käyttäjä ei omista laitetta kokonaan, vaan samassa koneessa ajetaan virtuaalisesti monta palvelinta. Virtuaalipalvelinalusta voi olla useaa tyyppiä: sellaista joka tarjoaa koko-virtuaalipc:n, jolloin käyttäjä voi käyttää sitä kuin tietokonetta (asentaa oman käyttöjärjestelmän jne.) taikka sellaista, jossa käyttöjärjestelmä on kiinteä eikä sitä pysty vaihtamaan. (<a href="http://fi.wikipedia.org/wiki/Virtuaalipalvelin" target="_blank">wikipedia</a>)</p>
</blockquote>
<p>Ja kun teille on selvitetty pari termiä niin voidaan jatkaa itse artikkelin kanssa. Mikäli joku termi jää epäselväksi niin kysykää kommenteissa, niin koitan vastata mahdollisimman hyvin.</p>
<h2>Alku</h2>
<p>Aloitin virtuaalipalvelinten kanssa pelailun parisen vuotta sitten ja silloin tarkoituksena oli pääasiallisesti oma testiserveri ja irc shelli. Homma kasvoi hieman ja siitä muodostuikin kavereiden ja tuttujen irc shelli palvelu enemmänkin. Noh mikäpäs siinä kun saadaan palvelimen resursseja hyödynnettyä useammalle käyttäjälle ja samalla saan itse hyvää harjoitusta palvelimen ylläpidosta.</p>
<p>Alkuun palvelimella pyöri siis Irssi shelli, bounceri ja Lighttpd (tietty php:n kera). MySQL lisättiin optimoituna hieman myöhemmin palvelimelle.</p>
<h2>Ongelmat</h2>
<p>Quakenet tuotti ongelmia alusta asti trustien takia ja niiden saamisen vaikeuden takia. Nämä ongelmat ovat vieläkin tapetilla ja niiden kanssa tullaan taistelemaan jatkossakin.</p>
<p>Hostit&#8230; Aloitin virtuaalipalvelinten kanssa säätämisen hyvällä suomalaisella hostilla, mutta se ostettiin ja hinnat nousivat radikaalisti. Tämän jälkeen olen palvelimen joutunut siirtämään useampaan otteeseen erilaisten syiden takia. Nyt on palvelin siirrossa takaisin Suomeen ja hosti on vaikuttanut erittäin lupaavalta.</p>
<h2>Mietteitä</h2>
<p>Olen ennen virtuaalipalvelimia pelaillut ihan fyysisten rautapalvelimien kanssa, lähinnä webbipalvelimen kanssa säätänyt. Jos joku muistaa taannoisen MarkoHostingin niin se oli ensimmänen kosketus webbipalvelimiin, tosin aluksi pyöri Windowsin päällä, mutta siirtyi sitten Linuxiin. Tämä on kuitenkin kuollut projekti ja sitä ei tulla herättämään eloon.</p>
<p>Virtuaalipalvelinten kanssa säätäminen on ollut hyvä kokemus kaikin puolin, sillä tämä tuo kokemusta työelämään ja on vähän näyttöjä, että tämmöistä olen tehnyt ja tämmöinen pyörii minulla tälläkin hetkellä. Myös se ettei itse tarvitse majoittaa fyysistä konetta omaan nurkkaan hurisemaan on iso plussa ja se, että on kiinteä ip-osoite tuo suhteellisen paljon etua dynaamiseen verrattuna.</p>
<p>Uusimpana kokeiluna tuli laitettua pyörimään mailipalvelin (<a href="http://linux.fi/wiki/S%C3%A4hk%C3%B6postipalvelin" target="_blank">???</a>), joka on tällä hetkellä siinä tilassa, että voin lähettää ja vastaanottaa sähköposteja sekä lukea webmailin/sähköpostiohjelman kautta niitä. Jossain välissä tulen koittamaan siihen vielä spämmifilttereitä, maililistoja ja ehkä jotain muuta, ehdottakaa!!</p>
<h2>Tämänhetkinen tilanne</h2>
<p>Tällä hetkellä virtuaalipalvelin pyörii, mutta on odottamassa siirtoa uudelle hostille. Quakenetin trustipolitiikka hidastaa taas toimintaa. Palvelimen resursseja tullaan siirron jälkeen hyödyntämään enemmän ja paremmin,sekä mahdollisesti laajennetaan toimintaa hieman.</p>
<h2>Tulevaisuus</h2>
<p>Tulen jatkamaan kokeiluja virtuaalipalvelimen kanssa ja laajennan osaamistani ja tietämystäni sillä saralla. Jossain vaiheessa tulen myös laittamaan fyysisen rautapalvelimen jonnekkin hyrräämään &#8211; todennäköisesti vain lähiverkkoon, mutta pieni testipenkki olisi ihan hyvä ratkaisu.</p>
<p>Myös virtuaalipalvelimen hallintaan olisi tarkoitus koodailla jonkinlainen webbipohjainen käyttöliittymä. Nyt hallinta tapahtuu käsin ja vain yksi bash skripti on tehty helpottamaan hallintaa.</p>
<p><strong>Kysymyksiä, kommentteja, ehdotuksia?! Rohkeasti vaan, en pure!</strong></p>