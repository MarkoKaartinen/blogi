---
title: 'Hovercardit saapuivat!'
slug: hovercardit-saapuivat
status: published
published_at: 2010-11-17 18:02
updated_at: 2013-08-05 15:20
description: |
    Bongasin eräästä toisesta blogista Hovercardin ja aloin googlailemaan miten tänne saisi semmoisen. Kun viette hiiren minun pikkukuvani päälle tämän blogikirjoituksen alapuolella, niin näette pienen ”kortin” minusta. Tämänhän loistavan ominaisuuden mahdollistaa jälleen kerran Gravatar. Sekä tämän lisääminen omaan WordPress blogiisi on helppoa! Avaat vain teemasi functions.php tiedoston ja lisäät sinne alla olevan pätkän (huom. blogisi on… Jatka lukemista Hovercardit saapuivat!
legacy: true
categories:
- Blogi
tags:
- Blogi
- Gravatar
- hovercard
- ominaisuus
- vinkki
- wordpress
---

<p>Bongasin eräästä toisesta blogista Hovercardin ja aloin googlailemaan miten tänne saisi semmoisen. Kun viette hiiren minun pikkukuvani päälle tämän blogikirjoituksen alapuolella, niin näette pienen &#8221;kortin&#8221; minusta.</p>
<p>Tämänhän loistavan ominaisuuden mahdollistaa jälleen kerran Gravatar. Sekä tämän lisääminen omaan WordPress blogiisi on helppoa!</p>
<p>Avaat vain teemasi <strong>functions.php</strong> tiedoston ja lisäät sinne alla olevan pätkän (huom. blogisi on käytettävä Gravatar avatareja oletuksena):</p>
<pre>wp_enqueue_script( 'gprofiles', 'http://s.gravatar.com/js/gprofiles.js', array( 'jquery' ), 'e', true );</pre>
<p>Tämän jälkeen homma toimii! Hienoa eikö? Omia hovercardin tietoja voit muokata <a href="http://fi.gravatar.com/" target="_blank">Gravatar.com</a> sivustolla ja kun sinulle on sinne tunnukset ja olet kirjautunut sisään &#8211; löydät kohdan My account -&gt; Muokkaa omaa profiilia. Tämän kun tallennat, niin tiedot näkyvät Hovercardissasi.</p>