---
title: 'Portaiden valot syttymään automaattisesti'
slug: portaiden-valot-syttymaan-automaattisesti
status: published
published_at: 2021-12-03 11:10
updated_at: 2021-12-03 11:12
description: |
    Portaikon valot syttymään automaattisesti Ikea Trådfri liiketunnistimen ja valojen avulla. Kaksi liiketunnistinta ohjaa yhtä valoa.
legacy: true
categories:
- Älykoti
tags:
- äly
- älykoti
- ikea
- smart home
- Trådfri
- valot
series:
- Älykoti
---

<p>Ensimmäisiä kevyitä älytyksiä piti tehdä portaisiin. Muistin, että aiemmasta mulla on jemmassa yksi Ikean Trådfri lamppu ja siihen jos parittaa Ikean liiketunnistimen niin siitähän saa portaisiin älyä.</p>



<p>Tavoite oli siis saada portaikon valo syttymään, kun siihen tullaan joko alhaalta tai ylhäältä. Portaikon muodosta ja eläimistä johtuen en usko, että yksi liiketunnistin olisi riittänyt.</p>



<p>Ikean ohjeissa ei löytynyt tietoa siitä, että saisiko kaksi liiketunnistinta yhteen lamppuun ilman Ikean siltaa ja en sitä halua ostaa, koska tilasin jo yleisen Zigbee tikun jonka kanssa Ikean kamat ovat yhteensopivia.</p>



<p>Verkosta kyseltyäni tämä olisi siis ehkä mahdollista. No eipä tuo kalliksi tule ja sitten ne viimeistään alkaisi toimimaan, kun saisin tuon Zigbee tikun. Noihan liiketunnistimet maksaa 9,99€ kappale ja ovat suht perus kamaa. Niissä on 3min &#8221;cooldown&#8221; eli ne havaitsee liikettä 3min jälkeen ja tuon ajan se valokin pysyy päällä ellei siis havaita liikettä. 3 minuutissa kerkeät nuo portaat kiivetä kyllä.</p>



<h2 class="wp-block-heading">Asennus</h2>



<p>Asennus oli suht simppeli homma. Lamppu päälle ja toisen tunnistimen paritus. Sit huomasinkin, että valo on himmeällä eli vanhojen säätöjen asetuksia olisiko ollut. Noh, paritin sen hetkeksi työhuoneen valojen kaukoon ja sain sitten valon kirkkauden sopivaksi ja jatketaan tunnistimien säätöä.</p>



<p>En ehkä saanut ekalla kertaa varmaan paritettua oikein, kun valo ei sammunutkaan. Noh tehdasasetukset takaisin tunnistimeen ja uusi kokeilu. Nyt onnistui paritus ja valo sammui ja syttyi sitten kun havaittiin liikettä. Oltiin siis puolessa välin.</p>



<p>Sitten piti saada vielä kaksi liiketunnistinta toimimaan tuon yhden valon kanssa. Ilmeisesti ne on mahdollista kloonata seuraavalla ohjeella:</p>



<ol class="wp-block-list"><li>Nollaa varuiksi molemmat liiketunnistimet tehdasasetuksiin</li><li>Parita toinen liiketunnistin lampun kanssa</li><li>Kloonaa tunnistimet pitämällä niitä lähellä toisiaan ja painamalla synkkaus painiketta 10s</li><li>Homma selvä</li></ol>



<p>Itse tein tuon pari kertaa sillä eka ei varmaan onnistunut kunnolla ja sitten tein varuiksi toisen kerran. Sillä lähti pelittämään.</p>



<p>Noiden toiminnan testaus vaati hieman kärsivällisyyttä sillä piti odottaa, että valo sammuu ja sitten testata syttyykö valo toisesta tunnistimesta ja sitten taas odottaa. Tämän jälkeen vielä koitin, että toimiiko ne aiotusta asennuspaikasta. Toimihan ne.</p>



<h2 class="wp-block-heading">Lopputulos ja ajatuksia jatkosta</h2>



<p>Alla on lyhyt video mistä näkee, että sehän valo syttyy kun portaikkoon menee. Eli homma rokkaa kuten olin ajatellutkin.</p>



<figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
<iframe loading="lazy" title="Portaiden liiketunnistin" width="750" height="422" src="https://www.youtube.com/embed/Riohd7Huv2A?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div></figure>



<p>Sitten, kun saan hieman älykkyyttä lisää tehtyä eli kun tulee Zigbee tikku niin pitää ehkä tehdä lisää älyä. Toihan voisi sitten toimia esimerkiksi niin, että valo syttyy kun havaitaan liikettä alhaalla ja sammuu kun havaitaan liikettä ylhäällä (sekä sama toisin päin).</p>



<p>Samaten voisi ohjelmoida, että yöaikaan valon teho olisi pienempi, kuin sitten päiväsaikaan.</p>



<p>En sitten tiedä onko se mahdollista, että kun alempi tunnistin havaitsee liikettä ylemmän tunnistimen jälkeen niin sytytetään myös valo alakerrasta.</p>



<p>Toinen mikä vielä mietityttää on, että miten sensorit ottaa elukoiden liikkeet. Sen näkeekin sitten tässä tulevaisuudessa, kunhan eletään tuon kanssa hieman.</p>



<p>Jatketaan puuhastelua ja tällä hetkellä tyytyväinen näihin.</p>