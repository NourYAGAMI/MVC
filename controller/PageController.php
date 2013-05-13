<?php
class PageController extends Controller {

	function view($id){
		$this->loadModel('Post');
		$d['Page']= $this->Post->findFirst(array(
			'conditions' => array('online'=>1, 'id'=>$id, 'type' =>'page')
			));
		if(empty($d['Page'])){
			$this->e404('page introuvable');
		}

		// $d['page']=$this->Post->find( array('conditions' => array('type' =>'page')));
		$this->set($d);
	}

// recupérer le menu pour la page appelée

	function getMenu(){
		$this->loadModel('Post');
		return $this->Post->find(array(
			'conditions' => array('online'=>1, 'type' =>'page')
		));
	}
}

?>



