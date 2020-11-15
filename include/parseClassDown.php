<?php
/** 
*
*
* ParseClassedown
* 
* a tiny markDown that handle a few selectors 
* we can add specific class to selector to match a custom design with css    
*
* 24/10/2020
* (c) jpb (rick)
* http://guitaresphere.com
* 
* For the full license information, view the LICENSE file that was distributed
* with this source code.
*
*
 * 
 *  v1.0.0 
 * 
 *  One line or multiLine per markdown
 * 
 *  each line must start at beginning of line 
 *      ex : # my text wrong
 *      ex :# my text good  
 * 
 *  each line must have a space between markdown tag and text to be interpreted.
 *      ex :#wrong  
 *      ex :# good
 *  
 * 
 * class can be added on fly  
 * 
 *   first method 
 *    implicit 
 *     the descriptor tag have some personnal class linked to markdown tag 
 *      :: on <p> give class="tip imp"
 *      && on <p> give class="tip warning"
 *      you have to declare on proper css file and include in desired html/php file
 * 
 *   seconde method
 *      explicit 
 *      at the end of line , you cann add the special tag {{}}  and 
 *      put some name class in it
 *      you can put un unlimited nombers of class. they have to be separated by space 
 *      ex :# my text {{ MyClass MyOtherClass }}
 * 
 *  multiLine  selectors
 * 
 *  ! , & , !! , &&  are multiline selectors
 *  they have to follow the monoline selector rule for starting point. 
 *  ex :! mytext good
 *  ex : ! mytext wrong
 * 
 *  each multiLine tag must be endded by his endtag  !/ , &/ , !!/ , &&/
 *  can be placed on  a text line or alone in separate line
 * 
 *  ex:! my text !/
 * 
 *  ex:! 
 *      my text !/
 * 
 *  ex:! 
 *      my text 
 *     !/
 * 
 *  WARNING :  multiLine and class Tag declaration  
 *  you have to always place class on first line of your multilineTag
 *  if you create a multiline tag with class contained on one line, you have to close tagMultine before tag class
 * 
 *  ex:! mytext !/ {{myclass myotherclass}}   
 * 
 *  ex: ! imp 1 {{tip imp}}
 *      2 imp text with explicit class
 *      3 imp text with explicit class
 *      !/
 * 
 */

 /**
  * update 0.0.1
  * 
  *  img handler
  *
  *   added monoline selector for img. 
  *   @[ space pathToImg
  *   the img selector will appear in bootstraps class="card-img-top"  
  *   feel free to write you own class if bootstrpas not implemented in your project 
  *     
  */
class ParseClassedown
{
    

    const version = '1.0.0';
    
    public $blocks = array();
    const  END_BRAKET = ">";
    const  START_CLASS = "{{";
    const  END_CLASS = "}}";
    const SELECTORS = array("header1"       =>'#',
                            "header2"       =>'##', 
                            "header3"       =>'###', 
                            "header4"       =>'####', 
                            "header5"       =>'#####', 
                            "header6"       =>'######', 
                            "quote"         =>'>', 
                            "code"          =>':', 
                            "p-standard-01" =>'!',
                            "p tip imp"     =>'!!',
                            "p-standard-02" =>'&',
                            "p tip warning" =>'&&',
                            "img"           =>'@['
                        );

    const END_SELECTORS = array(
                            ">"  => '>/', 
                            ":"  => ':/', 
                            "!"  => '!/',
                            "!!" => '!!/',
                            "&"  => '&/',
                            "&&" => '&&/',
                            "@[" => ']@' 
                        );

    const START_TAG_SELECTOR = array("#"   => "<h1",
                                     "##"   => "<h2",
                                     "###"   => "<h3",
                                     "####"   => "<h4",
                                     "#####"   => "<h5",
                                     "######"   => "<h6",
                                     
                                     ">"   => "<blockquote><p",
                                     ":"   => "<pre><code",
                                     "!"   => "<p" , 
                                     "!!"  => '<p class="tip imp"',
                                     "&"   => "<p",
                                     "&&"   => '<p class="tip warning"',
                                     "@[" => '<img class="card-img-top" '
                                    );

