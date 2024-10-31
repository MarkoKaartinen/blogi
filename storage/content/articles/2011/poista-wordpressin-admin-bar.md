---
title: 'Poista WordPressin admin bar'
slug: poista-wordpressin-admin-bar
status: published
published_at: 2011-06-07 12:53
updated_at: 2011-06-07 12:53
description: |
    Itselleni tuli eteen tilanne, jossa halusin WordPressin Admin Bar -osan pois käytöstä. Tämähän on ominaisuus, joka on rakennettu WordPressiin ja suoraa on/off -painiketta ei taida olla olemassa. Ratkaisu on helppo, kopioi teemasi functions.php -tiedostoon seuraava koodinpätkä: add_filter( ’show_admin_bar’, ’__return_false’ ); Tämän jälkeen Admin Baria ei pitäisi enää näkyä!
legacy: true
categories:
- Blogi
tags:
- Admin Bar
- koodi
- ohjelmointi
- vinkki
- wordpress
---

<p>Itselleni tuli eteen tilanne, jossa halusin WordPressin Admin Bar -osan pois käytöstä. Tämähän on ominaisuus, joka on rakennettu WordPressiin ja suoraa on/off -painiketta ei taida olla olemassa.</p>
<p>Ratkaisu on helppo, kopioi teemasi <strong>functions.php</strong> -tiedostoon seuraava koodinpätkä:<br />
<em>add_filter( &#8217;show_admin_bar&#8217;, &#8217;__return_false&#8217; );</em></p>
<p>Tämän jälkeen Admin Baria ei pitäisi enää näkyä!</p>