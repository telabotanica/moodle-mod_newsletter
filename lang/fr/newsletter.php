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
 * English strings for newsletter
 *
 * @package    mod_newsletter
 * @copyright  2013 Ivan Šakić <ivan.sakic3@gmail.com>
 * @copyright  2015 onwards David Bogner <info@edulabs.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'Newsletter';
$string['modulenameplural'] = 'Newsletters';
$string['modulename_help'] = 'Le module newsletter permet la publication de newsletters par e-mail.';
$string['newslettername'] = 'Nom';
$string['newslettername_help'] = 'C\'est le contenu de l\'info-bulle d\'aide associée au champ newsletter. La syntaxe Markdown est prise en charge.';
$string['newsletter'] = 'Newsletter';
$string['pluginadministration'] = 'Administration de la newsletter';
$string['pluginname'] = 'Newsletter';
$string['newsletterintro'] = 'Description';
$string['stylesheets'] = 'Télécharger les feuilles de style de la newsletter';
$string['stylesheets_help'] = '
Téléchargez des fichiers CSS qui serviront de feuilles de style pour les numéros de cette newsletter. Vous pouvez en télécharger plusieurs et vous pouvez les sélectionner lors de la création d\'un nouveau problème. Ce champ est facultatif, car le module est livré avec au moins un fichier de feuille de style prêt à l\'emploi.';

$string['eventissuecreated'] = 'Problème de newsletter créé';
$string['eventsubscriptioncreated'] = 'Nouvel abonnement à la newsletter';
$string['eventsubscriptiondeleted'] = 'Abonnement à la newsletter supprimé';
$string['eventsubscriptionunsubscribed'] = 'Abonnement à la newsletter désabonné';
$string['eventissueviewed'] = 'Problème de newsletter consulté';
$string['eventsubscriptionsviewed'] = 'Abonnements à la newsletter consultés';
$string['eventsubscriptionresubscribed'] = 'Réinscription à la newsletter';

$string['edit_issue'] = 'Modifier cette news';
$string['delete_issue'] = 'Supprimer cette news';

$string['edit_issue_title'] = 'Modifier le titre de la news';
$string['issue_title'] = 'Titre de la news';
$string['issue_title_help'] = 'Indiquer le titre de la news. Obligatoire.';

$string['issue_htmlcontent'] = 'Contenu HTML';
$string['issue_stylesheet'] = 'Fichier de feuille de style pour le contenu HTML';

$string['mode_group_by_year'] = 'Grouper les numéros par années';
$string['mode_group_by_month'] = 'Grouper les numéros par mois';
$string['mode_group_by_week'] = 'Grouper les numéros par semaines';

$string['attachments'] = 'Pièces jointes';
$string['attachments_help'] = 'Téléchargez les fichiers que vous souhaitez livrer avec ce numéro sous forme de pièces jointes.';
$string['attachments_no'] = 'Aucunes pièces jointes téléchargées.';

$string['delete_all_subscriptions'] = 'Supprimer tous les abonnements';

$string['subscription_mode'] = 'Mode d\'abonnement';
$string['subscription_mode_help'] = 'Sélectionnez si les utilisateurs inscrits sont automatiquement abonnés à cette newsletter (opt-out) ou doivent s\'abonner manuellement (opt-in). ATTENTION! La désactivation abonnera automatiquement tous les utilisateurs inscrits!';
$string['sub_mode_opt_in'] = 'Accepter';
$string['sub_mode_opt_out'] = 'Refuser';
$string['sub_mode_forced'] = 'Forcer';

$string['publishon'] = 'Publier sur';
$string['header_content'] = 'Contenu de la news';
$string['header_publish'] = 'Options de publication';
$string['header_publishinfo'] = 'Une fois l\'envoi de la newsletter lancée, il ne sera plus possible de modifier la date de publication';