    const END_TAG_SELECTOR = array(
                                    "#"   => "</h1",
                                    "##"   => "</h2",
                                    "###"   => "</h3",
                                    "####"   => "</h4",
                                    "#####"   => "</h5",
                                    "######"   => "</h6",
                                    ">"   => "</p></blockquote", 
                                    ":"   => "</code></pre", 
                                    "!"   => "</p", 
                                    "!!"  => "</p",
                                    "&"   => "</p",
                                    "&&"   => "</p",
                                    "@[" => ""
                                );

   const Tooltips = array (
       "H" => "h1 to h6 click to add desired number.",
       "<>"=> "To be setted properly",
       "!"=> " a standard Paragraph <p> ex:  \n ! your text !/",
       "</>"=> "code pre can be inserted here like : your code :/",
       "#"=> "Draw a green  hashtag  before <p> ",
       "!alert"=> "draw vertical red line on <p>",
       "!warning"=> "draw vertical orange line on <p>",
       "quote" => "draw vertical green bar on Paragraph <p>  ex: > your quote >/",
   );
   
    /**
     * this is the main function for this lib
     * we can pass one line or multilines  as params
     * @param string $text 
     */
    function text($text,$ajax = false){
        # standardize line breaks 
        $text = str_replace(array("\r\n", "\r"), "\n", $text);

        # remove surrounding line breaks
        $text = rtrim($text, "\n");

        # split text into lines
        $lines = explode("\n", $text);
        
        $nbLines = count($lines);
       
        for ($i = 0 ; $i < $nbLines ; $i++){
            // we only work with line have valid starter selector
            if (!is_null($this->is_valid_starter_selector($lines[$i]))){
               // var_dump('valid selector');    
                $this->blocks[$i]["start"] = $i;

                //@TODO si multi c'est pas bon là . à deplacer 
                $this->blocks[$i]["end"] = $this->findNextEmptyLine($lines, $i);
 
                $this->blocks[$i]["selector"] =  $this->extractValidSelector($lines[$i]);  
               // var_dump($this->blocks[$i]["selector"]);
                $this->blocks[$i]["HtmlName"] =  $this->getNameSeletor($this->blocks[$i]["selector"]);
                // we looking for some class inline declaration 
                $this->blocks[$i]["class"] = $this->is_valid_class_selector($lines[$i],$i);
                $this->blocks[$i]["className"] = $this->extractClassName($lines[$i],$i);

                // starting tag 
                $this->blocks[$i]["htmlTagStart"] = $this::START_TAG_SELECTOR[$this->blocks[$i]["selector"]];
                
                //ending tag   
                $this->blocks[$i]["htmlTagEnd"] = $this::END_TAG_SELECTOR[$this->blocks[$i]["selector"]];
            
                // close the tag with proper informations
                $this->blocks[$i]["htmlTagStart"] .= $this->addClassToHtmlSelector($i);    
               
                // if img  text is the src on element <img src="..."
                if ($this->istagImg($i)){

                    $this->blocks[$i]["htmlTagStart"] .= $this->addSrcImgToSelector($i,$this->extractText($i,$lines[$i]));    
                } 

                $this->blocks[$i]["htmlTagStart"] .= $this->closeTagHtml($this->blocks[$i]["selector"]);  

                if (!$this->istagImg($i)){   
                    $this->blocks[$i]["htmlTagEnd"] .= $this->closeTagHtml($this->blocks[$i]["selector"]);    
                }
                
                // selector is a multiLine type ?
                if ($this->is_multiline_selector($this->blocks[$i]["selector"])){

                    // seek end selector 
                    $posEndTagClosure = $this->getEndTagClosureLineNumber($i,$lines);
                
                    // cancat each line contained in start and end tag multiSelector 
                    $this->blocks[$i]["text"] = $this->concatMultiLines($i,$posEndTagClosure,$lines,$this::END_SELECTORS[$this->blocks[$i]["selector"]]);   

                    // udpate $i with offset $posEndTagClosure  
                    $i = $posEndTagClosure + 1;    
                }else{

                    if (!$this->istagImg($i)){
                        // get the text without markdow tag    
                        $this->blocks[$i]["text"] = $this->extractText($i,$lines[$i]);    
                       // var_dump($this->blocks[$i]["text"]);
                    }
                }

            }else{//@ TODO not the right way to do this it's temporary
                if ($lines[$i] !== ""){
                    $this->blocks[$i]["selector"] = "no-selector";
                    $this->blocks[$i]["htmlTagStart"] = "<p>";
                    $this->blocks[$i]["text"] = $lines[$i];  
                    $this->blocks[$i]["htmlTagEnd"] = "</p>";
                }
            }
        } 
        if ($ajax){
            return $this->outputHtmlAjax(); 
        }else{
            $this->outputHtml(); 
        }     
    }
    /**
     * is the first car of line exist in valid selector
     * @param string $string line treated
     */
   function is_valid_starter_selector($string){
            
        $Tresult = explode(" ",$string);       
        if (in_array($Tresult[0],SELF::SELECTORS,true)){
            return array_search($Tresult[0], SELF::SELECTORS);
        }else{
            return null;
        }
        
    }   
   /**
    * 
    * @param array $lines 
    * @param int  $index  curernt index in lines traitement 
    */
   function findNextEmptyLine(array $lines,int $index){

        for ($i = $index ; $i < count($lines); $i++ ) {
                if ($lines[$i] == ""){
                    return $i;
                break;  
                }   
        }
   }
   /**
    *
    * @param string $line  
    */
   function extractValidSelector(string $line){
        // on cherche le premier espace dans la ligne
        $Tresult = explode(" ",$line);
        return $Tresult[0];
   }
   /**
    * 
    * @param string $selector 
    */
   function getNameSeletor($selector){
       return array_search ($selector,$this::SELECTORS );
   }
    /**
     * 
     * @param string $line  
     */
   function setMultiplicatorSelector(string $line){
        $firstCharacter = substr($line, 0, 1);
        $multiplicator = 0;
        $array = str_split($line);
        foreach ($array as $char) {
            if  ($char === $firstCharacter){
                $multiplicator++;
            }else{
                return $multiplicator;
            }
        }
        return $multiplicator;
   }
   /**
    * 
    */
   function ammendTagHtml($selector,$multiplicator){
        $result = '';  
        if ($selector == $this::SELECTORS['header']){
            $result .= $multiplicator; 
        }

      return $result; 
   }
   /**
    * 
    */
   function closeTagHtml($selector){  
       return $this::END_BRAKET;
   }
   /**
    * 
    */
   function addClassToHtmlSelector($index){
        
    if ($this->blocks[$index]['class']){
        return  ' class="'.$this->blocks[$index]['className'] .'"';
    }

    return '';
   }
   /**
    * extract markdown starting tag and class from line
    */
   function extractText($index,$line){
       // extracting start markdown Tag
        $result  =substr($line,strlen($this->blocks[$index]['selector']));

       // extraction class if exist 
        if  ($this->blocks[$index]['class']){
          $result = substr($result, 0, strpos($result, $this::START_CLASS));  
          $result = rtrim($result);
        }
        return $result;  
   }
    /**
     * 
     */
   function is_valid_class_selector($string, $index){
      
        $Startpos = strpos($string,$this::START_CLASS);
        $Endpos = strpos($string,$this::END_CLASS);
        if ($Startpos!== false){
        $this->blocks[$index]['startPosClass'] = $Startpos;
        } 
        if ($Endpos!== false){
            $this->blocks[$index]['endPosClass'] = $Endpos;
        } 
        
        return strpos($string,$this::START_CLASS) && strpos($string,$this::END_CLASS);
   } 
   /**
    * Extract class name from string 
    */
   function extractClassName($string,$index){
       if ($this->blocks[$index]['class']){
        return substr ( $string , ($this->blocks[$index]['startPosClass']+ 2), (($this->blocks[$index]['endPosClass']) - ($this->blocks[$index]['startPosClass'] + 2)));
       }
   }
   /**
    * 
    */
   function outputHtml(){
       foreach ($this->blocks as $block){
        echo    isset($block['htmlTagStart']) ? $block['htmlTagStart'] : '';
        echo    isset($block['text']) ? $block['text'] : '';
        echo    isset($block['htmlTagEnd']) ? $block['htmlTagEnd'] : '' ;
       }
   }

