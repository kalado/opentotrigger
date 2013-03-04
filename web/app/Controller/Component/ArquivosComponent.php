<?php
class ArquivosComponent extends Component{
      var $sub_diretorio;
      var $tabela;
      var $campo;//campo do form, não da tabela
      private $diretorio_fixo; //caminho padrão basico .../webroot/files
      private $diretorio_destino; //caminho do diretorio do para aonde sera movido os arquivos
      private $destino;
      private $arquivo;

      function ArquivosComponent(){
            $this->diretorio_fixo= APP.WEBROOT_DIR.DS;
            //$this->diretorio_fixo= APP.WEBROOT_DIR.DS."img".DS."files".DS;
            $this->sub_diretorio = "";
            $this->campo = "arquivo";
      }

       function upload($tabela = "" ,$campo = "",$sub_diretorio="", $descompactar = false){
            //se passar o subdiretorio como parametro ele tambem faz upload para esse subdiretorio
            $this->setBasicos($tabela,$campo,$sub_diretorio);
            $this->arquivo = $_FILES['data'];
            //print_r($this->arquivo['name'][$this->tabela][$this->campo]);
            if($this->arquivo['name'][$this->tabela][$this->campo] == ""){
                  return "";
            }
            //cria o diretorio destino, tendo em vista que se não for setado manualmente o diretorio destino serra o ...webroot/img/files/ (diretorio_fixo)
            if(!file_exists($this->diretorio_destino)){
                  mkdir($this->diretorio_destino);
            }
            $this->renomear();
            move_uploaded_file($this->arquivo['tmp_name'][$this->tabela][$this->campo],$this->diretorio_destino.$this->arquivo['name'][$this->tabela][$this->campo]);
            if($descompactar){
                  $this->descompactar();
                  //$this->deletar("files".DS.$this->sub_diretorio.$this->arquivo['name'][$this->tabela][$this->campo]);
                  return "files".DS.$this->sub_diretorio;
            }
            return "files".DS.$this->sub_diretorio.$this->arquivo['name'][$this->tabela][$this->campo];
       }

      function deletar($dir){
            if($dir == "")return;
            if(!eregi(APP.WEBROOT_DIR.DS."img".DS,$dir)){
                  $dir=APP.WEBROOT_DIR.DS."img".DS.$dir;
            }
            if(is_dir($dir)){
                  if($handle = opendir($dir)){
                        while(false !== ($file = readdir($handle))) {
                              if(($file == ".") or ($file == "..")){
                                    continue;
                              }
                              if(is_dir($dir . $file)) {
                                    $this->deletar($dir . $file . "/");
                              } else {
                                    unlink($dir . $file);
                              }
                        }
                  }else{
                        return false;
                  }
                  // fecha a pasta aberta
                  closedir($handle);
                  // apaga a pasta, que agora esta vazia
                  rmdir($dir);
                  return true;
            }else if(is_file($dir)){
                  return unlink($dir);
            }else {
                  return false;
            }
      }

