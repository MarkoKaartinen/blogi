---
title: 'NTFS tuki Yosemiteen'
slug: ntfs-tuki-yosemiteen
status: published
published_at: 2015-02-15 18:13
updated_at: 2016-09-26 15:42
description: |
    Mac osaa lukea oletuksena NTFS muotoisia levyjä, mutta jos olet kuin minä niin haluat myös kirjoittaa sinne. NTFS tuen asentelu on suhteellisen simppeli homma, asenna nämä kolme pakettia niin homman pitäisi toimia vallan mainiosti.
legacy: true
categories:
- Apple
- Blogi
tags:
- Apple
- kiintolevy
- Mac
- Mac OS X
- NTFS
- ohje
- OS X
- Yosemite
---

<p>Mac osaa lukea oletuksena NTFS muotoisia levyjä, mutta jos olet kuin minä niin haluat myös kirjoittaa sinne. NTFS tuen asentelu on suhteellisen simppeli homma, asenna nämä kolme pakettia niin homman pitäisi toimia vallan mainiosti.</p>
<ol>
<li>Asenna FUSE for OS X
<ul>
<li>Lataa osoitteesta: <a href="http://osxfuse.github.io/" target="_blank">http://osxfuse.github.io/</a></li>
<li>Asennuksessa valitse kohdat:
<ul>
<li>OSXFUSE Core</li>
<li>OSXFUSE Preference Pane</li>
<li>OSXFUSE Compatibility Layer</li>
</ul>
</li>
</ul>
</li>
<li>Asenna NTFS-3G
<ul>
<li>Lataa osoitteesta: <a href="http://macntfs-3g.blogspot.fi/2010/10/ntfs-3g-for-mac-os-x-2010102.html" target="_blank">http://macntfs-3g.blogspot.fi/2010/10/ntfs-3g-for-mac-os-x-2010102.html</a></li>
<li>Valitse asennuksessa Caching mode: <strong>No caching</strong></li>
</ul>
</li>
<li>Asenna fuse_wait
<ul>
<li>Lataa osoitteesta: <a href="https://github.com/bfleischer/fuse_wait/downloads" target="_blank">https://github.com/bfleischer/fuse_wait/downloads</a></li>
</ul>
</li>
</ol>
<p>Itse asentelin nämä ja tämän jälkeen NTFS levylle kirjoittaminen onnistui.</p>
<p>Sama ohje kuvineen ja tarkempine selityksineen: <a href="http://www.macbreaker.com/2014/06/how-to-enable-writing-to-ntfs-hard.html" target="_blank">MacBreaker</a></p>