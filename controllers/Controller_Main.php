<?php

    final class Controller_Main extends Controller
    {
        public function __construct()
        {
            $this->model = new Model_Main();
            parent::__construct();
        }


        public function import()
        {
            if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
            {
                $this->view->render('upload_form', 'template');
            }
            elseif ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) )
            {
                $errors = [];

                $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
                $destination = $upload_dir . basename($_FILES['upload_file']['name']);

                if ( is_uploaded_file($_FILES['upload_file']['tmp_name']) )
                {
                    if ( move_uploaded_file($_FILES['upload_file']['tmp_name'], $destination) )
                    {
                        $file = fopen($destination, 'r');
                        $titles = fgetcsv($file);

                        $titles = array_map(function($elem) {
                            return strtolower($elem);
                        }, $titles);
                        $valid_titles = ['uid', 'name', 'age', 'email', 'phone', 'gender'];

                        for ( $i = 0; $i < count($titles); $i++ )
                        {
                            if ( $titles[$i] != $valid_titles[$i] )
                            {
                                $errors[] = 'Data structure is wrong!';
                                break;
                            }
                        }

                        if ( empty($errors) )
                        {

                            $existed_data = $this->model->get_data();

                            while ( $row = fgetcsv($file) )
                            {
                                $record = [
                                    'name' => $row[1],
                                    'age' => $row[2],
                                    'email' => $row[3],
                                    'phone' => $row[4],
                                    'gender' => $row[5]
                                ];
                                if ( !in_array($row, $existed_data) )
                                {
                                    if ( !$this->model->put_data($record) )
                                    {
                                        $errors[] = 'Could not save records to database!';
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                if ( empty($errors) )
                {
                    $data = ['success' => true];
                }
                else
                {
                    $data = ['errors' => $errors];
                }
                $this->view->render('upload_form', 'template', $data);
            }

        }


        public function list()
        {
            $data = $this->model->get_data();
            $this->view->render('table', 'template', $data);
        }
    }

?>