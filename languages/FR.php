<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.2.6
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
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
Le module External Calendar vous permet a impliquer calendriers externe (ics ou DAVCal)
dans une page WebsiteBaker.
</p>

<h3>Param&egrave;tres g&eacute;n&eacute;raux</h3>

<P> Les calendriers sont maintenu moyens des programmes comme Outlook, Thunderbird
Lightning et similaire, ou au moyen d'une interface web d'un WebSpace fournisseur.

Le calendrier est inclus avec ce module dans la page web. Ce module n'est pas &eacute;crit
pur montrer un calendrier entier, mais explicitement pour repr&eacute;senter les dates le
plus homog&egrave;nement possible dans la page web. (Si vous &ecirc;tes &agrave; la
recherche d'un outil pour afficher un calendrier externe dans une vue de semaine mois ou
vous pouvez utiliser php-iCalendar et l'inclure dans une page avec une iframe.) </P>

<P> Pour la configuration du module, entrez simplement l'URL des fichiers iCal ou du
WebDAV-calendrier et les rendez-vous du calendrier apparaissent comme une liste au
frontend.
La solution la plus simple est de mettre vos fichiers iCal juste dans le dossier des
m&eacute;dias ou dans le r&eacute;pertoire des calendriers de ce module et de les
g&eacute;rer en utilisant le ftp-url dans votre client. Cependant, cela ne fonctionne que
pour un seul client se il est assur&eacute; qu'aucun acc&egrave;s simultan&eacute; peut
arriver. Si vous avez besoin de plusieurs comptes et vous cherchez un serveur WebDAV,
vous voudrez peut-&ecirc;tre essayer Owncloud. </P>

<P> Dans le backend vous pouvez configurer beaucoup de d&eacute;tails sur l'apparence du
module. La situation centrale est la zone de texte o&ugrave; vous entrez les URL de vos
calendriers. Si un nom d'utilisateur et mot de passe est n&eacute;cessaire pour
acc&eacute;der &agrave; votre calentrier, vous devez inclure ces informations
d'identification dans l'URL suivant le sch&eacute;ma [protocole]: // [utilisateur]: [mot
de passe] @ [domaine] / [chemin]. <br/>

Gardez &agrave; l'esprit que seul un acc&egrave;s en lecture est n&eacute;ccessaire. Si
vous n'avez aucune possibilit&eacute; de partager le calendrier en lecture seule, vous
pouvez prot&eacute;ger votre mot de passe en restreindre l'acc&egrave;s &agrave; la page
dans le backend.

Utilisation d'une connexion https est recommand&eacute;. Dans les options avanc&eacute;es,
vous pouvez d&eacute;sactiver la v&eacute;rification du certificat du serveur au cas
o&ugrave; il n'a pas &eacute;t&eacute; sign&eacute; par une autorit&eacute; de confiance
(d'autre part sur un renoncement &agrave; la v&eacute;rification implique un risque de
s&eacute;curit&eacute;).</P>

<P> Si le chemin se termine sur &quot;/&quot; l'URL est interpr&eacute;t&eacute;e comme
CalDAV - sinon, il est suppos&eacute; que l'URL pointe vers un fichier iCal. Les lignes
commen&ccedil;ant par '&#35;' sont consid&eacute;r&eacute;es &ecirc;tre comment&eacute;.
</P>

<P>Les entr&eacute;es de calendrier peuvent &ecirc;tre limit&eacute;es dans le sens de
combien de jours &agrave; l'avenir doivent &ecirc;tre affich&eacute;s. En outre, vous
pouvez configurer une limite pour le nombre de rendez-vous pour montrer. Si vous entrez
un z&eacute;ro pour une de ces limites, cela signifie &quot; illimit&eacute;e &quot;. Dans
les options avanc&eacute;es, vous pouvez sp&eacute;cifier si les dates &eacute;coul&eacute;es
seront pr&eacute;sent&eacute;s jusqu'&agrave; minuit avant qu'ils ne disparaissent.

