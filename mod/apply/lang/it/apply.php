<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'apply', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   mod_apply
 * @copyright Fumi.Iseki {@link http://www.nsl.tuis.ac.jp}, 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['messageprovider:submission'] = 'Operatione di ingresso';
$string['messageprovider:message']    = 'Messaggio';
$string['messageprovider:processed']  = 'Operazione processata';

$string['accept_entry'] = 'accettata';
$string['acked_accept'] = 'Accettata';
$string['acked_notyet'] = 'Non ancora';
$string['acked_reject'] = 'Rifiutato';
$string['add_item']  = 'Aggiungi un tipo di oggetto';
$string['add_items'] = 'Aggiungi un tipo di oggetto';
$string['add_pagebreak'] = 'Aggiungi interruzione pagina';
$string['adjustment'] = 'Regolazione';
$string['apply_is_not_ready'] = 'La domanda non è ancora pronta. Modifica prima gli elementi.';
$string['apply:addinstance'] = 'Aggiungi nuova domanda';
$string['apply:applies'] = 'nuova domanda';
$string['apply:createprivatetemplate'] = 'Crea private template';
$string['apply:createpublictemplate'] = 'Crea pubblico template';
$string['apply:deletetemplate'] = 'Cancella template';
$string['apply:deletesubmissions'] = 'Delete submissions';
$string['apply:edititems'] = 'Modifica elementi';
$string['apply:edittemplates'] = 'Modifica Templates';
$string['apply:mapcourse'] = 'Mappa i corsi su candidature globali';
$string['apply:operatesubmit'] = 'Operazione di ingresso';
$string['apply:preview'] = 'Anteprima';
$string['apply:receivemail'] = 'Ricevi una notifica via e-mail';
$string['apply:submit'] = 'Invia';
$string['apply:preview_submit'] = 'Invia anteprima schermata';
$string['apply:view'] = 'Visualizza una candidatura';
$string['apply:viewentries'] = 'Elenco domanda';
$string['apply:viewanalysepage'] = 'Visualizza la pagina di analisi dopo l\'invio';
$string['apply:viewreports'] = 'Visualizza reports';
$string['apply_is_already_submitted'] = 'La domanda è già stata presentata';
$string['apply_is_closed'] = 'Il periodo di candidatura è chiuso';
$string['apply_is_disable'] = 'Candidatura disabilitata';
$string['apply_is_not_open'] = 'L\'applicazione non è ancora aperta';
$string['apply_options'] = 'Candidatura optioni';
$string['average'] = 'Media';
$string['back_button'] = ' Indietro ';
$string['before_apply'] = 'Prima di inviare';
$string['cancel_entry'] = 'Cancella';
$string['cancel_entry_button'] = ' Cancella ';
$string['cancel_moving'] = 'Cancella spostamento';
$string['cannot_save_templ'] = 'il salvataggio dei modelli non è consentito';
$string['captcha'] = 'Captcha';
$string['check'] = 'Check Box';
$string['checkbox'] = 'Check Boxes';
$string['class_cancel']  = 'Cancel';
$string['class_draft']   = 'Bozza';
$string['class_newpost'] = 'New Post';
$string['class_update']  = 'Update';
$string['confirm_cancel_entry'] = 'Sei sicuro di voler cancellare questa domanda?';
$string['confirm_delete_entry'] = 'Sei sicuro di voler ritirare questa domanda?';
$string['confirm_delete_item'] = 'Sei sicuro di voler cancellare questo oggetto?';
$string['confirm_delete_submit'] = 'Sei sicuro di voler cancellare questa domanda?';
$string['confirm_delete_template'] = 'Sei sicuro di voler cancellare questa template?';
$string['confirm_rollback_entry'] = 'Sei sicuro di voler ritirare questa domanda?';
$string['confirm_use_template'] = 'Sei sicuro di voler usare questa template?';
$string['count_of_nums'] = 'Conteggio dei numeri';
$string['creating_templates'] = 'Salva queste domande come nuovo modello';
$string['delete_entry'] = 'Ritirare';
$string['delete_entry_button'] = ' Ritirare ';
$string['delete_item'] = 'Cancella oggetto';
$string['delete_submit'] = 'Cancella domanda';
$string['delete_template'] = 'Cancella template';
$string['delete_templates'] = 'cancella template...';
$string['depending'] = 'Dipendenze';
$string['depending_help'] = 'È possibile mostrare un oggetto a seconda del valore di un altro oggetto.<br />
<strong>Ecco un esempio.</strong><br />
<ul>
<li>Per prima cosa, crea un elemento da cui dipenderà un altro elemento.</li>
<li>Successivamente, aggiungi un\'interruzione di pagina per dipendere.</li>
<li>Quindi aggiungi gli elementi in base al valore dell\'elemento creato in precedenza. Scegli l\'elemento dall\'elenco denominato "Elemento di dipendenza" e scrivi il valore richiesto nella casella di testo denominata "Valore di dipendenza".</li>
</ul>
<strong>La struttura dell\'elemento dovrebbe essere simile a questa.</strong>
<ol>
<li>Articolo Q: Hai una macchina? A: sì/no</li>
<li>Pagebreak per dipendere</li>
<li>Articolo Q: Di che colore è la tua auto?<br />
(questo articolo dipende dall\'articolo 1 con valore = sì)</li>
<li>Articolo Q: Perché non hai una macchina?<br />
(questo articolo dipende dall\'articolo 1 con valore = no)</li>
<li> ... altri articoli</li>
</ol>';
$string['dependitem'] = 'Elemento di dipendenza';
$string['dependvalue'] = 'Valore di dipendenza';
$string['description'] = 'Descrizione';
$string['display_button'] = ' Display ';
$string['do_not_analyse_empty_submits'] = 'Non analizzare gli invii vuoti';
$string['dropdown'] = 'Dropdown List';
$string['edit_entry'] = 'Modifica';
$string['edit_entry_button'] = ' Modifica ';
$string['edit_item'] = 'Modifica domanda';
$string['edit_items'] = 'Modifica Oggetto';

$string['email_entry'] = 'Invia e-mail al richiedente';
$string['email_notification'] = 'Invia notifiche e-mail all\'amministratore';
$string['email_notification_help'] = 'Se abilitato, gli amministratori ricevono un\'e-mail di notifica degli invii di candidatura.';
$string['email_notification_user'] = 'terminare le notifiche e-mail ai candidati';
$string['email_notification_user_help'] = 'Se abilitato, l\'amministratore può inviare un\'e-mail dei processi di candidatura ai candidati.';
$string['email_confirm_text'] = ' : \'{$a->apply}\'

You can view it here:
{$a->url}';
$string['email_confirm_html'] = ' : <i>\'{$a->apply}\'</i><br /><br /> Tu puoi vedere <a href="{$a->url}">here</a>.';
$string['email_teacher'] = '{$a->username} ha inviato l\'attività di domanda';
$string['email_user_done']   = 'La tua domanda è stata creata';
$string['email_user_accept'] = 'La tua domanda è stata accettata';
$string['email_user_reject'] = 'La tua domanda è stata rifiutata';
$string['email_user_other']  = 'L\'amministratore ha elaborato la tua richiesta';
$string['email_noreply'] = 'Questa email è automatica. per favore non rispondere a questa email.';
//
$string['only_acked_accept'] = 'Solo ricezione';
$string['only_acked_accept_help'] = 'Enable to only accept reception. Specify when processing is not required.'; 
$string['enable_deletemode'] = 'Delete Mode';
$string['enable_deletemode_help'] = 'Ciò consente a un insegnante di eliminare tutte le domanda.<br />Di solito, impostare su "No" per sicurezza.'; 
$string['can_discard'] = 'Puoi scartare';
$string['can_discard_help'] = 'Abilita cancellazione domanda.'; 
$string['date_format']      = 'Formato di visualizzazione della data(time)';
$string['date_format_default'] = '%m/%d/%y %H:%M';
$string['date_format_help'] = 'Specificare il formato di visualizzazione di data e ora. L\'impostazione predefinita è%m/%d/%y %H:%M';
$string['entries_list_title'] = 'Elenco delle voci';
$string['entry_saved'] = 'La tua domanda è stata salvata. <strong>Grazie</strong>.';
$string['entry_saved_draft'] = 'La tua domanda è stata salvata in <strong>Bozza</strong>.';
$string['entry_saved_operation'] = 'La tua richiesta è stata elaborata.';
$string['execd_done']    = 'Completato';
$string['execd_entry']  = 'completato';
$string['execd_notyet']  = 'Non ancora';
$string['exist'] = 'Exist';
$string['export_templates'] = 'Export templates';
$string['hide_no_select_option'] = 'Nascondi l\'opzione "Non selezionato"';
$string['horizontal'] = 'Orizzontale';
$string['import_templates'] = 'Import templates';
$string['info'] = 'Infomazioni';
$string['infotype'] = 'Informazioni-Tipo';
$string['item_label'] = 'Label';
$string['item_label_help'] = 'Special Labels<br />
<ul>
<li><strong>submit_title</strong>
<ul><li>Quando questa etichetta è allegata al campo di testo (risposta breve), viene trattata come il titolo di una domanda.</li></ul>
</li>
<li><strong>submit_only</strong>
<ul><li>Questo è un elemento visualizzato solo al momento di una domanda. Questo viene utilizzato per il consenso all\'uso, ecc.</li></ul>
</li>
<li><strong>admin_reply</strong>
<ul><li>Sebbene non sia visualizzato su un utente al momento di un\'applicazione, viene visualizzato dopo un\'applicazione.
Poiché l\'amministratore può modificare, questo viene utilizzato per il commento di un amministratore, ecc. </li></ul>
</li>
<li><strong>solo_admin</strong>
<ul><li>Questo è un elemento che può essere visualizzato solo da un amministratore e può essere modificato solo da un amministratore.
Viene utilizzato per il promemoria di un amministratore, ecc.</li></ul>
</li>
</ul>';

$string['item_name'] = 'Nome Oggetto';
$string['items_are_required'] = 'Le risposte sono obbligatorie.';
$string['label'] = 'Label';
$string['maximal'] = 'maximal';
$string['modulename'] = 'Form Domanda';
$string['modulename_help'] = 'Puoi creare semplici moduli di domanda e farli inviare da un utente.';
$string['modulenameplural'] = 'I moduli di domanda';
$string['move_here'] = 'Sposta qui';
$string['move_item'] = 'Sposta questa domanda';
$string['movedown_item'] = 'Sposta questa domanda giù';
$string['moveup_item'] = 'Sposta questa domanda in alto';
$string['multichoice'] = 'Multiple choice';
$string['multichoice_values'] = 'Multiple choice values';
$string['multichoicerated'] = 'Multiple choice (rated)';
$string['multichoicetype'] = 'Multiple choice type';
$string['multiple_submit'] = 'Multiple Submissions';
$string['multiple_submit_help'] = 'Se abilitato per sondaggi anonimi, gli utenti possono inviare candidature un numero illimitato di volte.';
$string['name'] = 'Name';
$string['name_required'] = 'Nome (obbligatorio)';
$string['next_page_button'] = ' Prossima pagina ';
$string['no_itemlabel'] = 'No label';
$string['no_itemname'] = 'No itemname';
$string['no_items_available_yet'] = 'No questions have been set up yet';
$string['no_settings_captcha'] = 'Setting of CAPTCHA cannot be edited. ';
$string['no_submit_data'] = 'Specified entry data does not exist';
$string['no_templates_available_yet'] = 'No templates available yet';
$string['no_title'] = 'No Title';
$string['not_selected'] = 'not Selected';
$string['not_exist'] = 'not Exist';
$string['numeric'] = 'Numeric answer';
$string['numeric_range_from'] = 'Range from';
$string['numeric_range_to'] = 'Range to';
$string['only_one_captcha_allowed'] = 'Only one captcha is allowed in a apply';
$string['operate_is_disable'] = 'You ca not use this Operation';
$string['operate_submit'] = 'Operate';
$string['operate_submit_button'] = ' Elaborazione ';
$string['operation_error_execd'] = 'When you do not accept entry, you can not checke "done"';
$string['overview'] = 'Panoramica domanda';
$string['pagebreak'] = 'Page break for depending';
$string['pluginadministration'] = 'Apply administration';
$string['pluginname'] = 'Application Form';
$string['position'] = 'Position';
$string['preview'] = 'Preview';
$string['preview_help'] = 'In the preview you can change the order of questions.';
$string['previous_apply'] = 'Previous submit';
$string['previous_page_button'] = ' Precedente pagina ';
$string['public'] = 'Public';
$string['radio'] = 'Radio Button';
$string['radiobutton'] = 'Radio Button';
$string['radiobutton_rated'] = 'Radio Button (Rated)';
$string['radiorated'] = 'Radio Button (Rated)';
$string['reject_entry'] = 'reject';
$string['related_items_deleted'] = 'All your user\'s responses for this question will also be deleted';
$string['required'] = 'Required';
$string['resetting_data'] = 'Reset apply responses';
$string['responsetime'] = 'Responsestime';
$string['returnto_course'] = 'Ritorna al corso';
$string['rollback_entry'] = 'Ritirare';
$string['rollback_entry_button'] = ' Ritirare ';
$string['save_as_new_item'] = 'Salva nuova domanda';
$string['save_as_new_template'] = 'Salva nuovo template';
$string['save_draft_button']  = ' Salva bozza ';
$string['save_entry_button']  = ' Invia domanda ';
$string['save_item'] = 'Salva oggetto';
$string['saving_failed'] = 'Salvataggio fallito';
$string['saving_failed_because_missing_or_false_values'] = 'Saving failed because missing or false values.';
$string['separator_decimal'] = '.';
$string['separator_thousand'] = ',';
$string['show_all'] = 'Show all {$a}';
$string['show_perpage'] = 'Visualizza {$a} per pagina';
$string['start'] = 'Avvio';
$string['started'] = 'avviato';
$string['stop'] = 'Fine';
$string['subject'] = 'Oggetto';
$string['submit_form_button'] = ' Nuova domanda ';
$string['submit_new_apply']   = 'Invia una nuova domanda';
$string['submitted'] = 'submitted';
$string['switch_item_to_not_required'] = 'cambia in: risposta non obbligatoria';
$string['switch_item_to_required'] = 'cambia in: risposta obbligatoria';
$string['template_saved'] = 'Template salvato';
$string['templates'] = 'Templates';
$string['textarea'] = 'Longer text answer';
$string['textarea_height'] = 'Numero di linee';
$string['textarea_width'] = 'Larghezza';
$string['textfield'] = 'Risposta di testo breve';
$string['textfield_maxlength'] = 'Caratteri massimi accettati';
$string['textfield_size'] = 'Larghezza del campo di testo';
$string['outside_style'] = 'Stile del bordo dell\'elemento';
$string['outside_style_default'] = 'border: 0px solid';
$string['outside_style_help'] = 'The style of the border around the item. This setting is ignored in the table. The default is ( border: 0px solid )';
$string['item_style'] = 'Stile di un oggetto';
$string['item_style_default'] = '';
$string['item_style_help'] = 'Lo stile dell\'oggetto. Il valore predefinito è (  )';

$string['time_close'] = 'È ora di chiudere';
$string['time_close_help'] = 'You can specify times when the apply is accessible for people to answer the applications. 
If the checkbox is not ticked there is no limit defined.';
$string['time_open'] = 'Time to open';
$string['time_open_help'] = 'You can specify times when the apply is accessible for people to answer the applications. 
If the checkbox is not ticked there is no limit defined.';
$string['title_ack']   = 'Ricevuto';
$string['title_before'] = 'Prima di inviarla';
$string['title_check'] = 'Controllo';
$string['title_class'] = 'Stato';
$string['title_draft'] = 'Bozza';
$string['title_exec']  = 'Elaborazione ';
$string['title_title'] = 'Titolo';
$string['title_version'] = 'Versione';
$string['update_entry'] = 'Aggiorna';
$string['update_entry_button'] = ' Aggiorna ';
$string['update_item'] = 'Salva i cambiamenti alla domanda';
$string['use_calendar'] = 'Usa il calendario';
$string['use_calendar_help'] = 'Il termine per la presentazione della domanda è registrato in un calendario.';
$string['use_item'] = 'usa {$a}';
$string['use_one_line_for_each_value'] = 'Use one line for each value!';
$string['use_this_template'] = 'Use this template';
$string['user_pic']  	 = 'Foto';
$string['username_manage'] = 'Gestione username';
$string['username_manage_help'] = 'È possibile selezionare il modello del nome visualizzato in questo modulo.';
//$string['firstname'] = get_string('firstname');
//$string['lastname']  = get_string('lastname');
$string['firstlastname'] = 'firstname lastname';
$string['lastfirstname'] = 'lastname firstname';
$string['using_templates'] = 'Usa un template';
$string['vertical'] = 'verticale';
$string['view_entries'] = 'Mostra candidature';
$string['wiki_url'] = '';
$string['yes_button'] = ' Si ';

$string['submit_num'] = 'Numero inviato';

// for new added items (1.3.0)
$string['fixedtitle'] = 'Titolo fisso';
$string['tablestart'] = 'Tabella inizio';
$string['tableend']   = 'Tabella fine';
$string['no_table']   = 'Tabella non è avviata!';
$string['nested_table'] = 'Tabella è annidato!';
$string['not_close_table'] = 'La tabella non è chiusa';
$string['table_columns'] = 'Numero di colonne';
$string['table_border'] = 'Grandezza Bordo dentro la tabella';
$string['table_border_help'] = 'La dimensione del bordo della cornice della tabella viene incrementata di 1';
$string['table_border_style'] = 'Stile del bordo della tabella interna';
$string['table_border_style_help'] = 'Lo stile del bordo del tabella esterna è solido (corretto)';
$string['table_th_sizes'] = 'Larghezza (px) di ogni colonna';
$string['table_th_sizes_help'] = 'Specifica la larghezza (unità px) di ogni colonna separata da virgole.';
$string['table_th_strings'] = 'Titolo di ogni colonna';
$string['table_th_strings_help'] = 'Descrivi il titolo di ogni colonna separato dal feed di riga. Cioè, un titolo è scritto su una riga.';
$string['table_disp_iname'] = 'Visualizza il nome dell\'elemento';
$string['table_disp_iname_help'] = 'Visualizza il nome dell\'elemento nella tabella';

//
$string['printpagebreak']  = 'Aggiungi un\'interruzione di pagina per la stampa';
$string['pagebreak_title'] = 'Interruzione di pagina per la stampa';
$string['pagebreak_style'] = 'Stile della linea di interruzione di pagina';
$string['pagebreak_style_default'] = '1px solid';
$string['pagebreak_style_help'] = 'Lo stile della linea di interruzione di pagina (&lt; hr /&gt;). Il valore predefinito è (1 pixel solido). In caso di vuoto, la linea non viene disegnata sulla schermata di stampa. La riga di interruzione di pagina non viene visualizzata nella schermata di invio e nell\'anteprima della schermata di invio.';