   function outputHtmlAjax(){
       $TblockText = [];
    foreach ($this->blocks as $index => $block){
        $TblockText[$index]= isset($block['htmlTagStart']) ? $block['htmlTagStart'] : '';
        $TblockText[$index]= isset($block['text']) ? $TblockText[$index] . $block['text'] : $TblockText[$index] . '';
        $TblockText[$index]=  isset($block['htmlTagEnd']) ? $TblockText[$index] . $block['htmlTagEnd'] : $TblockText[$index] . '' ;
    }
    return $TblockText;
}

   /**
    * 
    */
   function is_multiline_selector($selector){
   
       if ($selector == $this::SELECTORS['code'] 
            || $selector == $this::SELECTORS['quote'] 
            || $selector == $this::SELECTORS['p-standard-01'] 
            || $selector == $this::SELECTORS['p tip imp'] 
            || $selector == $this::SELECTORS['p-standard-02'] 
            || $selector == $this::SELECTORS['p tip warning'] 
        ){
            return true;
       }
       return false;
   }
   /**
    * 
    */
   function getEndTagClosureLineNumber(int $index, array &$lines){
       $nb = count($lines);
       $tag = $this->blocks[$index]['selector'];
       
        for ($i = $index ; $i < $nb ; $i++){
            $Tresult = explode(" ",$lines[$i]);
            $res =  in_array($this::END_SELECTORS[$tag],$Tresult);
        
            if ($res){
                return $i;
            break;
            }  
        }
        return $index;
   }
   /**
    * 
    */
   function extractEndMultiTag($line,$endSelector){
        // extracting text without end multiLine Tag from line 
        return substr( $line,0 ,strlen($line) -  strlen($endSelector ));
   }
   /**
    * 
    * @param int $index
    * @param int $posEndTagClosure
    * @param mixed &$lines
    * @param string $endSelector
    */
   function concatMultiLines( int $index,int  $posEndTagClosure,&$lines,string $endSelector){

        $lastLineNbElements = count(explode(" ",$lines[$posEndTagClosure]));
        $result = '';
        for ($i = $index; $i <= $posEndTagClosure ;$i++){
            // first line , we remove entry tag 
            if ($i == $index){
                $result = $this->extractText($i,$lines[$i]);
    
                if ($posEndTagClosure == $i){
                    $result = $this->extractEndMultiTag($result,$endSelector);
                }
            }else
            // are we on last line ?
            if ($i == $posEndTagClosure){
                // is there text before End Tag ? 
                if ($lastLineNbElements > 1 ){
                        // extract end tag from text
                    $result .= "</br>". $this->extractEndMultiTag($lines[$posEndTagClosure],$endSelector) ;  
                }
            }else{
                if ($i <> $index){
                    $result .= '</br>';    
                }
                $result .= $lines[$i];
            }
        }    
        return $result;
   }  

   /**
    * 
    */
    public function istagImg($index){
            return $this->blocks[$index]["selector"] == $this::SELECTORS['img'] ;
    }

    /**
     * 
     */
    public function addSrcImgToSelector($index,$src){
            return  ' src="'.$src .'"'; 
    }
}