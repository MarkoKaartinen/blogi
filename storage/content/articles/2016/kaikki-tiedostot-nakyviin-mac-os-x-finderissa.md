---
title: 'Kaikki tiedostot näkyviin Mac OS X Finderissa'
slug: kaikki-tiedostot-nakyviin-mac-os-x-finderissa
status: published
published_at: 2016-05-12 09:11
updated_at: 2017-03-06 08:32
description: |
    Tänään se alkoi viimein ärsyttämään oikein olan takaa, kun en nähnytkään kaikkia tiedostoja Finderissa. Halusin nähdä nimenomaan .gitignore ja .htaccess filut, jotta saisin ne kopioitua eteenpäin toisaalle. No tämä on aiemmin tehty komentorivin kautta, mutta tänään päätin googlettaa ja löytää ratkaisun tähän. Tämä ratkaisu olikin onneksi helppo sillä se vaati vain parin komennon ajamisen päätteellä… Jatka lukemista Kaikki tiedostot näkyviin Mac OS X Finderissa
legacy: true
categories:
- Apple
tags:
- Finder
- Mac
- Mac OS X
- OS X
- piilotetut tiedostot
- tiedostot
- vinkki
---

<p>Tänään se alkoi viimein ärsyttämään oikein olan takaa, kun en nähnytkään kaikkia tiedostoja Finderissa. Halusin nähdä nimenomaan .gitignore ja .htaccess filut, jotta saisin ne kopioitua eteenpäin toisaalle. No tämä on aiemmin tehty komentorivin kautta, mutta tänään päätin googlettaa ja löytää ratkaisun tähän. Tämä ratkaisu olikin onneksi helppo sillä se vaati vain parin komennon ajamisen päätteellä ja homma oli sillä selvä.</p>
<p>Tässä vielä muistiin itselle ja teille:</p>
<ol>
<li>Avaa pääte</li>
<li>Kopioi tämä komento: <code>defaults write com.apple.finder AppleShowAllFiles YES</code></li>
<li>Tapa Finder tällä komennolla: <code>killall Finder</code></li>
<li>Nauti kaikista mahdollisista tiedostoista Finderissasi</li>
</ol>
<p>Piiloon nämä tiedostot saat näillä tempuilla:</p>
<ol>
<li>Avaa pääte</li>
<li>Kopioi tämä komento: <code>defaults write com.apple.finder AppleShowAllFiles NO</code></li>
<li>Tapa Finder tällä komennolla: <code>killall Finder</code></li>
<li>Poof &#8211; tiedostot katosivat näkyvistä</li>
</ol>