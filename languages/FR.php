<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.1.0
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2016, Martin Hecht (mrbaseman)
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl 
 *
 **/

/*
 -----------------------------------------------------------------------------------------
  FRANCAIS LANGUE FICHIER POUR LE MODULE: __module__
 -----------------------------------------------------------------------------------------
*/

// include fichier anglais afin que toute les chaines ont au moins une valeur par default
include("EN.php");


// francais description du module
$module_description = "
<p>
Le module External Calendar vous permet a impliquer calendriers externe (ics ou DAVCal) dans une page WebsiteBaker.
</p>

<P> Les calendriers sont maintenu moyens des programmes comme Outlook, Thunderbird Lightning et similaire, ou au moyen d'une interface web d'un WebSpace fournisseur.
Le calendrier est inclus avec ce module dans la page web. Ce module n'est pas &eacut;crit pur montrer un calendrier entier, mais explicitement pour repr&eacut;senter les dates le plus homog&egrave;nement possible dans la page web. (Si vous &ecirc;tes &agrave; la recherche d'un outil pour afficher un calendrier externe dans une vue de semaine mois ou vous pouvez utiliser php-iCalendar et l'inclure dans une page avec une iframe.) </ P>

<P> Pour la configuration du module, entrez simplement l'URL des fichiers iCal ou du WebDAV-calendrier et les rendez-vous du calendrier apparaissent comme une liste au frontend.
La solution la plus simple est de mettre vos fichiers iCal juste dans le dossier des m&eacut;dias ou dans le r&eacut;pertoire des calendriers de ce module et de les g&eacut;rer en utilisant le ftp-url dans votre client. Cependant, cela ne fonctionne que pour un seul client se il est assur&eacut; qu'aucun acc&egrave;s simultan&eacut; peut arriver. Si vous avez besoin de plusieurs comptes et vous cherchez un serveur WebDAV simple, vous voudrez peut-&ecirc;tre essayer Ba&iuml;kal. </ P>

