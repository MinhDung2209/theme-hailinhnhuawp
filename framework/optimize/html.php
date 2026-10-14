<?php
/*-----------------------------------------------------------------------------------*/
/*  Minify html output
/*-----------------------------------------------------------------------------------*/
	function minify_output($buffer) {
	    $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
	    $replace = array('>', '<', '\\1');
	    if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
	        $buffer = preg_replace($search, $replace, $buffer);
	    }
	    return $buffer;
	}
	ob_start("minify_output");

	function stripwhitespace($bff){
		$pzcr=0;
		$pzed=strlen($bff)-1;
		$rst="";
		while($pzcr<$pzed){
			$t_poz_start=stripos($bff,"<textarea",$pzcr);
			if($t_poz_start===false){
				$bffstp=substr($bff,$pzcr);
				$temp=stripBuffer($bffstp);
				$rst.=$temp;
				$pzcr=$pzed;
			}
			else{
				$bffstp=substr($bff,$pzcr,$t_poz_start-$pzcr);
				$temp=stripBuffer($bffstp);
				$rst.=$temp;
				$t_poz_end=stripos($bff,"</textarea>",$t_poz_start);
				$temp=substr($bff,$t_poz_start,$t_poz_end-$t_poz_start);
				$rst.=$temp;
				$pzcr=$t_poz_end;
			}
		}
		return $rst;
	}

	function stripBuffer($bff){
		/* carriage returns, new lines */
		$bff=str_replace(array("\r\r\r","\r\r","\r\n","\n\r","\n\n\n","\n\n"),"\n",$bff);
		/* tabs */
		$bff=str_replace(array("\t\t\t","\t\t","\t\n","\n\t"),"\t",$bff);
		/* opening HTML tags */
		$bff=str_replace(array(">\r<a",">\r <a",">\r\r <a","> \r<a",">\n<a","> \n<a","> \n<a",">\n\n <a"),"><a",$bff);
		$bff=str_replace(array(">\r<b",">\n<b"),"><b",$bff);
		$bff=str_replace(array(">\r<d",">\n<d","> \n<d",">\n <d",">\r <d",">\n\n<d"),"><d",$bff);
		$bff=str_replace(array(">\r<f",">\n<f",">\n <f"),"><f",$bff);
		$bff=str_replace(array(">\r<h",">\n<h",">\t<h","> \n\n<h"),"><h",$bff);
		$bff=str_replace(array(">\r<i",">\n<i",">\n <i"),"><i",$bff);
		$bff=str_replace(array(">\r<i",">\n<i"),"><i",$bff);
		$bff=str_replace(array(">\r<l","> \r<l",">\n<l","> \n<l",">  \n<l","/>\n<l","/>\r<l"),"><l",$bff);
		$bff=str_replace(array(">\t<l",">\t\t<l"),"><l",$bff);
		$bff=str_replace(array(">\r<m",">\n<m"),"><m",$bff);
		$bff=str_replace(array(">\r<n",">\n<n"),"><n",$bff);
		$bff=str_replace(array(">\r<p",">\n<p",">\n\n<p","> \n<p","> \n <p"),"><p",$bff);
		$bff=str_replace(array(">\r<s",">\n<s"),"><s",$bff);
		$bff=str_replace(array(">\r<t",">\n<t"),"><t",$bff);
		/* closing HTML tags */
		$bff=str_replace(array(">\r</a",">\n</a"),"></a",$bff);
		$bff=str_replace(array(">\r</b",">\n</b"),"></b",$bff);
		$bff=str_replace(array(">\r</u",">\n</u"),"></u",$bff);
		$bff=str_replace(array(">\r</d",">\n</d",">\n </d"),"></d",$bff);
		$bff=str_replace(array(">\r</f",">\n</f"),"></f",$bff);
		$bff=str_replace(array(">\r</l",">\n</l"),"></l",$bff);
		$bff=str_replace(array(">\r</n",">\n</n"),"></n",$bff);
		$bff=str_replace(array(">\r</p",">\n</p"),"></p",$bff);
		$bff=str_replace(array(">\r</s",">\n</s"),"></s",$bff);
		/* other */
		$bff=str_replace(array(">\r<!",">\n<!"),"><!",$bff);
		$bff=str_replace(array("\n<div")," <div",$bff);
		$bff=str_replace(array(">\r\r \r<"),"><",$bff);
		$bff=str_replace(array("> \n \n <"),"><",$bff);
		$bff=str_replace(array(">\r</h",">\n</h"),"></h",$bff);
		$bff=str_replace(array("\r<u","\n<u"),"<u",$bff);
		$bff=str_replace(array("/>\r","/>\n","/>\t"),"/>",$bff);
		$bff=ereg_replace(" {2,}",' ',$bff);
		$bff=ereg_replace("  {3,}",'  ',$bff);
		$bff=str_replace("> <","><",$bff);
		$bff=str_replace("  <","<",$bff);
		/* non-breaking spaces */
		$bff=str_replace(" &nbsp;","&nbsp;",$bff);
		$bff=str_replace("&nbsp; ","&nbsp;",$bff);
		/* Example of EXCEPTIONS where I want the space to remain
		between two form buttons at */
		/* <!-- http://websitetips.com/articles/copy/loremgenerator/ --> */
		/* name="select" /> <input */
		$bff=str_replace(array("name=\"select\" /><input"),"name=\"select\" /> <input",$bff);

		return $bff;
	}
	ob_start("stripwhitespace");

	function minify_output($buffer) {
	    $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
	    $replace = array('>', '<', '\\1');
	    if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
	        $buffer = preg_replace($search, $replace, $buffer);
	    }
	    return $buffer;
	}
	ob_start("minify_output");