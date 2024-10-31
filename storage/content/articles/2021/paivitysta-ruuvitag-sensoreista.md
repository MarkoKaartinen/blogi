---
title: 'Päivitystä RuuviTag sensoreista'
slug: paivitysta-ruuvitag-sensoreista
status: published
published_at: 2021-07-30 09:46
updated_at: 2021-07-30 09:46
description: |
    Nyt onkin aika päivittää tätä tarinaa. RuuviTag sensoreita onkin tällä hetkellä kahdeksan kappaletta ja tuntuu, että pitäisi olla lisää.
legacy: true
categories:
- Blogi
tags:
- IoT
- Ruuvi
- RuuviTag
---

<p>Kirjoittelin tuossa joulun aikaan miten olen ottanut RuuviTag (<a href="https://ruuvi.com/" target="_blank" rel="noreferrer noopener">ruuvi.com</a>) sensorit käyttöön omassa kodissa. <a href="https://markokaartinen.net/ruuvitagit-koko-kodin-lamposensoreina/">Linkki artikkeliin →</a></p>



<p>Nyt onkin aika päivittää tätä tarinaa. Sensoreita onkin tällä hetkellä kahdeksan kappaletta ja välillä tuntuu, että pitäisi olla pari vielä lisää&#8230; Eli nälkähän tässäkin kasvaa syödessä.</p>



<p>Itsessään toiminta ei ole muuttunut. Vieläkin hommaa pyörittää Raspberry Pi tietokoneessa pyörivä Python skripti, joka lähettää joka minuutti sensorien tiedot virtuaalipalvelimelle, jossa sitten tietoa näytetään. Olen vieläkin yllättynyt siitä, että alakerran komerossa oleva Raspberry Pi saa tiedot kaikista RuuviTageista eli niiden kantama on kyllä omaan makuun tosi hyvä. </p>



<p>Hieman olen ulkokiinnityksiä päivittänyt ja varsinkin takapihan osalta. Veli löysi passelin 3D tulostus mallin, joka on nimenomaan RuuviTageille tarkoitettu. Tämän tulostinkin PET muovista ja se on vielä kestänyt tosi hyvin ja toimiikin mallikkaasti.</p>



<div class="wp-block-image"><figure class="aligncenter size-large"><img loading="lazy" decoding="async" width="1600" height="1600" src="https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-1600x1600.jpg" alt="" class="wp-image-7615" srcset="https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-1600x1600.jpg 1600w, https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-1000x1000.jpg 1000w, https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-300x300.jpg 300w, https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-1536x1536.jpg 1536w, https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-2048x2048.jpg 2048w, https://cdn.markokaartinen.net/uploads/2021/07/2021-03-15-18.05.58-1568x1568.jpg 1568w" sizes="(max-width: 1600px) 100vw, 1600px" /><figcaption>3D tulostettu &#8221;sääasema&#8221;</figcaption></figure></div>



<p>Aamulla tulee vieläkin tuttu sähköposti, joka kertoo viime yön maksimin ja minimin sekä sen hetkisen tilanteen. Antaapa se sääennusteenkin. Tähän on ulkoasua muutettu sekä hallinan puolelta voi nyt määrittää mitä RuuviTageja näytetään sähköpostissa ja monelta se lähtee.</p>



<div class="wp-block-image"><figure class="aligncenter size-full"><img loading="lazy" decoding="async" width="537" height="713" src="https://cdn.markokaartinen.net/uploads/2021/07/image.png" alt="" class="wp-image-7612"/><figcaption>Aamuinen sähköposti</figcaption></figure></div>



<p>Hallintaa onkin muutettu sitten oikein urakalla ja ulkoasu onkin muuttunut. Etusivulle on ensinnäkin mahdollista pistää kuvat taustaksi sensoreista jolloin ne tunnistaa helposti. Itseltä uupuu pari kuvaa, kun pakastimien seuranta aloitettiin vasta äskettäin.</p>



