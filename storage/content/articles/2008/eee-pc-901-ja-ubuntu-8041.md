---
title: 'Eee Pc 901 ja Ubuntu 8.04.1'
slug: eee-pc-901-ja-ubuntu-8041
status: published
published_at: 2008-09-18 17:02
updated_at: 2014-12-10 19:27
description: |
    Kävin hankkimassa Prismasta 2 Gigan USB-tikun mallia Kingston DataTraveler 2 GB ja hintaa tälle tuli 9,90 € ja viiden vuoden takuulla. Ja eiliset tikulta boottamiseen liittyvät ongelmat katosivat ja pääsin asentamaan Ubuntua Eeelleni. Muokkaukset: Kohdassa 6. korjattu virheellinen poisto komento. Lisätty kuinka asennetaan Caps-lock indikaattori Eli ajattelin kertoa teille miten asensin Ubuntun omaan Eee Pc… Jatka lukemista Eee Pc 901 ja Ubuntu 8.04.1
legacy: true
categories:
- Blogi
- Marko testaa
tags:
- Eee PC 901
- Linux
- miniläppäri
- ubuntu
---

<figure id="attachment_179" aria-describedby="caption-attachment-179" style="width: 150px" class="wp-caption alignright"><a href="https://cdn.markokaartinen.net/uploads/2008/09/screenshot.png"><img loading="lazy" decoding="async" class="size-thumbnail wp-image-179" title="Ubuntu 8.04.1 &amp; Eee 901" src="https://cdn.markokaartinen.net/uploads/2008/09/screenshot-150x150.png" alt="Ubuntu 8.04.1 &amp; Eee 901" width="150" height="150" /></a><figcaption id="caption-attachment-179" class="wp-caption-text">Ubuntu 8.04.1 &amp; Eee 901</figcaption></figure>
<p>Kävin hankkimassa Prismasta 2 Gigan USB-tikun mallia Kingston DataTraveler 2 GB ja hintaa tälle tuli 9,90 € ja viiden vuoden takuulla.<br />
Ja eiliset tikulta boottamiseen liittyvät ongelmat katosivat ja pääsin asentamaan Ubuntua Eeelleni.</p>
<p><span style="font-size: medium;"><strong>Muokkaukset:</strong></span></p>
<ul>
<li>Kohdassa 6. korjattu virheellinen poisto komento.</li>
<li>Lisätty kuinka asennetaan Caps-lock indikaattori</li>
</ul>
<p>Eli ajattelin kertoa teille miten asensin Ubuntun omaan Eee Pc 901 läppäriin.<br />
Joten tämmönen simppeli tutoriaali tulee tässä.</p>
<h2>1. Ubuntun lataus</h2>
<p>Lataa Ubuntun uusin versio vaikka <a href="http://www.ubuntu-fi.org/lataa.html" target="_blank">tästä</a>.</p>
<h2>2. Usb tikun valmistelu (tämä tehdään toisella koneella)</h2>
<ol>
<li>Lataa <a href="http://unetbootin.sourceforge.net/" target="_blank">UNetbootin</a>, jonka avulla tehdään Usb tikustasi boottaava. Tarvitset mielellään 1 gigatavun kokoisen usb-tikun.</li>
<li>Pistä usb-tikku koneeseesi kiinni ja avaan UNetbootin</li>
<li>Valitse Distribution listasta Ubuntu ja versioksi 8.04</li>
<li>Laita täppä kohtaan Diskimage ja etsi lataamasi Ubuntun .iso tiedosto</li>
<li>Typeksi valitse USB Drive ja tarkasta vielä että Drive kohdassa on USB-tikkusi asema.</li>
<li>Lopuksi paina OK ja odota, kun se pyytää boottaamaan, mutta <strong>ÄLÄ</strong> boottaa konettasi vaan lopeta UNetbootin.</li>
</ol>
<h2>3. Asentaminen</h2>
<ol>
<li>Liitä usb-tikku Eee Pc 901 koneeseesi ja käynnistä kone</li>
<li>Kun saat Asuksen logon eteesi, pitäisi tulla lähes heti kun boottaat koneen. Niin paina ESCiä ja saat eteesi boottivalinnat, valitse tästä USB-tikkusi.</li>
<li>Listasta valitse Install, jolloin Ubuntun asennus alkaa. (mielestäni on täysin turha ladata ensin live ympäristö jonka jälkeen aloittaa asennus)</li>
<li>Asentaminen on suhteellisen helppo, ja täytät kentät sitä mukaa kun ne tulee eteen. Ainut missä pitää kiinnittää huomiota on osiointi! Osioi itse! Eli valitse manuaalinen tapa osioida.
<ol>
<li>Osiointi ikkunassa näet 3 päätasoa ja joitain alatasoja.</li>
<li>Itselläni ylin taso oli 4 gigan kokoinen eli se nopea SSD levy. Tämän alatasot poistetaan ja luodaan yksi yhtenäinen osio ja mount pointiksi laittakaa /</li>
<li>Ja 16 gigainen taso on sitten se hitaampi SSD ja sille luodaan myös yksi alataso ja sen mount pointiksi tulee /home</li>
<li>SWAP osiosta se herjaa kun hyväksyt osioinnin ja SWAP OSIOTA <strong>EI</strong> LUODA.</li>
</ol>
</li>
<li>Sitten tulee yhteenveto asennuksesta ja valitse INSTALL.</li>
<li>Nyt vain odotat.</li>
</ol>
<h2>4. Array.orgin Eee Pc:lle tehdyn kernelin asentaminen.</h2>
<p>Itselläni ei ainakaan toiminut verkko kun olin asentanut Ubuntun tähän ja boottasin sen ensimmäisen kerran. Joten neuvon miten saat asennettua uuden Kernelin ilman verkkoa, tarvitset käyttöösi toisen koneen ja usb-tikkusi.</p>
<ol>
<li>Lataa seuraavat kaksi tiedostoa ja siirrä ne tikullesi
<ol>
<li><a href="http://www.array.org/ubuntu/dists/hardy/eeepc/binary-i386/linux-image-2.6.24-21-eeepc_2.6.24-21.39eeepc1_i386.deb" target="_blank">linux-image-2.6.24-21-eeepc_2.6.24-21.39eeepc1_i386.deb</a></li>
<li><a href="http://www.array.org/ubuntu/dists/hardy/eeepc/binary-i386/linux-ubuntu-modules-2.6.24-21-eeepc_2.6.24-21.30eeepc4_i386.deb" target="_blank">linux-ubuntu-modules-2.6.24-21-eeepc_2.6.24-21.30eeepc4_i386.deb</a></li>
</ol>
</li>
<li>Jos saat tikkuasi liitettäessä virheilmoituksen ettei tikun mounttaus onnistu niin tee päätteessä nämä toimenpiteet:
<ol>
<li>sudo gedit /etc/fstab</li>
<li>Poista tai kommentoi sieltä rivi: /dev/sdc1 /media/cdrom0 udf,iso9660 user,noauto,exec 0 0
<ol>
<li>Kommentointi tapahtuu laittamalla # merkki rivin eteen</li>
</ol>
</li>
<li>Nyt tikun liittäminen pitäisi onnistua</li>
</ol>
</li>
<li>Käyttäen terminaalia navigoi tikkusi juureen ja asenna kernel
<ol>
<li>Itselläni tikku mounttasi kohtaan /media joten <em>cd /media</em> päästää sinut kansioon missä tikku on</li>
<li>Tämän jälkeen komennolla <em>ls</em> näet kansion sisällön</li>
<li>Bongaa sieltä oma tikkusi ja komenna <em>cd tikkusi_nimi</em></li>
<li>Asenna molemmat paketit yhtä aikaa ja tämä onnistuu ajamalla seuraava komento
<ol>
<li><em>sudo dpkg -i linux-image-2.6.24-21-eeepc_2.6.24-21.39eeepc1_i386</em><em>.deb linux-ubuntu-modules-2.6.24-21-eeepc_2.6.24-21.30eeepc4_i386</em><em>.deb</em></li>
</ol>
</li>
</ol>
</li>
<li>Käynnistä kone uudelleen</li>
<li>Kun boottivaiheessa se lataa GRUBia niin paina ESC, sinulla on jokunen sekunti aikaa tehdä tämä.<br />
Tarkista onko eeepc kerneli valittuna, mikäli ei niin valitse se ja paina ENTER</li>
</ol>
<h2>5. Asennuslähteiden asennus</h2>
<ol>
<li>Suorita seuraavat komennot terminaalissa
<ol>
<li><em>wget http://www.array.org/ubuntu/array.list</em></li>
<li><em>sudo mv -v array.list /etc/apt/sources.list.d/</em></li>
<li>
<div class="terminal"><em>wget http://www.array.org/ubuntu/array-apt-key.asc</em></div>
</li>
<li>
<div class="terminal"><em>sudo apt-key add array-apt-key.asc</em></div>
</li>
<li>
<div class="terminal"><em>sudo apt-get update</em></div>
</li>
</ol>
</li>
</ol>
<h2>6. Asenna loput komponentit</h2>
<ol>
<li>Terminaaliin kirjoita seuraava komento:
<div class="terminal"><em>sudo apt-get install linux-eeepc linux-headers-eeepc</em></div>
</li>
<li>Vaihtoehtoisesti voit poistaa vanhan kernelin seuraavalla komennolla:
<div class="terminal"><em> sudo apt-get remove linux-generic linux-image-generic linux-headers-generic linux-restricted-modules-generic</em></div>
</li>
</ol>
<p><strong>Ja that&#8217;s it olet asentanut Ubuntun ja kustomoidun kernelin.</strong></p>
<h2>Muokkauksia Ubuntuun vielä</h2>
<ol>
<li>Automaattisesti moduulit lataukseen käynnistyksessä
<ol>
<li>
<div class="terminal"><em>sudo gedit /etc/modules</em></div>
</li>
<li>Lisää seuraavat rivit avattuun tiedostoon:<br />
<em>pciehp pciehp_debug=1 pciehp_force=1<br />
acpi-cpufreq</em></li>
<li>Tallenna ja reboottaa</li>
</ol>
</li>
<li>FN + F* napit toimimaan sekä pikanapit toimimaan
<ol>
<li><em>wget http://www.informatik.uni-bremen.de/~elmurato/901/Ubuntu_ACPI_scripts-EeePC_901_1000.tar.gz</em></li>
<li><em>tar xfvz Ubuntu_ACPI_scripts-EeePC_901_1000.tar.gz</em></li>
<li><em>cd Ubuntu_ACPI_scripts-EeePC_901_1000</em></li>
<li><em>chmod +x install.sh</em></li>
<li><em>sudo ./install.sh</em></li>
<li>Nyt napit toimivat seuraavalla tavalla:<br />
<strong>Ylimmät pikanäppäimet vasemmalta oikealle:</strong><br />
Powersave mode with display off, Bluetooth on/off, Processor mode, Camera on/off<br />
<strong>FN + F* napit:</strong><br />
Fn+ F1 sleep, F2 wlan on/off, F3 F4 backlight, F5 not tested (display change), F7 mute, F8 volume down, F9 volume up.</li>
</ol>
</li>
<li>Caps,num ja scroll lock ilmaisin appletti
<ol>
<li><em>sudo apt-get install lock-keys-applet</em></li>
<li>Paina oikeall hiirennapilla yläpalkista ja valitse Lisää paneelin<br />
Valitse listasta Lock keys applet ja paina lisää</li>
</ol>
</li>
</ol>
<p>No jos jotain tulee niin kysykää, kirjoitusvirheitäkin voi olla, mutta tämä opas on tehty Eee Pc 901 läppärillä ja käyttäen Ubuntu 8.04.1 käyttöjärjestelmää.</p>
<p><strong>Päivitystä:</strong><br />
Ubuntun 8.10 versiolle on tehty oma oppaansa:<br />
<a href="http://wiki.ubuntu-fi.org/Asus_EEE_901_konfigurointi_(Intrepid_Ibex)" target="_blank">http://wiki.ubuntu-fi.org/Asus_EEE_901_konfigurointi_(Intrepid_Ibex)</a></p>