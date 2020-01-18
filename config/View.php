<?php

/*
 * You can call the View : $view = new View($p_to_file)
 *
 * You can also pass data : $view.set($key, $value)
 *
 * Render the view using : $view.render()
 *
 * */

class View {
    protected $_file;
    protected $_data = array();

    public function __construct($file, $data = null) {
        $this->_file = env('ROOT_PATH').'resources/views/' . $file;
        $this->_data = $data;
    }

    public function set($key, $value) {
        $this->_data[$key] = $value;
    }

    public function get($key) {
        if(array_key_exists($key, $this->_data)) {
            return $this->_data[$key];
        }
        return null;
    }

    public function render() {
        if (!file_exists($this->_file)) {
            throw new Exception("Template " . $this->_file . " doesn't exist.");
        }

        //extract($this->_data);

        ob_start();
        include_once ($this->_file);
        $main_section = ob_get_contents();
        ob_end_clean();

        $this->set('main-content', $main_section);

        ob_start();
        include_once view("main-section.php");
        $main_section_content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include_once view('actualite.php');
        $actualite_content = ob_get_contents();
        ob_end_clean();

        $this->set('actualite-content', $actualite_content);
        $this->set('main-section-content', $main_section_content);

        ob_start();
        include_once env('ROOT_PATH') . 'resources/views/layouts/app.php';
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
