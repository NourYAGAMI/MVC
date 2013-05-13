<?php
class PostsController extends Controller{

	function index(){
		$perPage = 10;
		$this->loadModel('Post');
		$condition = array('online'=>1, 'type' =>'post');
		$d[	'posts' ]= $this->Post->find(array(
			'conditions' => $condition,
			'limit'		 => ($perPage*($this->request->page-1)).','.$perPage
		));
		/**$d['total']= $this->Post->FindCount($condition);
		$d['page']= ceil($d['total'] / $perPage);**/
		$this->set($d);
	}
	


	function view($id, $slug) {

		$this->loadModel('Post');
		$d['posts']= $this->Post->findFirst(array(
			'fields' => 'id,slug,content,name',
			'conditions' => array('online'=>1, 'id'=>$id, 'type' =>'post')
			));
		
		if(empty($d['page'])){
			$this->e404('page introuvable');
		}

		if($slug != $d['posts']->slug){
			$this->redirect("posts/view/id:$id/slug:".$d['post']->slug,301);
		}
		
		$this->set($d);
	}

	/**
	* ADMIN *
	**/

	function admin_index(){
		$perPage = 10;
		$this->loadModel('Post');
		$condition = array('type' =>'post');
		$d[	'posts' ]= $this->Post->find(array(
				'fields' 	 => 'id,name,online',
				'conditions' => $condition,
				'limit'		 => ($perPage*($this->request->page-1)).','.$perPage
		));
		$d['total']= $this->Post->FindCount($condition);
		$d['page']= ceil($d['total'] / $perPage);
		$this->set($d);
	}

	/**
	* ADMIN EDIT fonction permettant d'editer un article *
	**/
	function admin_edit($id = null){
		$this->loadModel('Post');
		if($this->request->data){
			$this->Post->save($this->request->data);
		}
		if($id){
			$this->request->data = $this->Post->findFirst(array(
				'conditions' => array('id'=>$id)
			));
		}	
	}


	/**
	* ADMIN DELETE fonction permettant de supprimer un article *
	**/

	function admin_delete($id){
		$this->loadModel('Post');
		$this->Post->delete($id);
		$this->Session->setflah('le contenu a bien été supprimé');
		$this->redirect('admin/posts/index');

	}
	
}
?>