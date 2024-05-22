<?php
class EasyTemplate
{
    // Public variable ---------------------------------------------------------
    var $error = "";                // Last error message will be stored here
    
    // Private variables -------------------------------------------------------
    var $tags = array();            // The tag values pairs, as defined by assign()
    var $template_file = "";        // The template file
    
    /*
     *      void EasyTemplate(string template_file)
     *      Constructor - assign template_file to the class
     */
    function __construct($template_file)
    {
        // Basic check whether the template file exists or not, 
        // unfortunately, we can't return(false) in a constructor
        if(!file_exists($template_file))
        {
            $this->error = "The template file $template_file does not exist.";
        }
        
        // Assign template file
        $this->template_file = $template_file;
    }
    
    /*
     *      bool assign(string tag, string value)
     *      Assign a value for template tag
     *      Sets $this->error and returns false on error, returns true on success
     */
    function assign($tag, $value)
    {
        // If the supplied tag name is empty, bail out
        if(empty($tag))
        {
            $this->error = "Tag name is empty";
            return(false);
        }
        
        // Assign value to tag
        $this->tags[$tag] = $value;
        
        return(true);
    }
        
    /*
     *      mixed easy_parse()
     *      Return the parsed template as string
     *      Sets $this->error and returns false on error, or returns the parsed template on success
     */
    function easy_parse()
    {
        // Read in template file, suppress error messages
        $contents = @implode("", (@file($this->template_file)));

		$contents = htmlentities($contents);

		/***** JAVASCRIPT *****/
		function lang_javascript($javascript) {
			
			$patron = "/__\([\'|\"]+[\s\S]*?[\'|\"]+\)/im";
			
            // replace &#039; for '
            $javascript[0] = str_replace('&#039;', "'", $javascript[0]);

			preg_match_all($patron, $javascript[0], $coincidencias_javascript);
					
			foreach($coincidencias_javascript[0] as $key2 => $coincidencia){
				$label =  eval("return $coincidencia;");
				$javascript[0] = str_replace($coincidencia, "'".$label."'", $javascript[0]);
			}
			return $javascript[0];
			
		};
				
		$contents = preg_replace_callback ( htmlentities("/<script[\s\S]*?script>/im"), "lang_javascript", $contents);
		
		/**********************/

		/******* HTML *******/
		function lang_html($html) {
			
			$patron = "/__\([\'|\"]+[\s\S]*?[\'|\"]+\)/im";
			
            // replace &#039; for '
            $html[0] = str_replace('&#039;', "'", $html[0]);

			preg_match_all($patron, $html[0], $coincidencias_html);
					
			foreach($coincidencias_html[0] as $key2 => $coincidencia){
				$label =  eval("return $coincidencia;");
				$html[0] = str_replace($coincidencia, $label, $html[0]);
			}
			return $html[0];
			
		}
		
		$contents = preg_replace_callback ( htmlentities("/<body[\s\S]*?body>/im"), "lang_html", $contents);
		/********************/

		$contents = html_entity_decode($contents);

        // Loop through all assigned tag-value pairs
        foreach ($this->tags as $key => $value)
        {
            // Construct the template tag name 
            $tag = '{'.$key.'}';
            
            // Is there such a tag in the template?
            if(!strstr($contents, $tag))
            {
                $this->error = "Tag $tag not found in template ".$this->template_file.".";
                return(false);
            }

            if(empty($value)){
                $value="";
            }

            if(empty($tag)){
                $tag="";
            }


            if(gettype($tag)!=gettype($value)){
                
                if(gettype($tag)=='string'&&gettype($value)=='integer'){
                    $value=strval($value);
                }

                if(gettype($tag)=='integer'&&gettype($value)=='string'){
                    $tag=strval($tag);
                }    

                if(gettype($tag)=='string'&&gettype($value)=='array'){
                    $value=implode(",", $value);

                 
                }            

            }
            
            if(gettype($tag)==gettype($value)){
                // Replace the template tag with the respective value
                $contents = str_replace($tag, $value, $contents);
            }else{

                $time = date("d M Y H:i:s");
                $linenum = 175;
                $errmsg = "str_replace(".$tag." (".gettype($tag).")".", ".$value." (".gettype($value).")"." , contenido_html)";

               
            }
        }
    
        // Return the parsed template    
        return($contents);    
    }
    
    /*
     *      bool easy_print()
     *      Parse and print the current template
     *      Sets $this->error and returns false on error, returns true on success
     */
    function easy_print()
    {
        // Parse the template
        $ret = $this->easy_parse();
        
        // Error found?
        if($ret == false)
        {
            return(false);
        }
 
        // Output the parsed template       
        print($ret);
        
        return(true);
    }
}

/* $Id: EasyTemplate.inc.php,v 1.1 2000/06/15 18:04:19 tobias Exp $ */ 
?>