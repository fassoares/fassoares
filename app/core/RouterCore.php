<?php
    namespace app\core;

    class RouterCore
    {
        //a variável privada <$uri> é todo o endereço que fica 
        //depois do dominio Ex: www.dominio.com.br/<$uri>
        private $uri; 
        private $method;
        private $getArr; //todas as rotas de get vem para esse array
        public function __construct()
        {
            $this->initialize();
            // dá visibilidade do arquivo Router.php
            require_once('../app/config/Router.php');
            $this->execute();
        }

        public function initialize(){
            $this->method = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];

            /*
            // faz o que A FUNÇÃO normalizeURI faz
            $part = str_replace('/FaturaCartaoBB/','',$uri);
            dd($part, false);*/

            $uri = $this->normalizeURI($uri);
        }

        private function normalizeURI($strg)
        {
            // 'Trandforma uma string em array, informando o delimitador dos valores do array';
            $ex = explode('/',$strg);
            // 'remove os valores vazios do array';
            $arr_sem_vazio = array_filter($ex);
            // 'recalcula os indices';
            $arr_new_indice = array_values($arr_sem_vazio);
            for ($i=0; $i < UNSET_URI_COUNT; $i++)
            {
                unset($arr_new_indice[$i]);
            }
            // 'removeu o indice zero';
            // 'recalculou novamente os indices';
            $arr_new_indices = array_values($arr_new_indice);
            return $arr_new_indices;

        }

        private function get($router,$call)
        {
            $this->getArr[] = [
                'router'=> $router,
                'call' => $call 
            ]; 
        }

        private function execute()
        {
            switch($this->method){
                case 'GET':
                    $this->executeGET();
                    break;
                case 'POST':
                    break;
            }

        }

        private function executeGET(){
            foreach( $this->getArr as $get)
            dd($get['router'] ,false);
            if ($get['router'] == $this->uri){
                echo "achei a rota que procurava";
            }
        }
    }
?>