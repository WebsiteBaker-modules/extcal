<?php
/**
 *
 * @category        page
 * @package         External Calendar
 * @version         1.2.2
 * @authors         Martin Hecht
 * @copyright       (c) 2015 - 2018, Martin Hecht (mrbaseman)
 * @link            https://github.com/WebsiteBaker-modules/extcal
 * @link            https://forum.wbce.org/viewtopic.php?id=18536
 * @link            https://forum.websitebaker.org/index.php/topic,30975.0.html
 * @license         GNU General Public License
 * @platform        WebsiteBaker 2.8.x
 * @requirements    PHP 5.3 and higher and Curl
 *
 **/

/*
 -----------------------------------------------------------------------------------------
  FILE LINGUA ITALIANO PER IL MODULO: __module__
 -----------------------------------------------------------------------------------------
*/

// includere file inglese in modo che tutte le strnghe hanno almeno un valore predefinito
include("EN.php");

//  descrizione italiano del modulo
$module_description = "
<P>
Il External Calendar modulo permette di includere calendari esterni (DavCAL o ics)
in una pagina WebsiteBaker
</P>

<P> Il calendario viene gestito usando normali programmi di calendario come Outlook,
Thunderbird Lightning e simili, o per mezzo di un interfaccia web di uno spazio
web-provider.Il calendario &egrave; incluso in questo modulo nella pagina web. Il
focus non &egrave; sulla visualizzazione di un online-calendario, ma in modo esplicito
sulla visualizzazione degli appuntamenti pi&ugrave; omogeneo possibile all'interno della
pagina web. (Se siete alla ricerca di uno strumento per visualizzare un calendario
esterno in vista mensile o settimana si potrebbe usare php-iCalendar e comprendono
che uno in una pagina iframe.) </P>

<P> Per la configurazione del modulo, &egrave; sufficiente inserire l'URL del file
iCal o WebDAV-calendario e gli appuntamenti del calendario appaiono  al frontend.
La soluzione pi&ugrave; semplice &egrave; quello di mettere i file iCal solo nella
cartella multimediale o nella directory calendari di questo modulo e di gestirli
tramite ftp-url del vostro software cliente. Tuttavia, questo funziona solo per
un singolo cliente qualora sia garantito che nessun accesso simultaneo pu&ograve;
accadere. Se avete bisogno di pi&ugrave; account e siete alla ricerca di un
server WebDAV si potrebbe desiderare di provare Owncloud. </P>

<P> Nel backend del modulo &egrave; possibile configurare un sacco di dettagli circa
l'aspetto del modulo. La posizione centrale &egrave; la casella di testo dove inserire
gli URL dei vostri calendari. Se
 &egrave; necessario un nome utente e password per accedere al calendario, &egrave;
necessario includere queste credenziali nell'URL seguito del regime
[protocollo]: // [utente]: [password] @ [dominio] / [percorso]. <br/>
Tenete a mente che &egrave; necessario solo l'accesso in lettura. Se no avete la
possibilit&agrave; di condividere il calendario di sola lettura, si potrebbe voleer
proteggere la password limitando l'accesso alla pagina nel backend.
L'utilizo di un https connessione &egrave; raccomandato. Nelle opzioni avanzate &egrave;
possibile dissattivare la verifica del certificato del server nel caso in cui quello non
&egrave; firmato da un'autorit&agrave; fiduciana (d'altra parte rinunciare a una
verificazione comporta un rischio per la sicurezza).</P>

<P> Se il percorso termina sul &quot; / &quot; l'URL viene interpretato come CalDAV -
altrimenti si presume che l'URL punta a un file iCal. Le linee che iniziano con '&#35;'
sono considerati essere commentata.</P>

<P> Gli appuntamenti del calendario possono essere limitati nel senso di quanti giorni in
futuro devono essere visualizzati. Inoltre, &egrave; possibile configurare un limite per
il numero di appuntamenti per mostrare. Se si inserisce uno zero per uno di questi
limiti, questo significa &quot; illimitata &quot;. Nelle opzioni avanzate &egrave;
possibile specificare se le date trascorsi devono essere indicate fino a mezzanotte prima
di scomparire. &Egrave; inoltre possibile regolare un offset in secondi, che si applica
per l'ora del server corrente prima di copararlo contro gli appuntamenti.</P>

