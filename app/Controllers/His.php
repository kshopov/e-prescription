<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class His extends BaseController {

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
		$data = trim(file_get_contents('php://input'), true);
		
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
		$xml = trim(file_get_contents('php://input'), true);
	}
}