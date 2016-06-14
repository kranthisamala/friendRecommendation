<?php
    /**
    * Copyright (c) 2005 Richard Heyes (http://www.phpguru.org/)
    *
    * All rights reserved.
    *
    * This script is free software.
    */

    /**
    * PHP5 Implementation of the Porter Stemmer algorithm. Certain elements
    * were borrowed from the (broken) implementation by Jon Abernathy.
    *
    * Usage:
    *
    *  $stem = PorterStemmer::Stem($word);
    *
    * How easy is that?
    */

    class PorterStemmer
    {
        /**
        * Regex for matching a consonant
        * @var string
        */
        private static $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';


        /**
        * Regex for matching a vowel
        * @var string
        */
        private static $regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';


        /**
        * Stems a word. Simple huh?
        *
        * @param  string $word Word to stem
        * @return string       Stemmed word
        */
        public static function Stem($word)
        {
            if (strlen($word) <= 2) {
                return $word;
            }

            $word = self::step1ab($word);
            $word = self::step1c($word);
            $word = self::step2($word);
            $word = self::step3($word);
            $word = self::step4($word);
            $word = self::step5($word);

            return $word;
        }


        /**
        * Step 1
        */
        private static function step1ab($word)
        {
            // Part a
            if (substr($word, -1) == 's') {

                   self::replace($word, 'sses', 'ss')
                OR self::replace($word, 'ies', 'i')
                OR self::replace($word, 'ss', 'ss')
                OR self::replace($word, 's', '');
            }

            // Part b
            if (substr($word, -2, 1) != 'e' OR !self::replace($word, 'eed', 'ee', 0)) { // First rule
                $v = self::$regex_vowel;

                // ing and ed
                if (   preg_match("#$v+#", substr($word, 0, -3)) && self::replace($word, 'ing', '')
                    OR preg_match("#$v+#", substr($word, 0, -2)) && self::replace($word, 'ed', '')) { // Note use of && and OR, for precedence reasons

                    // If one of above two test successful
                    if (    !self::replace($word, 'at', 'ate')
                        AND !self::replace($word, 'bl', 'ble')
                        AND !self::replace($word, 'iz', 'ize')) {

                        // Double consonant ending
                        if (    self::doubleConsonant($word)
                            AND substr($word, -2) != 'll'
                            AND substr($word, -2) != 'ss'
                            AND substr($word, -2) != 'zz') {

                            $word = substr($word, 0, -1);

                        } else if (self::m($word) == 1 AND self::cvc($word)) {
                            $word .= 'e';
                        }
                    }
                }
            }

            return $word;
        }


        /**
        * Step 1c
        *
        * @param string $word Word to stem
        */
        private static function step1c($word)
        {
            $v = self::$regex_vowel;

            if (substr($word, -1) == 'y' && preg_match("#$v+#", substr($word, 0, -1))) {
                self::replace($word, 'y', 'i');
            }

            return $word;
        }


        /**
        * Step 2
        *
        * @param string $word Word to stem
        */
        private static function step2($word)
        {
            switch (substr($word, -2, 1)) {
                case 'a':
                       self::replace($word, 'ational', 'ate', 0)
                    OR self::replace($word, 'tional', 'tion', 0);
                    break;

                case 'c':
                       self::replace($word, 'enci', 'ence', 0)
                    OR self::replace($word, 'anci', 'ance', 0);
                    break;

                case 'e':
                    self::replace($word, 'izer', 'ize', 0);
                    break;

                case 'g':
                    self::replace($word, 'logi', 'log', 0);
                    break;

                case 'l':
                       self::replace($word, 'entli', 'ent', 0)
                    OR self::replace($word, 'ousli', 'ous', 0)
                    OR self::replace($word, 'alli', 'al', 0)
                    OR self::replace($word, 'bli', 'ble', 0)
                    OR self::replace($word, 'eli', 'e', 0);
                    break;

                case 'o':
                       self::replace($word, 'ization', 'ize', 0)
                    OR self::replace($word, 'ation', 'ate', 0)
                    OR self::replace($word, 'ator', 'ate', 0);
                    break;

                case 's':
                       self::replace($word, 'iveness', 'ive', 0)
                    OR self::replace($word, 'fulness', 'ful', 0)
                    OR self::replace($word, 'ousness', 'ous', 0)
                    OR self::replace($word, 'alism', 'al', 0);
                    break;

                case 't':
                       self::replace($word, 'biliti', 'ble', 0)
                    OR self::replace($word, 'aliti', 'al', 0)
                    OR self::replace($word, 'iviti', 'ive', 0);
                    break;
            }

            return $word;
        }


        /**
        * Step 3
        *
        * @param string $word String to stem
        */
        private static function step3($word)
        {
            switch (substr($word, -2, 1)) {
                case 'a':
                    self::replace($word, 'ical', 'ic', 0);
                    break;

                case 's':
                    self::replace($word, 'ness', '', 0);
                    break;

                case 't':
                       self::replace($word, 'icate', 'ic', 0)
                    OR self::replace($word, 'iciti', 'ic', 0);
                    break;

                case 'u':
                    self::replace($word, 'ful', '', 0);
                    break;

                case 'v':
                    self::replace($word, 'ative', '', 0);
                    break;

                case 'z':
                    self::replace($word, 'alize', 'al', 0);
                    break;
            }

            return $word;
        }


        /**
        * Step 4
        *
        * @param string $word Word to stem
        */
        private static function step4($word)
        {
            switch (substr($word, -2, 1)) {
                case 'a':
                    self::replace($word, 'al', '', 1);
                    break;

                case 'c':
                       self::replace($word, 'ance', '', 1)
                    OR self::replace($word, 'ence', '', 1);
                    break;

                case 'e':
                    self::replace($word, 'er', '', 1);
                    break;

                case 'i':
                    self::replace($word, 'ic', '', 1);
                    break;

                case 'l':
                       self::replace($word, 'able', '', 1)
                    OR self::replace($word, 'ible', '', 1);
                    break;

                case 'n':
                       self::replace($word, 'ant', '', 1)
                    OR self::replace($word, 'ement', '', 1)
                    OR self::replace($word, 'ment', '', 1)
                    OR self::replace($word, 'ent', '', 1);
                    break;

                case 'o':
                    if (substr($word, -4) == 'tion' OR substr($word, -4) == 'sion') {
                       self::replace($word, 'ion', '', 1);
                    } else {
                        self::replace($word, 'ou', '', 1);
                    }
                    break;

                case 's':
                    self::replace($word, 'ism', '', 1);
                    break;

                case 't':
                       self::replace($word, 'ate', '', 1)
                    OR self::replace($word, 'iti', '', 1);
                    break;

                case 'u':
                    self::replace($word, 'ous', '', 1);
                    break;

                case 'v':
                    self::replace($word, 'ive', '', 1);
                    break;

                case 'z':
                    self::replace($word, 'ize', '', 1);
                    break;
            }

            return $word;
        }


        /**
        * Step 5
        *
        * @param string $word Word to stem
        */
        private static function step5($word)
        {
            // Part a
            if (substr($word, -1) == 'e') {
                if (self::m(substr($word, 0, -1)) > 1) {
                    self::replace($word, 'e', '');

                } else if (self::m(substr($word, 0, -1)) == 1) {

                    if (!self::cvc(substr($word, 0, -1))) {
                        self::replace($word, 'e', '');
                    }
                }
            }

            // Part b
            if (self::m($word) > 1 AND self::doubleConsonant($word) AND substr($word, -1) == 'l') {
                $word = substr($word, 0, -1);
            }

            return $word;
        }


        /**
        * Replaces the first string with the second, at the end of the string. If third
        * arg is given, then the preceding string must match that m count at least.
        *
        * @param  string $str   String to check
        * @param  string $check Ending to check for
        * @param  string $repl  Replacement string
        * @param  int    $m     Optional minimum number of m() to meet
        * @return bool          Whether the $check string was at the end
        *                       of the $str string. True does not necessarily mean
        *                       that it was replaced.
        */
        private static function replace(&$str, $check, $repl, $m = null)
        {
            $len = 0 - strlen($check);

            if (substr($str, $len) == $check) {
                $substr = substr($str, 0, $len);
                if (is_null($m) OR self::m($substr) > $m) {
                    $str = $substr . $repl;
                }

                return true;
            }

            return false;
        }


        /**
        * What, you mean it's not obvious from the name?
        *
        * m() measures the number of consonant sequences in $str. if c is
        * a consonant sequence and v a vowel sequence, and <..> indicates arbitrary
        * presence,
        *
        * <c><v>       gives 0
        * <c>vc<v>     gives 1
        * <c>vcvc<v>   gives 2
        * <c>vcvcvc<v> gives 3
        *
        * @param  string $str The string to return the m count for
        * @return int         The m count
        */
        private static function m($str)
        {
            $c = self::$regex_consonant;
            $v = self::$regex_vowel;

            $str = preg_replace("#^$c+#", '', $str);
            $str = preg_replace("#$v+$#", '', $str);

            preg_match_all("#($v+$c+)#", $str, $matches);

            return count($matches[1]);
        }


        /**
        * Returns true/false as to whether the given string contains two
        * of the same consonant next to each other at the end of the string.
        *
        * @param  string $str String to check
        * @return bool        Result
        */
        private static function doubleConsonant($str)
        {
            $c = self::$regex_consonant;

            return preg_match("#$c{2}$#", $str, $matches) AND $matches[0]{0} == $matches[0]{1};
        }


        /**
        * Checks for ending CVC sequence where second C is not W, X or Y
        *
        * @param  string $str String to check
        * @return bool        Result
        */
        private static function cvc($str)
        {
            $c = self::$regex_consonant;
            $v = self::$regex_vowel;

            return     preg_match("#($c$v$c)$#", $str, $matches)
                   AND strlen($matches[1]) == 3
                   AND $matches[1]{2} != 'w'
                   AND $matches[1]{2} != 'x'
                   AND $matches[1]{2} != 'y';
        }
    }
    function removeCommonWords($input){
        // EEEEEEK Stop words
        $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
        return preg_replace('/\b('.implode('|',$commonWords).')\b/','',$input);
    }
    function autostem($post,$stemmed_text)
    {
        $post=removeCommonWords($post);
        $array=preg_split('/[\s]+/', $post );
        $result='';
        $j=0;
        for($i=0;$i<count($array);$i++)
        {
            $result = PorterStemmer::Stem($array[$i]);
            if(strrpos($stemmed_text,$result)===false)
            {
                $stemmed_text=$stemmed_text."".$result." ";
            }
        }
        return $stemmed_text;
    }
    //echo ( autostem("kranthi is very good boy and sexy",""));
?>