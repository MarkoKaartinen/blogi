---
title: 'SpottiHinta.fi - pörssisähkön spot-hinnat'
slug: spottihinta-fi-porssisahkon-spot-hinnat
status: published
published_at: 2022-10-03 12:39
updated_at: 2022-10-03 14:00
description: |
    Pikaisessa esittelyssä oma vapaa-ajan projekti SpottiHinta.fi jossa voi seurata pörssisähkön spot-hintaa oman "dashboardin" avulla.
legacy: true
categories:
- Blogi
tags:
- laravel
- livewire
- php
- pörssisähkö
- projekti
- sähkö
- sähkön hinta
- spot-hinta
- spothinta
- spottihinnat
- spottihinta
---

<p>On tullut taas koodailtua omia tässä iltasella ja töiden ohessa. Näistä koodailuista syntyi <a href="https://spottihinta.fi/" target="_blank" rel="noreferrer noopener">SpottiHinta.fi</a> sivu. No kerrotaan nyt hieman mitä on koodattu eikä vain tuota osoitetta.</p>



<p>Sähkön hinnat ovat mitä ovat ja markkinat ovat sekaisin. Itsellä loppui sopimus 30.9. ja siihen piti sitten saada toinen ja sattumusten kautta olenkin nyt pörssisähkössä. </p>



<p>Halusin tavan seurata pörssisähköä helposti puhelimella ja nähdä spot-hinnat ja näin hieman ehkä miettiä laitanko sitä saunaa lämpiämään vaiko en. Pari viikkoa sitten ei ollut iOS puhelimelle kunnollisia pörssisähkön hinnan näyttäviä appeja ja en tykännyt silloin saatavilla olevasta Tuntihinta appista. Päätin siis tehdä oman version, jonka saa pwa tyylisesti &#8221;appiksi&#8221; lisäämällä sen kuvakkeen kotivalikkoon. Näin siis saan appi tyylisesti spot-hinnat näkyviin helposti.</p>


<div class="wp-block-image">
<figure class="aligncenter size-full"><img loading="lazy" decoding="async" width="1125" height="2436" src="https://cdn.markokaartinen.net/uploads/2022/10/2022-10-03-13.57.14.png" alt="" class="wp-image-7792" srcset="https://cdn.markokaartinen.net/uploads/2022/10/2022-10-03-13.57.14.png 1125w, https://cdn.markokaartinen.net/uploads/2022/10/2022-10-03-13.57.14-1000x2165.png 1000w, https://cdn.markokaartinen.net/uploads/2022/10/2022-10-03-13.57.14-709x1536.png 709w, https://cdn.markokaartinen.net/uploads/2022/10/2022-10-03-13.57.14-946x2048.png 946w" sizes="(max-width: 1125px) 100vw, 1125px" /></figure></div>


<p>Mulla oli siis tarve saada &#8221;dashboard&#8221; tyyppisesti tulevat spottihinnat näkyviin ja näin teinkin &#8221;linkki generaattorin&#8221;, jolla voi luoda listauksen oli sitten kyse puhelimesta tai vaikka televisiosta.</p>



<p>Hintoja haistellaan koko ajan ja seuraavan päivän spot-hinnat tulevat Nordpoolin datan kautta yleensä kahden aikaan. Näin voidaan suunnitella hieman seuraavaa päivää eli kannattaako sitä saunaa lämmittää vaiko ei. </p>



<p>Sivua on jo nyt kehitetty hieman palautteen perusteella ja sitä kautta onkin saatu hinnat sivu uusittua ja tehtyä muutakin pientä parannusta.</p>



<p>Tämähän on koodattu käyttäen Laravelia ja Livewireä. Tulikin opittua lisää tuosta Livewirestä sillä sitä on hieman vähemmän tullut käytettyä. Sen kanssa saakin tehtyä mukavia toimintoja, kuten tuo Alv. prosentin vaihtaminen vaihtaa hinnat auki olevalla sivulla.</p>



<p>Omat projektit on aina mukavia ilta/viikonloppu projekteja joita koodaillaan kun/jos aikaa sattuu olemaan.</p>



<p>Osoitehan oli siis yksinkertaisuudessaan <a href="https://spottihinta.fi/" target="_blank" rel="noreferrer noopener">SpottiHinta.fi</a> ja käyttäminen on täysin ilmaista.</p>