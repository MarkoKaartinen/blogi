---
title: 'Pokemon Go & Tasker'
slug: pokemon-go-tasker
status: published
published_at: 2016-07-17 10:37
updated_at: 2017-03-06 08:30
description: |
    Olen hieman tutkaillut Pokemon Go peliä tässä viikon aikana ja tänään tuli sitten mieleen, että Tasker nimisellä ohjelmalla saan pari ärsyttävyyttä pois.
legacy: true
categories:
- Android
tags:
- Android
- Pokemon
- Pokemon Go
- Tasker
---

<p>Olen hieman tutkaillut Pokemon Go peliä tässä viikon aikana ja tänään tuli sitten mieleen, että Tasker nimisellä ohjelmalla saan pari ärsyttävyyttä pois. Näitä vinkkejä varten tarvitset tosiaan Tasker nimisen ohjelman, jonka saa <a href="https://play.google.com/store/apps/details?id=net.dinglisch.android.taskerm&amp;hl=fi" target="_blank">Google Playstä</a>. Tämä ei ole täydellinen opas millään muotoa Taskerin käyttämiseen vaan vinkkejä Pokemon Go peliin liittyen. Taskerista lisää sen <a href="http://tasker.dinglisch.net/" target="_blank">kotisivuilla</a>.</p>
<h2>Näyttö sammuu liian äkkiä</h2>
<p>Itse idlaan kotosalla tuo päällä ja joskus sattuukin Pokemon pomppaamaan ruudulle. Täällä näkyy liikkuvan Eeveetä jonkin verran ja muuta Pokemoniakin. Halusinkin, että näyttö ei sammuisi ihan heti ja päädyinkin tekemään taskin, joka pistää näytön timeoutin 45 minuuttiin kun Pokemon Go peli on päällä ja takaisin minuuttiin, kun peli sammutetaan.</p>
<p>Loin siis uuden taskin ja nimesin sen. Tämän jälkeen actioniksi laitoin Display -&gt; Display Timeout -&gt; Valitsin ajaksi 45 min. Exit taskinkin loin ja tällöin tein täysin saman tempun, mutta valitsin ajaksi minuutin. Kun taskit on luotu niin tehdään uusi profiili ja se valitaan application mukaan ja taskinahan on ensin tuo 45min display timeout taski ja exit taskiksi tuo 1 minuutin taski.</p>
<h2>Vahinkokosketukset taskussa</h2>
<p>Itselläni on tulut jokunen vahinkokosketus taskussa, sillä tämähän pitää olla päällä jos haluaa munan saada liikkumalla auki. Noh tähän löytyi ratkaisu, mutta tämä onkin hieman kinkkisempi ja koitan sitä avata parhaani mukaan.</p>
<p>Ensinnäkin luodaan uusi scene ja nimetään se. Vasemmalta sormen kuvasta otat resize ja laitat sen koko ruudun kokoiseksi. Oikealta ylhäältä otat kolmen pisteen kautta properties ja laitat Property Typeksi Overlay, Orientation System sekä väriksi #000000 eli mustan. Omassa Samsungissa musta väri säästää näyttöä.</p>
<p>Kun scene on luotu niin tehdään kaksi taskia jo valmiiksi tasks välilehdeltä. Ensimmäinen task tehdään niin että valitaan actioniksi scene -&gt; show scene. Sieltä nimeksi kirjoita luomasi scenen nimi ja Display As kohtaan Overlay, Blocking, Full Window ja täppä pois kohdasta Show Exit Button. Tämän jälkeen luot toisen taskin vielä jossa actioniksi scene -&gt; hide scene ja nimeksi luomasi scenen nimi.</p>
<p>Nyt tehdään uusi profiili jossa ensin valitaan application ja se Pokemon Go. Valitaan sitten meno taskiksi tuo scenen näyttö ja exit taskiksi tuo scenen piilotus taski. Tämän jälkeen paina pitkään pohjassa profiilin Pokemon Go kohtaan ja valitse Add -&gt; State -&gt; Sensor -&gt; Proximity Sensor.</p>
<p>Itselläni näyttää alla olevan kuvanmukaiselta tämä profiili. 11 task on minun scenen näyttö ja 22 on minun scenen piiloitus taskin nimi.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43.png"><img loading="lazy" decoding="async" class="alignnone wp-image-6358" src="https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43-1000x1778.png" alt="2016-07-17 07.20.43" width="400" height="711" srcset="https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43-1000x1778.png 1000w, https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43-600x1067.png 600w, https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43-1050x1867.png 1050w, https://cdn.markokaartinen.net/uploads/2016/07/2016-07-17-07.20.43.png 1440w" sizes="(max-width: 400px) 100vw, 400px" /></a></p>
<p>Toivottavasti tämä auttaa jotakin ja tämä ei tosiaan ole Taskerin opas vaan suht huono selostus siitä millaiset taskit tein siihen tätä peliä varten. Jos ei auennut niin jaan teille xml muotoisena tuon koodin minkä Tasker minulle antoi noista. Tämä tosiaan pätee vain ja ainoastaan Androidiin! Tuon kun tallentaa xml muodossa Tasker/profiles kansioon ja pitkään painaa sormella Profiles kohtaa niin voi importata &#8211; toivottavasti toimii!</p>
<p>https://gist.github.com/MarkoKaartinen/377a49d14545f3d67105f063d15f44d4</p>