<P> Il fuso orario in base al quale vengono interpretate le date nei
calendari, pu&ograve; essere configurato nel backend, anche. Ci&ograve; &egrave;
particolarmente importante per una corretta gestione di appuntamenti in tutta ora legale.
Scegliere il fuso orario corretto per il vostro paese. Non usare qualcosa come
&quot;UTC + X ore&quot;, perch&eacute; questa impostazione non sarebbe a conoscenza
di eventuali legale.

 &Egrave; anche possibile lasciare vuoto il campo, poi il modulo tenta di determinare il
fuso orario dalle impostazioni globali linguistiche di WebsiteBaker (questo dovrebbe
funzionare per la Germania, l'Inghilterra, la Francia e l'Italia, attualmente). Per
ripristinare uno dei campi, basta inserire &quot;{DEFAULT}&quot; e salvare le
impostazioni. </P>

<P> L'intera formattazione delle nomine &egrave; controllata da modelli e blocchi di
formattazione.
Nota che alcune di queste imposatzioni sono coverto al gruppo dei opzioni avanzate.
C'&egrave; un modello per l'intera ingresso e uno speciale per la data. Nel modello data,
diversi segnaposto possono essere utilizzati: {START_DATE}, {END_DATE}, {START_TIME},
{END_TIME} e {DATE_SEPARATOR}. Il formato della data e il formato orario possono essere
regolate nel backend. Questi formati vengono utilizzati per riempire i segnaposto dai
dati di ogni appuntamento. Inoltre, c'&egrave; un separatore, che pu&ograve; essere
inserito tra l'inizio e la fine. A seconda del tipo di ingresso, la data viene
visualizzata in diverse maniere. Per appuntamenti del intero giorno ore del inizio e di
fine non viene visualizzato nulla. Il modulo cerca anche di ottimizzare la stringa data.
Se la data di inizio e la data di fine sono gli stessi, la data di fine viene omesso.
Tuttavia, se si desidera disattivare questa funzione, &egrave; possibile farlo
deselezionando tale casella di controllo. Con un'altra casella di controllo  &egrave;
possibile definire se la data di fine di un appuntamento un secondo per essere dedotto,
se cade a mezzanotte. Cos&igrave;, il termine della manifestazione &ecrave; ancora uno
per l'ultimo giorno (reale) del evento.  Infine, l'intera stringa &egrave; circondato da
un blocco formattazione inizio e una di fine. Ecco come il {DATE} blocco viene generato.
</P>

<P> Gli altri segnaposto sono pi&ugrave; semplici. Essi consistono essenzialmente di un
valore che viene dal appuntamento e un blocco formattazione prefisso e un blocco
formattazione suffisso. Questo vale per il titolo del appuntamento ({TITLE}), la
posizione ({LOCATION}), la descrizione dettagliata ({DESCRIPTION}) e categorie ({CATEGORIES}). E anche possibile utilizzare il nome del calendario {CALENDAR} dentro un appuntamento.

Se uno dei campi &egrave; vuoto, anche il blocco formattazione prefisso e suffisso
vengono soppressi. Se si vuole evitare questo, basta inserire uno spazio nel titolo, la
posizione o la descrizione, rispettivamente.
</P>

<P> Oltre ai blocchi di formattazione utilizzati in ogni voce del calendario, ci sono
altri due blocchi di formattazione per l'intera sezione: uno per l'inizio di tutta la
&quot; sezione &quot; (Ad esempio &egrave; possibile aggiungere un titolo l&igrave;), e
uno per la fine della sezione. Per aggiungere definizioni de stile per l'uso in questi
blocchi di formattatzione &egrave; possibile aggiungerli al file stile frontend di
questo modulo direttamente dal backend.</P>

<P> Il modulo si occupa circa le impostazioni di privacy delle voci di calendario.
Appuntamenti contrassegnati come privati non vengono visualizzati affatto, mentre gli
appuntamenti riservati vengono visualizzati con solo la data, ma senza alcuna
descrizione. Al posto del titolo, un blocco di testo fisso che pu&ograve; essere
configurata nel backend, viene visualizzato per le iscrizioni riservate. </P>


