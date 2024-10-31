---
title: 'RuuviTagit koko kodin lämpösensoreina'
slug: ruuvitagit-koko-kodin-lamposensoreina
status: published
published_at: 2020-12-21 13:28
updated_at: 2020-12-21 13:28
description: |
    Voisin väittää, että moni meistä on ostanut yhden jos toisenkin sääaseman, jossa on langattomia ja langallisia sensoreita. Itse ainakin olen ostanut useammankin kappaleen. Kaikissa on ollut samaa ongelmaa ja ovat lopulta joutaneet roskiin. Se ulkosensori ei nyt vaan toimi kunnolla ja ei signaali tule edes luotettavasti muutamaa metriä ulkoa sisälle. En edes muista monennenko halpavehkeen… Jatka lukemista RuuviTagit koko kodin lämpösensoreina
legacy: true
categories:
- Blogi
tags:
- IoT
- Ruuvi
- RuuviTag
---

<p>Voisin väittää, että moni meistä on ostanut yhden jos toisenkin sääaseman, jossa on langattomia ja langallisia sensoreita. Itse ainakin olen ostanut useammankin kappaleen. Kaikissa on ollut samaa ongelmaa ja ovat lopulta joutaneet roskiin. Se ulkosensori ei nyt vaan toimi kunnolla ja ei signaali tule edes luotettavasti muutamaa metriä ulkoa sisälle. </p>



<p>En edes muista monennenko halpavehkeen kanssa tuli taas ulkomittauksessa ongelmia, kun aikanaan päätin tilata ensimmäisen 3-packin RuuviTageja. Ajatuksena oli silloin pistää vanha käyttämätön Raspberry Pi tietokone keräämään dataa ja tunkemaan ne omalle palvelimelle ja siellä sitten käpistellä sitä. Näinhän siinä sitten kävikin. Ensimmäiset ruuvit tulikin toukokuussa 2019.</p>



<p>Nykyään, kun olen muuttanut isompaan (2. kerroksiseen) asuntoon on RuuviTageja jo kuusi kappaletta. Myöhemmin tulevissa kuvissa näkyykin missäpäin asuntoa mikäkin sensori on.</p>



<p>Ruuvihan on avoimen lähdekoodin langaton sensori. Sillä voit mitata mm. lämpötilaa, ilmanpainetta ja ilmankosteutta. Itseä noista kiinnostaa pääosin lämpötila. Nämähän ovat muuten suomalaisen Ruuvi Innovations Oy käsialaa ja taustalla häärää mm. Lauri Jämsä joka muuten pyöritti Ruuvipenkki.fi sivustoa aikoinaan.</p>



<h2 class="wp-block-heading">Niin mitä tehdään?</h2>



<p>Säädetään. Ekat kolme Ruuvia tuli siis toukokuussa 2019 ja nehän piti pistää toimintaan. Itse Ruuvit sai toimintaan helposti. Otti vain pariston välistä muoviliuskan pois ja itse RuuviTag oli sillä toimintavalmis.</p>



<p>Dataakin voit alkaa heti tutkimaan sillä ilmaisella Ruuvi Station puhelin applikaatiolla näet heti mitä tietoa RuuviTag lähettää, kunhan vain lisäät sen ensin. Tämä riittää jo monelle sillä näin saat reaaliaikaisen tiedon lämpötilasta suoraan RuuviTageista. Eli ei sinun tarvitse säätää yhtään tämän enempää. Itse Ruuvi Station sovelluksella pärjää jo tosi pitkälle ja itsekin käytän sitä.</p>



<p>Sitten säätämiseen. Koska RuuviTag ei ollut ihan uusi juttu tuolloin 2019 niin oli jo aika paljon oppaita ja apuja olemassa. Itsellä oli tosiaan Raspberry Pi kaapissa ja pistin sen toimivaksi taas. Oma Raspberry Pi on vain sisäverkossa ja siihen ei pääse ulkoverkosta käsin ollenkaan.</p>



