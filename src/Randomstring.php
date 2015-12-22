<?php

namespace monodesigns;

class Randomstring
{
	public static $upper  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	public static $lower  = 'abcdefghijklmnopqrstuvwxyz';
	public static $number = '1234567890';
	public static $symbol = '!#%&()*+,-./~:;<=>?@^_`{|}';
	public static $hex    = '1234567890abcdef';

	/**
	 * Generate random strings.
	 * @param  array $params overwrite defaults
	 * @return  string
	 */
	public static function generate(array $params = array())
	{
		$defaults = [
			'length' => 6,
			'types' => 'upper lower number', // all, upper, lower, number, symbol - space separated
			'hex' => false,
			'custom' => ''
		];
		
		$params = array_merge($defaults, $params);

		if($params['types'] == 'all') {
			$params['types'] = 'upper lower number symbol';
		}

		$types = explode(' ', $params['types']);
		$charstring = '';

		foreach($types as $type) {
			$charstring .= self::$$type;
		}

		if($params['custom']) {
			$charstring .= $params['custom'];
		}

		if($params['hex']) {
			$charstring = self::$hex;
		}

		$chararray = str_split($charstring);

		$randomstring = '';

		for ($i = 0; $i <= $params['length'] - 1; $i++) {
            $randomstring .= $chararray[mt_rand(0, strlen($charstring) - 1)];
        }

        return $randomstring;
	}
}