---
title: 'Backspace näppäimestä edelliselle sivulle Firefoxissa'
slug: backspace-nappaimesta-edelliselle-sivulle-firefoxissa
status: published
published_at: 2009-01-24 13:34
updated_at: 2009-01-24 13:34
description: |
    Asentelin CrunchEee Linuxin omaan Eeeheni ja tähän mennessä olen pitänyt ko. distrosta. Kuitenkin olen törmännyt samaan ongelmaan aiemminkin ja etsinyt aina samaan ongelmaan ratkaisua Googlesta, mutta nyt päätin blogata sen tänne, jotta ei tarvitse aina etsiä sitä. Eli ongelma on, että olen tottunut siihen, että Firefoxissa kun painnaa backspace näppäintä niin menee edelliselle sivulle. Jos… Jatka lukemista Backspace näppäimestä edelliselle sivulle Firefoxissa
legacy: true
categories:
- Blogi
tags:
- backspace
- CrunchEee
- Firefox
- Linux
---

<p>Asentelin CrunchEee Linuxin omaan Eeeheni ja tähän mennessä olen pitänyt ko. distrosta.</p>
<p>Kuitenkin olen törmännyt samaan ongelmaan aiemminkin ja etsinyt aina samaan ongelmaan ratkaisua Googlesta, mutta nyt päätin blogata sen tänne, jotta ei tarvitse aina etsiä sitä.<br />
Eli ongelma on, että olen tottunut siihen, että Firefoxissa kun painnaa backspace näppäintä niin menee edelliselle sivulle. Jos näin ei tapahdu niin tässä tulee korjaus siihen:</p>
<p>Kirjoita about:config Firefoxin osoiteriville ja etsi kohta: browser.backspace_action ja määritä sille arvoksi 0<br />
Tämän jälkeen backspace näppäin toimii kuten haluankin.</p>