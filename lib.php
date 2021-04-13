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
 * Library of interface functions and constants for module newsletter
 *
 * @package    mod_newsletter
 * @copyright  2013 Ivan Šakić <ivan.sakic3@gmail.com>
 * @copyright  2015 onwards David Bogner <info@edulabs.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Newsletter internal constants.

define('NEWSLETTER_CRON_TEMP_FILENAME', 'newsletter_cron.tmp');
define('NEWSLETTER_LOCK_DIR', $CFG->dataroot . '/temp/mod/newsletter');
define('NEWSLETTER_LOCK_SUFFIX', 'lock');
define('NEWSLETTER_TEMP_DIR', NEWSLETTER_LOCK_DIR);
define('NEWSLETTER_BASE_STYLESHEET_PATH', 'reset.css');

define('NEWSLETTER_FILE_AREA_STYLESHEET', 'stylesheets');
define('NEWSLETTER_FILE_AREA_ATTACHMENT', 'attachments');
define('NEWSLETTER_FILE_AREA_ISSUE', 'issue');

define('NEWSLETTER_FILE_OPTIONS_SUBDIRS', 0);

define('NEWSLETTER_DELIVERY_STATUS_UNKNOWN', 0);
define('NEWSLETTER_DELIVERY_STATUS_DELIVERED', 1);
define('NEWSLETTER_DELIVERY_STATUS_INPROGRESS', 2);
define('NEWSLETTER_DELIVERY_STATUS_FAILED', 3);

define('NEWSLETTER_SUBSCRIBER_STATUS_OK', 0);
define('NEWSLETTER_SUBSCRIBER_STATUS_PROBLEMATIC', 1);
define('NEWSLETTER_SUBSCRIBER_STATUS_BLACKLISTED', 2);
define('NEWSLETTER_SUBSCRIBER_STATUS_UNSUBSCRIBED', 4);

define('NEWSLETTER_ACTION_VIEW_NEWSLETTER', 'view');
define('NEWSLETTER_ACTION_CREATE_ISSUE', 'createissue');
define('NEWSLETTER_ACTION_EDIT_ISSUE', 'editissue');
define('NEWSLETTER_ACTION_READ_ISSUE', 'readissue');
define('NEWSLETTER_ACTION_DELETE_ISSUE', 'deleteissue');
define('NEWSLETTER_ACTION_MANAGE_SUBSCRIPTIONS', 'managesubscriptions');
define('NEWSLETTER_ACTION_EDIT_SUBSCRIPTION', 'editsubscription');
define('NEWSLETTER_ACTION_DELETE_SUBSCRIPTION', 'deletesubscription');
define('NEWSLETTER_ACTION_SUBSCRIBE_COHORTS', 'subscribecohorts');
define('NEWSLETTER_ACTION_SUBSCRIBE', 'subscribe');
define('NEWSLETTER_ACTION_UNSUBSCRIBE', 'unsubscribe');
define('NEWSLETTER_ACTION_GUESTSUBSCRIBE', 'guestsubscribe');

define('NEWSLETTER_GROUP_ISSUES_BY_YEAR', 'year');
define('NEWSLETTER_GROUP_ISSUES_BY_MONTH', 'month');
define('NEWSLETTER_GROUP_ISSUES_BY_WEEK', 'week');
define('NEWSLETTER_GROUP_ISSUES_BY_DAY', 'day');

define('NEWSLETTER_SUBSCRIPTION_MODE_OPT_IN', 0);
define('NEWSLETTER_SUBSCRIPTION_MODE_OPT_OUT', 1);
define('NEWSLETTER_SUBSCRIPTION_MODE_FORCED', 2);
define('NEWSLETTER_SUBSCRIPTION_MODE_NONE', 3);

define('NEWSLETTER_NEW_USER', -1);

define('NEWSLETTER_NO_ISSUE', 0);
define('NEWSLETTER_NO_USER', 0);

define('NEWSLETTER_DEFAULT_STYLESHEET', 0);

define('NEWSLETTER_GROUP_BY_DEFAULT', NEWSLETTER_GROUP_ISSUES_BY_WEEK);
define('NEWSLETTER_FROM_DEFAULT', 0);
define('NEWSLETTER_COUNT_DEFAULT', 30);
define('NEWSLETTER_TO_DEFAULT', 0);
define('NEWSLETTER_SUBSCRIPTION_DEFAULT', 0);

define('NEWSLETTER_PREFERENCE_COUNT', 'newsletter_count');
define('NEWSLETTER_PREFERENCE_GROUP_BY', 'newsletter_group_by');

