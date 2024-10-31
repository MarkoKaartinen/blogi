---
title: 'Palvelimen vaihto ja miten tämä nyt toimii'
slug: palvelimen-vaihto-ja-miten-tama-nyt-toimii
status: published
published_at: 2016-06-22 15:10
updated_at: 2017-03-06 08:31
description: |
    Olen viime aikoina puuhastellut Laravelin parissa ja tuli törmättyä Laravel Forgeen. Eilen tuli tehtyä tili Forgeen ja siitä se säätö lähti.
legacy: true
categories:
- Blogi
tags:
- Digitalocean
- Git
- https
- laravel
- laravel forge
- let's encrypt
- letsencrypt
- linode
- palvelin.github
- ssl
- virtuaalipalvelin
- vps
---

<p>Olen viime aikoina puuhastellut <a href="https://laravel.com/" target="_blank">Laravelin</a> parissa ja tuli törmättyä tässä yhteydessä Laravel Forgeen. Eilen tuli sitten tehtyä sinne tili ja sen kautta <a href="https://www.linode.com/?r=28f57b9930639eba1568ea7ecec425661e3752eb" target="_blank">Linodeen</a> virtuaalipalvelin. Sen takia tein muuten Linodeen, koska ne tuplasi muistin määrän. No nyt minulla on sitten uusi palvelin, jonne siirrän omat projektit yksi kerrallaan tässä tämän viikon aikana. Oma blogini oli ensimmäisistä siirroista.</p>
<p>Minulla oli ennen <a href="https://m.do.co/c/34aebd17275a" target="_blank">DigitalOceanilla</a> virtuaalipalvelin ja pidän edelleen tästä palvelusta. Sen päällä oli <a href="http://vestacp.com/" target="_blank">VestaCP</a>, joka hoiti sitten sivujen hallintaa ja asensi palvelimet yms. minun puolesta. Tuo Forge kuitenkin mahdollistaa vieläki helpomman hallinnan ja suoran deployn Gitistä, joten lähdetään sen kanssa leikkimään. Siitä on varmasti hyötyä myös töiden kanssa, joten ei tässä voi kun voittaa &#8211; eikös?</p>
<p>Forge tukee myös suoraan <a href="https://letsencrypt.org/" target="_blank">Let&#8217;s Encryptiä</a>, joten minun sivuilla (ja muillakin) on nyt SSL sertifikaatti täysin ilmaiseksi! Kannattaa muuten kokeilla tuota, on suhteellisen simppeli käyttää, mutta jos haluaa itse tehdä niin vaatii hieman palvelinpuolen osaamistakin.</p>
<p>Oma sivusto on nyt siis Linoden päällä ja sillä on ssl sertifikaatti. Karsin lisäosia jonkun verran ja samalla otin käyttöön GitHub repositoryn ja <a href="https://roots.io/bedrock/" target="_blank">Bedrockin</a> tälle sivulle. Niin siis tämä sivusto on GitHubissa ja voitte sitä ihmetellä repostani <a href="https://github.com/MarkoKaartinen/MarkoKaartinen.net" target="_blank">MarkoKaartinen/MarkoKaartinen.net</a>. Tuonne kun teen pushin niin se tulee täysin automaattisesti tänne. Tämä on hyödyllinen varsinkin, jos minulla olisi täysin itse tehty teema tässä alla ja muutenkin.</p>
<p>Pientä bugia ja säätöä on vielä varmasti ja jos huomaat jotain niin pistä kommenttia tai mailia minulle <a href="mailto:markokaartinen@gmail.com">markokaartinen@gmail.com</a> osoitteeseen!</p>