<?php

class Export {

    private $fsep;
    private $lsep;
    private $html;
    private $filename;
    private $encobj;

    function __construct() {
        global $encobj;
        $this->encobj = $encobj;
    }

    //intialiaze here class variables and functions
    public function setEncValues($encKey='', $algo='', $mode='') {
        $this->encobj->setkey($encKey);
        $this->encobj->setMode($mode);
        $this->encobj->setAlgo($algo);
        $iv_val = $this->encobj->setiv();
        return $iv_val;
    }

    /*
      public function Export($reqarr) {
      $this->fsep = ($reqarr['fieldsep'] != '')?$reqarr['fieldsep']:",";
      $this->lsep= ($reqarr['linesep'] != '')?$reqarr['linesep']:"\n";
      $this->filename= ($reqarr['filename'] != '')?$reqarr['filename']:'export.xls';
      $this->html = '';
      $this->fsep = str_replace(array('\r', '\n','\t'), array(chr(13), chr(10),chr(9)), $this->fsep);
      $this->lsep = str_replace(array('\r', '\n','\t'), array(chr(13), chr(10),chr(9)), $this->lsep);
      } */

    // GET THE FORMATED HTML FOR EXPORT
    public function GenerateFormat($fieldArr, $dataArr, $CallFunctionArr) {
        $html = '';
        if (count($fieldArr) > 0) {
            $i = 0;
            foreach ($fieldArr as $farr) {
                $html.=$farr;
                $i++;
                if ($i < count($fieldArr))
                    $html.=$this->fsep;
            }
            $html.=$this->lsep;

            foreach ($dataArr as $key => $data) {
                $j = 0;
                foreach ($fieldArr as $key1 => $val) {
                    if ($CallFunctionArr[$key1] != '') {
                        $objArr = @explode('->', $CallFunctionArr[$key1]);
                        $objName = $objArr[0];
                        $methodName = $objArr[1];
                        if (count($objArr) == 2) {
                            $val = @ call_user_method('' . $methodName . '', $$objName, $data[$key1]);
                        } else {
                            $val = @ call_user_func($objName, $data[$key1]);
                        }
                        $html.=$val;
                    } else {
                        $html.=$data[$key1];
                    }

                    $j++;
                    if ($j < count($fieldArr))
                        $html.=$this->fsep;
                }
                $html.=$this->lsep;
            }
        }
        $this->html = $html;
        return $html;
    }

    // GENERATE THE XlS FILE
    public function GenerateFile($type='D', $path='') {
        $day = date("Y-m-d_H-m-s");
        $this->filename = $this->filename . "_" . $day . ".xml";
        //echo $this->html;exit;
        switch ($type) {
            case "D":
                //echo $data;
                ob_clean();
                header("Content-type: application/text");
                header("Content-Disposition: attachment; filename=$this->filename");
                header("Pragma: no-cache");
                header("Expires: 0");
                ob_flush();
                print "$this->html";
                exit();
                break;
            case 'W':
                if (!$handle = fopen($path . $this->filename, 'wb+')) {
                    echo "Cannot open file ($path.$this->filename)";
                    exit;
                }
                // Write $somecontent to our opened file.
                if (fwrite($handle, $this->html) === FALSE) {
                    echo "Cannot write to file ($path.$this->filename)";
                    exit;
                } else {
                    fclose($handle);
                }
                break;
        }
        return $this->filename;
    }

    //Take Source Back Up and make a Zip file
    public function MakeZip($source_folder_path, $zip_path, $main_path=EXPORT_FILES_PATH) {

        $zip_folder_path = $source_folder_path;
        $day = date("Y-m-d_H-m-s");
        $zipfile = $zip_path . '_' . $day . '.tar.gz';
        //Prints($zipfile);
        //Prints($zip_folder_path);exit;
        //$zip_folder_path = 'exportaccount_2010-03-31_12-03-34.xml';
        $ss = exec('cd ' . $main_path . '; tar -czf ' . $zipfile . ' ' . $zip_folder_path);
        return $zipfile;
    }