$string['config_send_notifications_label'] = 'Envoyer les notifications';
$string['config_send_notifications_desc'] = 'Cochez cette case pour activer l\'envoi de notifications liées à l\'abonnement aux abonnés.';
$string['config_debug_label'] = 'Mode Cron DEBUG';
$string['config_debug_desc'] = 'Cochez cette case pour activer la sortie de débogage pour la tâche cron de la newsletter.';
$string['config_activation_timeout_label'] = 'Temps d\'expiration des liens d\'activation';
$string['config_activation_timeout_desc'] = 'Sélectionnez la durée de validité des liens d\'activation envoyés par e-mail.';
$string['config_bounceprocessing'] = 'Paramètres de gestion du rebond: fournissez les données de connexion de la boîte aux lettres pour l\'adresse e-mail de rebond';
$string['config_bounceinfo'] = 'Utilisez la gestion des rebonds pour la newsletter uniquement si vous ne pouvez pas configurer les paramètres de rebond Moodle VERP comme décrit sur la page suivante: https://docs.moodle.org/dev/Email_processing L\'utilisation de la méthode VERP Moodle ne peut pas être utilisée sur tous les systèmes et est assez difficile à configurer. C\'est une alternative plus simple, mais qui ne fonctionne que pour le module newsletter. Après avoir enregistré les paramètres, testez-les à {$a}';
$string['config_host'] = 'Serveur hôte de messagerie (ex. Mail.yourserver.com)';
$string['config_username'] = 'Nom d\'utilisateur de la boîte mails';
$string['config_password'] = 'Mot de passe de la boîte mails';
$string['config_service'] = 'Le service à utiliser (imap ou pop3)';
$string['config_service_option'] = 'Les options de service (aucun, tls, notls, ssl)';
$string['config_port'] = 'Le port pour accéder à votre boîte mails; par défaut 143, les autres choix courants sont 110 (pop3), 995 (gmail)';
$string['config_bounce_enable'] = 'Activer le traitement des rebonds pour le module de newsletter';
$string['config_bounce_email'] = 'Adresse e-mail qui devrait recevoir les rebonds. Assurez-vous que cette adresse n\'est utilisée que pour la gestion des mails de rebond.';
$string['config_sendinglimit'] = 'Limiter les e-mails par exécution';
$string['config_sendinglimit_desc'] = 'Limite le nombre de courriels envoyés à chaque exécution de cron pour éviter le spam.';

$string['default_stylesheet'] = 'Feuille de style par défaut';

$string['header_email'] = 'E-Mail';
$string['header_name'] = 'Nom';
$string['header_health'] = 'Statut (livré / rebond)';
$string['header_bounceratio'] = 'Taux de rebond';
$string['header_actions'] = 'Actions';
$string['header_timesubscribed'] = 'Date d\'abonnement';
$string['header_timestatuschanged'] = 'Dernier changement de statut';
$string['header_subscriberid'] = 'Abonné par';
$string['header_unsubscriberid'] = 'Désabonné par';

$string['entries_per_page'] = 'Entrées par page';
$string['create_new_issue'] = 'Créer un nouveau problème';
$string['manage_subscriptions'] = 'Gérer les abonnements';

$string['health_0'] = 'Actif';
$string['health_1'] = 'Problématique';
$string['health_2'] = 'Liste noire';
$string['health_4'] = 'Désabonné';

$string['page_first'] = 'Première';
$string['page_previous'] = 'Précédente';
$string['page_next'] = 'Suivante';
$string['page_last'] = 'Dernière';

$string['subscribe'] = 'Souscrire';
$string['guestsubscribe'] = 'Abonnez-vous maintenant!';
$string['resubscribe'] = 'Confirmer le réabonnement';
$string['resubscribe_text'] = 'Vous avez été désabonné de cette newsletter. Voulez-vous vraiment vous réinscrire?';
$string['resubscribe_btn'] = 'Confirmer';

$string['subscribe_question'] = 'Souhaitez-vous vous abonner à la newsletter "{$a->name}" en utilisant l\'adresse e-mail "{$a->email}"?';
$string['unsubscribe_question'] = 'Souhaitez-vous désabonner votre adresse e-mail "{$a->email}" de la newsletter "{$a->name}"?';
$string['unsubscription_succesful'] = 'Votre e-mail "{$a->email}" a bien été supprimé de la newsletter suivante: "{$a->name}".';

$string['new_user_subscribe_message'] = 'Bonjour {$a->fullname},

