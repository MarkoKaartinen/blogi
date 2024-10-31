---
title: 'XAMPP ja alidomain localhostille'
slug: xampp-ja-alidomain-localhostille
status: published
published_at: 2011-09-20 17:48
updated_at: 2011-09-20 17:48
description: |
    Virittelen tässä itselleni työympäristöä ja en halua sekoittaa työtä ja normikoodailua keskenään. Halusin erottaa jotenkin localhostin ja työpuolen. No keksin sitten, että miten onnistuisi work.localhost osoitteen tekeminen. Käytössänihän on XAMPP ja Windows 7 – uskon tosin, että tämä toimii muillakin Windows asennuksilla. 1. Avaa C:WindowsSystem32driversetchosts tiedosto ja lisää sinne seuraava rivi: 127.0.0.1 work.localhost 2. Avaa C:xamppapacheconfextrahttpd-vhosts.conf tiedosto… Jatka lukemista XAMPP ja alidomain localhostille
legacy: true
categories:
- Blogi
tags:
- apache
- säätäminen
- säätö
- vhost
- virtualhost
- XAMPP
---

<p>Virittelen tässä itselleni työympäristöä ja en halua sekoittaa työtä ja normikoodailua keskenään. Halusin erottaa jotenkin localhostin ja työpuolen. No keksin sitten, että miten onnistuisi work.localhost osoitteen tekeminen.</p>
<p>Käytössänihän on XAMPP ja Windows 7 &#8211; uskon tosin, että tämä toimii muillakin Windows asennuksilla.</p>
<p>1. Avaa C:\Windows\System32\drivers\etc\hosts tiedosto ja lisää sinne seuraava rivi:<br />
<code>127.0.0.1 work.localhost</code></p>
<p>2. Avaa C:\xampp\apache\conf\extra\httpd-vhosts.conf tiedosto ja itse lisäsin seuraavat rivit sinne:<br />
<code>&lt;VirtualHost work.localhost&gt;<br />
DocumentRoot "C:/Users/Marko/git"<br />
ServerName work.localhost<br />
ServerAlias work.localhost<br />
&lt;Directory "C:/Users/Marko/git"&gt;<br />
Options Indexes FollowSymLinks<br />
AllowOverride All<br />
Order allow,deny<br />
Allow from all<br />
&lt;/Directory&gt;<br />
&lt;/VirtualHost&gt;</code></p>
<p>Itselläni se ohjaa C:/Users/Marko/git kansioon, muuta tämän haluamaksesi kansioksi!</p>
<p>3. Käynnistä XAMPPin Apache ja sen jälkeen osoitteen <em>http://work.localhost</em> pitäisi toimia. Jossain sanottiin, että käynnistä kone uusiksi, mutta itselläni ei tätä tarvinnut tehdä.</p>