<p>Siihen löysinkin sitten Python kirjaston, jolla saadaan luettua RuuviTagien dataa. Tämä kirjasto on vieläkin käytössä ja löytyy Githubista: <a href="https://github.com/ttu/ruuvitag-sensor" target="_blank" rel="noreferrer noopener">https://github.com/ttu/ruuvitag-sensor</a></p>



<p>Itsellä pyörii joka minuutti cronissa hieman modifioitu koodinpätkä. Taisi olla se osittain 2019 esimerkkinä tuossa repossa. Alla on vielä tuo koodinpätkä niille jotka kaipailee vastaavaa.</p>



<pre class="wp-block-code"><code>from urllib.parse import quote
import requests
from ruuvitag_sensor.ruuvi import RuuviTagSensor

macs = &#91;
    'XX:XX:XX:XX:XX:XX',
    'XX:XX:XX:XX:XX:XX',
    'XX:XX:XX:XX:XX:XX'
]

timeout_in_sec = 5

url = 'https://server.test/endpoint'

datas = RuuviTagSensor.get_data_for_sensors(macs, timeout_in_sec)

for key, value in datas.items():
    requests.post(url + quote(key), json=value)</code></pre>



<p>Tuo koodinpätkä lähettää tietoa minun palvelimelleni, jossa pyörii Laravelin päällä sovellus. Sovellus  vastaanottaa tuon python skriptin datan ja tallentaa sen tietokantaan. Minulla siis tallentuu joka minuutti tieto jokaisesta RuuviTagista ja näitä sitten voin hyödyntää miten haluan.</p>



<p>Tällä hetkellä käytössä on yksinkertainen näkymä siitä mitä mikäkin sensori näyttää ja 24h ajalta maksimi sekä minimi. Jokaisen sensorin takaa saan vielä yksittäiset tulokset halutessani sekä hieman käppyrää.</p>



<figure class="wp-block-image size-large"><img loading="lazy" decoding="async" width="1126" height="500" src="https://cdn.markokaartinen.net/uploads/2020/12/image.png" alt="" class="wp-image-7334" srcset="https://cdn.markokaartinen.net/uploads/2020/12/image.png 1126w, https://cdn.markokaartinen.net/uploads/2020/12/image-1000x444.png 1000w, https://cdn.markokaartinen.net/uploads/2020/12/image-600x266.png 600w" sizes="(max-width: 1126px) 100vw, 1126px" /></figure>



<figure class="wp-block-image size-large"><img loading="lazy" decoding="async" width="1116" height="313" src="https://cdn.markokaartinen.net/uploads/2020/12/image-2.png" alt="" class="wp-image-7336" srcset="https://cdn.markokaartinen.net/uploads/2020/12/image-2.png 1116w, https://cdn.markokaartinen.net/uploads/2020/12/image-2-1000x280.png 1000w, https://cdn.markokaartinen.net/uploads/2020/12/image-2-600x168.png 600w" sizes="(max-width: 1116px) 100vw, 1116px" /></figure>



<p>Itsellä tulee myös joka aamu kuudelta tieto sen hetkisestä lämpötilasta, sekä mitä yöllä on ollut ja vielä ennuste (OpenWeatherMap apia käyttäen) sen päivän säästä.</p>



<figure class="wp-block-image size-large"><img loading="lazy" decoding="async" width="529" height="701" src="https://cdn.markokaartinen.net/uploads/2020/12/image-1.png" alt="" class="wp-image-7335"/></figure>



<p>Tuo koodipuoli on vielä itsellä kehityksessä ja siihen olisi halu saada hälytykset esim. Telegrammin kautta. Ajatus olisi siis, että saisi saunan lämpiämisestä hälytyksen. Eli voisin pistää vaikka niin, että kun seuraavan kerran saunassa olevan RuuviTagin lämpötila on 60 astetta saan ilmoituksen siitä.</p>