    // DOWN LOAD THE FILE
    public function DownloadFles($path, $filname) {
        ob_clean();
        header('Content-type: application/download');
        header('Content-Disposition: attachment; filename=' . $filname);
        header('Pragma: public');
        ob_flush();
        readfile($path);
    }

    public function MakeXml($xmlArr, $TagArr, $repeat='', $Extrepeat='', $SExtrepeat='', $enc='') {
        $header = $xmlArr['Header'];
        $header_nospace = strtolower(str_replace(" ", "", $header));
        $ReqArr = $xmlArr['Arr'];
        $html = '';
        if (count($ReqArr) > 0) {
            foreach ($ReqArr as $rArr) {
                if ($header_nospace != '')
                    $html.='<' . $header_nospace . '>' . "\n";
                if (count($TagArr) > 0) {
                    foreach ($TagArr as $fKey => $fArr) {
                        $Attrheader = strtolower(str_replace(" ", "", $fKey));
                        $AttrvalArr = @explode(',', $fArr);
                        if (count($AttrvalArr) > 0) {
                            $Attrval = '';
                            foreach ($AttrvalArr as $val) {
                                $Attrval.=$rArr[$val] . " ";
                            }
                        }
                        $Attrval = (trim($Attrval) != '') ? trim($Attrval) : "-";
                        if ($val == 'iPurchaseOrderID') {
                            if ($Attrval < 1) {
                                // $Attrval = "no related po";
                            }
                        }
                        $html.='<' . $Attrheader . '>' . "\n";
                        if ($enc == 'y') {
                            $Attrval = $this->encobj->mencrypt($Attrval);
                            if ($val == 'iPurchaseOrderID') {

                            }
                        }
                        $html.= htmlentities($Attrval);
                        $html.='</' . $Attrheader . '>' . "\n";
                    }
                }
                if ($repeat != '') {
                    if ($repeat['CallFunc'] != '') {
                        $objArr = @explode('->', $repeat['CallFunc']);
                        $objName = $repeat['CallFunc'];

                        $methodName = $objArr[1];
                        $objectName = $objArr[0];
                        global $poObj;
                        //prints($poObj);exit;
                        $variables = @explode(',', $repeat['VariablePass']);
                        $varStr = '';
                        for ($v = 0; $v < count($variables); $v++) {
                            $varStr[$variables[$v]] = $rArr[$variables[$v]];
                        }
                        if (count($objArr) == 2) {
                            $val = call_user_func_array(array($poObj, '' . $methodName . ''), $varStr);
                            // Prints($val);exit;
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakeXml($RxmlArr, $RtagArr, '', '', '', $enc);
                            $html.= $html_rep;
                        } else {
                            $val = call_user_func($objName, $varStr);
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakeXml($RxmlArr, $RtagArr, '', '', '', $enc);
                            $html.= $html_rep;
                        }
                    }
                }
                if ($Extrepeat != '') {
                    if ($Extrepeat['CallFunc'] != '') {
                        $objArr = @explode('->', $Extrepeat['CallFunc']);
                        $objName = $Extrepeat['CallFunc'];
                        $methodName = $objArr[1];
                        $variables = @explode(',', $Extrepeat['VariablePass']);
                        $varStr = '';
                        for ($v = 0; $v < count($variables); $v++) {
                            $varStr[$variables[$v]] = $rArr[$variables[$v]];
                        }
                        if (count($objArr) == 2) {
                            $val = call_user_func_array(array($this, '' . $methodName . ''), array($varStr));

                            $ERxmlArr = array('Header' => $Extrepeat['Header'], 'Arr' => $val);
                            $ERtagArr = $Extrepeat['XmlTagArr'];
                            $html_exrep = $this->MakeXml($ERxmlArr, $ERtagArr, '', '', '', $enc);
                            //Prints($html_exrep);
                            $html.= $html_exrep;
                        } else {
                            $val = call_user_func($objName, $varStr);
                            $ERxmlArr = array('Header' => $Extrepeat['Header'], 'Arr' => $val);
                            $ERtagArr = $Extrepeat['XmlTagArr'];
                            $html_exrep = $this->MakeXml($RxmlArr, $RtagArr, '', '', '', $enc);
                            $html.= $html_exrep;
                        }
                    }
                }
                if ($SExtrepeat != '') {
                    if ($SExtrepeat['CallFunc'] != '') {
                        $objArr = @explode('->', $SExtrepeat['CallFunc']);
                        $objName = $SExtrepeat['CallFunc'];
                        $methodName = $objArr[1];
                        $variables = @explode(',', $SExtrepeat['VariablePass']);
                        $varStr = '';
                        for ($v = 0; $v < count($variables); $v++) {
                            $varStr[$variables[$v]] = $rArr[$variables[$v]];
                        }
                        if (count($objArr) == 2) {
                            $val = call_user_func_array(array($this, '' . $methodName . ''), array($varStr));
                            $SERxmlArr = array('Header' => $SExtrepeat['Header'], 'Arr' => $val);
                            $SERtagArr = $SExtrepeat['XmlTagArr'];
                            $html_exrep = $this->MakeXml($SERxmlArr, $SERtagArr, '', '', '', $enc);
                            //Prints($html_exrep);
                            $html.= $html_exrep;
                        } else {
                            $val = call_user_func($objName, $varStr);
                            $SERxmlArr = array('Header' => $SExtrepeat['Header'], 'Arr' => $val);
                            $SERtagArr = $SExtrepeat['XmlTagArr'];
                            $html_exrep = $this->MakeXml($SERxmlArr, $SERtagArr, '', '', '', $enc);
                            $html.= $html_exrep;
                        }
                    }
                }
                if ($header_nospace != '')
                    $html.='</' . $header_nospace . '>' . "\n";
            }
        }
        //$html.='</Dataroot>'."\n";
        return $html;
    }