<div class="wp-block-image"><figure class="aligncenter size-large"><img loading="lazy" decoding="async" width="1600" height="467" src="https://cdn.markokaartinen.net/uploads/2021/07/image-1-1600x467.png" alt="" class="wp-image-7613" srcset="https://cdn.markokaartinen.net/uploads/2021/07/image-1-1600x467.png 1600w, https://cdn.markokaartinen.net/uploads/2021/07/image-1-1000x292.png 1000w, https://cdn.markokaartinen.net/uploads/2021/07/image-1-1536x448.png 1536w, https://cdn.markokaartinen.net/uploads/2021/07/image-1-1568x457.png 1568w, https://cdn.markokaartinen.net/uploads/2021/07/image-1.png 1920w" sizes="(max-width: 1600px) 100vw, 1600px" /><figcaption>&#8221;Dashboard&#8221;</figcaption></figure></div>



<p>Hallintaan on myös tullut mahdollisuus laittaa hälytyksiä. Hälytyksen voikin määrittää haluamakseen eli onko saatu arvo isompi/pienempi kuin haluttu. Voit pistää hälytyksen niin lämpötilaan, ilmanpaineeseen, kosteuteen tai pariston jännitteeseen. Itsellä on käytössä hälytys, kun saunan lämpötila on haluttu sekä jos pakkasten lämpötila menee liian lämpimäksi. Hälytys tulee sitten Telegrammiin halutun viestin kera.</p>



<p>Optimointiakin on tehty tuonne hallinnan puolelle. Joka yö arkistoidaan vanhaa dataa ja näin saadaan tuo varsinainen datatulu pysymään fiksun kokoisena. Arkistoon pitäisikin rakennella työkalu, jotta voi historiadataa seurata ja tutkia.</p>



<p>Myös puhelinkäyttöä on mietitty. iPhonessa saa laitettua verkkosivun kuvakkeeksi ja näin avattua sen kuten minkä tahansa applikaation. Teinkin yksityiset linkit (jotka voi nollata), jotka saa laitettua avautumaan. Samoin käyttöliittymässä on pelkästään sääkortit.</p>



<div class="wp-block-image"><figure class="aligncenter size-full"><img loading="lazy" decoding="async" width="1242" height="2688" src="https://cdn.markokaartinen.net/uploads/2021/07/img_3234.png" alt="" class="wp-image-7614" srcset="https://cdn.markokaartinen.net/uploads/2021/07/img_3234.png 1242w, https://cdn.markokaartinen.net/uploads/2021/07/img_3234-1000x2164.png 1000w, https://cdn.markokaartinen.net/uploads/2021/07/img_3234-710x1536.png 710w, https://cdn.markokaartinen.net/uploads/2021/07/img_3234-946x2048.png 946w" sizes="(max-width: 1242px) 100vw, 1242px" /><figcaption>&#8221;Mobiiliappi&#8221;</figcaption></figure></div>



<p>Tätähän voisi tosiaan kehittää vaikka kuinka pitkälle. Nyt ollaan menty tosiaan tällä setupilla ja oon kyllä tosi tyytyväinen. Ei ole puhettakaan, että lähtisin hankkimaan mitään muuta järjestelmään lämpötilan seurantaan. RuuviTagit on helppoja, kun voit vain laittaa sen esim. pakkaseen tai jääkaappiin ja alkaa seuraamaan.</p>



<p>Tämä on myös käytössä veljellä ja hänellä on omat RuuviTagit seurannassa ja omat tunnukset tuohon järjestelmään. Hänellä on myös Raspberry Pi, joka lähettää tuolle palvelimelle kerran minuutissa tiedot.</p>



<p>Home Assistantin kanssa voisi joskus alkaa myös pelailemaan enemmän ja näin voisi saada automaatiota ja älykkyyttä kotiin. Tästä tulenee postausta, jos tälle tielle lähdetään.</p>