Vous avez demandé à être abonné à
\'{$a->newslettername} \' newsletter à \'{$a->sitename} \'
en utilisant cette adresse e-mail. Un nouveau compte a été créé pour vous:

Nom d\'utilisateur: {$a->username}
Mot de passe: {$a->password}

Vous pouvez modifier les détails du compte après confirmation.
Pour confirmer votre nouveau compte, veuillez vous rendre à cette adresse Web:

{$a->link}

Dans la plupart des programmes de messagerie, cela devrait apparaître comme un lien bleu
sur lequel vous pouvez simplement cliquer. Si cela ne fonctionne pas,
puis coupez et collez l\'adresse dans l\'adresse
ligne en haut de la fenêtre de votre navigateur Web.

Si vous avez besoin d\'aide, veuillez contacter l\'administrateur du site,
{$a->admin}';

$string['account_confirmed'] = 'Bienvenue dans {$a->sitename}, {$a->fullname}!

Votre compte {$a->username} a été activé.
Pour modifier les détails de votre compte, cliquez sur {$a->editlink}.
Pour accéder à la newsletter, cliquez sur {$a->newsletterlink}.';

$string['account_already_confirmed'] = 'Votre compte a déjà été activé.
Pour accéder à la newsletter, cliquez sur {$a->newsletterlink}.';
$string['allusers'] = 'Utilisateurs (y compris désabonnés): ';
$string['filteredusers'] = 'Utilisateurs filtrés: ';
$string['groupby'] = 'Regrouper les numéros par: ';

$string['unsubscribe_link_text'] = 'Cliquez ici pour vous désabonner';

$string['publish_in'] = 'À paraître dans {$a->days} jours, {$a->hours} h, {$a->minutes} min, {$a->seconds} sec.';
$string['already_published'] = 'Ce numéro a été publié.';
$string['delete_issue_question'] = 'Voulez-vous vraiment supprimer ce numéro ?';
$string['delete_subscription_question'] = 'Êtes-vous sûr de vouloir supprimer cet abonnement ?';
$string['no_issues'] = 'Cette newsletter n\'a pas encore de problèmes.';

$string['edit_subscription_title'] = 'Edit subscription';
$string['subscribe'] = 'S\'abonner';
$string['unsubscribe'] = 'Se désabonner';

$string['allowguestusersubscriptions'] = 'Autoriser l\'abonnement des utilisateurs invités';
$string['allowguestusersubscriptions_help'] = 'Activer pour permettre aux utilisateurs invités de s\'abonner aux newsletters sur ce site. Cela nécessitera la création de comptes utilisateurs.';
$string['welcomemessage'] = 'Message de bienvenue';
$string['welcomemessage_help'] = 'Ce texte sera présenté à un utilisateur après s\'être inscrit avec succès à une newsletter.';
$string['welcomemessageguestuser'] = 'Utilisateur invité du message de bienvenue';
$string['welcomemessageguestuser_help'] = 'Ce texte sera affiché à un nouvel utilisateur après qu\'il se soit inscrit avec succès en tant qu\'invité à une newsletter.';

$string['newsletter:viewnewsletter'] = 'Voir la newsletter';
$string['newsletter:addinstance'] = 'Ajouter une newsletter';
$string['newsletter:createissue'] = 'Créer un numéro de newsletter';
$string['newsletter:deleteissue'] = 'Supprimer un numéro de newsletter';
$string['newsletter:deletesubscription'] = 'Supprimer les abonnements à la newsletter';
$string['newsletter:editissue'] = 'Modifier un numéro de newsletter';
$string['newsletter:editsubscription'] = 'Modifier un numéro de newsletter';
$string['newsletter:manageownsubscription'] = 'Gérer mon abonnement à la newsletter';
$string['newsletter:managesubscriptions'] = 'Gérer les abonnements à la newsletter';
$string['newsletter:publishissue'] = 'Publier un numéro de newsletter';
$string['newsletter:readissue'] = 'Lire un numéro de newsletter';
$string['newsletter:subscribecohort'] = 'Abonnez une cohorte à la newsletter';
$string['newsletter:subscribeuser'] = 'Abonnez les utilisateurs à la newsletter';
$string['newsletter:unsubscribecohort'] = 'Se désabonner d\'une cohorte d\'une newsletter';
$string['newsletter:viewnewsletter'] = 'Afficher une instance de newsletter';

