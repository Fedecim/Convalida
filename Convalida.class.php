<?php
class Convalida{

    private $valido = false;//rappresenta se il dato di input e' stato convalidato
    private $errori = array();//rappresenta elenco di messaggi di  errore

    //metodo principale che convalida l'input in ingresso da un form html
    //$input = array associativo con input da convalidare
    //$parametri = array associativo con regole per la convalida
    //esempio di utilizzo/funzionamento:
    /*
        FORM HTML
        <form>
            <input type="text" name="email">
            <input type="submit">
        </form>

        UTILIZZO OGGETTO:
        $convalida = new Convalida();
        $verifica = $convalida->check($_POST, array(
            'email' => array(
                'required' => true,
                'mailcheck' => true
            )
        ));
        //come primo parametro passo direttamente la var php $POST
        //secondo parametro regole array:
        //la chiave deve essere uguale al name dell input
        //all'interno inserire le regole di convalida ad esempio true.
    */
    public function check($input,$parametri = array()){
        //inizio ciclo array paramentri con regole di validazione
        foreach($parametri as $chiave=>$regole){
            //chiave contiene il nome associato al 'name' dell input del form html
            //regole contiene l'array con le regole di convalida
            
            //'ripulisco' la stringa arrivata in input da esaminare da eventuali tag html e spazi bianchi:
            $stringa = htmlspecialchars(trim($input[$chiave]),ENT_QUOTES,'UTF-8');
            //inizio a scorrere array con regole
            foreach($regole as $regola=>$valore_regola){
                switch($regola){
                    //richiesto : il parametro inserito come input deve essere per forza inserito
                    case 'required':
                        if(empty($stringa)){
                            $this->add_error('Errore, il parametro: '.$chiave." e' richiesto.");
                        }
                        break;
                        //il parametro deve avere una lunghezza minima di caratteri
                    case 'length_min':
                        if(strlen($stringa) < $valore_regola){
                            $this->add_error("Errore, il parametro:".$stringa." deve contenere minimo: ".$valore_regola." caratteri.");
                        }
                        break;
                        //il parametro deve avere una lunghezza massima di caratteri
                    case 'length_max':
                        if(strlen($stringa) > $valore_regola){
                            $this->add_error('Errore, la stringa puo contenere massimo : '.$valore_regola." caratteri.");
                        }
                        break;
                        //il parametro deve essere una email valida
                    case 'mailcheck':
                        if(!filter_var($stringa, FILTER_VALIDATE_EMAIL)){
                            $this->add_error('Errore, la mail: '.$stringa."non e' una email valida.");
                        }
                        break;
                        //il parametro deve essere composto solo da numeri da 0 a 9 
                        //e' ammesso il '+' (per esempio per i numeri di telefono: +39)
                    case 'numeri':
                        if(!ctype_digit(str_replace('+','',$stringa))){
                            $this->add_error('Errore, il parametro: '.$chiave." accetta solo caratteri numerici da 0-9 incluso +.");
                        }
                        break;
                        //il parametro deve essere composto solo da caratteri alfabetici dalla A-Z
                        //sono ammessi spazi bianchi e carattere : " ' "
                    case 'alphabetic':
                        if(!ctype_alpha(str_replace(array(' ',"'"),'',$stringa))){
                            $this->add_error('Errore, il parametro: '.$chiave." accetta solo caratteri alfabetici inclusi: ',' e spazi bianchi.");
                        }
                        break;
                        //il parametro ammette solo caratteri alfanumerici da 0 - 9 e da A - Z non sono ammessi caratteri speciali
                    case 'alfanumerico':
                        if(!ctype_alnum($stringa)){
                            $this->add_error('Errore, il parametro: '.$chiave." accetta solo caratteri alfanumerici da 0-9, A-Z.");
                        }
                        break;
                        //il parametro non puo essere uguale ad alcune parole vietate
                    case 'blacklist':
                        foreach($valore_regola as $parola_vietata){
                            if($stringa == $parola_vietata){
                                $this->add_error('Errore, la parola : '.$chiave." non puo essere utilizzata(blacklist).");
                            }
                        }
                        //il parametro puo essere uguale sono ad alcune parole ammesse
                    case 'whitelist':
                        $trovata = false;
                        foreach ($valore_regola as $parola_approvata) {
                            if($stringa == $parola_approvata){
                                $trovata = true;
                                break;
                            }
                        }
                        if(!$trovata)
                        {
                            $this->add_error('Errore, la parola : '.$chiave." non puo essere utilizzata(solo whitelist).");
                        }
                    }
                }
            }
            //se l'array membro della classe : errori e' vuoto : l'input viene approvato la funzione ritorna true
            if(empty($this->errori)){
                $this->valido = true;
                return true;
            }
            //altrimenti se l'array : errori contiene elemento/i ritorna false l'input non è stato convalidato
            return false;
        }

    public function errori(){ return $this->errori; }// restituisce array associativo con elenco errori
    public function valido(){ return $this->valido; } // e' uguale a  true se l'input e valido altrimenti e' = false

    //PRIVATE
    private function add_error($errore){ $this->errori[] = $errore; }

}
?>