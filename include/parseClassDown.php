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
 *  One line per markdown
 * 
 *  each line must start at beginning of line 
 *      ex : # my text wrong
 *      ex :# my text good  
 * 
 *  each line must have a space between markdow tag and text to be interpreted.
 *      ex :#wrong  
 *      ex :# good
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
 * 
 */

class ParseClassedown
{
    # ~

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
                            "code"          =>'-', 
                            "p-standard-01" =>':',
                            "p tip imp"     =>'::',
                            "p-standard-02" =>'&',
                            "p tip warning" =>'&&'
                        );

    const START_TAG_SELECTOR = array("#"   => "<h1",
                                     "##"   => "<h2",
                                     "###"   => "<h3",
                                     "####"   => "<h4",
                                     "#####"   => "<h5",
                                     "######"   => "<h6",
                                     
                                     ">"   => "<blockquote><p",
                                     "-"   => "<pre><code",
                                     ":"   => "<p" , 
                                     "::"  => '<p class="tip imp"',
                                     "&"   => "<p",
                                     "&&"   => '<p class="tip warning"'
                                    );

    const END_TAG_SELECTOR = array(
                                    "#"   => "</h1",
                                    "##"   => "</h2",
                                    "###"   => "</h3",
                                    "####"   => "</h4",
                                    "#####"   => "</h5",
                                    "######"   => "</h6",
                                    ">"   => "</p></blockquote", 
                                    "-"   => "</code></pre", 
                                    ":"   => "</p", 
                                    "::"  => "</p",
                                    "&"   => "</p",
                                    "&&"   => "</p"
                                );

    /**
     * 
     * @param string $text 
     */
    function text($text)
    {
        # standardize line breaks 
        $text = str_replace(array("\r\n", "\r"), "\n", $text);

        # remove surrounding line breaks
        $text = trim($text, "\n");

        # split text into lines
        $lines = explode("\n", $text);
        //var_dump($lines);

        for ($i = 0 ; $i < count($lines) ; $i++){

            // on ne traite que les lignes avec selector valid
            if (!is_null($this->is_valid_starter_selector($lines[$i]))){

                $this->blocks[$i]["start"] = $i;
                $this->blocks[$i]["end"] = $this->findNextEmptyLine($lines, $i);


                // on recherche la fin de la clé 
                // c'est à dire une ligne vide
                // la fonction renvoie l'index de la ligne vide
               
                // @TODO le cas du p ne commence pas par un selector valide

                // @TODO le cas du code  commence à la ligne seulement



                $this->blocks[$i]["selector"] =  $this->extractValidSelector($lines[$i]);  
                
                $this->blocks[$i]["HtmlName"] =  $this->getNameSeletor($this->blocks[$i]["selector"]);   
                //deprecated
                //$this->blocks[$i]["multiplicator"] = $this->setMultiplicatorSelector($lines[$i]);

                // on recherche les classes déclarées si existantes     
                $this->blocks[$i]["class"] = $this->is_valid_class_selector($lines[$i],$i);
                $this->blocks[$i]["className"] = $this->extractClassName($lines[$i],$i);

                // starting tag 
                $this->blocks[$i]["htmlTagStart"] = $this::START_TAG_SELECTOR[$this->blocks[$i]["selector"]];
                 //ending tag   
                $this->blocks[$i]["htmlTagEnd"] = $this::END_TAG_SELECTOR[$this->blocks[$i]["selector"]];
                

                
                

                // close the tag with proper informations
                //deprecated
                // $this->blocks[$i]["htmlTagStart"] .= $this->ammendTagHtml($this->blocks[$i]["selector"],$this->blocks[$i]["multiplicator"]);    
                $this->blocks[$i]["htmlTagStart"] .= $this->addClassToHtmlSelector($i);    
                $this->blocks[$i]["htmlTagStart"] .= $this->closeTagHtml($this->blocks[$i]["selector"]);    
                $this->blocks[$i]["htmlTagEnd"] .= $this->closeTagHtml($this->blocks[$i]["selector"]);    



                // get the text without markdow tag    
                $this->blocks[$i]["text"] = $this->extractText($i,$lines[$i]);    


               //var_dump($this->blocks[$i]); 

            }else{//@ TODO not the right way to do this it's temporary

                if ($lines[$i] !== ""){
                    $this->blocks[$i]["htmlTagStart"] = "";
                    $this->blocks[$i]["text"] = $lines[$i];  
                    $this->blocks[$i]["htmlTagEnd"] = "";
                }
               
            }
                
        } 
        $this->outputHtml();
       //var_dump($this->blocks);
        
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
        }
        return $result;  
   }
    /**
     * 
     */
   function is_valid_class_selector($string, $index){
        // on veux trouver les deux dernier }} sur la ligne
        //var_dump($string);
        $Startpos = strpos($string,$this::START_CLASS);
        $Endpos = strpos($string,$this::END_CLASS);
        if ($Startpos!== false){
        $this->blocks[$index]['startPosClass'] = $Startpos;
        } 
        if ($Endpos!== false){
            $this->blocks[$index]['endPosClass'] = $Endpos;
        } 
        
        // si oui 
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

   function outputHtml(){
       foreach ($this->blocks as $block){
        echo    isset($block['htmlTagStart']) ? $block['htmlTagStart'] : '';
        echo    isset($block['text']) ? $block['text'] : '';
        echo    isset($block['htmlTagEnd']) ? $block['htmlTagEnd'] : '' ;

       }
   }
}