$string['emailexists'] = 'Un compte utilisateur avec cette adresse e-mail existe déjà. Veuillez vous connecter pour vous abonner à la newsletter. Si vous avez oublié votre identifiant, utilisez le lien {$a} sur la page de connexion pour le récupérer.';
$string['guestsubscriptionsuccess'] = 'Votre email a été enregistré avec succès. <br /> Pour activer l\'abonnement, veuillez vérifier la boîte de réception de votre compte de messagerie ({$a}) et cliquer sur le lien de confirmation';
$string['resubscriptionsuccess'] = 'Vous avez été désabonné avec succès.';

$string['readonline'] = 'Afficher la version Web';
$string['send_newsletter'] = 'Envoyer la newsletter';
$string['process_bounces'] = 'Traiter les e-mails renvoyés';
$string['subscribercandidatesmatching'] = 'Utilisateurs correspondants pour ({$a})';
$string['subscribercandidates'] = 'Abonnés potentiels';
$string['subscribedusersmatching'] = 'Utilisateurs abonnés correspondant ({$a})';
$string['subscribedusers'] = 'Utilisateurs abonnés';
$string['cohortmanagement'] = 'Cohortes d\'abonnement/désabonnement';
$string['cohortsavailable'] = 'Cohortes disponibles';
$string['welcomeredirect'] = 'Bienvenue! Vous serez bientôt redirigé vers la page de connexion.';
$string['welcometonewsletter'] = 'Bienvenue à la newsletter';
$string['welcometonewsletter_guestsubscription'] = 'Bienvenue à la newsletter! <br /> Vous pouvez vous désinscrire à tout moment en cliquant sur le bouton de désinscription après connexion ou sur le lien de désinscription dans chaque numéro de newsletter.';
$string['unsubscribedinfo'] = 'Les utilisateurs marqués d\'un (!) Sont désabonnés';
$string['toc_header'] = 'Table des matières';
$string['toc_no'] = 'Ne pas générer automatiquement une table des matières';
$string['toc_yes'] = 'Utilisez {$a} niveau (s) de titre';
$string['toc'] = 'Sélectionnez comment générer automatiquement la table des matières';
$string['toc_help'] = 'Il s\'agit du nombre de niveaux de titres à inclure. Exemple: vous avez un numéro de newsletter avec trois niveaux de titre différents (h1, h2, h3). Ensuite, vous pouvez choisir de n\'utiliser que les titres les plus importants pour la table des matières. Ensuite, vous choisissez de ne sélectionner qu\'un seul niveau de titre. Si vous souhaitez également inclure h2 dans la table des matières, choisissez 2 niveaux.';
$string['unsubscribe_mail_subj'] = 'Vous avez été désabonné avec succès de la newsletter';
$string['unsubscribe_mail_text'] = '<p>
Bonjour {$a->firstname} {$a->lastname},
<br>
Vous avez été désabonné avec succès de la newsletter {$a->newslettertitle}. Si vous l\'avez fait exprès, il n\'y a plus rien à faire. Si vous vous êtes désabonné accidentellement, vous pouvez vous réinscrire maintenant sous le lien suivant:
<br>
{$a->newsletterurl}</p>';
$string['unsubscribe_nounsub_text'] = 'N\'envoyez pas de lien de désabonnement.';
$string['unsubscribe_nounsub'] = 'Distributeur';

