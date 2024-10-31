---
title: 'Debian motd säätö'
slug: debian-motd-saato
status: published
published_at: 2009-02-02 18:37
updated_at: 2014-12-10 19:26
description: |
    Sain tänään idean muokata hieman Debian serverini motd tiedostoa, eli tiedostoa joka näyttää ”message of the day” viestin kun esimerkiksi ssh:lla kirjautuu palvelimelle. Sehän on hieman mälsä aluksi joten päätin muokata sitä hieman hienommaksi ja no kerronpa tässä mitä tein ja miksi ja lopuksi saatte vielä kuvan minkälainen siitä lopulta sitten tulikaan. Eli aloitetaan asentamalla… Jatka lukemista Debian motd säätö
legacy: true
categories:
- Blogi
tags:
- Debian
- Linux
- motd
- säätö
---

<p>Sain tänään idean muokata hieman Debian serverini motd tiedostoa, eli tiedostoa joka näyttää &#8221;message of the day&#8221; viestin kun esimerkiksi ssh:lla kirjautuu palvelimelle.<br />
Sehän on hieman mälsä aluksi joten päätin muokata sitä hieman hienommaksi ja no kerronpa tässä mitä tein ja miksi ja lopuksi saatte vielä kuvan minkälainen siitä lopulta sitten tulikaan.</p>
<p>Eli aloitetaan asentamalla linux_logo niminen paketti komennolla <strong><em>apt-get install linuxlogo</em></strong> (tietysti roottina).</p>
<p>Tämän jälkeen voit komentaa linux_logo, jotta näät millainen se tällä hetkellä on.</p>
<p>Sitten kun ja jos haluat kustomoida sitä niin komenna roottina <strong><em>nano /etc/linux_logo.conf</em></strong> jolloin aukeaa nanossa tekstitiedosto.</p>
<p>Itselläni on seuraava rivi ensimmäisenä ja olen varsin tyytyväinen kyseiseen lopputulokseen:<br />
<em><strong>-L 4 -u -k -y -s -F &#8221;IRC: Marko@Qnet ja MarkoKaa@IRCnet\nE-mail: osoitteeni\nUrl: www.markokaartinen.net\n\nUNIX is basically a simple operating system,\nbut you have to be a genius to understand\nthe simplicity.\n- Dennis Ritchie&#8221;</strong></em></p>
<p>Eli koko pitkä pötkö on samalla rivillä, ensimmäisenä kyseisessä konffi tiedostossa. Olen poistanut oman e-mailin erimerkistä.<br />
\n toimii rivinvaihtona.</p>
<p>Tämän jälkeen tallenna <strong>ctrl + o</strong> näppäin yhdistelmällä ja sulje <strong>ctrl + x</strong> yhdistelmällä.</p>
<p><em><strong>linux_logo</strong></em> komennolla voit katsoa miltä se näyttää.</p>
<p>Seuraavalla komennolla siirretään lopputulos <em>motd</em> tiedostoon: <strong>linux_logo &gt; /etc/motd</strong> (roottina)</p>
<p>Oma tulokseni on seuraavanlainen:<br />
<a href="https://cdn.markokaartinen.net/uploads/2009/02/pottumotd.png"><img loading="lazy" decoding="async" class="alignnone size-medium wp-image-398" title="pottumotd" src="https://cdn.markokaartinen.net/uploads/2009/02/pottumotd-300x180.png" alt="pottumotd" width="300" height="180" /></a></p>