      function  gerarTumb($filename , $new_width = 120 , $new_height = 100){
            #pegar o nome da imagem que será salvo mais tarde
            $nome = explode("/", $filename);
            $nome = $nome[count($nome)-1];
            $filename = $nome;
            #pegando as dimensoes reais da imagem, largura e altura
            list($width, $height) = getimagesize($this->diretorio_destino.$filename);

            #gerando a a miniatura da imagem
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($this->diretorio_destino.$filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            #o 3º argumento é a qualidade da miniatura de 0 a 100
            imagejpeg($image_p, $this->diretorio_destino."TUMB_".$nome , 100);
            imagedestroy($image_p);
            $endereco = explode("/img/", $this->diretorio_destino."TUMB_".$nome);
            return $endereco[1];
      }

      function getArquivos($dir){
            //essa função retorna todos arquivos dentro de um diretorio
            $dir_relativo = $dir;
            if($dir == "")return;
            if(!eregi(APP.WEBROOT_DIR.DS."img".DS,$dir)){
                  $dir=APP.WEBROOT_DIR.DS."img".DS.$dir;
            }
            if(is_dir($dir)){
                  if($handle = opendir($dir)){
                        while(false !== ($file = readdir($handle))) {
                              if(($file == ".") or ($file == "..") or ($file == ".svn") or ($file == "__MACOSX") ) {
                                    continue;
                              }
                              $arquivos[] = $file; //caminho absoluto do arquivo
                        }
                  }else{
                        return false;
                  }
                  // fecha a pasta aberta
                  closedir($handle);
                  sort($arquivos);
                  return $arquivos;
            }
            return false;
      }

      function gerarCSV($dados,$colunas = ""){
            //descobrindo o nome da Tabela
            $tabela = $this->getTable($dados);
            if(!is_array($colunas))$colunas = $this->getCampos($dados);
            $csv = "";
            $x = count($colunas);
            foreach($colunas as $coluna){
                  $csv .= $coluna;
                  $x--;
                  if($x != 0){
                        $csv .= ";";
                  }
            }
            $csv .= "\n";
            foreach ($dados as $dado){
                  $x = count($colunas);
                  foreach($colunas as $coluna){
                        $csv .= $dado[$tabela][$coluna];
                        $x--;
                        if($x != 0){
                              $csv .= ";";
                        }
                  }
                  $csv .= "\n";
            }
            return $csv;
      }

      function  gerarArquivo($nome,$conteudo){
            $file = fopen($this->diretorio_fixo.$nome, "w");
            fwrite($file,$conteudo);
            fclose($file);
            return $this->diretorio_fixo.$nome;
      }


      private function getTable($dado){
            if(isset($dado[0])){
                  $dado = $dado[0];
            }
            $dado = array_keys($dado);
            return $dado[0];
      }

      private function getCampos($dados){
            $tabela = $this->getTable($dados);
            if(!isset($dados[0])){
                  $dados[0] = $dados;
            }
            $campos = array_keys($dados[0][$tabela]);
            return $campos;
      }


      private function removerAcento($str){
            $replace_pairs = array(
                              " "=>"_",
                              "ã"=>"a",
                              "à"=>"a",
                              "á"=>"a",
                              "â"=>"a",
                              "é"=>"e",
                              "ê"=>"e",
                              "í"=>"i",
                              "ó"=>"o",
                              "õ"=>"o",
                              "ô"=>"o",
                              "ú"=>"u",
                              "ü"=>"u",
                              "ç"=>"c",
                              "!"=>"",
                              "@"=>"",
                              "#"=>"",
                              "$"=>"",
                              "%"=>"",
                              "^"=>"",
                              "&"=>"",
                              "*"=>"",
                              "("=>"",
                              ")"=>"",
                              "+"=>"",
                              "="=>"",
                              "|"=>"",
                              "\\\\"=>"",
                              "'"=>"",
                              "{"=>"",
                              "}"=>"",
                              "["=>"",
                              "]"=>"",
                              ":"=>"",
                              ";"=>"",
                              "\\\""=>"",
                              "?"=>"",
                              "/"=>"",
                              "?"=>"",
                              "."=>"",
                              ">"=>"",
                              "<"=>"",
                              ","=>"",
                            );
            return strtolower(strtr($str, $replace_pairs));
      }

      private function descompactar(){
            $arquivo = $this->arquivo['name'][$this->tabela][$this->campo];
            $dir = $dir=APP.WEBROOT_DIR.DS."img".DS."files".DS.$this->sub_diretorio;
            chmod ($dir.$arquivo, 0777);
            $ext = $this->getExt($arquivo);
            $this->escolha($dir,$arquivo,$ext);
      }

      private function setBasicos($tabela,$campo,$sub_diretorio){
      //cria o caminho do local onde o arquivo vai ser colocado
      if($sub_diretorio != ""){
            $this->sub_diretorio = $sub_diretorio;
            if($this->sub_diretorio[0] == DS)$this->sub_diretorio[0] = "";
            if($sub_diretorio[strlen($sub_diretorio)-1] != DS)$this->sub_diretorio .= DS;
      }
      $this->diretorio_destino = $this->diretorio_fixo.$this->sub_diretorio;
      //seta a tabela
      if($tabela != "")$this->tabela = $tabela;
      if($campo != "")$this->campo = $campo;
      }

      private function renomear(){
            $nome = $this->arquivo['name'][$this->tabela][$this->campo];
            $ext = $this->getExt($nome);
            $no_ext = $this->removerAcento(substr($nome, 0, ((strlen($ext)+1)*(-1))));
            $x = 0;
            $nome = $no_ext.".".$ext;
            while(file_exists($this->diretorio_destino.$nome)){
                  $x++;
                  $nome = $no_ext.$x.".".$ext;
            }
            $this->arquivo['name'][$this->tabela][$this->campo] = $nome;
      }

      private function getExt($nome){
            $nome = explode(".", $nome);
            return $nome[count($nome)-1];
      }

      private function escolha($dir , $arquivo , $ext){
            switch($ext){
                  case "zip":
                        $this->descompactarZip($dir,$arquivo);
                        break;
                  case "rar":
                        $this->descompactarRar($dir,$arquivo);
                        break;
                  default:
                        $this->descompactarZip($dir,$arquivo);
                        break;
            }
      }
      
      private function descompactarZip($dir , $arquivo){
            App::import('Lib', 'Zip');
            $zipFile = new Zip($dir.$arquivo);
            if(!$zipFile->hasErrors())
            {
               $zipFile->extract(); // Se não passar parâmetro, extrai pro mesmo diretório
               unlink($dir.$arquivo);
            }else{
                        print_r($zipFile->getFilenames());
                        echo "<br />";
                        print_r($zipFile->getErrorMessage());
            }

      }
}











// classe auxiliar para descompactar os arquivos
class Zip extends Object
    {
        private $_file;
        private $_errors = false;
        private $_dirName;
        private $_extracted = array();

