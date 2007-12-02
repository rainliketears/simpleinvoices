<?php

/*
* Script: auto_complete_search.php
* 	Do the autocomplete of invoice id in the process payment page
*
* Authors:
*	 Justin Kelly, Nicolas Ruflin
*
* Last edited:
* 	 2007-07-18
*
* License:
*	 GPL v2 or above
*/

define("BROWSE","browse");
//if this page has error with auth remove the above line and figure out how to do it right
include_once('./include/include_main.php');

$sql = "SELECT * FROM ".TB_PREFIX."invoices";

global $dbh
$sth = dbQuery($sql) or die(end($dbh->errorInfo()));

$q = strtolower($_GET["q"]);
if (!$q) return;

while ($invoice = getInvoices($sth)) {

	$biller = getBiller($invoice['biller_id']);
	$customer = getCustomer($invoice['customer_id']);
	$invoiceType = getInvoiceType($invoice['type_id']);

	if (strpos(strtolower($invoice['id']), $q) !== false) {
		echo "$invoice[id]|<table><tr><td class='details_screen'>Invoice:</td><td> $invoice[id] </td><td  class='details_screen'>Total: </td><td>$invoice[total_format] </td></tr><tr><td class='details_screen'>Biller: </td><td>$biller[name] </td><td class='details_screen'>Paid: </td><td>$invoice[paid_format] </td></tr><tr><td class='details_screen'>Customer: </td><td>$customer[name] </td><td class='details_screen'>Owing: </td><td><u>$invoice[owing_format]</u></td></tr></table>\n";
	}
}


/*

foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}
*/
?>
