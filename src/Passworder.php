<?php namespace Lucasvdh\Passworder;

use SplFileObject;

/**
 * Credits to wingman
 */

class Passworder
{

	private $randCase = true;
	private $words = NULL;

	public function gen()
	{
		$word = $this->getWord();
		$string = $this->getString();

		$password = $this->inject($string, $word);

		$password = $this->inject($password, $this->getDelimeter());

		return str_replace(["\r", "\n"], '', $password);
	}

	private function inject($target, $string)
	{
		$rand_pos = mt_rand(0, strlen($target) - 1 );
		return substr($target, 0, $rand_pos) . $string . substr($target, $rand_pos);
	}

	private function getResult( $string, $word )
	{
		$delimeter = $this->getDelimeter();
		return $string.$delimeter.$word;
	}

	private function randomize($string)
	{
		$string = $this->ucase($string);
		$string = $this->numbers($string);

		return $string;
	}

	private function numbers($string)
	{
		if(config('passworder.add_numbers') !== true ) {
			return $string;
		}
		$chance = config('passworder.number_chance');
		if(!is_numeric($chance)) {
			return $string;
		}

		// commented, because not so friendly
		//# before
		//if(mt_rand(0, 10) < $chance ) {
		//    $string = mt_rand(0,9).$string;
		//}

		# after
		if(mt_rand(0, 10) < $chance ) {
			$string = $string.mt_rand(0,9);
		}

		return $string;
	}

	private function ucase($string)
	{
		if(config('passworder.random_uppercase') !== true) {
			return $string;
		}
		$chance = config('passworder.uppercase_chance');
		if(!is_numeric($chance)) {
			return $string;
		}

		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			if(mt_rand(0,10) < $chance) {
				$result .= mb_strtoupper($string[$i]);
			}
			else {
				$result .= $string[$i];
			}
		}

		return $result;
	}

	private function getDelimeter()
	{
		$delimeters = config('passworder.delimeters');
		return substr($delimeters, mt_rand(0, strlen($delimeters) - 1), 1 );
	}

	/**
	 * return random word from config array
	 * @return string
	 */
	private function getWord()
	{
		if($this->words == NULL) {
			$this->words = explode("\n",file_get_contents(config_path('wordset.txt')));
		}
		$word = trim($this->words[mt_rand(0, count($this->words)-1)]);
		return $this->randomize($word);
	}

	/**
	 * return random well-readable string
	 *
	 * @return string
	 */
	private function getString()
	{
		$consonants = 'bcdgkmnprst';
		$vowels = 'aeiou';
		$len = 6;

		$str = '';
		$c = $v = [];
		for( $x = 0; $x <= $len; $x++ ) {
			if(mt_rand(0, 1)) {
				$str .= substr( $consonants, mt_rand(0, strlen($consonants) - 1 ), 1 );
			}
			else {
				$str .= substr( $vowels, mt_rand(0, strlen($vowels) - 1 ), 1 );
			}
		}
		return $this->randomize($str);
	}
}
