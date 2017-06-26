
<?php

require_once('../../nusoap/lib/nusoap.php');
$client = new SoapClient("https://apiconnector.com/v2/api.svc?wsdl");
$params = array("login" => "username","password" => "password");
$result =$client->GetContactsInAddressBookResponse(array('withFullData'));
$array =$result->GetContactsInAddressBookResponse->GetContactsInAddressBookResult;
print "<table border='2'>
<tr>
    <th></th>
    <th>addressBookId</th>
    <th>withFullData</th>
</tr>";
foreach($array as $k=>$v){
    print "<tr>
    <td align='right'>" . ($k+1) . "</td>
    <td>" . $v->addressBookId . "</td>
    <td align='right'>" . $v->withFullData . "</td>
</tr>";
}print "</table>";

?>
