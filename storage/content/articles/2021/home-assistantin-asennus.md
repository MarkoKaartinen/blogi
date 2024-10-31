---
title: 'Home Assistantin asennus'
slug: home-assistantin-asennus
status: published
published_at: 2021-12-09 11:40
updated_at: 2021-12-09 11:40
description: |
    Asennellaan Home Assistant Raspberry Pi 4 SSD:lle ja tutkitaan hieman millainen systeemi on oikein kyseessä.
legacy: true
categories:
- Älykoti
tags:
- äly
- älykoti
- Home Assistant
- smart home
series:
- Älykoti
---

<p>Pitihän se jo jostain aloittaa vaikka ei Zigbee tikkua olekaan vielä. Piti nimittäin asentaa Home Assistant, joka tulee toimimaan koko operaation aivoina. </p>



<p>Sattuipa vielä niin, että itsellä on tähän steppiin kaikki vaadittavat laitteet jo olemassa. Löytyy nimittäin Raspberry Pi 4 jo tuolta kaapista joka oli menossa toiseen projektiin, mutta pääseekin parempaan käyttöön tässä. Katsellaan uutta raspia sitten, kunhan hinnat hieman fiksuuntuu&#8230; Haluaisin itseasiassa tähän projektiin ennemmin Intel NUC konesetin, jossa voisin Docker konteissa pyöritellä muutakin, mutta mennään nyt kevyesti Raspberry Pi koneella ja päivitetään joskus jos tulee tarvetta.</p>



<p>Home Assistanthan tulee hoitamaan automaatioita ja yleensäkin toimintaa. Ajatus olisi myös vanha iPad tabletti saada toimimaan niin, että siitä voisi ohjata koko kodin älylaitteita ja nähdä lämpötilat yms. mitä nyt onkaan. </p>



<h2 class="wp-block-heading">Ensimmäinen asennus</h2>



<p>Home Assistantin omissa <a href="https://www.home-assistant.io/installation/raspberrypi" target="_blank" rel="noreferrer noopener">dokkareissa</a> on oikeastaan hyvät ohjeet asennukseen, joten en sitä sen enempää lähde tässä avaamaan.</p>



<p>Asentelin tämän ensin MicroSD kortille ja pyörittelin tätä jokusen päivän ihan vain kokeeksi ja niin, että näin millainen tämä on ja miten homma toimii. </p>



<p>Tässä ajassa tuli kuitenkin ongelmia siinä, että satunnaisesti se hävisi verkosta tai kaatui kokonaan. Vain virtapiuhan irroitus nosti sen takaisin pystyyn. En tätä ihan kauheammin alkanut tutkimaan, sillä ajatus oli tämä saada SSD levylle pyörimään kuitenkin lopulta.</p>



<p>Voi olla, että toi vanha MicroSD kortti ei ollut paras ratkaisu tähän käyttöön. Eikä varmaan ollutkaan&#8230; </p>



<h2 class="wp-block-heading">Toinen asennus SSD levylle</h2>



<p>Vähemmän yllättäen multa löytyikin yksi SSD levy, jonka tilasin BF tarjouksista toiseen käyttöön, mutta otetaan se nyt tähän. Samaten löytyy SATA &#8211; USB adapterikin, joten hommahan on taas osien osalta selvä.</p>



<p>Tähänkin hommaan löytyy ohjetta tällä kertaa Home Assistantin <a href="https://community.home-assistant.io/t/installing-home-assistant-on-a-rpi-4b-with-ssd-boot/230948" target="_blank" rel="noreferrer noopener">foorumeilta</a>. Käytännössä ensin asennetaan Raspberry OS jolla päivitetään Raspberry Pi ja otetaan USB bootti käyttöön. Sen jälkeen SSD:lle heitetään Home Assistant ja pistetään kiinni. </p>



<p>Tämähän lähti toimimaan suht kivutta ja toimikin tuossa pari päivää hyvin. Nyt oli kuitenkin viime yönä kaatunut ja samaa ongelmaa kuin aiemmin. Koitan tässä nyt pistää tietokantaa MariaDB päälle ja 30s välein dataa sinne aiemman sekunnin sijaan. Katsotaan mitä tapahtuu.</p>



