<?php

namespace App\Validation;

use App\Models\DoctorModel;

class UserRules {

    private $uinSpecArray = array(
        '01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
        '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
        '21', '22', '23', '24', '25', '26', '27', '28', '29'
    );

    private $EGN_WEIGHTS = array(2,4,8,5,10,9,7,3,6);

    public function verifiedUser(string $str, string $fields, $data)
    {
        $doctorModel = new DoctorModel();
        $doc = $doctorModel->where('email', $data['email'])
                           ->where('is_verified', DoctorModel::$STATUS_VERIFIED)
                           ->first();
        return isset($doc['ID']) ? true : false;
     }

    public function validateUser(string $str, string $fields, $data) {
        $user = $this->getUser($data);
        if(!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }

    public function validateUIN(string $str, string $fields, $data)
    {
        return in_array(substr($data['uin'], 0, 2), $this->uinSpecArray);
    }

    public function validateCyrillic(string $str, string $fields, $data) {
        if (empty($str)) {
            return true;
        }
        return preg_match ('/^[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ-]+$/', $str) == 1 ? true : false;
    }

    public function validEGN(string $str, string $fields, $data) {
		if (strlen($data['inputIdent']) != 10)
			return false;
		$year = substr($data['inputIdent'],0,2);
		$mon  = substr($data['inputIdent'],2,2);
		$day  = substr($data['inputIdent'],4,2);

		if ($mon > 40) {
			if (!checkdate($mon-40, $day, $year+2000)) return false;
		} else
		if ($mon > 20) {
			if (!checkdate($mon-20, $day, $year+1800)) return false;
		} else {
			if (!checkdate($mon, $day, $year+1900)) return false;
		}

		$checksum = substr($data['inputIdent'],9,1);

		$egnsum = 0;

		for ($i=0;$i<9;$i++)
			$egnsum += substr($data['inputIdent'],$i,1) * $this->EGN_WEIGHTS[$i];

		$valid_checksum = $egnsum % 11;
		if ($valid_checksum == 10)
			$valid_checksum = 0;

        return $checksum == $valid_checksum ? true : false;
    }

    public function between(string $str, string $fields, $data) {
        return $data['inputAge'] >= 1 && $data['inputAge'] <= 120 ? true : false;
    }
    
    public function validateBirthdate($date) {
        $format = 'Y-m-d';
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    private function getUser($data) {
        $model = new DoctorModel();
        return $model->where('email', $data['email'])->first();
    }

    
}