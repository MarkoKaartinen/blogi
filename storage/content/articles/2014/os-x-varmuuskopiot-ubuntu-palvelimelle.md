---
title: 'OS X varmuuskopiot Ubuntu palvelimelle'
slug: os-x-varmuuskopiot-ubuntu-palvelimelle
status: published
published_at: 2014-11-18 08:31
updated_at: 2014-12-10 17:17
description: |
    OS X tarjoaa erittäin toimivan varmuuskopioinnin jos suoraan. Itse olen käyttänyt tähän asti ulkoista kiintolevyä varmuuskopiointiin Time Machinella. Eilen tuli kuitenkin mieleen, että miksi en käyttäisi toimiston nurkassa olevaa Ubuntu pohjaista palvelinta hyödyksi ja laittaisi sinne varmuuskopiot menemään? Löysinkin nopeasti ohjeen minkä suomennankin teille tässä niiltä osin mitä itse tarvitsi tehdä. Tätä operaatiota varten tarvitset… Jatka lukemista OS X varmuuskopiot Ubuntu palvelimelle
legacy: true
categories:
- Blogi
tags:
- Linux
- Mac
- mäk
- ohje
- opas
- OS X
- OSX
- palvelin
- time machine
- ubuntu
- varmuuskopio
- varmuuskopiot
---

