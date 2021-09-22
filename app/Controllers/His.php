<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokenModel;

class His extends BaseController {

	private $loggedUserId;

	function __construct() {
        $this->session = \Config\Services::session();
        $this->loggedUserId = $this->session->get('loggedUserId');
    }

    public function getChallenge() {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, "https://ptest-auth.his.bg/token");
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $challengeResp = curl_exec($ch);
      /*if(curl_error($ch)) {
            $response = [
                'errors' => 'Възникна проблем при комуникацията с his.bg. Моля, опитайте по-късно'
            ];
            return $this->response->setXML($response);
        }*/
        curl_close($ch);
		
		return $challengeResp;
    }
	
	public function getToken() {
		$data = $this->request->getVar('xml');
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://ptest-auth.his.bg/token");
		curl_setopt($ch , CURLOPT_POST, true);
		curl_setopt($ch , CURLOPT_RETURNTRANSFER, true);
		$headers = array( 
		   "Content-Type: application/xml",
		   "Accept: application/xml",
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		$resp = curl_exec($ch);
		curl_close($ch);
		
		return $resp;
	}
	
	public function saveToken() {
		$data = $this->request->getVar('tokenData');
		$xml = simplexml_load_string($data);
		$namespaces = $xml->getNameSpaces(true);
		$xs = $xml->children($namespaces['nhis']);
		$token = new TokenModel();

		$data = [
			TokenModel::$COLUMN_DOCTOR_ID => $this->loggedUserId,
			TokenModel::$COLUMN_TOKEN => (string) $xs->contents->accessToken->attributes()->value,
			TokenModel::$COLUMN_EXPIRES_IN => (string) $xs->contents->expiresIn->attributes()->value,
			TokenModel::$COLUMN_ISSUED_ON => (string) $xs->contents->issuedOn->attributes()->value,
			TokenModel::$COLUMN_EXPIRES_ON => (string) $xs->contents->expiresOn->attributes()->value,
			TokenModel::$COLUMN_REFRESH_TOKEN => (string) $xs->contents->refreshToken->attributes()->value
		];
		$tokenId = $token->save($data);

		if($tokenId > 0) {
			echo 'success';
		} else {
			echo 'fail';
		}
	}
}