Vous pouvez &eacute;galement r&eacute;gler un d&eacute;calage en secondes, qui est
appliqu&eacute;e &agrave; l'heure actuelle du serveur avant de le comparer &agrave;
une entr&eacute;e de calendrier.</P>

<h3>Format de date et heure</h3>

<P> Le fuseau horaire sur la base duquel les dates dans les calandres sont
interpr&eacute;t&eacute;s, peut &ecirc;tre configur&eacute; dans le backend, aussi. Ceci est
particuli&egrave;rement important pour une manipulation correcte des rendez-vous entre la
lumi&egrave;re du jour-&eacute;pargne. Choisissez le fuseau horaire correspondant &agrave;
votre pays. Ne pas utiliser quelque chose comme &quot; UTC + X heures &quot ;, de car ce
param&egrave;tre ne serait pas au courant de l'heure d'&eacute;t&eacute;.

Vous pouvez &eacute;galement laisser le champ vide, alors le module tente de
d&eacute;terminer le fuseau horaire dans les param&egrave;tres globaux linguistiques de
WebsiteBaker (cela devrait fonctionner pour l'Allemagne, l'Angleterre, la France et
l'Italie, actuellement). Pour r&eacute;initialiser l'un des champs, il suffit d'entrer
&quot; {DEFAULT} &quot; et enregistrer les r&eacute;glages. </P>

<h3>Formatage de la sortie</h3>

<P> Tout le formatage des nominations est contr&ocirc;l&eacute;e par des mod&egrave;les
et des blocs de mise en forme.
Notez que certains param&egrave;tres sont cach&eacute;s a la groupe des options
avanc&eacute;es.

Il y a un mod&egrave;le pour l'ensemble d'entr&eacute;e et un autre sp&eacute;cialement
pour la date. Dans le mod&egrave;le pour la date, plusieurs d&eacute;tenteurs de lieu
peuvent &ecirc;tre utilis&eacute;s: {START_DATE}, {END_DATE}, {START_TIME}, {END_TIME} et
{DATE_SEPARATOR}.  Le format de date et le format de temps peuvent &ecirc;tre
ajust&eacute;s dans le backend. Ces formats sont utilis&eacute;s pour remplir les
d&eacute;tenteurs place &agrave; la base des donn&eacute;es de chaque rendez-vous. En
outre, il y a un s&eacute;parateur, qui peut &ecirc;tre ins&eacute;r&eacute; entre le
d&eacute;but et la date de fin. Selon le type de l'entr&eacute;e, la date est
affich&eacute;e de diff&eacute;rentes mani&egrave;res. Pour entr&eacute;es du jour complet
seulement les dates, mais le d&eacute;but et de fin n'est pas affich&eacute; du tout. Le
module tente &eacute;galement d'optimiser la cha&icirc;ne de date. Si la date de
d&eacute;but et la date de fin sont les m&ecirc;mes, la date de fin est omise. Toutefois,
si vous souhaitez d&eacute;sactiver cette fonctionnalit&eacute;, vous pouvez le faire en
d&eacute;cochant ce case. Une autre case vous permet de configurer, si une seconde
do&icirc;t &ecirc;tre soustrait la date du  fin, si elle tombe &agave; minuit. Ainsi, la
fin de l'&eacute;v&eacute;nement est toujours un pour le dernier (r&eacute;el) jour del
&eacute;v&eacute;nement.  Enfin, toute la cha&icirc;ne est entour&eacute;e par un bloc de
mise en forme du debut et lequel de la fin. Ceci est comment le {DATE} bloc est
g&eacute;n&eacute;r&eacute;. </P>

<P> Les autres d&eacute;tenteurs place sont plus simples. Ils se composent essentiellement
d'une valeur qui vient de l'entr&eacute;e et un bloc de mise en forme de pr&eacute;fixe et
un autre de suffixe. Cela se applique pour le titre de l'entr&eacute;e ({TITLE}),
l'emplacement ({LOCATION}), la description d&eacute;taill&eacute;e ({DESCRIPTION}),
et cat&eacute;gories ({CATEGORIES}). On peut autant utiliser le nom du calendrier({CALENDAR}).

Si l'un des champs est vide, aussi le bloc de formatage pr&eacute;fixe et le suffixe sont
supprim&eacute;es. Si vous voulez &eacute;viter cela, il suffit d'entrer un
caract&egrave;re d'espace dans le titre, l'emplacement ou la description, respectivement.
</P>

<P> En outre des blocs de mise en forme utilis&eacute;s dans chaque entr&eacute;e de
calendrier, il y a deux autres blocs de mise en forme pour toute la section: Un pour le
commencer de toute la &quot;section&quot; (Par exemple, vous pouvez ajouter un titre
ici), et un pour la fin de la section. Afind d'ajouter des d&eacute;finitions de style
pour l'utilisaton dans ces blocs de mise en forme, vous pouvez les ajouter &agrave; la
feuille de style frontend de ce module directement sur le backend.</P>

<h3>Param&egrave;tres divers</h3>

<P> Le module prend en charge sur les param&egrave;tres des entr&eacute;es d'agenda de la
vie priv&eacute;e. Nominations marqu&eacute;s comme priv&eacute; ne sont pas affich&eacute;s
du tout, alors rendez-vous confidentiels sont affich&eacute;s avec la date seulement, mais
sans aucune description. Au lieu de le titre, un bloc fixe de texte qui peut &ecirc;tre
configur&eacute; dans le backend, est affich&eacute; pour les entr&eacute;es
confidentielles. </P>

<h3>Param&egrave;tres du cache</h3>

<P> Enfin, le module comporte une cache interne configurable, qui peut &ecirc;tre
activ&eacute; avec une autre case. Il y a deux saveurs de la cache: Il y a un cache de
courte dur&eacute;e, qui stocke l'ensemble des calendriers pendant quelques secondes
jusqu'&agrave; minutes entre abords de la page Web. Il est aussi un cache de longue date
pour webcal-calendriers. Ce dernier stocke les entr&eacute;es individuelles de la
WebCal-calendrier pour plusieurs jours. Tant que l'entr&eacute;e ne est pas modifi&eacute;e
dans le calendrier en ligne WebCal, l'entr&eacute;e est charg&eacute; &agrave; partir du

cache. Les deux timings des caches peuvent &ecirc;tre configur&eacute;es individuellement
dans le backend. A tout moment vous pouvez voir combien d'espace disque votre cache prend
en g&eacute;n&eacute;ral pour toutes les instances du module de calendrier externe, et si
n&eacute;cessaire, vous pouvez effacer le cache en un seul clic. </P>

<P> Ce module utilise SabreDAV et php-curl pour acc&eacute;der WebDAV URL et SG-iCalendar
pour analyser les calendriers. </P>
";


// sorties de texte pour le backend
$LANG ['backend'] = array(
    'TXT_EXTCAL_SETTINGS'           => "Param&egrave;tres du calendrier externe -"
                                     . " entrent {DEFAULT} pour r&eacute;initialiser"
                                     . " n'importe quel domaine &agrave; sa valeur"
                                     . " par d&eacute;faut",
    'TXT_EXTCAL_SETTINGS_URLS'      => "entrez les URL de vos calendriers pour afficher"
                                     . " ici, une ligne par URL",
    'TXT_EXTCAL_MAX_DAYS'           => "voir tant de jours &agrave; l'avance"
                                     . " (0 = aucune limite)",
    'TXT_EXTCAL_MAX_ENTRIES'        => "voir que ce nombre d'entr&eacute;es au maximum"
                                     . " (0 = aucune limite)",

    'TXT_EXTCAL_TIME_ZONE'          => "fuseau horaire &agrave; afficher les"
                                     . " entr&eacute;es"
                                     . " (vide = fuseau horaire par d&eacute;faut)",
    'TXT_EXTCAL_DATEFORMAT'         => "Le format de date (sans temps)" ,
    'TXT_EXTCAL_TIMEFORMAT'         => "Le format de l'heure"
                                     . " (sauf si ce est un rendez-jour complet)",
    'TXT_EXTCAL_DATE_SEPARATOR'     => "le s&eacute;parateur utilis&eacute; entre le"
                                     . " d&eacute;but et date de fin ou le temps",
    'TXT_EXTCAL_SECTION_START'      => "mise en forme pour le d&eacute;but de l'ensemble"
                                     . " de la section (par exemple titre)",
    'TXT_EXTCAL_DATE_END'           => "mise en forme entre la date et la description"
                                     . " (annex&eacute; &agrave; {DATE})",
    'TXT_EXTCAL_SECTION_END'        => "mise en forme pour la fin de l'ensemble de"
                                     . " la section ",
    'TXT_EXTCAL_CACHE_SIZE'         => "Cache actuellement utilis&eacute; pour les"
                                     . " entr&eacute;es de CalDAV ",
    'TXT_EXTCAL_EMPTY_CACHE'        => "Effacer le cache",
    'TXT_EXTCAL_ENABLE_CACHE'       => "Activer le cache ",
    'TXT_EXTCAL_REFRESH_TIME'       => "Actualiser temps pour l'ensemble des calendriers"
                                     . " entre quelques appels du site en quelques"
                                     . " secondes ",
    'TXT_EXTCAL_CACHE_TIME'         => "temps de cache pour les entr&eacute;es du"
                                     . " calendrier qui ne sont pas modifi&eacute;s,"
                                     . " en jours ",
    'TXT_EXTCAL_DESCRIPTION_END'    => "mise en forme a la fin de la description"
                                     . " d&eacute;taill&eacute;e (annex&eacute; &agrave;"
                                     . " {DESCRIPTION})",
    'TXT_EXTCAL_HELP_PAGE'          => "Page d'aide",
    'TXT_EXTCAL_CACHE_EMPTY'        => "Cache effac&eacute;",
    'TXT_EXTCAL_ENTRY_TEMPLATE'     => "dans le mod&egrave;le suivant, vous pouvez"
                                     . " configurer l'apparence de chaque entr&eacute;e"
                                     . " de calendrier endroit possible titulaires sont"
                                     . " {DATE}, {TITLE}, {LOCATION}, {DESCRIPTION},"
                                     . " {CATEGORIES} et {CALENDAR}."
                                     . " Au lieu de la date vous pouvez &eacute;galement"
                                     . " utilizer {START_DATE}, {END_DATE},"
                                     . " {START_TIME}, {END_TIME} et {DATE_SEPARATOR}"
                                     . " ici. L'ouverture et bloque la fermeture"
                                     . " d&eacute;finis ci-dessus sont"
                                     . " ins&eacute;r&eacute;s autour de chacun de ces"
                                     . " espaces r&eacute;serv&eacute;s &agrave; condition"
                                     . " que cette cha&icirc;ne ne est pas vide pour"
                                     . " l'entr&eacute;e courante. ",
    'TXT_EXTCAL_DESCRIPTION_START'  => "mise en forme du d&eacute;but de la description"
                                     . " (pr&eacute;fix&eacute; &agrave; {DESCRIPTION })",
    'TXT_EXTCAL_LOCATION_START'     => "mise en forme au d&eacute;but d'un lieu"
                                     . " (pr&eacute;fix&eacute; &agrave; {LOCATION})",
    'TXT_EXTCAL_LOCATION_END'       => "formatage &agrave; la fin d'un lieu"
                                     . " (annex&eacute; &agrave; {LOCATION})",
    'TXT_EXTCAL_TITLE_START'        => "mise en forme au d&eacute;but d'un titre"
                                     . " (pr&eacute;fix&eacute; &agrave; {TITLE})",
    'TXT_EXTCAL_TITLE_END'          => "formatage &agrave; la fin d'un titre"
                                     . " (annex&eacute; &agrave; {TITLE})",
    'TXT_EXTCAL_DATE_START'         => "mise en forme au d&eacute;but de la date"
                                     . " (pr&eacute;fix&eacute; &agrave; {DATE})",
    'TXT_EXTCAL_CONFIDENTIAL_TEXT'  => "texte affich&eacute; comme description pour"
                                     . " entr&eacute;es confidentielles (y compris"
                                     . " l'ouverture et la fermeture des balises si vous"
                                     . " aimeriez avoir ceux autour de ce texte)",
    'TXT_EXTCAL_DATE_TEMPLATE'      => "dans le mod&egrave;le suivant, vous pouvez"
                                     . " affiner l'apparence de la date endroit possible"
                                     . " titulaires sont {START_DATE}, {END_DATE},"
                                     . " {START_TIME}, {END_TIME} et {DATE_SEPARATOR}."
                                     . " Ce dernier et ouverture et de fermeture des"
                                     . " blocs, sont enroul&eacute;s autour de la suite"
                                     . " de cette matrice, sont d&eacute;finis"
                                     . " ci-dessus.",
    'TXT_EXTCAL_MIDNIGHT_FIX'       => "&eacute;craser rendez-vous  se terminant &agrave;"
                                     . "minuit dans la jour pr&eacute;c&eacute;dente",
    'TXT_EXTCAL_OPTIMIZE_DATE'      => "essayer d'optimiser la sortie de la date"
                                     . " (par exemple l'abandon date de fin si ce est"
                                     . " le m&ecirc;me jour)",
    'TXT_EXTCAL_VERIFY_PEER'        => "v&eacute;rification des certificates ssl pour"
                                     . " les connexions https (risque de"
                                     . " s&eacute;curit&eacute; quand"
                                     . " d&eacute;coch&eacute;e)",
    'TXT_EXTCAL_KEEP_TODAYS_EVENTS' => "vos ev&egrave;nementes se sont"
                                     . " &eacute;coul&eacute;s jusqu'&agrave; minuit",
    'TXT_EXTCAL_TIME_OFFSET'        => "correction de l'heure du serveur en quelques"
                                     . " secondes",
    'TXT_EXTCAL_CALENDAR_START'     => "mise en forme au d&eacute;but d'un nom d'un calendrier"
                                     . " (pr&eacute;fix&eacute; &agrave; {CALENDAR})",
    'TXT_EXTCAL_CALENDAR_END'       => "formatage &agrave; la fin d'un nome d'un calendrier"
                                     . " (annex&eacute; &agrave; {CALENDAR})",
    'TXT_EXTCAL_GENERAL_SETTINGS'   => "Param&egrave;tres g&eacute;n&eacute;raux",
    'TXT_EXTCAL_DATE_FORMAT_SETTINGS' => "Format de date et heure",
    'TXT_EXTCAL_FORMAT_SETTINGS'    => "Formatage de la sortie",
    'TXT_EXTCAL_DIVERSE_SETTINGS'   => "Param&egrave;tres divers",
    'TXT_EXTCAL_CACHE_SETTINGS'     => "Param&egrave;tres du cache"


);


$LANG['frontend']['MOD_EXTCAL_TIMEZONE']    = 'Europe/Paris';
$LANG['frontend']['MOD_EXTCAL_DATEFORMAT']  = 'd.m.Y';
$LANG['frontend']['MOD_EXTCAL_TIMEFORMAT']  = 'H:i';


$LANG['categories'] = array(
    'anniversary' => 'Anniversaires',
    'birthday' => 'Anniversaire',
    'business' => 'Entreprise',
    'calls' => 'Appels',
    'clients' => 'Clients',
    'competition' => 'Comp&acute;tition',
    'customer' => 'Client',
    'favorites' => 'Favoris',
    'follow up' => 'Suivre',
    'gifts' => 'Cadeaux',
    'holidays' => 'Vacance',
    'ideas' => 'Id&eacute;&eacute;s',
    'issues' => 'Probl&egrave;mes',
    'miscellaneous' => 'Divers',
    'personal' => 'Personnel',
    'projects' => 'Projets',
    'public holiday' => 'Jour f&eacute;ri&eacute;',
    'status' => 'Statut',
    'suppliers' => 'Fournisseurs',
    'travel' => 'Voyages',
    'vacation' => 'Vacances'
);
