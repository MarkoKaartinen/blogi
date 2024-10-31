---
title: 'Liikennetieto botin tekeminen'
slug: liikennetieto-botin-tekeminen
status: published
published_at: 2012-07-16 13:10
updated_at: 2012-07-16 11:43
description: |
    Ajattelin aukaista teille hieman tekniikkaa ja koodia tuon @Liikennetieto botin takaa. Tässä postauksessa on siis aimo annos nörtti-puhetta. Käytetyt tekniikat Liikennetieto botin takana on paljon muutakin, kuin pelkkä Twitter-tili johon ilmestyy automaattisesti päivityksiä. Kerron tässä kappaleessa seikkaperäisesti eri tekniikoista ja miten niitä käytetään tämän botin kanssa. TwitterOAuth on PHP-kirjasto, jonka avulla voidaan käyttää Twitterin APIa… Jatka lukemista Liikennetieto botin tekeminen
legacy: true
categories:
- Blogi
tags:
- bootstrap
- botti
- Git
- jQuery
- koodaus
- nörtti
- ohjelmointi
- php
- Twitter
---

<p>Ajattelin aukaista teille hieman tekniikkaa ja koodia tuon @Liikennetieto botin takaa. Tässä postauksessa on siis aimo annos nörtti-puhetta.</p>
<h2>Käytetyt tekniikat</h2>
<p>Liikennetieto botin takana on paljon muutakin, kuin pelkkä Twitter-tili johon ilmestyy automaattisesti päivityksiä. Kerron tässä kappaleessa seikkaperäisesti eri tekniikoista ja miten niitä käytetään tämän botin kanssa.</p>
<p><a href="https://github.com/abraham/twitteroauth/" target="_blank">TwitterOAuth</a> on PHP-kirjasto, jonka avulla voidaan käyttää Twitterin APIa suhteellisen helposti. Tämän kirjaston avulla saadaan Twitteriin uusi päivitys.</p>
<p><a href="http://fi.wikipedia.org/wiki/Cron" target="_blank">Cronilla</a> taas saadaan koodinpätkä katsomaan 5 minuutin välein onko tullut uusia liikennetiedotteita ja päivittämään ne Twitteriin ja tietokantaan automaattisesti.</p>
<p><a href="https://developers.google.com/maps/documentation/javascript/" target="_blank">Google Maps API</a>lla toteutin kartan botin kotisivuille ja sitä on muutenkin käytetty hyödyksi esim. staattisissa karttakuvissa, 24h kartassa sekä liikennetiedotteen infoissa.</p>
<p><a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a> sai tälläkin kertaa toimia ulkoasun frameworkkinä. Suosittelen lämpimästi tätä täysin ilmaista &#8221;koodikasaa&#8221;.</p>
<p><a href="http://fancyapps.com/fancybox/" target="_blank">Fancyboxilla</a> saatiin aikaan se kiva efekti, jossa kuva pomppaa nokkasi eteen.</p>
<p><a href="http://fi.wikipedia.org/wiki/Htaccess" target="_blank">Htaccess</a> -tiedostolla saatiin aikaan &#8221;siistit&#8221; urlit tuonne sivuille. Tällöin esimerkiksi osoite <em>http://liikenne.kaartinen.eu/arkisto/kunta/Kuopio</em> onkin muotoa <em>http://liikenne.kaartinen.eu/index.php?p=arkisto&amp;do=kunta&amp;kunta=Kuopio</em> &#8211; ei liene vaikeaa päätellä kumpi on luettavampi muoto?</p>
<p><a href="http://git-scm.com/" target="_blank">GIT</a> on erittäin pätevä versionhallintaohjelmisto, jota itse käytän työssäni päivittäin ja käytän sitä myös omissa koodausprojekteissani. Tässä projektissa sille muodostui kuitenkin omanlainen rooli sillä sen avulla päivitän myös tuotannon. Ohjelmoin ensin muutokset ja korjaukset localhostiin ja sen jälkeen pushaan ne GIT repositoryyn. Tämän jälkeen pullaan muutokset tuotannossa ja tadaa &#8211; muutokset ovat toiminnassa.</p>
<h2>Käytetyt ohjelmointikielet</h2>
<p><strong>PHP</strong> on se kieli mitä itse tulee käytettyä lähes päivittäin, teen tällä kielellä työkseni sovelluksia joten valinta oli itselleni luonteva.</p>
<p><strong>Javascript</strong> ja <strong>jQuery</strong> kulkee itsellä nykyään käsikädessä ja aika monessa tekemässäni sovelluksessa on mukana näitä kieliä jollain tapaa.</p>
<h2>Yleistä</h2>
<p>Tämän botin koodaaminen oli sinällään erittäin hauska haaste, sillä en ole Twitterin APIn kanssa puljannut ja sitä kautta kun löysi tuon TwitterOAuth kirjaston niin homma vaan helpottui. Tämän myötä kynnys tehdä Twitter yhteensopivia koodinpätkiä madaltui ja voin luottavaisin mielin sanoa pystyväni tekemään Twitter botin joka toimii!</p>
<p>Botti on nyt ollut toiminnassa noin 10 päivää ja en ole huomannut sen toiminnassa mitään ongelmia. Jokusen bugin olen liiskannut verkkosivun puolelta ja siellä taitaa joitain vielä lymytä. Tulen myös kehittämään tuota verkkosivun puolta mm. tilastoilla ja päiväkohtaisella arkistolla. Tietty te voitte ehdottaa jos haluatte jotain lisäominaisuuksia tuohon!</p>