---
title: 'Viimeaikaiset tietovuodot'
slug: viimeaikaiset-tietovuodot
status: published
published_at: 2011-11-28 18:36
updated_at: 2011-11-29 14:56
description: |
    Heitänpä minäkin oman lusikan soppaan tai heitän lusikan soppaan tässä blogissa. Olen puhunut tästä aiheesta RantSitellä ja yksityisissä keskusteluissa. Nyt on aika tuoda tämä aihe myös tälle sivustolle. Viime yönä julkaistiin taas tietoja, tällä kertaa kyseessä oli noin 70000 ihmisen salasanat, sähköpostiosoitteet ja tunnukset Terve.fi sivustoperheestä. Näiden takanahan on Darwin Media Oy ja heidän mukaansa… Jatka lukemista Viimeaikaiset tietovuodot
legacy: true
categories:
- Blogi
tags:
- fail
- phpbb
- PhpBB2
- tietovuodot
- tietovuoto
---

<p>Heitänpä minäkin oman lusikan soppaan tai heitän lusikan soppaan tässä blogissa. Olen puhunut tästä aiheesta <a href="http://rantsite.net/2011/11/pari-sanaa-tietovuodosta/" target="_blank">RantSitellä</a> ja yksityisissä keskusteluissa. Nyt on aika tuoda tämä aihe myös tälle sivustolle.</p>
<p>Viime yönä julkaistiin taas tietoja, tällä kertaa kyseessä oli noin 70000 ihmisen salasanat, sähköpostiosoitteet ja tunnukset Terve.fi sivustoperheestä. Näiden takanahan on Darwin Media Oy ja heidän mukaansa Helistin.fi sivustolle oli tehty tietoturvapäivitykset (tästä lisää kohta). Listassa oli mm. lääkärien ja muiden tietoja.</p>
<p>Mitä kautta tämä hyökkäys tehtiin? Vastaus on yksinkertainan: PhpBB2 foorumin kautta. He <a href="http://www.tohtori.fi/?page=4229755&amp;id=3194005" target="_blank">väittivät</a>, että päivitykset olivat tehty. Muuten hyvä, mutta PhpBB2 ei ole tullut moneen vuoteen tietoturvapäivityksiä, sen tukikin on jo lopetettu. He sanoivat tehneensä asianmukaiset päivitykset vuonna 2007, eli neljä vuotta sitten. Kuinka moni uskoo, että neljä vuotta sitten päivitetty sovellus on enää tietoturvallinen? En minä ainakaan. Heidän olisi pitänyt päivittää PhpBB3 versioon aikoja sitten &#8211; miksihän näin ei muuten tehty?</p>
<p>PhpBB2 virallinen tuki lopetettiin 1.2.2009 ja sitä ei saanut edes ladattua 1.10.2008 jälkeen (<a href="http://www.phpbb.com/community/viewtopic.php?t=900655" target="_blank">lähde</a>). Huomaatteko muuten, että he sanoivat tehneensä päivitykset vuonna 2007? MikroPC:n mukaan heillä oli käytössä vuonna 2006 julkaistu 2.0.22 versio (<a href="http://www.mikropc.net/kaikki_uutiset/helistinfin+tietoturva+ei+ollut+ajan+tasalla/a730224" target="_blank">lähde</a>), eli vielä heikommaksi mennään tämänkin asian suhteen.</p>
<p>Salasanan suojaus PhpBB2:ssa oli erittäin huonossa jamassa tämän päivän tarpeisiin verrattuna. Pelkkänä md5 hashauksella suojatut salasanat voidaan selvittää hyvinkin pikaisesti. En kerro tämän selvittämisestä sen enempää, mutta tuttavani OP on kirjoittanut aiheesta <a href="http://unknownpixels.com/blogi.php?kategoria=ohjelmointi&amp;id=149" target="_blank">artikkelin</a>.</p>
<p>Vuodosta saaduilla tunnuksilla päästään muihinkin sivustoihin kuten Mustapippuri.fi, Tohtori.fi, Terkkari.fi ja Pudottajat.fi. Sinänsä hyvä idea, että yhdellä tunnarilla pääsee joka paikkaan, mutta miksi sitten pitää yhtä sivustoa heikoimpana lenkkinä? Tietty jokaisessa järjestelmässä on heikoin lenkki, mutta se on yleensä käyttäjä itse.</p>
<p>Sitä en osaa sanoa kuka on tämän vuodon takana ollut, Anon Finland on kieltänyt olevansa osallisena ja lista julkaistiin Ylilaudalla. Tuolta sivustolta muuten ihmiset menivät kirjautumaan Helistin.fi sivustolle (sekä muille). Eräs henkilö sulki tuon Helistin.fi saitin tai näin ainakin MikroPC <a href="http://www.mikropc.net/kaikki_uutiset/quotsuljin+helistinfin+koska+en+kestanyt+katsoa+ylilautakulttuuriaquot/a729851" target="_blank">väittää</a>.</p>
<p>Tämänkin olisi voinut väittää päivittämällä sovellukset ajantasaiseksi. Yleisimmät mokat viime aikaisiin tietovuotoihin taitaa olla peru SQL-injektio, järjestelmien päivittämättömyys ja oma huolimattomuus järjestelmän tietoturvassa (tämä pätee kahteen edelliseenkin).</p>
<p>Kiitos ja hyvää alkavaa viikkoa. Mielipiteet ovat tervetulleita, sekä mikäli tiedoissa on virheitä niin saa korjata.</p>
<p><strong>Parsimaani dataa:</strong> <em>(datassa voi olla virheitä)</em><br />
&#8211; <a href="http://www.slideshare.net/markokaartinen/helistin-emailin-domainit" target="_blank">Tunnuksien mailiosotteiden domainit</a><br />
&#8211; <a href="http://www.slideshare.net/markokaartinen/helistin-salasana-tutkailua" target="_blank">Salasanojen tutkailua</a></p>
<p><strong>Muokattua</strong><span class="Apple-style-span" style="font-weight: normal;">: Lisäsin loppuun hieman parsimaani dataa.</span></p>