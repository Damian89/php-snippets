<?php
	class Helper {
		
		public static function compressCSSFile( $file )
		{
			if( $file == '' )
			{
				return '<!-- Could find CSS-File -->';
			}

			$buffer = "";
			$buffer .= file_get_contents($file);

			// Remove comments
			$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

			// Remove space after colons
			$buffer = str_replace(': ', ':', $buffer);

			// Remove whitespace
			$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
			$buffer = str_replace(';}','}',$buffer);
			// Write everything out
			return '<style type="text/css">'.$buffer.'</style>';
		}

		public static function compressHTMLoutput($buffer)
		{

	    $search = array(
	        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
	        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
	        '/(\s)+/s',       // shorten multiple whitespace sequences
	        '/<!--(.|\s)*?-->/s'
	    );

	    $replace = array(
	        '>',
	        '<',
	        '\\1',
	        ''
	    );

	    $buffer = preg_replace($search, $replace, $buffer);
	    return $buffer;

		}
	}
?>