        public function __construct($path)
        {
            parent::__construct();
            $this->_file = new File($path);
            if(!$this->_file->readable())
            {
                $this->_errors = 1;
            }
            else
            {
                $out = $this->testFile();
                if(stripos($out, "End-of-central-directory signature not found") !== false)
                {
                    $this->_errors = 2;
                }
                elseif(stripos($out, "No errors detected") === false)
                {
                    $this->_errors = 3;
                }
            }
            $this->_dirName = $this->_file->Folder->pwd();
        }

        public function __destruct()
        {
            $this->_file->close();
        }

        public function testFile()
        {
            exec("unzip -tq ".$this->_file->pwd(), $out);
            return join('', $out);
        }

        public function hasErrors()
        {
            return (bool)$this->_errors;
        }

        public function getErrorMessage()
        {
            switch($this->_errors)
            {
                case false:
                    return false;
                case 1:
                    return __('O arquivo não pôde ser aberto para leitura. Cheque as permissões.', true);
                case 2:
                    return __('O arquivo não é do tipo ZIP.', true);
                default:
                    return __('Ocorreu um erro ao abrir o arquivo.', true);
            }
        }

        public function extract($destination = null)
        {
            if(!$destination)
            {
                $destination = $this->_dirName;
            }
            exec("unzip -d $destination -o ".$this->_file->pwd(), $out, $ret);
            if($ret === 0)
            {
                array_shift($out);
                $this->buildFilenames($out, $this->_extracted);
                return true;
            }
            return false;
        }

        private function buildFilenames($outArr, &$extractedArr, $i = 0, $dirName = null)
        {
            for($j = count($outArr); $i < $j; ++$i)
            {
                if(($pos = stripos($outArr[$i], 'inflating: ')) !== false)
                {
                    $filename = trim(substr($outArr[$i], 11+$pos));
                    if($dirName && stripos($filename, $dirName) === false)
                    {
                        return;
                    }
                    $extractedArr[] = $filename;
                }
                elseif(($pos = stripos($outArr[$i], 'creating: ')) !== false)
                {
                    $dn = basename(trim(substr($outArr[$i], 10+$pos)));
                    $extractedArr[$dn] = array();
                    $this->buildFilenames($outArr, $extractedArr[$dn], ++$i, $dn);
                }
            }
        }

        public function getFilenames()
        {
            return $this->_extracted;
        }
    };
?>
