<?php

class MenusComponent extends Component {

    function MenusComponent() {
        
    }

    private function ModelRegistre($modelName) {
        eval("\$this->" . $modelName . " = ClassRegistry::init('" . $modelName . "');");
    }

    function MenuSerieADMIN($serie_id) {
        $this->ModelRegistre('Anime');
        $this->ModelRegistre('Serie');

        $animes = $this->Anime->find('all', array('conditions' => array('Anime.serie_id' => $serie_id)));

        /*
          Ainda tenho que pensar na forma de ordenação
          quem saber exibir

          (Multimida)Nome do Anime


         */


        // -anime 1 (id - nome_unidade)
        // -anime 2
        // -anime 3
        // -manga 1
        // -manga 2
        // -OVA 1
        // -filme 1
        // -filme 2
        // -filme 3
        // -filme 4


        $serie = $this->Serie->getField($serie_id, 'nome');



        return array(
            "serie_nome" => $serie,
            "serie_id" => $serie_id,
            "menu_da_serie" => array(),
        );
    }

    function MenuEsquerdaADMIN() {
        return array(
            'Series',
            'serie' => 'Series',
            'Dados Tecnicos',
            'autor' => 'Autores',
            'fansub' => 'Fansubs',
            'Configurações',
            'servidor' => 'Servidores',
            'status' => 'Status',
            'multimidia' => 'Multimidias',
            'idioma' => 'Idiomas',
            'qualidade' => 'Qualidades',
        );
    }

}

?>