<P> Dans le backend vous pouvez configurer beaucoup de d&eacut;tails sur l'apparence du module. La situation centrale est la zone de texte où vous entrez les URL de vos calendriers. Si un nom d'utilisateur et mot de passe est n&eacut;cessaire pour acc&eacut;der &agrave; votre calentrier, vous devez inclure ces informations d'identification dans l'URL suivant le sch&eacut;ma [protocole]: // [utilisateur]: [mot de passe] @ [domaine] / [chemin]. <br/>
Gardez &agrave; l'esprit que seul un acc&egrave;s en lecture est n&eacut;ccessaire. Si vous n'avez aucune possibilit&eacut; de partager le calendrier en lecture seule, vous pouvez prot&eacut;ger votre mot de passe en restreindre l'acc&egrave;s &agrave; la page dans le backend.
Utilisation d'une connexion https est recommand&eacut;. Dans les options avanc&eacut;es, vous pouvez d&eacut;sactiver la v&eacut;rification du certificat du serveur au cas o&ugrave; il n'a pas &eacut;t&eacut; sign&eacut; par une autorit&eacut; de confiance (d'autre part sur un renoncement &agrave; la v&eacut;rification implique un risque de s&eacut;curit&eacut;).
</ P>

<P> Si le chemin se termine sur &quot;/&quot; l'URL est interpr&eacut;t&eacut;e comme CalDAV - sinon, il est suppos&eacut; que l'URL pointe vers un fichier iCal. Les lignes commen&ccedil;ant par '&#35;' sont consid&eacut;r&eacut;es &ecirc;tre comment&eacut;.</ P>

<P>Les entr&eacut;es de calendrier peuvent &ecirc;tre limit&eacut;es dans le sens de combien de jours &agrave; l'avenir doivent &ecirc;tre affich&eacut;s. En outre, vous pouvez configurer une limite pour le nombre de rendez-vous pour montrer. Si vous entrez un z&eacut;ro pour une de ces limites, cela signifie &quot; illimit&eacut;e &quot;. Dans les options avanc&eacut;es, vous pouvez sp&eacut;cifier si les dates &eacut;coul&eacut;es seront pr&eacut;sent&eacut;s jusqu'&agrave; minuit avant qu'ils ne disparaissent. 
Vous pouvez &eacut;galement r&eacut;gler un d&eacut;calage en secondes, qui est appliqu&eacut;e &agrave; l'heure actuelle du serveur avant de le comparer &agrave; une entr&eacut;e de calendrier.</ P>

<P> Le fuseau horaire sur la base duquel les dates dans les calandres sont interpr&eacut;t&eacut;s, peut &ecirc;tre configur&eacut; dans le backend, aussi. Ceci est particuli&egrave;rement important pour une manipulation correcte des rendez-vous entre la lumi&egrave;re du jour-&eacut;pargne. Choisissez le fuseau horaire correspondant &agrave; votre pays. Ne pas utiliser quelque chose comme &quot; UTC + X heures &quot ;, de car ce param&egrave;tre ne serait pas au courant de l'heure d'&eacut;t&eacut;. 
 Vous pouvez &eacut;galement laisser le champ vide, alors le module tente de d&eacut;terminer le fuseau horaire dans les param&egrave;tres globaux linguistiques de WebsiteBaker (cela devrait fonctionner pour l'Allemagne, l'Angleterre, la France et l'Italie, actuellement). Pour r&eacut;initialiser l'un des champs, il suffit d'entrer &quot; {DEFAULT} &quot; et enregistrer les r&eacut;glages. </ p>

<P> Tout le formatage des nominations est contr&ocirc;l&eacut;e par des mod&egrave;les et des blocs de mise en forme. 
Notez que certains param&egrave;tres sont cach&eacut;s a la groupe des options avanc&eacut;es.
Il y a un mod&egrave;le pour l'ensemble d'entr&eacut;e et un autre sp&eacut;cialement pour la date. Dans le mod&egrave;le pour la date, plusieurs d&eacut;tenteurs de lieu peuvent &ecirc;tre utilis&eacut;s: {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME} et {DATE_SEPARATOR}.  Le format de date et le format de temps peuvent &ecirc;tre ajust&eacut;s dans le backend. Ces formats sont utilis&eacut;s pour remplir les d&eacut;tenteurs place &agrave; la base des donn&eacut;es de chaque rendez-vous. En outre, il y a un s&eacut;parateur, qui peut &ecirc;tre ins&eacut;r&eacut; entre le d&eacut;but et la date de fin. Selon le type de l'entr&eacut;e, la date est affich&eacut;e de diff&eacut;rentes mani&egrave;res. Pour entr&eacut;es du jour complet seulement les dates, mais le d&eacut;but et de fin n'est pas affich&eacut; du tout. Le module tente &eacut;galement d'optimiser la cha&icirc;ne de date. Si la date de d&eacut;but et la date de fin sont les m&ecirc;mes, la date de fin est omise. Toutefois, si vous souhaitez d&eacut;sactiver cette fonctionnalit&eacut;, vous pouvez le faire en d&eacut;cochant ce case. Une autre case vous permet de configurer, si une seconde do&icirc;t &ecirc;tre soustrait la date du  fin, si elle tombe &agave; minuit. Ainsi, la fin de l'&eacut;v&eacut;nement est toujours un pour le dernier (r&eacut;el) jour del &eacut;v&eacut;nement.  Enfin, toute la cha&icirc;ne est entour&eacut;e par un bloc de mise en forme du debut et lequel de la fin. Ceci est comment le {DATE} bloc est g&eacut;n&eacut;r&eacut;. </ p>

<P> Les autres d&eacut;tenteurs place sont plus simples. Ils se composent essentiellement d'une valeur qui vient de l'entr&eacut;e et un bloc de mise en forme de pr&eacut;fixe et un autre de suffixe. Cela se applique pour le titre de l'entr&eacut;e ({TITLE}), l'emplacement ({LOCATION}), et de la description d&eacut;taill&eacut;e ({DESCRIPTION}).
Si l'un des champs est vide, aussi le bloc de formatage pr&eacut;fixe et le suffixe sont supprim&eacut;es. Si vous voulez &eacut;viter cela, il suffit d'entrer un caract&egrave;re d'espace dans le titre, l'emplacement ou la description, respectivement.
</ P>

<P> En outre des blocs de mise en forme utilis&eacut;s dans chaque entr&eacut;e de calendrier, il y a deux autres blocs de mise en forme pour toute la section: Un pour le commencer de toute la &quot;section&quot; (Par exemple, vous pouvez ajouter un titre ici), et un pour la fin de la section. Afind d'ajouter des d&eacut;finitions de style pour l'utilisaton dans ces blocs de mise en forme, vous pouvez les ajouter &agrave; la feuille de style frontend de ce module directement sur le backend.</ P>

<P> Le module prend en charge sur les param&egrave;tres des entr&eacut;es d'agenda de la vie priv&eacut;e. Nominations marqu&eacut;s comme priv&eacut; ne sont pas affich&eacut;s du tout, alors rendez-vous confidentiels sont affich&eacut;s avec la date seulement, mais sans aucune description. Au lieu de le titre, un bloc fixe de texte qui peut &ecirc;tre configur&eacut; dans le backend, est affich&eacut; pour les entr&eacut;es confidentielles. </ P>

<P> Enfin, le module comporte une cache interne configurable, qui peut &ecirc;tre activ&eacut; avec une autre case. Il y a deux saveurs de la cache: Il y a un cache de courte dur&eacut;e, qui stocke l'ensemble des calendriers pendant quelques secondes jusqu'&agrave; minutes entre abords de la page Web. Il est aussi un cache de longue date pour webcal-calendriers. Ce dernier stocke les entr&eacut;es individuelles de la WebCal-calendrier pour plusieurs jours. Tant que l'entr&eacut;e ne est pas modifi&eacut;e dans le calendrier en ligne WebCal, l'entr&eacut;e est charg&eacut; &agrave; partir du cache. Les deux timings des caches peuvent &ecirc;tre configur&eacut;es individuellement dans le backend. A tout moment vous pouvez voir combien d'espace disque votre cache prend en g&eacut;n&eacut;ral pour toutes les instances du module de calendrier externe, et si n&eacut;cessaire, vous pouvez effacer le cache en un seul clic. </ P>

<P> Ce module utilise SabreDAV et php-curl pour acc&eacut;der WebDAV URL et SG-iCalendar pour analyser les calendriers. </ P>
";


// sorties de texte pour le backend
$LANG ['backend'] = array(
        'TXT_EXTCAL_SETTINGS'                        => "Param&egrave;tres du calendrier externe - entrent {DEFAULT} pour r&eacut;initialiser n'importe quel domaine &agrave; sa valeur par d&eacut;faut",
        'TXT_EXTCAL_SETTINGS_URLS'                 => "entrez les URL de vos calendriers pour afficher ici, une ligne par URL",
        'TXT_EXTCAL_MAX_DAYS'                         => "voir tant de jours &agrave; l'avance (0 = aucune limite)",
        'TXT_EXTCAL_MAX_ENTRIES'                => "voir que ce nombre d'entr&eacut;es au maximum (0 = aucune limite)",

        'TXT_EXTCAL_TIME_ZONE'                         => "fuseau horaire &agrave; afficher les entr&eacut;es (vide = fuseau horaire par d&eacut;faut)",
               'TXT_EXTCAL_DATEFORMAT'                        => "Le format de date (sans temps)" ,
        'TXT_EXTCAL_TIMEFORMAT'                        => "Le format de l'heure (sauf si ce est un rendez-jour complet)",
        'TXT_EXTCAL_DATE_SEPARATOR'                 => "le s&eacut;parateur utilis&eacut; entre le d&eacut;but et date de fin ou le temps",
        'TXT_EXTCAL_SECTION_START'                 => "mise en forme pour le d&eacut;but de l'ensemble de la section (par exemple titre)",
        'TXT_EXTCAL_DATE_END'                         => "mise en forme entre la date et la description (annex&eacut; &agrave; {DATE})",
        'TXT_EXTCAL_SECTION_END'                 => "mise en forme pour la fin de l'ensemble de la section ",
        'TXT_EXTCAL_CACHE_SIZE'                 => "Cache actuellement utilis&eacut; pour les entr&eacut;es de CalDAV ",
        'TXT_EXTCAL_EMPTY_CACHE'                 => "Effacer le cache",
        'TXT_EXTCAL_ENABLE_CACHE'                 => "Activer le cache ",
        'TXT_EXTCAL_REFRESH_TIME'                 => "Actualiser temps pour l'ensemble des calendriers entre quelques appels du site en quelques secondes ",
        'TXT_EXTCAL_CACHE_TIME'                 => "temps de cache pour les entr&eacut;es du calendrier qui ne sont pas modifi&eacut;s, en jours ",
        'TXT_EXTCAL_DESCRIPTION_END'            => "mise en forme a la fin de la description d&eacut;taill&eacut;e (annex&eacut; &agrave; {DESCRIPTION})",
        'TXT_EXTCAL_HELP_PAGE'                        => "Page d'aide",
        'TXT_EXTCAL_CACHE_EMPTY'                => "Cache effac&eacut;",
        'TXT_EXTCAL_ENTRY_TEMPLATE'                 => "dans le mod&egrave;le suivant, vous pouvez configurer l'apparence de chaque entr&eacut;e de calendrier endroit possible titulaires sont {DATE}, {TITLE}, {LOCATION} et {DESCRIPTION}. Au lieu de la date vous pouvez &eacut;galement utilizer {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME} et {DATE_SEPARATOR} ici. L'ouverture et bloque la fermeture d&eacut;finis ci-dessus sont ins&eacut;r&eacut;s autour de chacun de ces espaces r&eacut;serv&eacut;s &agrave; condition que cette cha&icirc;ne ne est pas vide pour l'entr&eacut;e courante. ",
        'TXT_EXTCAL_DESCRIPTION_START'                 => "mise en forme du d&eacut;but de la description (pr&eacut;fix&eacut; &agrave; {DESCRIPTION })",
        'TXT_EXTCAL_LOCATION_START'                 => "mise en forme au d&eacut;but d'un lieu (pr&eacut;fix&eacut; &agrave; {LOCATION})",
        'TXT_EXTCAL_LOCATION_END'                 => "formatage &agrave; la fin d'un lieu (annex&eacut; &agrave; {LOCATION})",
        'TXT_EXTCAL_TITLE_START'                 => "mise en forme au d&eacut;but d'un titre (pr&eacut;fix&eacut; &agrave; {TITLE})",
        'TXT_EXTCAL_TITLE_END'                         => "formatage &agrave; la fin d'un titre (annex&eacut; &agrave; {TITLE})",c
        'TXT_EXTCAL_DATE_START'                 => "mise en forme au d&eacut;but de la date (pr&eacut;fix&eacut; &agrave; {DATE})",
        'TXT_EXTCAL_CONFIDENTIAL_TEXT'                 => "texte affich&eacut; comme description pour entr&eacut;es confidentielles (y compris l'ouverture et la fermeture des balises si vous aimeriez avoir ceux autour de ce texte)",
        'TXT_EXTCAL_DATE_TEMPLATE'                 => "dans le mod&egrave;le suivant, vous pouvez affiner l'apparence de la date endroit possible titulaires sont {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME} et {DATE_SEPARATOR}. Ce dernier et ouverture et de fermeture des blocs, sont enroul&eacut;s autour de la suite de cette matrice, sont d&eacut;finis ci-dessus.",
        'TXT_EXTCAL_OPTIMIZE_DATE'                 => "essayer d'optimiser la sortie de la date (par exemple l'abandon date de fin si ce est le m&ecirc;me jour)",
        'TXT_EXTCAL_VERIFY_PEER'                => "v&eacut;rification des certificates ssl pour les connexions https (risque de s&eacut;curit&eacut; quand d&eacut;coch&eacut;e)",
        'TXT_EXTCAL_KEEP_TODAYS_EVENTS'                => "vos ev&egrave;nementes se sont &eacut;coul&eacut;s jusqu'&agrave; minuit",
        'TXT_EXTCAL_TIME_OFFSET'                => "correction de l'heure du serveur en quelques secondes",

);


$LANG['frontend']['MOD_EXTCAL_TIMEZONE']        = 'Europe/Paris';
$LANG['frontend']['MOD_EXTCAL_DATEFORMAT']        = 'd.m.Y';
$LANG['frontend']['MOD_EXTCAL_TIMEFORMAT']         = 'H:i';


?>

