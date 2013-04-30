<?php
class form{
	public $controller;

	public function __construct($controller){
		$this->controller = $controller;
	}

	public function input($name,$label,$options = array()){
		if(isset($this->controller->request->data->$name)){
			$value = '';
		}else{
			$value = $this->controller->request->data->$name;
		}
		if ($label == 'hidden') {
			# code...
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		}

		$html ='<div class="clearfix">
			<label for="input'.$name.'">'.$label.'</label>
			<div class="input">';
		$attr='';
		foreach ($options as $k => $v) {
			# code...
			$attr .= " $k=\"$v\"";
		}
		if(!isset($options['type'])){
			$html= '<input type="text" id="input'.$name.'" name="'.$name.'" value="'.$value.'">';
		}elseif ($options['type']=='textearea') {
			# code...
			$html.= '<textearea id="input'.$name.'" name="'.$name.'">'.$value.'</textearea>';
		}elseif ($options['type']=='checkbox') {
			# code...
			$html.= 'input type="hidden" name="'.$name.'" value="0"><input type="checkbox" name="'.$name.'" value="1">';
		}
		$html .='</div></div>';
	}
}