<p>OS X tarjoaa erittäin toimivan varmuuskopioinnin jos suoraan. Itse olen käyttänyt tähän asti ulkoista kiintolevyä varmuuskopiointiin Time Machinella. Eilen tuli kuitenkin mieleen, että miksi en käyttäisi toimiston nurkassa olevaa Ubuntu pohjaista palvelinta hyödyksi ja laittaisi sinne varmuuskopiot menemään? Löysinkin nopeasti <a href="https://www.64bit.co.uk/ubuntu-as-a-osx-time-machine/" target="_blank">ohjeen</a> minkä suomennankin teille tässä niiltä osin mitä itse tarvitsi tehdä.</p>
<p>Tätä operaatiota varten tarvitset Ubuntu palvelimen, jossa on kiintolevytilaa varmuuskopioita varten (itsellä vapaana 1.7 teratavua) sekä tietysti sen OS X tietokoneen eli mäkin.</p>
<ol>
<li>Asennetaan ensin tarvittavat paketit:<br />
<code>sudo apt-get install netatalk avahi-daemon<br />
</code></li>
<li>Tämän jälkeen luodaan asetustiedosto joka avautuu nano nimisessä ohjelmassa:<br />
<code>sudo nano /etc/avahi/services/afpd.service</code></li>
<li>Liität alla olevan rimpsun tiedostoon ja tallennat sen (<em>ctrl+o</em> tallentaa nanossa ja <em>ctrl+x</em> sulkee):<br />
<code>&lt;?xml version="1.0" standalone=’no’?&gt;&lt;!–*-nxml-*–&gt;<br />
&lt;!DOCTYPE service-group SYSTEM "avahi-service.dtd"&gt;<br />
&lt;service-group&gt;<br />
&lt;name replace-wildcards="yes"&gt;%h&lt;/name&gt;<br />
&lt;service&gt;<br />
&lt;type&gt;_afpovertcp._tcp&lt;/type&gt;<br />
&lt;port&gt;548&lt;/port&gt;<br />
&lt;/service&gt;<br />
&lt;/service-group&gt;</code></li>
<li>Tämän jälkeen luodaan toinen tiedosto nanolla:<br />
<code>sudo nano /etc/avahi/services/deviceinfo.service</code></li>
<li>Tähän tiedostoon laitetaan alla oleva sisältö ja tallennetaan se:<br />
<code>&lt;?xml version="1.0" standalone=’no’?&gt;&lt;!–*-nxml-*–&gt;<br />
&lt;!DOCTYPE service-group SYSTEM "avahi-service.dtd"&gt;<br />
&lt;service-group&gt;<br />
&lt;name replace-wildcards="yes"&gt;%h&lt;/name&gt;<br />
&lt;service&gt;<br />
&lt;type&gt;_device-info._tcp&lt;/type&gt;<br />
&lt;port&gt;548&lt;/port&gt;<br />
&lt;txt-record&gt;model=Xserve&lt;/txt-record&gt;<br />
&lt;/service&gt;<br />
&lt;/service-group&gt;<br />
</code></li>
<li>Käynnistetään palvelut:<br />
<code>sudo /etc/init.d/netatalk restart<br />
sudo /etc/init.d/avahi-daemon restart</code></li>
<li>Luodaan kansio sekä käyttäjä Time Machinea varten<br />
<code>sudo mkdir -p /data/osx/timemachine<br />
sudo useradd -c "Time Machine User" -d /data/osx/timemachine/ -s /bin/false -g 10 timemachine<br />
sudo passwd timemachine</code></li>
<li>Kerrotaan kansiolle, että se tukee Time Machinea:<br />
<code>sudo touch /data/osx/timemachine/.com.apple.timemachine.supported</code></li>
<li>Oikeuksia kansiolle:<br />
<code>sudo chown -R timemachine:users /data/osx/timemachine</code></li>
<li>Avataan tiedosto nanolla:<br />
<code>sudo nano /etc/netatalk/AppleVolumes.default</code></li>
<li>Laitetaan tiedostoon seuraava rivi ennen <em># End of file</em> -tekstiä<br />
<code>/data/osx/timemachine TimeMachine allow:timemachine options:tm</code></li>
<li>Oletus kotijaot pois:<br />
<code>sed -i ‘s/^~/#~/’ /etc/netatalk/AppleVolumes.default</code></li>
<li>Selvitä oman Ubuntu palvelimesi MAC osoite ja ota se talteen:<br />
<code>ifconfig -a | grep HWaddr</code></li>
<li>Luodaan tiedosto nanolla:<br />
<code>sudo nano /etc/avahi/services/adisk.service</code></li>
<li>Laita seuraava rimpsu tiedostoon (älä tallenna vielä):<br />
<code>&lt;?xml version="1.0" standalone=’no’?&gt;<br />
DOCTYPE service-group SYSTEM "avahi-service.dtd"&gt;<br />
&lt;service-group&gt;<br />
&lt;name replace-wildcards="yes"&gt;%h&lt;/name&gt;<br />
&lt;service&gt;<br />
&lt;type&gt;_adisk._tcp&lt;/type&gt;<br />
&lt;port&gt;9&lt;/port&gt;<br />
sys=waMA=nnnnnn,adVF=0×100<br />
&lt;txt-record&gt;dk0=adVF=0xa1,adVN=TimeMachine,adVU=xxxxxxxx&lt;/txt-record&gt;<br />
&lt;txt-record&gt;dk1=adVN=media,adVU=yyyyyyyyyy&lt;/txt-record&gt;<br />
&lt;txt-record&gt;dk2=adVN=software,adVU=zzzzzzzzz&lt;/txt-record&gt;<br />
&lt;/service&gt;<br />
&lt;/service-group&gt;</code></li>
<li>Korvaa rimpsusta <em>nnnnnn</em> kohta omalla MAC osoitteellasi.</li>
<li>Korvaa rimpsusta kohdat <em>xxxxxxxx</em>, <em>yyyyyyyyyy</em> ja <em>zzzzzzzzz</em> uniikeilla UUID:llä. Voit luoda kolme kappaletta UUID:tä osoitteessa http://www.guidgen.com/</li>
<li>Tämän jälkeen tallenna tiedosto <em>ctrl+o</em> yhdistelmällä ja sulke <em>ctrl+x</em> yhdistelmällä.</li>
<li>Käynnistetään palvelut uudestaan:<br />
<code>sudo /etc/init.d/netatalk restart<br />
sudo /etc/init.d/avahi-daemon restart</code></li>
<li>Lisää palvelin oman mäkkisi finderissa ja tallenna salasana<br />
<code>Siirry -&gt; Yhdistä palvelimelle</code></li>
<li>Lisää palvelin Time Machinen asetuksissa</li>
</ol>
<p>Näiden jälkeen itselläni oli homma valmis ja Time Machine alkoi tekemään varmuuskopiota tuonne palvelimelle.</p>
<p><a href="https://cdn.markokaartinen.net/uploads/2014/11/Screenshot-2014-11-18-08.13.48.png"><img loading="lazy" decoding="async" class="aligncenter size-full wp-image-5273" src="https://cdn.markokaartinen.net/uploads/2014/11/Screenshot-2014-11-18-08.13.48.png" alt="Screenshot 2014-11-18 08.13.48" width="792" height="540" srcset="https://cdn.markokaartinen.net/uploads/2014/11/Screenshot-2014-11-18-08.13.48.png 792w, https://cdn.markokaartinen.net/uploads/2014/11/Screenshot-2014-11-18-08.13.48-600x409.png 600w" sizes="(max-width: 792px) 100vw, 792px" /></a></p>