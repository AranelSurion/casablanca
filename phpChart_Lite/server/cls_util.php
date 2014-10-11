<?php    
class C_Utility_pC
	{  	  	  	  	
	public static function add_slashes($str)
		{   
		if (get_magic_quotes_gpc() == 1) 
			{   
			return ($str);
			}
		else
			{
			return (addslashes($str));
			}  	
		}  	  	  	
	public static function indent_json($json) 
		{    
		$result = '';
		$pos = 0;
		$strLen = strlen($json);
		$indentStr = '  ';
		$newLine = "\n";
		for($i = 0; $i <= $strLen; $i++) 
			{         
			$char = substr($json, $i, 1); 
			if($char == '}' || $char == ']')
				{
				$result .= $newLine;   $pos --;
				for ($j=0; $j<$pos; $j++) 
					{
					$result .= $indentStr;   
					}   
				}         
				$result .= $char; 
			if ($char == '{' || $char == '[') 
				{
				$result .= $newLine;
			if ($char == '{' || $char == '[') 
				{   
				$pos ++;
				}   
				for ($j = 0; $j < $pos; $j++) 
					{
					$result .= $indentStr;
					}   
				}   
			}     
		return $result;
		}  	  	  	
	public static function literalBool($boolValue)
		{
		return ($boolValue)?'true':'false';
		}
	}
?>