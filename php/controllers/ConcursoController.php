<?php
class ConcursoController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function verConcurso($id_concurso) {
        var_dump($id_concurso);
    }

}

?>