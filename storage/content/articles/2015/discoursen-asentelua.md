---
title: 'Discoursen asentelua'
slug: discoursen-asentelua
status: published
published_at: 2015-03-09 15:09
updated_at: 2016-09-26 15:42
description: |
    Löysin Discoursen vähän aikaa sitten. Muistaakseni törmäsin tähän jo aiemmin, mutta sivuutin sen aika pitkälti. Piru, se on ilmainen ja avointa lähdekoodia.
legacy: true
categories:
- Blogi
tags:
- Digitalocean
- Discourse
- foorumi
- https
- namecheap
- nörtti
- oppiminen
- Pleikka
- Pleikka.fi
- säätö
- ssl
---

<p>Löysin Discoursen vähän aikaa sitten. Muistaakseni törmäsin tähän jo aiemmin, mutta sivuutin sen aika pitkälti. Törmäsin erääseen Discoursella toteutettuun foorumiin ja lähdin tutkimaan paljonko se kustantaisi. Piru, se on ilmainen ja avointa lähdekoodia &#8211; eikun säätämään siis.</p>
<p><a href="https://markokaartinen.net/pleikka-fi-uusin-projektini/">Pleikka.fi</a> oli loistava domain siihen ja jotain tämänkaltaista halusinkin rakentaa sille. Discourse on simppeli, mutta silti siinä on sitä jotain mikä vetoaa minuun ja muihinkin (toivottavasti). Discoursen ominaisuuksista ja muusta voi lukea sen omilta sivuilta: <a href="http://www.discourse.org/" target="_blank">www.discourse.org</a></p>
<p>Tuesta sen verran, että pistin eilen kyselyä Discoursen omille foorumeille ja sainkin suhteellisen nopeaan vastausta eli homma pelittää tälläkin saralla mainiosti.</p>
<p>Mielenkiintoista tässä on se, että tämä asentuu Dockerin kautta ja käyttää mm. Gittiä päivityksien lataamiseen ja muutenkin apunaan. Lisäosat asennellaan myös Gitin ja Dockerin avustuksella. Ainut miinus mitä olen löytänyt on se, että plugarin asennus vaatii tuon Docker containerin rebuildaamisen mikä aiheuttaa käyttökatkon foorumille.</p>
<p>Tämmöisellä setupilla lähdin liikenteeseen &#8211; ainakin aluksi:</p>
<ul>
<li>Domain Pleikka.fi (<a href="https://domain.fi" target="_blank">Ficora</a>)</li>
<li>SSL Sertifikaatti (<a href="http://www.namecheap.com/?aff=25198" target="_blank">Namecheap</a>)</li>
<li>Virtuaalipalvelin (1GB muistia) (<a href="https://www.digitalocean.com/?refcode=34aebd17275a" target="_blank">Digitalocean</a>)</li>
</ul>
<p>Digitaloceanilla tuota droplettia voi kasvattaa isompaan mikäli tuo Pleikka.fi alkaa lähteä lentoon. Suosittelen muutenkin Digitaloceania sillä mm. tämä sivusto pyörii siellä VPS:n päällä.</p>
<p>Pleikka.fi domainin nimipalvelimet olikin jo valmiiksi asetettu Digitaloceanin nimipalvelimiin päin joten siitä ei tarvinnut huolehtia. SSL sertti piti kuitenkin säätää uusiksi. Homma on suhteellisen simppeli. Tarvitset siihen oikeastaan vain sähköpostin (esim. admin@pleikka.fi käy mainiosti) ja sitten pääsyn palvelimelle. Ensin generoidaan csr ja tämä syötellään sitten SSL tarjoajan (tässä tapauksessa Namecheap) sivustolle. Tämän jälkeen valitaan mihin sähköpostiin lähetetään vahvistus (itse olen tehnyt tuon admin@domain.fi osoitteen). Vahvistusviestissä klikataan käytännössä siinä olevaa linkkiä ja syötetään vahvistus koodit. Tämän jälkeen saat sähköpostiisi itse sertifikaatin. Itse SSL asennetaan Discoursen kanssa toimivaksi erikseen, mutta siihen on olemassa hyvä <a href="https://meta.discourse.org/t/allowing-ssl-for-your-discourse-docker-setup/13847" target="_blank">ohje</a> &#8211; tee kuitenkin itse Discoursen asennus ensin.</p>
<p>Itse Discoursen asennus oli suhteellisen suoraviivainen sillä käytin apunani tätä <a href="https://github.com/discourse/discourse/blob/master/docs/INSTALL-digital-ocean.md" target="_blank">ohjetta</a>. Siinä käydään läpi dropletin luonti, swapin teko, Dockerin ja gitin asennus, Discoursen asennus, asetusten muunto ja itse containerin buildaus ja avaus. Siellä on myös linkkejä ssl sertin käyttöönottoon ja moneen muuhun asiaan. Eli aikas tekninen suoritus on tuon asennus jos sitä lähtee tekemään. Ihan kaikille tämä ei siis ole vaan hieman Linux tuntemusta on hyvä olla.</p>
<p>Discoursen asennettua sen asetusten säätö oli suhteellisen vaivatonta ja onpa tuossa sisäänrakennettuna mahdollisuus muokata CSS koodia ja neppailla muutenkin hieman ulkoasun kimpussa. Onpa tämä muuten aika pitkälle suomeksikin käännetty &#8211; joitain kukkasia löytyy ja ihan täydellinen ei tuo käännös vielä ole. Pitää jossain välissä tutkia miten tuota saisi hieman päiviteltyä tuon käännöksen osalta.</p>
<p>Nyt kun olen jokusen päivän pyöritellyt tuota niin olen kyllä pitänyt siitä. Hallinnan puolella on kivoja tilastoja heti kättelyssä ja näkee senkin onko Discourse ajantasalla. Varmuuskopion luominen käy nappia painamalla ja sen saisi myös automatisoitua Amazonin S3:een &#8211; samaten tiedostot saisi siirrettyä Amazonin S3 tilaan automaattisesti.</p>
<p>Lisäosan asennus on suhteellisen mielenkiintoinen homma tai oikeastaan simppeli homma. Muokkaat käytännössä containerin app.yml tiedostoa ja laitat sinne oikeaan paikkaan git clone komennon lisäosaan. Eli käytännössä kun lisäosan git repoon tulee päivitys niin saat sen myös sinäkin. Tämän rivin lisäämisen jälkeen rebuildataan ja homma on mahdollisia lisäosan asetuksia vaille valmista.</p>
<p>Muutenkin päivittäminen menee gitin kautta, kuten mainitsinkin jo aiemmin. Voit käytännössä päivittää oman Discoursen aina viimeisimpään committiin sillä päivitys otetaan suoraan Discoursen <a href="https://github.com/discourse/discourse/" target="_blank">Github reposta</a>. Odottelinkin tässä päivitystä käännöksiin sillä kävin lisäilemässä Discoursen Transifexiin muutaman rivin, jotka on jäänyt kääntämättä päivitysten ja muiden myötä.</p>
<p>Mikäli Pleikka.fi ottaa tuulta alleen niin tulen miettimään ensinnäkin isompaa droplettia, mutta tämä vaatii osittain myös hieman rahallista panostusta. Samaten tulen miettimään joko Amazon S3 tai CDN palvelun käyttöönottoa helpottamaan palvelimen omaa kuormaa.</p>
<p>Tällä hetkellä Discourse vaikuttaa erittäin hyvältä ja katsotaan miten Pleikka.fi kanssa käy. Tulen tuota Discoursea säätämään lisää kunhan keksin mitä haluan tuonne Pleikka.fi alle pistää. Muutenkin jos tulee projekteja niin pidän Discoursen mielessä josko se sopisi pohjaksi.</p>