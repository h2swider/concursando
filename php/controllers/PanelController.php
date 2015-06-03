<?php

class PanelController extends Controller {

    public function main($data) {
        $tipoPregunta = new TipoPreguntaModel();
        $data['tipos_pregunta'] = $tipoPregunta->getTipoPreguntas();
        parent::cargarVista('header.php');
        parent::cargarVista('menu.php');
        parent::cargarVista('panel.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

}
