---
title: 'Gitlab - Hallitse omia Git repoja'
slug: gitlab-hallitse-omia-git-repoja
status: published
published_at: 2012-11-06 09:01
updated_at: 2012-11-06 09:01
description: |
    Gitlab oli myös yksi must have softia omalle palvelimelleni. Sen kanssa tuli säädettyä jo perjantaina, mutta eilen vasta sain laitettua sen siihen kuntoon että lisäilin omia projekteja sinne. Itsellähän oli myös Githubiin privaattirepoja, mutta tämä hoitaa asian ilmaiseksi ja mikä parasta tätäkin kehitetään aktiivisesti.
legacy: true
categories:
- Blogi
- Kotipalvelin
tags:
- asennus
- Git
- gitlab
- kotipalvelin
- ohjelma
- palvelin
- serveri
- softa
- ubuntu
---

<p>Gitlab oli myös yksi must have softia omalle palvelimelleni. Sen kanssa tuli säädettyä jo perjantaina, mutta eilen vasta sain laitettua sen siihen kuntoon että lisäilin omia projekteja sinne. Itsellähän oli myös Githubiin privaattirepoja, mutta tämä hoitaa asian ilmaiseksi ja mikä parasta tätäkin kehitetään aktiivisesti.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2012/11/gitlab_commits.png"><img loading="lazy" decoding="async" class="aligncenter size-medium wp-image-3505" title="Gitlab commits" src="https://cdn.markokaartinen.net/uploads/2012/11/gitlab_commits-610x322.png" alt="" width="610" height="322" /></a></p>
<p><!--more--></p>
<p>Ainut huono puoli tässä on oikeastaan se, että tämä on rakennettu Ruby on Railsin päälle ja itselläni ei ole tuosta kielestä mitään kokemusta. Luotetaan siis siihen, että se toimii ilman minun säätämistäkin! Sen jälkeen kun Gitlabin oli saanut asennettua on sen käyttö ollut suhteellisen simppeliä ja helppoa, ongelmia ei ole sinällään ollut.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2012/11/gitlab_source.png"><img loading="lazy" decoding="async" class="aligncenter size-medium wp-image-3506" title="Gitlab source" src="https://cdn.markokaartinen.net/uploads/2012/11/gitlab_source-610x396.png" alt="" width="610" height="396" /></a></p>
<p>Asennusohjeita en ala tähän laittamaan sillä Gitlabilla on pätevät <a href="https://github.com/gitlabhq/gitlabhq/blob/stable/doc/installation.md" target="_blank">ohjeet</a> asentamiseen. Suosittelen muuten tekemään asennuksen ohjeiden mukaan, älä siis käytä valmista skriptiä mikä on saatavilla. Saat näin itse paremman kuvan siitä mitä tapahtuu missäkin vaiheessa.</p>
<p>Onhan tämä systeemi hieman &#8221;hardcore&#8221; viritys yhdelle hengelle, mutta minulla on mahdollisuus luoda käyttäjätilejä jos haluan alkaa kehittämään jonkun kanssa jotain tai haluan näyttää jollekkin jonkun projektin koodia.</p>
<p>Suosittelen kokeilemaan tätä softaa ja ottamaan tämän käyttöön mikäli pidät tästä. Jos haluat omalla koneella asennella tämän niin virtuaalikone on hyvä väline testaukseen. Asentelet virtuaalikoneelle Ubuntun ja siihen asennat Gitlabin.</p>
<p><em>Kuvien lähde: <a href="http://blog.gitlabhq.com/screenshots/" target="_blank">Gitlab</a></em></p>