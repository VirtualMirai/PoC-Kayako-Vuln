# PoC-Kayako-Vuln
PoC Vulnerability of Kayako Ticketing PRE v4.70.2 
The vulnerability was found in June 2015 and reported to Kayako.

This is a PoC for the vulnerability of the Kayako Ticketing suite. Affected versions are v4.70.1 and everything below.

I have gained permission to public the PoC.

##Vulnerability details:
https://classichelp.kayako.com/hc/en-us/articles/360006460899-June-2015-Security-Advisory-Kayako-Classic-4-70-1-and-Earlier

Vulnerability

An attacker could use this vulnerability to remotely execute PHP code on the server on which Kayako is installed. To exploit this vulnerability, an attacker would need HTTP access to any of the web-facing parts of Kayako. We have verified that the potential for exploitation exists. There is no known exploit in the wild.
Severity

According to our severity scale, we have rated this vulnerability as critical (a CVSS2 base score of 8.0 or higher).
Credit

This vulnerability was responsibly disclosed to us by a Kayako customer. We confirmed this vulnerability on the 9th June 2015 and released a fix and security advisory on the 10th June 2015.

## Explanation:
Exploiting through modified cookies with nullbytes.

By adding nullbytes in the cookies, it will allow the template generation to generate a custom template including arbitrary code. Upon browsing this file, you will be able to execute the code that was placed in the custom template.

With this, you will be able to use any functions enabled in PHP, and be able to steal data or take over the system.
