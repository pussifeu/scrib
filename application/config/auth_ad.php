<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// hosts: an array of AD servers (usually domain controllers) to use for authentication
/*$config['hosts'] = array('ldaps://preprod-gardiansesame.edf.fr:10636');*/
/*$config['hosts'] = array('ldaps://dmztest-annuaire-gardiansesame.edf.fr:636');*/
$config['hosts'] = array('ldaps://noe-gardiansesame.edf.fr:636');

// ports: an array containing the remote port number to connect to (default is 389)
$config['ports'] = array(636);


// base_dn: the base DN of your Active Directory domain
$config['base_dn'] = 'dc=gardiansesame';


// ad_domain: the domain name to prepend (versions prior to Windows 2000) or append (Windows 2000 and up)
$config['ad_domain'] = '';

// start_ou: the DN of the OU you want to start searching from. Leave empty to start from domain root.
$config['start_ou'] = 'ou=People';


// proxy_user: the (distinguished) username of the user that does the querying (AD generally does not allow anonymous binds) 
$config['proxy_user'] = 'uid=9TPET001,ou=Applis,dc=gardiansesame';


// proxy pass: the password for the proxy_user
$config['proxy_pass'] = 'KYS4n$jy';


/* End of file auth_ad.php */
/* Location: ./application/config/auth_ad.php */