define('NEWSLETTER_PARAM_ID', 'id');
define('NEWSLETTER_PARAM_ACTION', 'action');
define('NEWSLETTER_PARAM_ISSUE', 'issue');
define('NEWSLETTER_PARAM_GROUP_BY', 'groupby');
define('NEWSLETTER_PARAM_FROM', 'from');
define('NEWSLETTER_PARAM_COUNT', 'count');
define('NEWSLETTER_PARAM_TO', 'to');
define('NEWSLETTER_PARAM_USER', 'user');
define('NEWSLETTER_PARAM_CONFIRM', 'confirm');
define('NEWSLETTER_PARAM_HASH', 'hash');
define('NEWSLETTER_PARAM_SUBSCRIPTION', 'sub');
define('NEWSLETTER_PARAM_DATA', 'data');
define('NEWSLETTER_PARAM_SEARCH', 'search');
define('NEWSLETTER_PARAM_STATUS', 'status');
define('NEWSLETTER_PARAM_RESETBUTTON', 'resetbutton');
define('NEWSLETTER_PARAM_ORDERBY', 'orderby');
define('NEWSLETTER_PARAM_ADD_SUBSCRIBERS', 'add');
define('NEWSLETTER_PARAM_REMOVE_SUBSCRIBERS', 'remove');

define('NEWSLETTER_CONFIRM_YES', 1);
define('NEWSLETTER_CONFIRM_NO', 0);
define('NEWSLETTER_CONFIRM_UNKNOWN', -1);

define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_EMAIL', 'col_email');
define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_NAME', 'col_name');
define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_HEALTH', 'col_health');
define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_BOUNCERATIO', 'col_bounceratio');
define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_TIMESUBSCRIBED', 'col_timesubscribed');
define('NEWSLETTER_SUBSCRIPTION_LIST_COLUMN_ACTIONS', 'col_actions');

// Moodle core API.

/**
 * Returns the information on whether the module supports a feature
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed true if the feature is supported, null if unknown
 * @see plugin_supports() in lib/moodlelib.php
 */
function newsletter_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        default:
            return null;
    }
}

/**
 * Implementation of the function for printing the form elements that control
 * whether the course reset functionality affects the newsletter.
 *
 * @param moodleform $mform form passed by reference
 */
function newsletter_reset_course_form_definition(&$mform) {
    $mform->addElement('header', 'newsletterheader',
            get_string('modulenameplural', 'mod_newsletter'));
    $name = get_string('delete_all_subscriptions', 'mod_newsletter');
    $mform->addElement('advcheckbox', 'reset_newsletter_subscriptions', $name);
}

/**
 * Course reset form defaults.
 *
 * @param object $course
 * @return array
 */
function newsletter_reset_course_form_defaults($course) {
    return array('reset_newsletter_subscriptions' => 1);
}

/**
 * Saves a new instance of the newsletter into the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $newsletter An object from the form in mod_form.php
 * @param mod_newsletter_mod_form $mform
 * @return int The id of the newly inserted newsletter record
 */
function newsletter_add_instance(stdClass $data, mod_newsletter_mod_form $mform = null) {
    $newsletter = new mod_newsletter\newsletter(context_module::instance($data->coursemodule));
    return $newsletter->add_instance($data, $mform);
}

/**
 * Updates an instance of the newsletter in the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $newsletter An object from the form in mod_form.php
 * @param mod_newsletter_mod_form $mform
 * @return boolean Success/Fail
 */
function newsletter_update_instance(stdClass $data, mod_newsletter_mod_form $mform = null) {
    $context = context_module::instance($data->coursemodule);
    $newsletter = new mod_newsletter\newsletter($context, null, null);
    return $newsletter->update_instance($data, $mform);
}

/**
 * Removes an instance of the newsletter from the database
 *
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function newsletter_delete_instance($id) {
    global $DB;

    if (!$newsletter = $DB->get_record('newsletter', array('id' => $id))) {
        return false;
    }

    $cm = get_coursemodule_from_instance('newsletter', $newsletter->id);
    $context = context_module::instance($cm->id);

    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'mod_newsletter', NEWSLETTER_FILE_AREA_STYLESHEET,
            $newsletter->id);
    foreach ($files as $file) {
        $file->delete();
    }

    $issues = $DB->get_records('newsletter_issues', array('newsletterid' => $newsletter->id));
    foreach ($issues as $issue) {
        $files = $fs->get_area_files($context->id, 'mod_newsletter', NEWSLETTER_FILE_AREA_ATTACHMENT,
                $issue->id);
        foreach ($files as $file) {
            $file->delete();
        }
    }

    $DB->delete_records_list('newsletter_bounces', 'issueid', array_keys($issues));
    $DB->delete_records('newsletter_subscriptions', array('newsletterid' => $newsletter->id));
    $DB->delete_records('newsletter_issues', array('newsletterid' => $newsletter->id));
    $DB->delete_records('newsletter_deliveries', array('newsletterid' => $newsletter->id));
    $DB->delete_records('newsletter', array('id' => $newsletter->id));
    return true;
}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 * This function will remove all newsletter subscriptions in the database
 * and clean up any related data.
 *
 * @param \stdClass $data data submitted from the reset course.
 * @return array status array
 */
function newsletter_reset_userdata($data) {
    global $DB;
    $status = array();

    $sql = "SELECT n.id FROM {newsletter} n WHERE n.course = :courseid";
    $params = array('courseid' => $data->courseid);
    if ($newsletterids = $DB->get_fieldset_sql($sql, $params)) {
        foreach ($newsletterids as $newsletterid) {
            $newsletter = mod_newsletter\newsletter::get_newsletter_by_instance($newsletterid);
            $status = array_merge($status, $newsletter->reset_userdata($data));
        }
    }
    return $status;
}

