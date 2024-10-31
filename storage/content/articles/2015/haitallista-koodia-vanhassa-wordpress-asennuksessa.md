---
title: 'Haitallista koodia vanhassa WordPress asennuksessa'
slug: haitallista-koodia-vanhassa-wordpress-asennuksessa
status: published
published_at: 2015-05-04 15:45
updated_at: 2015-05-04 15:45
description: |
    Olen viikonlopun aikana siirrellyt sivujani palvelimelta toiselle sillä asentelin Vesta nimisen hallintapaneelin ja lähdin sen kanssa pelaamaan. Tästä tulee juttua vielä erikseen. Siirsin kaikki sivut sellaisenaan ja tavoite oli päivitellä WordPressit ja muut samalla ellei ne olleet ajantasalla. Sivustoissa oli yksi tai kaksi WP asennusta, jotka ei ole juurikaan käytössä ja domainit meni minne sattuu… Jatka lukemista Haitallista koodia vanhassa WordPress asennuksessa
legacy: true
categories:
- Blogi
tags:
- Debian
- find
- Linux
- ncdu
- ongelma
- rm
- sähköposti
- spam
- wordpress
---

<p>Olen viikonlopun aikana siirrellyt sivujani palvelimelta toiselle sillä asentelin Vesta nimisen hallintapaneelin ja lähdin sen kanssa pelaamaan. Tästä tulee juttua vielä erikseen. Siirsin kaikki sivut sellaisenaan ja tavoite oli päivitellä WordPressit ja muut samalla ellei ne olleet ajantasalla. Sivustoissa oli yksi tai kaksi WP asennusta, jotka ei ole juurikaan käytössä ja domainit meni minne sattuu &#8211; otin ne nyt käyttöön oikein ja sieltähän löytyi jotain mielenkiintoista. Puran tässä nyt tapahtumaketjua hieman teille auki ja otetaan opiksi tästä.</p>
<h3>Levytilan täyttyminen</h3>
<p>Huomasin, että levytila oli jostain syystä täyttynyt ja ihmettelin suuresti tätä. Siirrettävää materiaalia kun oli ollut alle 10 gigaa ja tilla pitäisi olla käytössä reilusti. Tilan täyttymisestä älähti MySQL kun se ei halunnut toimia oikein. Olipa tämän ansioista yksi taulu hieman korruptoitunut, mutta mitään tämän vakavempaa ei ollut tapahtunut &#8211; tietoa ei sentään kadonnut.</p>
<h3>Täyttymisen syy?</h3>
<p>Levytilan täyttymisen syyksi paljastui nopeasti <code>/var/spool/exim4/</code> kansio. Olen löytänyt mahtavan työkalun levytilan käytön tutkimiseen &#8211; nimi on ncdu. Sen saa asennettua suoraan Ubuntussa <code>apt-get install ncdu</code> komennolla ja komennolla <code>ncdu /</code> se skannaa ja näyttää tulokset sinulle (kuva alla).</p>
<figure id="attachment_5671" aria-describedby="caption-attachment-5671" style="width: 600px" class="wp-caption aligncenter"><a href="https://cdn.markokaartinen.net/uploads/2015/05/Screenshot-2015-05-04-10.42.35.png"><img loading="lazy" decoding="async" class="wp-image-5671 size-large" src="https://cdn.markokaartinen.net/uploads/2015/05/Screenshot-2015-05-04-10.42.35-1200x617.png" alt="" width="600" height="309" /></a><figcaption id="caption-attachment-5671" class="wp-caption-text">Tämän hetkinen tilanne ncdu:n mukaan</figcaption></figure>
<p>Komento exim -bp näyttää hieman sitä mitä siellä jonossa oikein on. Samoin komento <code>exim -q</code> alkaa tyhjäämään jonoa. Tiedostoja oli kuitenkin rutkasti ja päädyin ensin koittamaan perinteistä <code>rm *</code> komentoa tuolla kansiossa. Tämä kuitenkin antoi argument list too long ilmoituksen sillä tiedostoja oli niin paljon. Hätä ei ole tämän näköinen vaan laitetaan komento <code>find ./ -type f -name "*" | xargs rm -f</code> sisään joka poistaa nuo tiedostot.</p>
<h3>Ongelman löytäminen</h3>
<p>Ongelma ei ratkennut kuitenkaan tähän. Tiedostoja tuli kokoajan lisää ja avasinkin pari tiedostoa. Näissä tiedostoissa koitettiin lähettää spämmiä erääseen oman domainin sähköpostiosoitteeseen mitä ei ole olemassakaan. Kaikki nuo tiedostot jäivät tuonne jumiin kun ei saanut mailia lähtemään. Tiedostossa myös kerrottiin mikä koitti lähettää ja vastauksena oli alias.php niminen tiedosto.</p>
<p>Seuraavaksi aloin etsimään tuota alias.php tiedostoa. Komento <code>find / -name "alias.php"</code> kertoi minulle tarkalleen missä tiedosto oli. Poistin sen ja välittömästi loppui uusien tiedostojen tuleminen sähköpostijonoon ja ongelma katosi. Joku oli tuota alias.php tiedostoa kutsunut koko sen ajan mitä tuo uusi palvelin oli ollut verkossa ja siitä lähtien kun toin tuon vanhan projektin näkyviin taas oikein.</p>
<h3>Mitä opin tästä?</h3>
<p>Ensinnäkin sen, että pidä huoli päivityksistä oli kyse miten vanhasta projusta tahansa (ehkä jopa hylätystä). Jostain syystä tuolla sivustolla ei ollut pelannut WordPressin automaattiset päivityksetkään &#8211; outoa. Toisekseen kun siirrän sivuja ensi kerran niin päivitä mielellään ennen siirtoa.</p>
<p>Opin myös hieman paremmin jäljittämään näitä ongelmia ja mistä ne voi johtua. Kaikelle tuppaa olemaan palvelinpuolellakin syy ja tällä kertaa syy oli yhdessä ainoassa koodissa.</p>
<p>Tämä artikkeli jääköön tänne blogiin muistutukseksi niin minulle kuin muille ja on tässä jokunen hyödyllinen komentokin laitettu jemmaan!</p>
<p>Katselin myös tuon Vesta hallintapaneelin käppyröitä. Alla onkin havainnollistava kuva tuosta exim4 palvelimen toiminnasta.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2015/05/image.png"><img loading="lazy" decoding="async" class="aligncenter size-full wp-image-5668" src="https://cdn.markokaartinen.net/uploads/2015/05/image.png" alt="image" width="537" height="189" /></a></p>
<p>Kuvasta näkeekin suoraan milloin minä tuon huomasin ja miten se vaikutti. 270 tuhatta spämmiä on koitettu lähettää oman domainin sähköpostiin jota ei ole edes olemassa. Se tippui käytännössä nollaan kun tuo alias.php poistettiin.</p>
<p>Tuo palvelin on ollut nyt tehokkaassa seurannassa ja mitään ongelmia ei ole tullut ilmi tänä aikana enää tähän liittyen.</p>
<p>Pitää myös etsiä palvelinpuolelle joku skannaus koodi joka tekisi tätä skannausta kerran pari päivässä, jos on heittää vinkkiä niin tuonne kommenttiboxiin voi heitellä. Toinen vaihtoehto voisi olla jokin WordPress plugari joka pitäisi tuosta puolesta huolta.</p>