// Privacy API.
$string['privacy:metadata:newsletter_subscriptions'] = 'Représente un abonnement à une newsletter.';
$string['privacy:metadata:newsletter_subscriptions:userid'] = 'Utilisateur qui a créé l\'enregistrement';
$string['privacy:metadata:newsletter_subscriptions:newsletterid'] = 'ID de la newsletter abonnée';
$string['privacy:metadata:newsletter_subscriptions:health'] = 'Santé de l\'abonnement à stocker si des erreurs ont été trouvées';
$string['privacy:metadata:newsletter_subscriptions:timesubscribed'] = 'Horodatage lors de l\'inscription';
$string['privacy:metadata:newsletter_subscriptions:timestatuschanged'] = 'Horodatage du dernier changement';
$string['privacy:metadata:newsletter_subscriptions:subscriberid'] = 'ID de l\'utilisateur qui s\'est abonné';
$string['privacy:metadata:newsletter_subscriptions:unsubscriberid'] = 'ID de l\'utilisateur qui s\'est désabonné';
$string['privacy:metadata:newsletter_subscriptions:sentnewsletters'] = 'Nombre de newsletters déjà envoyées';
$string['privacy:metadata:newsletter_bounces'] = 'Représenter les newsletters que nous avons reçu un rebond du serveur.';
$string['privacy:metadata:newsletter_bounces:userid'] = 'Utilisateur qui a créé l\'enregistrement';
$string['privacy:metadata:newsletter_bounces:issueid'] = 'Quelle newsletter a été rejetée';
$string['privacy:metadata:newsletter_bounces:statuscode'] = 'Code de statut que nous avons reçu';
$string['privacy:metadata:newsletter_bounces:timecreated'] = 'Horodatage de la création de l\'entrée';
$string['privacy:metadata:newsletter_bounces:type'] = 'Type que nous avons reçu';
$string['privacy:metadata:newsletter_bounces:timereceived'] = 'Horodatage de la réception du rebond';
$string['privacy:metadata:newsletter_deliveries'] = 'Représenter les newsletters que nous avons envoyées aux utilisateurs.';
$string['privacy:metadata:newsletter_deliveries:userid'] = 'Utilisateur qui a reçu la newsletter';
$string['privacy:metadata:newsletter_deliveries:issueid'] = 'ID du problème que nous avons envoyé';
$string['privacy:metadata:newsletter_deliveries:newsletterid'] = 'ID de la newsletter que nous avons envoyée';
$string['privacy:metadata:newsletter_deliveries:delivered'] = 'Horodatage de la livraison de la newsletter';

// Traduction custom smtp settings.
$string['customsmtp_label'] = "SMTP personnalisé";
$string['customsmtp_info'] = "Ces options permettent de définir un SMTP tiers si vous avez besoin de gérer les mails envoyés par le système de newsletter via un autre SMTP que celui géré par moodle.";
$string['activesmtpcustom_label'] = "Activer un smtp tiers";
$string['activesmtpcustom_desc'] = "Si vous cochez cette option, les options par défaut de moodle seront remplacées par celles définies ci-dessous pour le plugin de newsletter.";
$string['config_smtpcustomhost'] = "Hôte SMTP";
$string['config_smtpcustomhostdesc'] = "Donnez le nom complet d'un ou plusieurs serveurs SMTP locaux que Moodle doit utiliser pour envoyer des e-mails (par exemple «mail.a.com» ou «mail.a.com; mail.b.com»). Pour spécifier un port autre que celui par défaut (c.-à-d. Autre que le port 25), vous pouvez utiliser la syntaxe [serveur]: [port] (par exemple «mail.a.com:587»). Pour les connexions sécurisées, le port 465 est généralement utilisé avec SSL, le port 587 est généralement utilisé avec TLS, spécifiez le protocole de sécurité ci-dessous si nécessaire. Si vous laissez ce champ vide, Moodle utilisera la méthode PHP par défaut d'envoi de courrier.";
$string['config_smtpcustomsecure'] = "Sécurité SMTP";
$string['config_smtpcustomsecuredesc'] = "Si le serveur SMTP a besoin d'une connexion sécurisée, specifiez le protocole idoine.";
$string['config_smtpcustomuser'] = 'Nom d\'utilisateur SMTP';
$string['config_smtpcustomuserdesc'] = 'Si vous avez spécifié un serveur SMTP ci-dessus et que le serveur requiert une authentification, saisissez le nom d\'utilisateur ici.';
$string['config_smtpcustompassword'] = 'Mot de passe SMTP';
$string['config_smtpcustompassworddesc'] = 'Si vous avez spécifié un serveur SMTP ci-dessus et que le serveur requiert une authentification, saisissez le mot de passe ici.';