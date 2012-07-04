SecureMe
========

This class implement a security check and validation against SQL-injection and xss on any input type.
Perhaps it support the UTF-8 encoding and there aren't adverse effects like javascript crash caused by common protection system.


 Usage
------------- 
 in the main page of your application:
 <code> 
 require('class.SecureMe.php');
 SecureMe::run(); 
 </code>
 
 Explanation
-------------
When SecureMe::run() is called all these global arrays will be validated.
 * $_GET
 * $_POST
 * $_REQUEST
 * $_SERVER
 * $_COOKIE 

 xss filter:
The most common xss attack will be blocked replacing or deleting the word "script", however sometimes a hacker use differents way to bypass this check.
Using htmlentities all attempts are time waste

 sql-injection:
nothing better than mysql_real_escape_string!
 