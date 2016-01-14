<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @authors         Martin Hecht
 * @copyright       2004-2015, Website Baker Org. e.V.
 * @link            http://forum.websitebaker.org/index.php/topic,28493.0.html
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl 
 *
*/
 
/*
 -----------------------------------------------------------------------------------------
  DEUTSCHE SPRACHDATEI FUER DAS MODUL: External Calendar
 -----------------------------------------------------------------------------------------
*/

// include English file so that all strings have at least a default value
include("EN.php");

// Deutsche Modulbeschreibung
$module_description = "
<p>

Das Modul External Calendar erm&ouml;glicht es, externe Kalender (DavCal oder ics) in eine WebsiteBaker-Seite einzubinden. </p>

<p>Die Kalender werden mit &uuml;blichen Kalender-Programmen wie Outlook, Thunderbird Lightning o.&auml;., oder mittels Web-Oberfl&auml;che eines WebSpace-Anbieters verwaltet und mit diesem Modul einfach in die Pr&auml;senz eingebunden. Dabei geht es nicht um eine Darstellung als Online-Kalender, sondern ausdr&uuml;cklich um eine m&ouml;glichst homogene Darstellung von Terminen auf der Webseite. (Wenn Sie nach einer M&ouml;glichkeit suchen um einen externen Kalender in einer Wochen- oder Monatsansicht darzustellen, k&ouml;nnten Sie auch php-icalendar nutzen und dieses innerhalb eines iframe in die Webseite einbinden.)</p>


<p> Zur Konfiguration im Backend einfach die URL des ical-Files oder des WebDAV-Kalenders eintragen und die Termine des Kalenders erscheinen als Auflistung im Frontend. Die einfachste L&ouml;sung zur Verwaltung der ical files ist, diese einfach im Media folder abzulegen und sie &uuml;ber die entsprechende ftp-url aus Ihrer Client-Software heraus zu verwalten. Das funktioniert allerdings nur, solange ausschlie&szlig;lich ein einzelner Client eingesetzt wird und sichergestellt ist, dass keine konkurrierenden Zugriffe stattfinden. Wenn Sie mehrere Accounts brauchen und einen einfachen WebDAV server suchen, k&ouml;nnte Ba&iuml;kal etwas f&uuml;r Sie sein.</p>

<p> Im Backend lassen sich viele Details zur Darstellung einstellen. Die zentrale Einstellung ist das Feld, in dem die URLs der Kalender eingegeben werden. Wird f&uuml;r den Zugriff ein Nutzername und Passwort ben&ouml;tigt, muss man diese in der URL mit angeben: [Protokoll]://[User]:[Passwort]@[Domain]/[Pfad]. <br/>
Beachten Sie, dass nur Lesezugriff erforderlich ist. Wenn Sie keine M&ouml;glichkeit haben, den Kalender schreibgesch&uuml;tzt bereitzustellen, k&ouml;nnen Sie Ihr Passwort dadurch besser sch&uuml;tzen, dass Sie auch im Backend den Zugriff auf die Seite Einschr&auml;nken. 
Eine https-Verbindung ist empfehlenswert. In den erweiterten Optionen kann die pr&uuml;fung des Server-Zertifikats abgeschaltet werden, wenn dieses nicht von einer vertrauensw&uuml;rdigen Zertifizierungsstelle ausgestellt ist (allerdings bedeutet der Verzicht auf die Sicherheitspr&uuml;fung ein Sicherheitsrisiko).
</p>

<p>Endet der Pfad auf &quot;/&quot; wird die URL als CalDAV interpretiert - wenn nicht, wird die URL als ical-File interpretiert. Zeilen, die mit '&#35;' beginnen, gelten als auskommentiert.</p>

<p>Die dargestellten Termine k&ouml;nnen begrenzt werden, wie viele Tage sie in der Zukunft liegen d&uuml;rfen. Auch die Anzahl der Termine kann begrenzt werden. Wird f&uuml;r einen der beiden Werte Null eingetragen, so bedeutet das &quot;unbegrenzt&quot;.</p>

