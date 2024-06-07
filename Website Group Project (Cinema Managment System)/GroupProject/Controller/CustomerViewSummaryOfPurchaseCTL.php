<?php
include_once "Entity/SummaryOfPurchase.php";

class CustomerViewSummaryOfPurchaseCTL
{
	public function viewSummaryOfPurchase($username)
	{
		$summary = new SummaryOfPurchase();
		$result = $summary->getSummaryOfPurchase(($username));
		return $result;
	}
}