<P> Infine, il modulo contiene una cache interna configurabile, che pu&ograve; essere
attivato con un'altra casella. Ci sono due tipi di cache: C'&egrave; una cache di tempo
breve, che memorizza l'intero calendari per alcuni secondi fino a minuti tra accessi della
pagina web. C'&egrave; anche una cache lungo per webcal-calendari. Quest'ultimo memorizza
le singole voci del WebCal-calendario per diversi giorni. Finch&eacute; la voce non viene
modificata in linea nel calendario WebCal, la voce viene caricato dalla cache. Entrambi i
tempi della cache possono essere configurate individualmente nel backend. In
 qualsiasi momento &egrave; possibile vedere quanto spazio su disco quella cache
 prende in generale per tutte le istanze del modulo calendario esterno, e
 se necessario si pu&ograve; cancellare la cache con un solo clic. </P>

<P>
 Questo modulo utilizza SabreDAV e php-curl per l'accesso WebDAV-URL e
SG-ICalendar per analizzare i calendari. </P>
";

// uscite di testo per il backend
$LANG ['backend'] = array(
    'TXT_EXTCAL_SETTINGS'           => "Impostazioni per il calendario esterno"
                                     . " - entrano e {DEFAULT} per ripristinare"
                                     . " qualsiasi campo al suo valore di default",
    'TXT_EXTCAL_SETTINGS_URLS'      => "inserire gli URL dei vostri calendari da"
                                     . " mostrare qui, una linea per URL",
    'TXT_EXTCAL_MAX_DAYS'           => "mostrano che tanti giorni di anticipo"
                                     . " (0 = nessun limite)" ,
    'TXT_EXTCAL_MAX_ENTRIES'        => "mostrano che tanti voci al massimo"
                                     . " (0 = nessun limite)",
    'TXT_EXTCAL_TIME_ZONE'          => "fuso orario per visualizzare le voci"
                                     . " (vuoto = fuso orario predefinito)",
    'TXT_EXTCAL_DATEFORMAT'         => "il formato della data senzo il tempo",
    'TXT_EXTCAL_TIMEFORMAT'         => "Il formato dell'ora (a meno che non si tratta"
                                     . " di un appuntamento allday)",
    'TXT_EXTCAL_DATE_SEPARATOR'     => "il separatore utilizzato tra l'inizio e la"
                                     . " data di fine",
    'TXT_EXTCAL_SECTION_START'      => "formattazione per l'inizio della intera sezione"
                                     . " (ad esempio titolo)",
    'TXT_EXTCAL_DATE_END'           => "formattazione tra la data e la descrizione"
                                     . "  (allegata a {DATE})",
    'TXT_EXTCAL_SECTION_END'        => "formattazione per la fine di tutta la sezione",
    'TXT_EXTCAL_CACHE_SIZE'         => "Cache attualmente utilizzato per le voci CalDAV",
    'TXT_EXTCAL_EMPTY_CACHE'        => "Cancella cache",
    'TXT_EXTCAL_ENABLE_CACHE'       => "Abilita cache",
    'TXT_EXTCAL_REFRESH_TIME'       => "tempo di aggiornamento per l'intero calendari"
                                     . " tra accessi della pagina web (pochi secondi)",
    'TXT_EXTCAL_CACHE_TIME'         => "tempo Cache per le voci di calendario,"
                                     . " che non vengono modificati, in giorni",
    'TXT_EXTCAL_DESCRIPTION_END'    => "formattazione a la fine della descrizione"
                                     . " dettagliata (allegata a {LOCATION})",
    'TXT_EXTCAL_HELP_PAGE'          => "Pagina di aiuto",
    'TXT_EXTCAL_CACHE_EMPTY'        => "Cache vuoto",
    'TXT_EXTCAL_ENTRY_TEMPLATE'     => "nel modello seguente &egrave; possibile"
                                     . " impostare l'aspetto di ogni voce del calendario"
                                     . " possibile segnaposto sono {DATE}, {TITLE},"
                                     . " {LOCATION}, {DESCRIPTION}, {CATEGORIES} et"
                                     . " {CALENDAR}. Invece de la data"
                                     . " &egrave; anche possibile utilizzare"
                                     . " {START_DATE}, {END_DATE}, {START_TIME},"
                                     . " {END_TIME} e {DATE_SEPARATOR} qui. L'apertura e"
                                     . " blocca chiusura sopra definiti sono inseriti"
                                     . " attorno a ciascuno di questi segnaposto a"
                                     . " condizione che questa stringa non &egrave;"
                                     . " vuota per la voce corrente. ",
    'TXT_EXTCAL_DESCRIPTION_START'  => "formattazione di inizio della descrizione"
                                     . " (anteporre a {DESCRIPTION})",
    'TXT_EXTCAL_LOCATION_START'     => "formattazione all'inizio di un percorso"
                                     . " (anteposta a {LOCATION})",
    'TXT_EXTCAL_LOCATION_END'       => "formattazione alla fine di un percorso"
                                     . " (allegato a {DESCRIPTION})",
    'TXT_EXTCAL_TITLE_START'        => "formattazione all'inizio di un titolo"
                                     . " (anteposta a {TITLE})",
    'TXT_EXTCAL_TITLE_END'          => "formattazione alla fine di un titolo"
                                     . " (allegato a {TITLE})",
    'TXT_EXTCAL_DATE_START'         => "formattazione all'inizio della data"
                                     . " (anteporre a {DATE})",
    'TXT_EXTCAL_CONFIDENTIAL_TEXT'  => "testo visualizzato come descrizione per le voci"
                                     . " confidenziali (tra cui l'apertura e chiusura"
                                     . " tag se si desidera averli attorno a quel"
                                     . " testo)",
    'TXT_EXTCAL_DATE_TEMPLATE'      => "nel modello seguente &egrave; possibile mettere"
                                     . " a punto l'aspetto della data. I possibili"
                                     . " segnaposto sono {START_DATE}, {END_DATE},"
                                     . " {START_TIME}, {END_TIME} e {DATE_SEPARATOR}."
                                     . " Quest'ultimo e i blocchi di apertura e"
                                     . " chiusura, che sono avvolti attorno al risultato"
                                     . " di questo modello, sono definiti sopra. ",
    'TXT_EXTCAL_OPTIMIZE_DATE'      => "cercare di ottimizzare l'uscita data"
                                     . " (ad esempio cadere data di fine, se &egrave;"
                                     . " lo stesso giorno)",
    'TXT_EXTCAL_VERIFY_PEER'        => "verificare certificati ssl per connessioni https"
                                     . " (risicho per la sicurezza se non controllata)",
    'TXT_EXTCAL_KEEP_TODAYS_EVENTS' => "mantenere gli appuntamenti trascorsi fino a"
                                     . " mezzanotte",
    'TXT_EXTCAL_TIME_OFFSET'        => "correzione del tempo del server in secondi",
    'TXT_EXTCAL_CALENDAR_START'     => "formattazione all'inizio di un nome del calendario"
                                     . " (anteposta a {CALENDAR})",
    'TXT_EXTCAL_CALENDAR_END'       => "formattazione alla fine di un nome del calendario"
                                     . " (allegato a {CALENDAR})"
);



$LANG['frontend']['MOD_EXTCAL_TIMEZONE']    = 'Europe/Rome';
$LANG['frontend']['MOD_EXTCAL_DATEFORMAT']  = 'd.m.Y';
$LANG['frontend']['MOD_EXTCAL_TIMEFORMAT']  = 'H:i';

$LANG['categories'] = array(
    'anniversary' => 'Anniversario',
    'birthday' => 'Compleanno',
    'business' => 'Attivit&agrave; commerciale',
    'calls' => 'Chiamte',
    'clients' => 'Clienti',
    'competition' => 'Concorrenza',
    'customer' => 'Cliente',
    'favorites' => 'Preferiti',
    'follow up' => 'Seguito',
    'gifts' => 'Regali',
    'holidays' => 'Vacanze',
    'ideas' => 'Idee',
    'issues' => 'Problemi',
    'miscellaneous' => 'Miscellaneo',
    'personal' => 'Personale',
    'projects' => 'Progetti',
    'public holiday' => 'Festa nazionale',
    'status' => 'Stato',
    'suppliers' => 'Fornitori',
    'travel' => 'Viaggio',
    'vacation' => 'Vacanza'
);