<p>Die Zeitzone, mit der die Zeiten in den Kalendern interpretiert werden sollen, kann ebenfalls im Backend eingestellt werden. Dies ist insbesondere f&uuml;r die korrekte Darstellung von Terminen &uuml;ber die Umstellung zwischen Sommer- und Winterzeit hinweg. 
W&auml;hlen Sie hierzu die Einstellung f&uuml;r Ihr Land und nicht &quot;UTC+X Stunden&quot;, da diese Einstellung keine Sommer- und Winterzeitumstellung kennt. Sie k&ouml;nnen das Feld auch leer lassen, dann versucht das Modul die Zeitzone anhand der globalen Spracheinstellung in WebsiteBaker zu ermitteln (das sollte derzeit f&uuml;r Deutschland, England, Frankreich und Italien funktionieren). Um ein beliebiges Feld auf die Default-Einstellungen zur&uuml;ckzusetzen, k&ouml;nnen Sie einfach &quot;{DEFAULT}&quot; eingeben und die Enistellungen speichern.</p>

<p>Die gesamte Formatierung der einzelnen Termine wird&uuml;ber Templates und Formatierungsbausteine gesteuert. 
Beachten Sie: Manche dieser Formatierungen sind in der Gruppe erweiterte Optionen verborgen.
Es gibt ein Template f&uuml;r den gesamten Eintrag und ein spezielles Template f&uuml;r das Datum.
Im Datums-Template k&ouml;nnen die folgenden Platzhalter verwendet werden: {START_DATE} {END_DATE} {START_TIME} {END_TIME} and {DATE_SEPARATOR}. 
Das Datumsformat und das Zeiformat kann im Backend eingestellt werden. Diese Formatierungen werden angewendet, um die Platzhalter mit den konkreten Daten des jeweiligen Eintrags auszuf&uuml;llen. 
Dar&uuml;ber hinaus gibt es einen Trenner, den Sie zwischen Start- und Enddatum des Termins einf&uuml;gen k&ouml;nnen. Abh&auml;ngig von der Art des Termins wird das Datum auch auf verschiedene Weise angezeigt. Bei ganzt&auml;gigen Terminen wird die Anzeige der Uhrzeit f&uuml;r Start und Ende unterdr&uuml;ckt.
Das Modul versucht au&szlig;erdem den Datumsstring zu optimieren. Wenn Start- und Enddatum am gleichen Tag sind, wird das Enddatum gar nicht erst angezeigt. Diese Funktionalit&auml;t kann jedoch abgeschaltet werden, indem Sie die entsprechende Checkbox deselektieren. Mit einer weiteren Checkbox k&ouml;nnen Sie festlegen, ob vom Enddatum eines Termins eine Sekunde abgezogen werden soll, falls dieses auf Mitternacht f&auml;llt. Dadurch z&auml;hlt das Ende des Termins noch zum letzten (echten) Veranstaltungstag. Zum Schluss wird der gesamte String durch die Formatierungsbausteine f&uuml;r den Start und das Ende des Datums eingeschlossen. Auf diese Weise entsteht der Inhalt f&uuml;r den {DATE} Platzhalter.</p>

<p> Die weiteren Platzhalter sind einfacher. Sie bestehen im wesentlichen aus einem Wert, der aus dem jeweiligen Kalendereintrag stammt und einem Formatierungs-Baustein als Pr&auml;fix und einem als Suffix.
Das gilt f&uuml;r den Titel des Kalendereintrags  ({TITLE}), den Ort ({LOCATION}) und die detaillierte Beschreibung  ({DESCRIPTION}).
Wenn eines der Felder leer ist, werden auch die Pr&auml;fix- und Suffix-Formatierungs-Bausteine unterdr&uuml;ckt. Wenn Sie dieses Verhalten vermeiden wollen, geben Sie einfach ein Leerzeichen als Titel, Ort bzw. Beschreibung ein.
</p>

<p> Au&szlig;er den Formatierungsbausteinen, die in jedem Kalendereintrag verwendet werden, gibt es noch zwei weitere f&uuml;r die gesamte Section: Einen f&uuml;r den Anfang (der z.B. auch eine &Uuml;berschrift enthalten kann) und einen f&uuml;r das Ende.
Style Definitionen zur Verwendung in den Formatierungsbausteinen k&ouml;nnen Sie aus dem Backend heraus im Frontend Style file dieses Moduls definieren.
</p>