<p>Sensorien lisääminen on suhteellisen helppo homma. Lisään vain MAC osoitteen Python koodiin ja sitten nimeän sen MAC osoitteen tuolla omassa softassani ja Ruuvi Station applikaatiossa.</p>



<h2 class="wp-block-heading">Miten homma on toiminut?</h2>



<p>Lyhyesti: hiivatin hyvin. RuuviTagit ovat toimineet hyvin ja niiden kanssa ei ole ollut ongelmia. Raspberry Pi:stä on hajonnut yksi virtalähde ja sen takia on jäänyt dataa tulematta. Samaten ollut hieman ongelmia, kun päivittänyt Raspberry Pi:n sovelluksia ja sitten on tuo koodi lakannut toimimasta. Eli tämmöistä pientä säätöä.</p>



<p>Näiden RuuviTagien signaalikin on ihan älyttömän hyvä. Mulla on tässä asunnossa Raspberry Pi alakerran vaatehuoneessa. Yläkerran kaikki RuuviTagit lukee hyvin ja ehkä pahin on saunan sensori, joka on yläkerrassa kauimmaisessa nurkassa ja se toimii moitteetta. Samoin tuo Ruuvi Station sovellus lukee kaikki sensorit olit missä päin asuntoa.</p>



<p>Itse webbipuoli on toiminut tosi hyvin ja sinne on mennyt data kuten pitääkin. Ainut, että on vielä hieman raskasta koodia ja sinne pitäisi tehdä optimointeja johtuen tuosta isosta massasta mitä tuota dataa tulee (1440 riviä / sensori / päivä).</p>



<p>Siitä huomaa helposti, kun homma lopettaa toimimisen on ettei tuota aamuista sähköpostia ole tullut. Silloin pitää yleensä alkaa perkaamaan, että missä on ongelmaa. Yleensä ongelma on ollut tuossa Raspberry Pi päässä.</p>



<p>3D tulostin on ollut myös pirun hyvä homma tän kannalta. Olen nimittäin tulostellut tuolle kiinnikkeet joilla se on kiinni saunassa ja ulkona. Ulos suunnittelin ja tulostin vielä erillisen suojakotelon, joka tulee siis tuon Thingiversestä napatun kotelon päälle. Suunnitteilla on tuohon ulkokoteloon versio missä on RuuviTagin pidike itsessään.</p>



<figure class="wp-block-gallery columns-2 is-cropped wp-block-gallery-3 is-layout-flex wp-block-gallery-is-layout-flex"><ul class="blocks-gallery-grid"><li class="blocks-gallery-item"><figure><img loading="lazy" decoding="async" width="1600" height="1600" src="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-1600x1600.jpg" alt="" data-id="7339" data-full-url="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1.jpg" data-link="https://markokaartinen.net/?attachment_id=7339" class="wp-image-7339" srcset="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-1600x1600.jpg 1600w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-1000x1000.jpg 1000w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-300x300.jpg 300w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-1536x1536.jpg 1536w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-1568x1568.jpg 1568w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-450x450.jpg 450w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-600x600.jpg 600w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1-100x100.jpg 100w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.13.19-1.jpg 1776w" sizes="(max-width: 1600px) 100vw, 1600px" /></figure></li><li class="blocks-gallery-item"><figure><img loading="lazy" decoding="async" width="1600" height="1600" src="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-1600x1600.jpg" alt="" data-id="7337" data-full-url="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21.jpg" data-link="https://markokaartinen.net/?attachment_id=7337" class="wp-image-7337" srcset="https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-1600x1600.jpg 1600w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-1000x1000.jpg 1000w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-300x300.jpg 300w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-1536x1536.jpg 1536w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-1568x1568.jpg 1568w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-450x450.jpg 450w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-600x600.jpg 600w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21-100x100.jpg 100w, https://cdn.markokaartinen.net/uploads/2020/12/2020-11-30-18.03.21.jpg 2000w" sizes="(max-width: 1600px) 100vw, 1600px" /></figure></li></ul></figure>