    public function MakeCSV($xmlArr, $TagArr, $repeat='', $Extrepeat='', $SExtrepeat='', $csv='', $accComps='', $compmembers='', $enc='', $sep="\t") {
        global $smarty;
        $header = $xmlArr['Header'];
        $header_nospace = strtolower(str_replace(" ", "", $header));
        $ReqArr = $xmlArr['Arr'];
        $iv_val = (isset($ReqArr['ivval'])) ? $ReqArr['ivval'] : "";
        unset($ReqArr['ivval']);
        $content = "";
        //$cury = getcurrencysymbol();

        if ($enc == 'y') {
            if (trim($csv) != '') {
                $hdt = @explode(',', $csv);
                for ($ln = 0; $ln < count($hdt); $ln++) {
                    //Prints($hdt[$ln]);
                    $hdt[$ln] = $this->encobj->mencrypt($hdt[$ln]);
                    //$dc = $this->encobj->mdecrypt($hdt[$ln]);
                    //Prints($hdt);
                    //Prints($dc);
                    //exit;
                }
                if (is_array($hdt) && count($hdt) > 0) {
                    $hdt = @implode(',', $hdt);
                }
            }
            // $csv = $this->encobj->encrypt($csv);
            $hdt = str_replace(',', "$sep", $hdt);
            $content .= "$hdt" . "\n";
        } else {
            $csv = str_replace(',', "$sep", $csv);
            //Prints($csv);exit;
            if ($csv != '')
                $content .= "$csv" . "\n";
        }
        if (count($ReqArr) > 0) {
            for ($l = 0; $l < count($ReqArr); $l++) {
                $tl = 1;
                $loop = 0;
                // prints($ReqArr); exit;
                foreach ($TagArr as $key => $val) {
                    $ReqArr[$l][$val] = str_replace(',', '&sbquo;', $ReqArr[$l][$val]);
                    if ($tl != count($TagArr)) {
                        if ($enc == 'y') {
                            $content.= $this->encobj->mencrypt($ReqArr[$l][$val]) . "$sep";
                        } else {
                            $content.= $ReqArr[$l][$val] . "$sep";
                        }
                    } else {
                        if ($enc == 'y') {
                            $content.= $this->encobj->mencrypt($ReqArr[$l][$val]);
                        } else {
                            $content.= $ReqArr[$l][$val];
                        }
                    }
                    $loop++;
                }
                if ($repeat != '') {
                    if ($repeat['CallFunc'] != '') {
                        $objArr = @explode('->', $repeat['CallFunc']);
                        $objName = $repeat['CallFunc'];

                        $methodName = $objArr[1];
                        $objectName = $objArr[0];
                        global $poObj;
                        //prints($poObj);exit;
                        $variables = @explode(',', $repeat['VariablePass']);
                        $varStr = '';
                        for ($v = 0; $v < count($variables); $v++) {
                            $varStr[$variables[$v]] = $ReqArr[$l][$variables[$v]];
                        }
                        if (count($objArr) == 2) {
                            $val = call_user_func_array(array($poObj, '' . $methodName . ''), $varStr);
                            // Prints($val);exit;
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakeCSV($RxmlArr, $RtagArr, '', '', '', '', '', '', $enc, $sep);
                            //$content.= $html_rep;
                        } else {
                            $val = call_user_func($objName, $varStr);
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakeCSV($RxmlArr, $RtagArr, '', '', '', '', '', '', $enc, $sep);
                        }
                    }
                    $vl = 1;
                    if (isset($this->encobj) && $this->encobj != '') {
                        if (trim($html_rep) == $this->encobj->mencrypt('')) {
                            $vl = 0;
                        }
                    }
                    if (trim($html_rep) != '' && $vl != 0) {
                        if ($enc == 'y') {
                            $header = $this->encobj->mencrypt("###" . $repeat['Header'] . "###");
                        } else {
                            $header = "###" . $repeat['Header'] . "###";
                        }
                        $repeatSeparate = "\n" . $header . "";
                        $repeatHeadings = $repeat['repeatcsv'];
                        $content .= "$repeatSeparate";
                        if ($enc == 'y') {
                            $rh = @explode(',', $repeatHeadings);
                            for ($ln = 0; $ln < count($rh); $ln++) {
                                $rh[$ln] = $this->encobj->mencrypt($rh[$ln]);
                            }
                            $rh = @implode(',', $rh);
                            $repeatCsv = str_replace(',', "$sep", $rh);
                        } else {
                            $repeatCsv = str_replace(',', "$sep", $repeatHeadings);
                        }
                        $content .= "\n$repeatCsv\n";
                        $content.= $html_rep;
                    }
                }
                $content.= "\n";
            }
            // $content.= "\n";
        }
        /* if($enc == 'y') {
          $content .= "ivval".";".";".";".htmlentities($iv_val);
          $content.= "\n";
          } */
        // prints($content); exit;
        return $content;
    }

