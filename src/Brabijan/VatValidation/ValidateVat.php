<?php

namespace Brabijan\VatValidation;

class ValidateVat
{

	/** @var string */
	private $apiUrl = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";

	/** @var  string */
	private $countryCode;

	/** @var int */
	private $vatNumber;

	/** @var string */
	private $name;

	/** @var string */
	private $address;

	/** @var bool */
	private $valid = FALSE;



	public function __construct($countryCode, $vatNumber = NULL)
	{
		if (!$vatNumber) {
			if (!preg_match('~([A-Za-z]{2})([0-9]+)~', $countryCode, $matches)) {
				throw new \Exception('Vat id is in wrong format');
			}
			$countryCode = $matches[1];
			$vatNumber = $matches[2];
		}

		if (!$vatNumber) {
			throw new \Exception('Please provide vat number');
		}

		$client = new \SoapClient($this->apiUrl);
		$response = $client->checkVat(array(
			'countryCode' => $countryCode,
			'vatNumber' => $vatNumber,
		));

		$this->countryCode = $response->countryCode;
		$this->vatNumber = $response->vatNumber;
		$this->valid = $response->valid;
		$this->name = $response->name;
		$this->address = $response->address;
	}



	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}



	/**
	 * @return string
	 */
	public function getCountryCode()
	{
		return $this->countryCode;
	}



	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}



	/**
	 * @return boolean
	 */
	public function isValid()
	{
		return $this->valid;
	}



	/**
	 * @return int
	 */
	public function getVatNumber()
	{
		return $this->vatNumber;
	}

}