<p>Tämähän olisi hyvä saada luotettavasti toimimaan jo vaikka ei ole mitään ihmeellisempää vielä pyörimässä.</p>



<h2 class="wp-block-heading">Onko Home Assistantissa jo jotain toimivaa käytössä?</h2>



<p>Oikeastaan on. Vaikka ei tuota Zigbee tikkua olekaan ja en vielä saa noita Ikean valoja ja liiketunnistimia otettua mukaan niin jotain saatiin jo toimimaan. </p>



<p>Kuten varmaan moni lukija tietää niin mulla on RuuviTageja käytössä lämpötilan seurantaan. Nämä saa myös Home Assistanttiin käyttäen <a href="https://github.com/ruuvi-friends/ruuvi-hass.io" target="_blank" rel="noreferrer noopener">ruuvi-HASS.io GitHub repoa</a>. Asennus on suht helppo ja konffiminenkin käy ohjeiden mukaan. Sen jälkeen mulla on mahdollista nähdä Ruuvien tuottamaa lämpötilaa dataa Home Assistantissa ja voinpa vaikka tehdä halutessani automaation, jossa saunan mittarin mennessä haluttuun lämpötilaan alkaa valot vilkkua (siis sitten, kun Zigbee tikku tulee).</p>



<p>Meillä on vaimon kanssa yhteinen Google kalenteri johon merkataan meitä molempia koskevat menot ja onpa siellä vaimon työvuorotkin (vuorotyöläinen kun on). Tämänkin kalenterin sain helposti näkyviin Home Assistanttiin.</p>



<p>Meillä molemmilla on käytössä iPhonet nykyään ja tätä kautta sitten pystytään hyödyntämään tietoa missä mennään siis kartalla. Tätä tietoa voidaan siis hyödyntää esimerkiksi niin, että kun kumpikaan ei ole kotona niin sammutetaan valot jos ne ovat sattuneet jäämään päälle.</p>



<h2 class="wp-block-heading">Lopuksi</h2>



<p>Mitä tässä nyt hieman vasta puuhastellut tuon kanssa niin vaikuttaa tosi hyvälle systeemille. Paljon saa aikaan jo ihan &#8221;kliksuttelemalla&#8221; ja hieman kun tajuaa syvemmälle niin pääsee vielä pidemmälle. </p>



<p>Vaikka ei vielä olekaan sen isompia automaatioita niin alkaa tajuta tuon tarjoamat mahdollisuudet. Niitä on oikeastaan niin paljon, kuin on halua puuhata ja kuluttaa rahaa. </p>



<p>Tässä on myös se hyvä puoli, että tätä voi laajentaa pala kerrallaan. Ei siis ole ajatus koko huushollia pistää kerralla tuon taakse vaan pala kerrallaan. Aluksi varmaan valo kerrallaan &#8211; nyt tosin ollaan jo siinä tilanteessa, että osa valoista on jo mahdollisuus liittää Home Assistanttiin (kunhan se pirun Zigbee tikku tulee).</p>



<p>Vuotosensorit tulee myös yksi kohde olemaan sillä olisihan se hyvä tietää, jos apk vuotaa vettä tuonne taakse tai joku putki vuotaa vettä. Niitä kun pistää sopiviin paikkoihin voi saada vuodon kiinni ennen isompaa vahinkoa.</p>



<p>Tietenkin ajatus ja tavoite on se, että nämä ei häiritse elämistä vaan päin vastoin helpottaa sitä. Portaikon valojen automatisointi helpotti jo hieman, mutta Home Assistant tuo siihen mahdollisuuden säätää valojen kirkkautta yöllä eriksi, kuin päivällä. </p>



<p>Sittenhän tätä touhua voi oikeasti harrastaa, kun joskus on oma asunto. Nyt nimittäin ei ole intoa alkaa korvaamaan valokytkimiä älykkäillä kytkimillä. Siitäpä johtuen on parissa kohtaa nytkin käytössä Ikean Trådfri valonkatkaisin jossa on himmennys ja tilan säädin ja varsinainen kytkin on teipattu ON asentoon. </p>



<p>Jatketaan Zigbee tikkua odotellessa Home Assistanttiin tutustumista ja säätöä sen suhteen. Vinkkejä voi heitellä tuonne kommenttiboxin puolelle!</p>