    public function MakePdf($xmlArr, $TagArr, $repeat='', $Extrepeat='', $SExtrepeat='', $csv='', $accComps='', $compmembers='', $enc) {
        global $smarty;
        $header = $xmlArr['Header'];
        $header_nospace = strtolower(str_replace(" ", "", $header));
        $ReqArr = $xmlArr['Arr'];
        $rptcsv = $repeat['repeatcsv'];
        $enc = "";
        if (trim($csv) != '') {
            $mheading = @explode(',', $csv);
        }
        //$cury = getcurrencysymbol();
        /* 		if($enc == 'y') {
          if(trim($csv) != '') {
          $hdt = @explode(',',$csv);
          for($ln=0;$ln<count($hdt);$ln++){
          $hdt[$ln] = $this->encobj->encrypt($hdt[$ln]);
          }
          if(is_array($hdt) && count($hdt)>0) {
          $hdt = @implode(',',$hdt);
          }
          }
          // $csv = $this->encobj->encrypt($csv);
          $hdt = str_replace(',',"\t",$hdt);
          $content .= "$hdt"."\n";
          } else {
          $csv = str_replace(',',"\t",$csv);
          //Prints($csv);exit;
          if($csv != '')
          $content .= "$csv"."\n";
          }
         */
        if (count($ReqArr) > 0 && is_array($ReqArr)) {
            for ($l = 0; $l < count($ReqArr); $l++) {
                if ($repeat == '') {
                    $content.= ( $l + 1) . ")" . "<br/>";
                } else {
                    $content.= "[" . ($l + 1) . "]" . "<br/>";
                }
                $tl = 1;
                $loop = 0;
                foreach ($TagArr as $key => $val) {
                    if ($tl != count($TagArr)) {
                        if ($enc == 'y') {
                            $content.= $this->encobj->mencrypt($mheading[$loop] . ": " . $ReqArr[$l][$val]) . "<br/>";
                        } else {
                            $content.= $mheading[$loop] . ": " . $ReqArr[$l][$val] . "<br/>";
                        }
                    } else {
                        if ($enc == 'y') {
                            $content.= $this->encobj->mencrypt($mheading[$l] . ": " . $ReqArr[$l][$val]) . "<br/>";
                        } else {
                            $content.= $mheading[$l] . ": " . $ReqArr[$l][$val] . "<br/>";
                        }
                    }
                    $loop++;
                }

                if ($repeat != '') {
                    if ($repeat['CallFunc'] != '') {
                        $objArr = @explode('->', $repeat['CallFunc']);
                        $objName = $repeat['CallFunc'];

                        $methodName = $objArr[1];
                        $objectName = $objArr[0];
                        global $poObj;
                        //prints($poObj);exit;
                        $variables = @explode(',', $repeat['VariablePass']);
                        $varStr = '';
                        for ($v = 0; $v < count($variables); $v++) {
                            $varStr[$variables[$v]] = $ReqArr[$l][$variables[$v]];
                        }
                        if (count($objArr) == 2) {
                            $val = call_user_func_array(array($poObj, '' . $methodName . ''), $varStr);
                            // Prints($val);exit;
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakePdf($RxmlArr, $RtagArr, '', '', '', "$rptcsv", '', '', $enc);
                            //$content.= $html_rep;
                        } else {
                            $val = call_user_func($objName, $varStr);
                            $RxmlArr = array('Header' => $repeat['Header'], 'Arr' => $val);
                            $RtagArr = $repeat['XmlTagArr'];
                            $html_rep = $this->MakePdf($RxmlArr, $RtagArr, '', '', '', "$rptcsv", '', '', $enc);
                        }
                    }

                    $vl = 1;
                    if (isset($this->encobj) && $this->encobj != '') {
                        if (trim($html_rep) == $this->encobj->mencrypt('')) {
                            $vl = 0;
                        }
                    }
                    if (trim($html_rep) != '' && $vl != 0) {
                        // if(trim($html_rep)!='' && trim($html_rep)!=$this->encobj->mencrypt('')) {
                        if ($enc == 'y') {
                            $header = $this->encobj->mencrypt($repeat['Header']);
                        } else {
                            $header = $repeat['Header'];
                        }
                        $repeatSeparate = "<br/>###" . $header . "###<br/>";
                        $repeatHeadings = $repeat['repeatcsv'];
                        // prints($repeatHeadings); exit;
                        $content .= "$repeatSeparate";
                        /* if($enc == 'y') {
                          $rh = @explode(',',$repeatHeadings);
                          for($ln=0;$ln<count($rh);$ln++) {
                          $rh[$ln] = $this->encobj->encrypt($rh[$ln]);
                          }
                          $rh = @implode(',',$rh);
                          $repeatCsv = str_replace(',',"\t",$rh);
                          } else {
                          $repeatCsv = str_replace(',',"\t",$repeatHeadings);
                          }
                          $content .= "\n$repeatCsv"; */
                        $content.= $html_rep . "<hr/>\n";
                    }
                }
                $content.= "<br/>";
            }
        }
        // prints($content); exit;
        return $content;
    }

    public function GenerateXml($content) {
        //$this->html  = $this->output_xml($content);
        $this->html = $content;
        $html = $this->html;
        return $html;
    }

    /**
     * Output content as XML
     *
     * @param string $content
     */
    public function output_xml($content) {
        header("Content-Type: application/xml; charset=UTF-8");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        print $content;
    }

}
?>