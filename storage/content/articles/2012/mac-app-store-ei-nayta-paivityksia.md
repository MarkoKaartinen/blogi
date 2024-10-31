---
title: 'Mac App Store ei näytä päivityksiä?'
slug: mac-app-store-ei-nayta-paivityksia
status: published
published_at: 2012-06-26 17:05
updated_at: 2012-06-26 09:52
description: |
    Onko sinulla ollut joskus ongelma Macin App Storen kanssa, kun koitat päivittää ohjelmia. Herjaako se silloin sinulle seuraavaa: ”Päivitä ohjelma kirjautumalla sisään tilille, jolla ostit ohjelman.”? Ei hätää tähän ongelmaan on ratkaisu. Itse törmäsin tähän ongelmaan tänään kun koitin päivittää Coda 2:sta ja tiesin, että siihen oli tullut päivitys. App Store ei näyttänyt, että minulla… Jatka lukemista Mac App Store ei näytä päivityksiä?
legacy: true
categories:
- Blogi
tags:
- App Store
- Apple
- indeksointi
- Mac
- Mac App Store
- päivitykset
---

<p>Onko sinulla ollut joskus ongelma Macin App Storen kanssa, kun koitat päivittää ohjelmia. Herjaako se silloin sinulle seuraavaa: <em>&#8221;Päivitä ohjelma kirjautumalla sisään tilille, jolla ostit ohjelman.&#8221;</em>?</p>
<p>Ei hätää tähän ongelmaan on ratkaisu. Itse törmäsin tähän ongelmaan tänään kun koitin päivittää Coda 2:sta ja tiesin, että siihen oli tullut päivitys. App Store ei näyttänyt, että minulla olisi päivityksiä mihinkään sieltä hankkimaani ohjelmaan. Tämä vaikutti oudolta joten päätin tutkia (lue. Googlata) asiaa hieman lisää.</p>
<p>Tutkimisen tuloksena oli se, että indeksointi jos on pois päältä niin kaikki ohjelmien päivitykset ei tule näkymiin App Storeen. Minun tapauksessani ei ollut ensimmäistäkään päivitystä. Olin aikoinaan ottanut indeksoinnin pois päältä, kun koin sen turhaksi. No päivityksiä on kiva saada niin laitoin indeksoinnin takaisin päälle <a href="http://www.ngpixel.com/2011/06/25/mac-app-store-you-have-updates-available-for-the-other-accounts-bug/" target="_blank">NGPixelin</a> ohjeilla.</p>
<blockquote><p><strong>Solution 1 – Spotlight works but the index is incomplete or empty:</strong></p>
<ol>
<li>Open System Preferences &gt; Spotlight</li>
<li>Under the Privacy tab. Add your Macintosh HD (or whatever your main hard disk is called) to the list.</li>
<li>Close the window. Wait a few seconds. Then go back to Spotlight settings and remove the entry you just added.</li>
<li>The spotlight index should now begin to re-index completely. (A dot will fade-in/out inside the Spotlight icon in the taskbar)</li>
<li>Wait for it to finish and then launch the Mac App Store. You should now see updates in the Updates tab.</li>
</ol>
<p>&nbsp;</p>
<p><strong>Solution 2 – Spotlight indexing is disabled (frequent on Mac OS X Server)</strong></p>
<ol>
<li>Open a Terminal window.</li>
<li>Type the following command: <em>sudo mdutil -i on /</em></li>
<li>A message saying “Indexing enabled.” should appear after a few seconds.</li>
<li>Close the Terminal window and the Spotlight indexing should now start automatically. (Again, a dot will appear inside the Spotlight icon during the indexing process)</li>
<li>Wait for it to finish and then launch the Mac App Store. You should now see updates in the Updates tab.</li>
</ol>
</blockquote>
<p>Tarvittaessa voin myös suomentaa teille tuon ohjeen, mikäli on tarvis niin kommentteja kiitos!</p>