<p>Das Modul ber&uuml;cksichtigt die Privatsph&auml;reneinstellungen der Kalendereintr&auml;ge. Private Eintr&auml;ge werden nicht angezeigt, w&auml;hrend als vertraulich markierte Eintr&auml;ge nur mit Datum und ohne Beschreibung angezeigt werden. Anstelle des Titels wird ein fest vorgegebener Textbaustein angezeigt, der im Backend konfiguriert werden kann. </p>


<p>Schlie&szlig;lich enth&auml;lt das Modul auch einen konfigurierbaren internen Cache, der &uuml;ber eine weitere Checkbox aktiviert werden kann. Dabei gibt es zwei verschiedene Cache-Varianten:
Einen kurzzeit-Cache, der gesamte Kalender f&uuml;r einige Sekunden bis Minuten zwischen einzelnen Seitenaufrufen zwischenspeichert und einen Langzeit-Cache f&uuml;r WebCal-Kalender. Bei diesen werden die einzelnen Termine f&uuml;r mehrere Tage zwischengespeichert. Sofern der Termin im WebCal-Kalender in der Zwischenzeit nicht bearbeitet wurde, wird der Inhalt des Kalendereintrags aus dem Cache gelesen. Beide Zeiten k&ouml;nnen unabh&auml;ngig voneinander im Backend konfiguriert werden. Wie viel Platz der Cache f&uuml;r alle Instanzen des External Calendar-Moduls insgesamt im Moment einnimmt, kann man im Backend sehen und bei Bedarf den Cache per Knopfdruck leeren.</p>

<p>Dieses Modul verwendet SabreDAV und php-curl f&uuml;r den Zugriff auf WebDAV-URLs und SG-ICalendar um die Kalender zu parsen.</p> 
";