<p>Sensorit ovat myös kestäneet tosi hyvin. Saunassa oleva sensori on vielä käyttökunnossa ja täysin toimintakuntoinen. Samoin sensori, joka on ollut ulkona käytännössä koko ajan. Muut sensorit ovatkin pääsääntöisesti sisätiloissa ja ns. normaalilämmöissä.</p>



<p>Saunassa oleva teline on hieman lämmössä ottanut muotoa, mutta on vielä täysin käyttökelpoinen. Nämä yksinkertaiset telineet ovat löytyneet Thingiversestä (<a href="https://www.thingiverse.com/thing:3983256" target="_blank" rel="noreferrer noopener">JKin</a> nimimerkin tekemiä)</p>



<h2 class="wp-block-heading">Mitä pitäisi kehittää?</h2>



<p>Sensorien asettelu on mielenkiintoinen. Tällä hetkellä takapihan sensori on huonossa kohtaa, koska se näyttää ehkä liian lämmintä ja varsinkin jos vertaa etu- ja takapihan sensoreita. Takapihan sensori on lähempänä taloa ja paikassa mikä on ehkä luonnostaan jo lämpimämpi. </p>



<p>Sovelluksen koodipuoleen pitäisi tosiaan panostaa. Tästä jo hieman mainitsin. Latausajat on joissain kohtaa aika pitkiä, kun en ole optimoinut mitenkään koodinpätkiä. Samoin osa ominaisuuksista on turhia tällä hetkellä, mutta ehkä tulevaisuudessa voisi historiadataa hyödyntää fiksummin.</p>



<p>Samoin tuo hälytysominaisuus olisi kova. Nyt on jo hieno asia se, että näkee saunan lämpötilan nousematta sohvalta. Tämä on kuitenkin toteuttavissa oleva asia taas.</p>



<p>Ulos oleville sensoreille voisi melkein tulostaa vielä lipan, jonka voisi laittaa yläpuolelle. Tämä voisi estää ylimääräisen veden menoa tuohon koteloon.</p>



<p>Raspberry Pi puolella taas pitäisi tehdä parannusta tuon datan lähetykseen. Pitäisi melkein tehdä datapaketti lokaalisti jota koitetaan lähettää ja jos ei jostain syystä onnistu niin yritetään sitten myöhemmin uudelleen. Näin katkokset verkkoyhteydessä tai muut häiriöt ei niin paljoa haittaa. Ainoastaan jos koko Raspberry Pi on pois käytöstä niin sitten ei mene dataa. Toinen vaihtoehto on tehdä toisinpäin eli mun sovellus koittaa hakea dataa Raspin päästä, mutta silloin pitäisi avata se ulkoverkkoon, jota en haluaisi.</p>



<h2 class="wp-block-heading">Lopuksi</h2>



<p>Pitää ehkä jotain loppuhuomioita vielä pistää. Ensinnäkin tästä artikkelista ei ole maksettu tai annettu sensoreita. Saa toki pistää postiin pari lisää&#8230; </p>



<p>Tällä hetkellä on aika yksinkertainen tämä sovellutus. Otetaan data talteen ja ihmetellään lämpötiloja. Tätähän voi aina laajentaa uusilla sensoreilla ja uusilla ominaisuuksilla.</p>



<p>Tämä on tällä hetkellä ainut ns. IoT komponentti tässä talossa ja ollaan vielä nätisti sisäverkossa, joten ulkoverkon möröt ei pääse käsiksi. Yhden Raspberry Pi koneenhan voisi melkein hankkia VPN:ksi, jotta pääsisi ylipäätään tänne sisäverkkoon&#8230; Tässäpä ajatusta tulevaan.</p>



<p><strong>Ideat ja vinkit on muuten tervetulleita!</strong> </p>