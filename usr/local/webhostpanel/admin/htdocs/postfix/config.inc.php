<?php
//
// File: config.inc.php
//
if (ereg ("config.inc.php", $_SERVER['PHP_SELF']))
{
   header ("Location: login.php");
   exit;
}

// Language config
// Language files are located in './languages'.
$CONF['language'] = 'en';

// Database Config
// 'database_type' is for future reference.
$CONF['database_type'] = 'mysql';
$CONF['database_host'] = 'localhost';
$CONF['database_user'] = 'postfixadmin';
$CONF['database_password'] = 'postfixadmin';
$CONF['database_name'] = 'postfix';

// Site Admin
// Define the Site Admins email address below.
// This will be used to send emails from to create mailboxes.
$CONF['admin_email'] = 'postmaster@domain.tld';

// Encrypt
// In what way do you want the passwords to be crypted?
// md5crypt = internal postfix admin md5
// system = whatever you have set as your PHP system default
// cleartext = clear text passwords (ouch!)
$CONF['encrypt'] = 'md5crypt';

// Default Aliases
// The default aliases that need to be created for all domains.
$CONF['default_aliases'] = array (
	'abuse' => 'abuse@domain.tld',
	'hostmaster' => 'hostmaster@domain.tld',
	'postmaster' => 'postmaster@domain.tld',
	'webmaster' => 'webmaster@domain.tld'
);

// Mailboxes
// If you want to store the mailboxes per domain set this to 'YES'.
// Example: /usr/local/virtual/domain.tld/username@domain.tld
$CONF['domain_path'] = 'YES';
// If you don't want to have the domain in your mailbox set this to 'NO'.
// Example: /usr/local/virtual/domain.tld/username
$CONF['domain_in_mailbox'] = 'YES';

// Default Domain Values
// Specify your default values below. Quota in MB.
$CONF['aliases'] = '10';
$CONF['mailboxes'] = '10';
$CONF['maxquota'] = '10';

// Quota
// When you want to enforce quota for your mailbox users set this to 'YES'.
$CONF['quota'] = 'NO';

// Virtual Vacation
// If you want to use virtual vacation for you mailbox users set this to 'YES'.
// NOTE: Make sure that you install the vacation module. http://high5.net/postfixadmin/
$CONF['vacation'] = 'NO';

// Alias Control
// Postfix Admin inserts an alias in the alias table for every mailbox it creates.
// The reason for this is that when you want catch-all or domain-2-domain forwarding
// to work you need to have the mailbox replicated in the alias table.
// If you want to take control of these aliases as well set this to 'YES'.
$CONF['alias_control'] = 'NO';

// Logging
// If you don't want logging set this to 'NO';
$CONF['logging'] = 'YES';

// Header
// Some header configuration.
// If you don't want the Postfix Admin logo to appear set this to 'NO'.
$CONF['logo'] = 'YES';
$CONF['header_text'] = ':: Welcome to Postfix Admin ::';

// Footer
// Below information will be on all pages.
// If you don't want the footer information to appear set this to 'NO'.
$CONF['show_footer_text'] = 'YES';
$CONF['footer_text'] = 'Return to domain.tld';
$CONF['footer_link'] = 'http://domain.tld';

?>
