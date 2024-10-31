---
title: 'Linux palvelimen tiedostojen ja tietokannan varmuuskopiointi Dropboxiin'
slug: linux-palvelimen-tiedostojen-ja-tietokannan-varmuuskopiointi-dropboxiin
status: published
published_at: 2018-07-24 15:14
updated_at: 2018-07-24 15:14
description: |
    Kirjoittelin aamulla varmuuskopiointi skriptiä yhdelle palvelimelle. Tästä tulikin ihan hyödyllinen paketti ja jaankin tähän nyt ohjeistusta miten saat tämän toimintaan itsellekkin. Oletan, että olet sinut Linuxin kanssa ja peukalo ei ole keskellä kämmentä :) Eli halusin varmuuskopiot tietokannasta ja tiedostoista. Sekä koska maksan Dropboxista niin minulla on siellä kivasti tilaa niin olisi näppärä jos ne… Jatka lukemista Linux palvelimen tiedostojen ja tietokannan varmuuskopiointi Dropboxiin
legacy: true
categories:
- Linux
tags:
- dropbox
- howto
- koodi
- Linux
- ohje
- opas
- palvelin
- tuto
- varmuuskopiointi
- vinkki
---

<p>Kirjoittelin aamulla varmuuskopiointi skriptiä yhdelle palvelimelle. Tästä tulikin ihan hyödyllinen paketti ja jaankin tähän nyt ohjeistusta miten saat tämän toimintaan itsellekkin. Oletan, että olet sinut Linuxin kanssa ja peukalo ei ole keskellä kämmentä :)</p>
<p>Eli halusin varmuuskopiot tietokannasta ja tiedostoista. Sekä koska maksan Dropboxista niin minulla on siellä kivasti tilaa niin olisi näppärä jos ne menisi sinne automaattisesti. Eikun siis töihin. Itse tein touhut roottina joten kannattaa sudo komentoa käyttää tai mennä roottina sisään.</p>
<p>Aloitetaan vaikka asentamalla lbzip2, jota itse käytin tietokannan pakkaamiseen. Ohjeita löydät heidän omalta kotisivultaan: <a href="http://lbzip2.org/" target="_blank" rel="noopener">http://lbzip2.org/</a></p>
<p>Seuraavaksi luodaan kansio varmuuskopioille. Itse loin /backup kansion ja se onnistuu komennolla <code>mkdir /backup</code></p>
<p>Mennään luotuun kansioon <code>cd /backup</code> komennolla.</p>
<p>Sinne voidaan sitten asennella Dropbox uploader. Itse latasin /backup kansioon tuon dropbox_uploader.sh tiedoston. Ohjeita löytyy Github reposta: <a href="https://github.com/andreafabrizi/Dropbox-Uploader" rel="noopener" target="_blank">https://github.com/andreafabrizi/Dropbox-Uploader</a></p>
<p>Muista antaa dropbox_uploader.sh tiedostolle oikeudet kuten ohjeistettu ja aja se kerran niin saat homman pelaamaan.</p>
<p>Tehdään Dropboxiin kansio varmuuskopioille komennolla <code>./dropbox_uploader.sh mkdir backups</code></p>
<p>Sitten tehdään backup.sh tiedosto /backup kansioon. Itse käytän nanoa niin komento <code>nano /backup/backup.sh</code> hoitaa homman.</p>
<p>Siihen liitetään alla oleva koodi ja muokataan omien tarpeiden mukaan:</p>
<pre>#!/bin/bash
MyUSER="tietokannan_tunnus"
MyPASS="tietokannan_salasana"
MyHOST="localhost"
MyDB="tietokannan_nimi"

NOW="$(date +"%d-%m-%Y-%H-%M-%S")"

FILES="/polku/tiedostoihin/"

DEST="/backup/$NOW"

[ ! -d $DEST ] && mkdir -p $DEST || :

FILE="$DEST/db.sql"

mysqldump -u $MyUSER -h $MyHOST -p$MyPASS $MyDB > $FILE

/usr/local/bin/lbzip2 $FILE

cd $FILES
tar zcpf $DEST/files.tar.gz ./*

cd $DEST
/backup/dropbox_uploader.sh upload $DEST backups</pre>
<p>Huomaa, että lbzip2 sijainti voi olla sinulla eri. Komennolla <code>which lbzip2</code> saat polun selville. Muokkaa myös tietokannan tiedot sopiviksi ja tiedostojen sijainti. </p>
<p>Tämän jälkeen tallenna tiedosto <kbd>ctrl</kbd> + <kbd>o</kbd> tekee tämän nano editorissa ja <kbd>ctrl</kbd> + <kbd>x</kbd> sulkee nanon.</p>
<p>Komennolla <code>chmod +x /backup/backup.sh</code> annetaan vielä hieman oikeuksia.</p>
<p>Voit koittaa homman toiminnan komennolla <code>sh /backup/backup.sh</code> &#8211; sen pitäisi luoda /backup kansioon päivämäärä ja aika niminen kansio jossa on kaksi tiedostoa: db.sql.bz2 ja files.tar.gz</p>
<p>Tämän voi sitten pistää esimerkiksi croniin pyörimään, jos haluat automaattisesti hoitaa ajamisen.</p>
<p>Mikäli tässä on virheitä tai aivopieruja niin en tietty vastaa ongelmista. Jokainen kokeilee omalla vastuullaan :)<br />
Palautteet ja kommentit ovat tervetulleita. Tämä toimii oikein mainiosti ja tätä voi kehittää pidemmällekkin mikäli haluaa.</p>