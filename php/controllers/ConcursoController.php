<?php
class ConcursoController extends Controller {
	private $errors = array();
    
	public function __construct() {
        parent::__construct();
    }

    public function viewSurvey($id_concurso) {
        var_dump($id_concurso);
    }
	
	 public function createSurvey($data) {
		$concurso = new ConcursoModel();
		$concurso_valido = $this->validateSurvey($data);
		if (!in_array(true, $this->errors)) {
			if ($concurso->createSurvey($data['post'])) {
				
			} else {
				
			}
		} else {
			var_dump($this->errors);
		}
    }
	
	
	private function validateSurvey($data) {
		$this->errors[] = parent::validarRequerido($data['post']['nombre']);
		$this->errors[] = parent::validarRequerido($data['post']['organizacion']);
		$this->errors[] = parent::validarRequerido($data['post']['f_inicio']);
		$this->errors[] = parent::validarRequerido($data['post']['f_fin']);
		$this->errors[] = parent::validarRequerido($data['post']['descripcion']);
		$this->errors[] = parent::validarRequerido($_FILES['archivo']['name']);
		$this->errors[] = parent::validarTipoImagen($_FILES['archivo']);
		var_dump($this->errors);
		if (empty($data['post']['pregunta'])) {
			$this->errors[] = true;
		} else {
			foreach($data['post']['pregunta'] as $pregunta) {
				$this->errors[] = parent::validarRequerido($pregunta);
			}
		}
		
	}

}