/**
 * Returns a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return stdClass|null
 */
function newsletter_user_outline($course, $user, $mod, $newsletter) {
    $return = new stdClass();
    $return->time = 0;
    $return->info = '';
    return $return;
}

/**
 * Prints a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @param stdClass $course the current course record
 * @param stdClass $user the record of the user we are generating report for
 * @param cm_info $mod course module info
 * @param stdClass $newsletter the module instance record
 * @return void, is supposed to echo directly
 */
function newsletter_user_complete($course, $user, $mod, $newsletter) {
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in newsletter activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 */
function newsletter_print_recent_activity($course, $viewfullnames, $timestart) {
    return false; // True if anything was printed, otherwise false.
}

/**
 * Prepares the recent activity data
 *
 * This callback function is supposed to populate the passed array with
 * custom activity records. These records are then rendered into HTML via
 * {@link newsletter_print_recent_mod_activity()}.
 *
 * @param array $activities sequentially indexed array of objects with the 'cmid' property
 * @param int $index the index in the $activities to use for the next record
 * @param int $timestart append activity since this time
 * @param int $courseid the id of the course we produce the report for
 * @param int $cmid course module id
 * @param int $userid check for a particular user's activity only, defaults to 0 (all users)
 * @param int $groupid check for a particular group's activity only, defaults to 0 (all groups)
 * @return void adds items into $activities and increases $index
 */
function newsletter_get_recent_mod_activity(&$activities, &$index, $timestart, $courseid, $cmid,
        $userid = 0, $groupid = 0) {
}

/**
 * Prints single activity item prepared by {@see newsletter_get_recent_mod_activity()}
 *
 * @return void
 */
function newsletter_print_recent_mod_activity($activity, $courseid, $detail, $modnames,
        $viewfullnames) {
}

/**
 * given the id of the newsletter, returns all recipients who have an
 * acceptable health status
 *
 * @param integer $newsletterid
 * @return array of objects indexed by userid
 */
function newsletter_get_all_valid_recipients($newsletterid) {
    global $DB;
    $validstatuses = array(NEWSLETTER_SUBSCRIBER_STATUS_OK, NEWSLETTER_SUBSCRIBER_STATUS_PROBLEMATIC);
    $guestuserid = guest_user()->id;
    list($insql, $params) = $DB->get_in_or_equal($validstatuses, SQL_PARAMS_NAMED);
    $params['newsletterid'] = $newsletterid;
    $sql = "SELECT *
              FROM {newsletter_subscriptions} ns
        INNER JOIN {user} u ON ns.userid = u.id
             WHERE ns.newsletterid = :newsletterid
               AND u.confirmed = 1
               AND ns.health $insql
               AND u.id <> $guestuserid";
    return $DB->get_records_sql($sql, $params);
}

/**
 * Returns all other caps used in the module
 *
 * @return array
 * @example return array('moodle/site:accessallgroups');
 */
function newsletter_get_extra_capabilities() {
    return array();
}

// Find the base url from $_GET variables, for print_paging_bar.
function newsletter_get_baseurl() {
    $getcopy = $_GET;

    unset($getcopy['blogpage']);

    if (!empty($getcopy)) {
        $first = false;
        $querystring = '';

        foreach ($getcopy as $var => $val) {
            if (!$first) {
                $first = true;
                $querystring .= "?$var=$val";
            } else {
                $querystring .= '&amp;' . $var . '=' . $val;
                $hasparam = true;
            }
        }
    } else {
        $querystring = '?';
    }

    return strip_querystring(qualified_me()) . $querystring;

}

// File API.

/**
 * Returns the lists of all browsable file areas within the given module context
 *
 * The file area 'intro' for the activity introduction field is added automatically
 * by {@link file_browser::get_file_info_context_module()}
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @return array of [(string)filearea] => (string)description
 */
function newsletter_get_file_areas($course, $cm, $context) {
    return array(NEWSLETTER_FILE_AREA_ATTACHMENT => 'attachments',
            NEWSLETTER_FILE_AREA_STYLESHEET => 'stylesheets',
            NEWSLETTER_FILE_AREA_ISSUE => 'htmlcontent of editor');
}

/**
 * File browsing support for newsletter file areas
 *
 * @param \file_browser $browser
 * @param array $areas
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param int $itemid
 * @param string $filepath
 * @param string $filename
 * @return \file_info instance or null if not found
 * @package mod_newsletter
 * @category files
 *
 */
function newsletter_get_file_info($browser, $areas, $course, $cm, $context, $filearea, $itemid,
        $filepath, $filename) {
    global $CFG, $DB, $USER;

    if ($context->contextlevel != CONTEXT_MODULE) {
        return null;
    }

    // Filearea must contain a real area.
    if (!isset($areas[$filearea])) {
        return null;
    }

    // Note that newsletter_user_can_see_post() additionally allows access for parent roles
    // and it explicitly checks qanda newsletter type, too. One day, when we stop requiring
    // course:managefiles, we will need to extend this.
    if (!has_capability('mod/newsletter:viewnewsletter', $context)) {
        return null;
    }

    if (is_null($itemid)) {
        require_once($CFG->dirroot . '/mod/forum/locallib.php');
        return new \forum_file_info_container($browser, $course, $cm, $context, $areas, $filearea);
    }

    static $cached = array();
    // Variable $cached will store last retrieved post, discussion and newsletter. To make sure that the
    // cache is cleared between unit tests we check if this is the same session.
    if (!isset($cached['sesskey']) || $cached['sesskey'] != sesskey()) {
        $cached = array('sesskey' => sesskey());
    }

    if (isset($cached['issue']) && $cached['issue']->id == $itemid) {
        $issue = $cached['issue'];
    } else if ($issue = $DB->get_record('newsletter_issues', array('id' => $itemid))) {
        $cached['issue'] = $issue;
    } else {
        return null;
    }

    if (isset($cached['newsletter']) && $cached['newsletter']->id == $cm->instance) {
        $newsletter = $cached['newsletter'];
    } else if ($newsletter = $DB->get_record('newsletter', array('id' => $cm->instance))) {
        $cached['newsletter'] = $newsletter;
    } else {
        return null;
    }

    $fs = get_file_storage();
    $filepath = is_null($filepath) ? '/' : $filepath;
    $filename = is_null($filename) ? '.' : $filename;
    if (!($storedfile = $fs->get_file($context->id, 'mod_newsletter', $filearea, $itemid, $filepath,
            $filename))) {
        return null;
    }

    // Checks to see if the user can manage files or is the owner.
    // TODO MDL-33805 - Do not use userid here and move the capability check above.
    if (!has_capability('moodle/course:managefiles', $context) &&
            $storedfile->get_userid() != $USER->id) {
        return null;
    }

    $urlbase = $CFG->wwwroot . '/pluginfile.php';
    return new \file_info_stored($browser, $context, $storedfile, $urlbase, $itemid, true, true,
            false, false);
}

/**
 * Serves the files from the newsletter file areas
 *
 * @param stdClass $course the course object
 * @param stdClass $cm the course module object
 * @param stdClass $context the newsletter's context
 * @param string $filearea the name of the file area
 * @param array $args extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @category files
 *
 * @package mod_newsletter
 */
function newsletter_pluginfile($course, $cm, $context, $filearea, array $args, $forcedownload,
        array $options = array()) {
    global $DB;

    if ($context->contextlevel != CONTEXT_MODULE) {
        return false;
    }

    require_course_login($course, true, $cm);

    if (!$newsletter = $DB->get_record('newsletter', array('id' => $cm->instance))) {
        return false;
    }

    $fileareas = newsletter_get_file_areas($course, $cm, $context);
    // Filearea must contain a real area.
    if (!isset($fileareas[$filearea])) {
        return false;
    }

    $issueid = (int) array_shift($args);

    $fs = get_file_storage();
    $relativepath = implode('/', $args);
    if ($filearea == NEWSLETTER_FILE_AREA_STYLESHEET) {
        if ($newsletter->id != $issueid) {
            return false;
        }
        $fullpath = "/$context->id/mod_newsletter/$filearea/$issueid/$relativepath";
    } else {
        $fullpath = "/$context->id/mod_newsletter/$filearea/$issueid/$relativepath";
    }

    $file = $fs->get_file_by_hash(sha1($fullpath));
    if (!$file || $file->is_directory()) {
        return false;
    }

    send_stored_file($file, 0, 0, true, $options);
}

// Navigation API.

/**
 * Extends the global navigation tree by adding newsletter nodes if there is a relevant content
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $navref An object representing the navigation tree node of the newsletter
 *        module instance
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
function newsletter_extend_navigation(navigation_node $navref, stdclass $course, stdclass $module,
        cm_info $cm) {
    global $DB;

    $action = optional_param(NEWSLETTER_PARAM_ACTION, NEWSLETTER_ACTION_VIEW_NEWSLETTER, PARAM_ALPHA);
    $context = $cm->context;

    switch ($action) {
        case NEWSLETTER_ACTION_CREATE_ISSUE:
            require_capability('mod/newsletter:createissue', $context);
            $url = new moodle_url('/mod/newsletter/view.php',
                    array(NEWSLETTER_PARAM_ID => $cm->id, 'action' => NEWSLETTER_ACTION_CREATE_ISSUE));
            $issuenode = $navref->add(get_string('create_new_issue', 'mod_newsletter'), $url);
            $issuenode->make_active();
            break;
        case NEWSLETTER_ACTION_EDIT_ISSUE:
            require_capability('mod/newsletter:editissue', $context);
            $issueid = optional_param(NEWSLETTER_PARAM_ISSUE, NEWSLETTER_NO_ISSUE, PARAM_INT);
            $url = new moodle_url('/mod/newsletter/view.php',
                    array(NEWSLETTER_PARAM_ID => $cm->id, 'action' => NEWSLETTER_ACTION_EDIT_ISSUE,
                            NEWSLETTER_PARAM_ISSUE => $issueid));
            $issuenode = $navref->add(get_string('edit_issue', 'mod_newsletter'), $url);
            $issuenode->make_active();
            break;
        case NEWSLETTER_ACTION_READ_ISSUE:
            require_capability('mod/newsletter:readissue', $context);
            $issueid = optional_param(NEWSLETTER_PARAM_ISSUE, NEWSLETTER_NO_ISSUE, PARAM_INT);
            $issuename = $DB->get_field('newsletter_issues', 'title',
                    array('id' => $issueid, 'newsletterid' => $module->id));
            $url = new moodle_url('/mod/newsletter/view.php',
                    array(NEWSLETTER_PARAM_ID => $cm->id, 'action' => NEWSLETTER_ACTION_READ_ISSUE,
                            NEWSLETTER_PARAM_ISSUE => $issueid));
            $issuenode = $navref->add($issuename, $url);
            $issuenode->make_active();
            break;
        case NEWSLETTER_ACTION_DELETE_ISSUE:
            require_capability('mod/newsletter:deleteissue', $context);
            $issueid = optional_param(NEWSLETTER_PARAM_ISSUE, NEWSLETTER_NO_ISSUE, PARAM_INT);
            $url = new moodle_url('/mod/newsletter/view.php',
                    array(NEWSLETTER_PARAM_ID => $cm->id, 'action' => NEWSLETTER_ACTION_DELETE_ISSUE,
                            NEWSLETTER_PARAM_ISSUE => $issueid));
            $issuenode = $navref->add(get_string('delete_issue', 'mod_newsletter'), $url);
            $issuenode->make_active();
            break;
        case NEWSLETTER_ACTION_MANAGE_SUBSCRIPTIONS:
            require_capability('mod/newsletter:managesubscriptions', $context);
            $url = new moodle_url('/mod/newsletter/view.php',
                    array(NEWSLETTER_PARAM_ID => $cm->id,
                            'action' => NEWSLETTER_ACTION_MANAGE_SUBSCRIPTIONS));
            $subnode = $navref->add(get_string('newsletter:managesubscriptions', 'mod_newsletter'),
                    $url);
            $subnode->make_active();
            break;
        default:
            break;
    }
}

/**
 * Extends the settings navigation with the newsletter settings
 *
 * This function is called when the context for the page is a newsletter module. This is not called
 * by AJAX
 * so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@link settings_navigation}
 * @param navigation_node $newsletternode {@link navigation_node}
 */
function newsletter_extend_settings_navigation(settings_navigation $settingsnav,
        navigation_node $newsletternode = null) {
    global $PAGE;
    $newsletter = mod_newsletter\newsletter::get_newsletter_by_course_module($PAGE->cm->id);

    if (has_capability('mod/newsletter:managesubscriptions', $newsletter->get_context())) {
        $newsletternode->add(get_string('manage_subscriptions', 'mod_newsletter'),
                new moodle_url('/mod/newsletter/view.php',
                        array('id' => $newsletter->get_course_module()->id,
                                'action' => NEWSLETTER_ACTION_MANAGE_SUBSCRIPTIONS)));
    }
    if (has_capability('mod/newsletter:createissue', $newsletter->get_context())) {
        $newsletternode->add(get_string('newsletter:createissue', 'mod_newsletter'),
                new moodle_url('/mod/newsletter/view.php',
                        array('id' => $newsletter->get_course_module()->id,
                                'action' => NEWSLETTER_ACTION_CREATE_ISSUE)));
    }
}

/**
 * Create a message-id string to use in the custom headers of forum notification emails
 *
 * message-id is used by email clients to identify emails and to nest conversations
 *
 * @param int $postid The ID of the forum post we are notifying the user about
 * @param int $usertoid The ID of the user being notified
 * @param string $hostname The server's hostname
 * @return string A unique message-id
 */
function newsletter_get_email_message_id($postid, $usertoid, $hostname) {
    return '<' . hash('sha256', $postid . 'to' . $usertoid) . '@' . $hostname . '>';
}

// Mail utility functions.

/**
 * Send an email to a specified user
 *
 * @param stdClass $user A {@link $USER} object
 * @param stdClass $from A {@link $USER} object
 * @param string $subject plain text subject line of the email
 * @param string $messagetext plain text version of the message
 * @param string $messagehtml complete html version of the message (optional)
 * @param string $attachment a file on the filesystem, either relative to $CFG->dataroot or a full
 *        path to a file in $CFG->tempdir
 * @param string $attachname the name of the file (extension indicates MIME)
 * @param bool $usetrueaddress determines whether $from email address should
 *        be sent out. Will be overruled by user profile setting for maildisplay
 * @param string $replyto Email address to reply to
 * @param string $replytoname Name of reply to recipient
 * @param int $wordwrapwidth custom word wrap width, default 79
 * @return bool Returns true if mail was sent OK and false if there was an error.
 */
function newsletter_email_to_user($user, $from, $subject, $messagetext, $messagehtml = '',
        $attachment = array(), $attachname = '', $usetrueaddress = true, $replyto = '', $replytoname = '',
        $wordwrapwidth = 79) {
    global $CFG, $PAGE, $SITE;

    if (empty($user) or empty($user->id)) {
        debugging('Can not send email to null user', DEBUG_DEVELOPER);
        return false;
    }

    if (empty($user->email)) {
        debugging('Can not send email to user without email: ' . $user->id, DEBUG_DEVELOPER);
        return false;
    }

    if (!empty($user->deleted)) {
        debugging('Can not send email to deleted user: ' . $user->id, DEBUG_DEVELOPER);
        return false;
    }

    if (defined('BEHAT_SITE_RUNNING')) {
        // Fake email sending in behat.
        return true;
    }

    if (!empty($CFG->noemailever)) {
        // Hidden setting for development sites, set in config.php if needed.
        debugging('Not sending email due to $CFG->noemailever config setting', DEBUG_NORMAL);
        return true;
    }

    if (email_should_be_diverted($user->email)) {
        $subject = "[DIVERTED {$user->email}] $subject";
        $user = clone($user);
        $user->email = $CFG->divertallemailsto;
    }

    // Skip mail to suspended users.
    if ((isset($user->auth) && $user->auth == 'nologin') or
            (isset($user->suspended) && $user->suspended)) {
        return true;
    }

    if (!validate_email($user->email)) {
        // We can not send emails to invalid addresses - it might create security issue or confuse
        // the mailer.
        debugging(
                "email_to_user: User $user->id (" . fullname($user) .
                ") email ($user->email) is invalid! Not sending.");
        return false;
    }

    if (over_bounce_threshold($user)) {
        debugging(
                "email_to_user: User $user->id (" . fullname($user) .
                ") is over bounce threshold! Not sending.");
        return false;
    }

    // TLD .invalid is specifically reserved for invalid domain names.
    // For More information, see {@link http://tools.ietf.org/html/rfc2606#section-2}.
    if (substr($user->email, -8) == '.invalid') {
        debugging(
                "email_to_user: User $user->id (" . fullname($user) .
                ") email domain ($user->email) is invalid! Not sending.");
        return true; // This is not an error.
    }

    // If the user is a remote mnet user, parse the email text for URL to the
    // wwwroot and modify the url to direct the user's browser to login at their
    // home site (identity provider - idp) before hitting the link itself.
    if (is_mnet_remote_user($user)) {
        require_once($CFG->dirroot . '/mnet/lib.php');

        $jumpurl = mnet_get_idp_jump_url($user);
        $callback = partial('mnet_sso_apply_indirection', $jumpurl);

        $messagetext = preg_replace_callback("%($CFG->wwwroot[^[:space:]]*)%", $callback,
                $messagetext);
        $messagehtml = preg_replace_callback("%href=[\"'`]($CFG->wwwroot[\w_:\?=#&@/;.~-]*)[\"'`]%",
                $callback, $messagehtml);
    }

    // Mail default moodle config will be override if custom smtp settings are define in plugin settings.
    $mail = override_mail_config(get_mailer());

    if (!empty($mail->SMTPDebug)) {
        echo '<pre>' . "\n";
    }

    $temprecipients = array();
    $tempreplyto = array();

    // Make sure that we fall back onto some reasonable no-reply address.
    $noreplyaddressdefault = 'noreply@' . get_host_from_url($CFG->wwwroot);
    $noreplyaddress = empty($CFG->noreplyaddress) ? $noreplyaddressdefault : $CFG->noreplyaddress;

    if (!validate_email($noreplyaddress)) {
        debugging('email_to_user: Invalid noreply-email ' . s($noreplyaddress));
        $noreplyaddress = $noreplyaddressdefault;
    }

    // Make up an email address for handling bounces.
    if (!empty($CFG->handlebounces)) {
        $modargs = 'B' . base64_encode(pack('V', $user->id)) . substr(md5($user->email), 0, 16);
        $mail->Sender = generate_email_processing_address(0, $modargs);
    } else {
        $mail->Sender = $noreplyaddress;
    }

    // Make sure that the explicit replyto is valid, fall back to the implicit one.
    if (!empty($replyto) && !validate_email($replyto)) {
        debugging('email_to_user: Invalid replyto-email ' . s($replyto));
        $replyto = $noreplyaddress;
    }

    if (is_string($from)) { // So we can pass whatever we want if there is need.
        $mail->From = $noreplyaddress;
        $mail->FromName = $from;
        // Check if using the true address is true, and the email is in the list of allowed domains
        // for sending email,
        // and that the senders email setting is either displayed to everyone, or display to only
        // other users that are enrolled
        // in a course with the sender.
    } else if ($usetrueaddress && can_send_from_real_email_address($from, $user)) {
        if (!validate_email($from->email)) {
            debugging('email_to_user: Invalid from-email ' . s($from->email) . ' - not sending');
            // Better not to use $noreplyaddress in this case.
            return false;
        }
        $mail->From = $from->email;
        $fromdetails = new stdClass();
        $fromdetails->name = fullname($from);
        $fromdetails->url = preg_replace('#^https?://#', '', $CFG->wwwroot);
        $fromdetails->siteshortname = format_string($SITE->shortname);
        $fromstring = $fromdetails->name;
        if ($CFG->emailfromvia == EMAIL_VIA_ALWAYS) {
            $fromstring = get_string('emailvia', 'core', $fromdetails);
        }
        $mail->FromName = $fromstring;
        if (empty($replyto)) {
            $tempreplyto[] = array($from->email, fullname($from));
        }
    } else {
        $mail->From = $noreplyaddress;
        $fromdetails = new stdClass();
        $fromdetails->name = fullname($from);
        $fromdetails->url = preg_replace('#^https?://#', '', $CFG->wwwroot);
        $fromdetails->siteshortname = format_string($SITE->shortname);
        $fromstring = $fromdetails->name;
        if ($CFG->emailfromvia != EMAIL_VIA_NEVER) {
            $fromstring = get_string('emailvia', 'core', $fromdetails);
        }
        $mail->FromName = $fromstring;
        if (empty($replyto)) {
            $tempreplyto[] = array($noreplyaddress, get_string('noreplyname'));
        }
    }

    if (!empty($replyto)) {
        $tempreplyto[] = array($replyto, $replytoname);
    }

    $temprecipients[] = array($user->email, fullname($user));

    // Set word wrap.
    $mail->WordWrap = $wordwrapwidth;

    if (!empty($from->customheaders)) {
        // Add custom headers.
        if (is_array($from->customheaders)) {
            foreach ($from->customheaders as $customheader) {
                $mail->addCustomHeader($customheader);
            }
        } else {
            $mail->addCustomHeader($from->customheaders);
        }
    }

    // If the X-PHP-Originating-Script email header is on then also add an additional
    // header with details of where exactly in moodle the email was triggered from,
    // either a call to message_send() or to email_to_user().
    if (ini_get('mail.add_x_header')) {

        $stack = debug_backtrace(false);
        $origin = $stack[0];

        foreach ($stack as $depth => $call) {
            if ($call['function'] == 'message_send') {
                $origin = $call;
            }
        }

        $originheader = $CFG->wwwroot . ' => ' . gethostname() . ':' .
                str_replace($CFG->dirroot . '/', '', $origin['file']) . ':' . $origin['line'];
        $mail->addCustomHeader('X-Moodle-Originating-Script: ' . $originheader);
    }

    if (!empty($from->priority)) {
        $mail->Priority = $from->priority;
    }

    $renderer = $PAGE->get_renderer('core');
    $context = array('sitefullname' => $SITE->fullname, 'siteshortname' => $SITE->shortname,
            'sitewwwroot' => $CFG->wwwroot, 'subject' => $subject, 'to' => $user->email,
            'toname' => fullname($user), 'from' => $mail->From, 'fromname' => $mail->FromName);
    if (!empty($tempreplyto[0])) {
        $context['replyto'] = $tempreplyto[0][0];
        $context['replytoname'] = $tempreplyto[0][1];
    }
    if ($user->id > 0) {
        $context['touserid'] = $user->id;
        $context['tousername'] = $user->username;
    }

    if (!empty($user->mailformat) && $user->mailformat == 1) {
        // Only process html templates if the user preferences allow html email.

        if ($messagehtml) {
            // If html has been given then pass it through the template.
            $context['body'] = $messagehtml;
            $messagehtml = $renderer->render_from_template('core/email_html', $context);
        } else {
            // If no html has been given, BUT there is an html wrapping template then
            // auto convert the text to html and then wrap it.
            $autohtml = trim(text_to_html($messagetext));
            $context['body'] = $autohtml;
            $temphtml = $renderer->render_from_template('core/email_html', $context);
            if ($autohtml != $temphtml) {
                $messagehtml = $temphtml;
            }
        }
    }

    $context['body'] = $messagetext;
    $mail->Subject = $renderer->render_from_template('core/email_subject', $context);
    $mail->FromName = $renderer->render_from_template('core/email_fromname', $context);
    $messagetext = $renderer->render_from_template('core/email_text', $context);

    // Autogenerate a MessageID if it's missing.
    if (empty($mail->MessageID)) {
        $mail->MessageID = generate_email_messageid();
    }

    if ($messagehtml && !empty($user->mailformat) && $user->mailformat == 1) {
        // Don't ever send HTML to users who don't want it.
        $mail->isHTML(true);
        $mail->Encoding = 'quoted-printable';
        $mail->Body = $messagehtml;
        $mail->AltBody = "\n$messagetext\n";
    } else {
        $mail->IsHTML(false);
        $mail->Body = "\n$messagetext\n";
    }
    if (!is_array((array) $attachment) && ($attachment && $attachname)) {
        $attachment[$attachname] = $attachment;
    }
    if (is_array((array) $attachment)) {
        foreach ($attachment as $attachname => $attachlocation) {
            if (preg_match("~\\.\\.~", $attachlocation)) {
                // Security check for ".." in dir path.
                $supportuser = core_user::get_support_user();
                $temprecipients[] = array($supportuser->email, fullname($supportuser, true));
                $mail->addStringAttachment(
                        'Error in attachment.  User attempted to attach a filename with a unsafe name.',
                        'error.txt', '8bit', 'text/plain');
            } else {
                require_once($CFG->libdir . '/filelib.php');
                $mimetype = mimeinfo('type', $attachname);

                $attachmentpath = $attachlocation;

                // Before doing the comparison, make sure that the paths are correct (Windows uses
                // slashes in the other direction).
                $attachpath = str_replace('\\', '/', $attachmentpath);
                // Make sure both variables are normalised before comparing.
                $temppath = str_replace('\\', '/', realpath($CFG->tempdir));

                // If the attachment is a full path to a file in the tempdir, use it as is,
                // otherwise assume it is a relative path from the dataroot (for backwards
                // compatibility reasons).
                if (strpos($attachpath, $temppath) !== 0) {
                    $attachmentpath = $CFG->dataroot . '/' . $attachmentpath;
                }

                $mail->addAttachment($attachmentpath, $attachname, 'base64', $mimetype);
            }
        }
    }

    // Check if the email should be sent in an other charset then the default UTF-8.
    if ((!empty($CFG->sitemailcharset) || !empty($CFG->allowusermailcharset))) {

        // Use the defined site mail charset or eventually the one preferred by the recipient.
        $charset = $CFG->sitemailcharset;
        if (!empty($CFG->allowusermailcharset)) {
            if ($useremailcharset = get_user_preferences('mailcharset', '0', $user->id)) {
                $charset = $useremailcharset;
            }
        }

        // Convert all the necessary strings if the charset is supported.
        $charsets = get_list_of_charsets();
        unset($charsets['UTF-8']);
        if (in_array($charset, $charsets)) {
            $mail->CharSet = $charset;
            $mail->FromName = core_text::convert($mail->FromName, 'utf-8', strtolower($charset));
            $mail->Subject = core_text::convert($mail->Subject, 'utf-8', strtolower($charset));
            $mail->Body = core_text::convert($mail->Body, 'utf-8', strtolower($charset));
            $mail->AltBody = core_text::convert($mail->AltBody, 'utf-8', strtolower($charset));

            foreach ($temprecipients as $key => $values) {
                $temprecipients[$key][1] = core_text::convert($values[1], 'utf-8',
                        strtolower($charset));
            }
            foreach ($tempreplyto as $key => $values) {
                $tempreplyto[$key][1] = core_text::convert($values[1], 'utf-8',
                        strtolower($charset));
            }
        }
    }

    foreach ($temprecipients as $values) {
        $mail->addAddress($values[0], $values[1]);
    }
    foreach ($tempreplyto as $values) {
        $mail->addReplyTo($values[0], $values[1]);
    }

    if ($mail->send()) {
        set_send_count($user);
        if (!empty($mail->SMTPDebug)) {
            echo '</pre>';
        }
        return true;
    } else {
        // Trigger event for failing to send email.
        $event = \core\event\email_failed::create(
                array('context' => context_system::instance(), 'userid' => $from->id,
                        'relateduserid' => $user->id,
                        'other' => array('subject' => $subject, 'message' => $messagetext,
                                'errorinfo' => $mail->ErrorInfo)));
        $event->trigger();
        if (CLI_SCRIPT) {
            mtrace('Error: lib/moodlelib.php email_to_user(): ' . $mail->ErrorInfo);
        }
        if (!empty($mail->SMTPDebug)) {
            echo '</pre>';
        }
        return false;
    }
}

/** This function will override SMTP moodle config with plugin settings
 * In case we need a different smtp from moodle settings.
 *
 * @param moodle_phpmailer $mail
 * @return moodle_phpmailer
 */
function override_mail_config(moodle_phpmailer $mailer): moodle_phpmailer {
    $config = get_config('mod_newsletter');
    // This code will set up ur smtp config and associate mailer.
    // If checkbox in plugin settings is set up.
    if ($config->activesmtpcustom) {
        if ($config->smtpcustomhost == 'qmail') {
            // Use Qmail system.
            $mailer->isQmail();

        } else if (empty($config->smtpcustomhost)) {
            // Use PHP mail() = sendmail.
            $mailer->isMail();

        } else {
            // Use SMTP directly.
            $mailer->isSMTP();
            // Specify main and backup servers.
            $mailer->Host          = $config->smtpcustomhost;
            // Specify secure connection protocol.
            $mailer->SMTPSecure    = $config->smtpcustomsecure;

            if ($config->smtpcustomuser) {
                // Use SMTP authentication.
                $mailer->SMTPAuth = true;
                $mailer->Username = $config->smtpcustomuser;
                $mailer->Password = $config->smtpcustompassword;
            } else {
                $mailer->SMTPAuth = false;
                $mailer->Username = null;
                $mailer->Password = null;
            }
        }
    }
    return $mailer;
}