// Text outputs for the backend
$LANG['backend'] = array(
        'TXT_EXTCAL_SETTINGS'                         => "Einstellungen f&uuml;r die externen Kalender - geben Sie {DEFAULT} ein, um ein beliebiges Feld auf seinen Standardwert zur&uuml;ckzusetzen",
        'TXT_EXTCAL_SETTINGS_URLS'                 => "URLs der externen Kalender hier eintragen,  jede URL auf einer separaten Zeile",
        'TXT_EXTCAL_MAX_DAYS'                         => "zeige so viele Tage im Voraus (0 = keine Beschr&auml;nkung)",
        'TXT_EXTCAL_MAX_ENTRIES'                 => "zeige maximal so viele Eintr&auml;ge (0 = keine Beschr&auml;nkung)",
        'TXT_EXTCAL_TIME_ZONE'                        => "Zeitzone zur Anzeige der Kalendereintr&auml;ge (leer = default-Zeitzone)",
        'TXT_EXTCAL_DATEFORMAT'                        => "das Datumsformat (ohne Uhrzeit)",
        'TXT_EXTCAL_TIMEFORMAT'                 => "das Zeitformat  (sofern es sich nicht um einen ganzt&auml;gigen Termin handelt)",
        'TXT_EXTCAL_DATE_SEPARATOR'                => "Trenner zwischen Anfangs- und Enddatum",
        'TXT_EXTCAL_SECTION_START'                => "Formatierung am Anfang der gesamten Section (z.B. auch eine &Uuml;berschrift)",
        'TXT_EXTCAL_DATE_END'                         => "Formatierung am Ende des Datums (wird an {DATE} angeh&auml;ngt)",
        'TXT_EXTCAL_SECTION_END'                => "Formatierung am Ende der gesamten Section",
        'TXT_EXTCAL_CACHE_SIZE'                        => "aktuell f&uuml;r CalDAV Eintr&auml;ge verwendeter Cache",
        'TXT_EXTCAL_EMPTY_CACHE'                => "Cache leeren",
        'TXT_EXTCAL_ENABLE_CACHE'                => "Cache aktivieren",
        'TXT_EXTCAL_REFRESH_TIME'                      => "Aktualisierungs-Cache-Zeit zwischen zwei Seitenaufrufen in Sekunden",
        'TXT_EXTCAL_CACHE_TIME'                        => "Cache-Zeit f&uuml;r Langzeit-Speicherung der Kalendereintr&auml;ge in Tagen",
        'TXT_EXTCAL_DESCRIPTION_END'             => "Formatierung um die ausf&uuml;hrliche Beschreibung abzuschlie&szlig;en (wird an {DESCRIPTION} angeh&auml;ngt)",
        'TXT_EXTCAL_HELP_PAGE'                        => "Hilfe-Seite",
        'TXT_EXTCAL_CACHE_EMPTY'                => "Cache geleert",                
        'TXT_EXTCAL_ENTRY_TEMPLATE'                => "im folgenden Template k&ouml;nnen Sie das Erscheinungsbild  eines Kalendereintrags festlegen. M&ouml;gliche Platzhalter sind {DATE} {TITLE} {LOCATION} und {DESCRIPTION}. Anstelle des Datums k&ouml;nnen Sie hier auch  {START_DATE} {END_DATE} {START_TIME} {END_TIME} und {DATE_SEPARATOR} verwenden. 
        Die oben definierten Formatierungsbausteine zum Einleiten und Abschlie&szlig;en der jeweiligen Platzhalter werden um diese herum eingef&uuml;gt falls der jeweilige String im aktuellen Kalendereintrag nicht leer ist.",
        'TXT_EXTCAL_DESCRIPTION_START'             => "Formatierung um die ausf&uuml;hrliche Beschreibung einzuleiten (wird {DESCRIPTION} vorangestellt)",
        'TXT_EXTCAL_LOCATION_START'                => "Formatierung um den Ort einzuleiten (wird {LOCATION} vorangestellt)",
        'TXT_EXTCAL_LOCATION_END'                => "Formatierung um den Ort abzuschlie&szlig;en (wird an  {LOCATION} angeh&auml;ngt)",
        'TXT_EXTCAL_TITLE_START'                => "Formatierung um den Titel einzuleiten (wird  {TITLE} vorangestellt)",
        'TXT_EXTCAL_TITLE_END'                        => "Formatierung um den Titel abzuschlie&szlig;en (wird an  {TITLE} angeh&auml;ngt)",
        'TXT_EXTCAL_DATE_START'                        => "Formatierung um das Datum einzuleiten (wird  {DATE} vorangestellt)",
        'TXT_EXTCAL_CONFIDENTIAL_TEXT'                 => "Text der anstelle des Titels bei vertraulichen Terminen angezeigt wird (inclusive den einleitenden und abschlie&szlig;enden Tags falls Sie diesen Text davon eingeschlossen haben m&ouml;chten)",
        'TXT_EXTCAL_DATE_TEMPLATE'                 => "Mit dem folgenden Template k&ouml;nnen Sie das Erscheinungsbild des Datums fein-justieren. M&ouml;gliche Platzhalter sind {START_DATE} {END_DATE} {START_TIME} {END_TIME} und {DATE_SEPARATOR}. Letzteres und der einleitende und der abschlie&szlig;ende Formatierungsblock, die das Ergebnis nach Anwendung dieses Templates einschlie&szlig;en, werden weiter oben definiert.",
        'TXT_EXTCAL_OPTIMIZE_DATE'                => "versuche die Ausgabe des Datums zu optimieren (z.B. das Enddatum weglassen, wenn es am gleichen Tag wie der Anfang des Termins ist)",
        'TXT_EXTCAL_MIDNIGHT_FIX'                => "quetsche Termine, die um Mitternacht enden noch in den Vortag",
        'TXT_EXTCAL_VERIFY_PEER'                => "&Uuml;berpr&uuml;fe ssl-Zertifikate f&uuml;r https-Verbindungen (Sicherheitsrisiko wenn deaktiviert)",
        
);



$LANG['frontend']['MOD_EXTCAL_TIMEZONE']        = 'Europe/Berlin';
$LANG['frontend']['MOD_EXTCAL_DATEFORMAT']        = 'd.m.Y';
$LANG['frontend']['MOD_EXTCAL_TIMEFORMAT']         = 'H:i';


?>
