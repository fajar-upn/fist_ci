<?php

class Feedback_management extends CI_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
            $this->session->set_userdata('typeNotif', 'notLoggedIn');
            redirect('auth'); //redirect kehalaman login
        }
        $this->load->model('Mworkshop_seminar');
        $this->load->model('Mworksem_feedback_question');
        $this->load->model('Mworksem_feedback_answer');
        $this->load->model('Mworksem_feedback');
        $this->load->model('Mworksem_feedback_selection');
        $this->load->model('Mtraining_feedback_question');
        $this->load->model('Mtraining_feedback_answer');
        $this->load->model('Mtraining_feedback');
        $this->load->model('Mtraining_feedback_selection');
        $this->load->model('Mconsult_feedback_question');
        $this->load->model('Mconsult_feedback_answer');
        $this->load->model('Mconsult_feedback');
        $this->load->model('Mconsult_feedback_selection');
    }

    public function index()
    {
        $data['workshop_seminars'] = $this->Mworkshop_seminar->get_workshop_seminars_desc();
        $data['titlebreadcrumb'] = "Workshop & Seminar";
        $data['breadcrumb'] = 'feedback/vfeedback_form_breadcrumb';
        $data['content'] = "feedback/vfeedback_worksem_management.php";
        $data['js']      = 'feedback/vcustom_script_js';
        $data['css']     = 'template/vdatatable_css';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    public function workshop_seminar($workshop_seminar_id)
    {
        $amount = $this->Mworksem_feedback_question->get_amt_question($workshop_seminar_id);
        if ($this->input->post('process')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            /**
             * data untuk informasi pertanyaan serta opsi apabila tipe pertanyaannya membutuhkan opsi
             */
            $amount_question = count($question); // untuk mendapatkan jumlah pertanyaan setelah disimpan
            if ($amount_question > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                $rest_question = $amount_question - $amount->amount;
                for ($i = 1; $i <= $rest_question; $i++) {
                    $data_question = array(
                        'wsfque_ws_fk'       => $workshop_seminar_id,
                        'wsfque_question'    => "",
                        'user_create'        => $this->session->userdata('id'),
                        'user_update'        => $this->session->userdata('id')
                    );
                    $this->Mworksem_feedback_question->insert($data_question); // Input pertanyaan tetapi data kosong
                }
            } else if ($amount_question < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                $rest = $amount->amount - $amount_question;
                $data_que = $this->Mworksem_feedback_question->get_list_question_desc();
                for ($i = 1; $i <= $rest; $i++) {
                    $id_que = $data_que[$i - 1]->wsfque_id;
                    // Kondisi jika pertanyaan yang ingin dihapus sudah menjawab atau blm
                    if ($this->Mworksem_feedback_answer->get_num_rows_by_id($id_que) >= 1) {
                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/workshop_seminar/" . $workshop_seminar_id);
                    } else {
                        // Jika false maka akan dihapus pertanyaannya
                        $this->Mworksem_feedback_question->delete($id_que);
                    }
                }
            }

            $data_id = $this->Mworksem_feedback_question->get_worksem_quetion_ws_id($workshop_seminar_id); // Untuk mengambil id pada setiap pertanyaan yang ada
            $type_question_index   = 0;
            $question_option_index = 0;
            foreach ($question as $val_question) {
                $data_question = array(
                    'wsfque_ws_fk'        => $workshop_seminar_id,
                    'wsfque_question'    => $val_question,
                    'wsfque_type'        => $type_question[$type_question_index],
                    'user_update'        => $this->session->userdata('id')
                );
                $id = $data_id[$type_question_index]->wsfque_id; // Memasukkan id pertanyaan pada $id

                // Kondisi jika pertanyaan yang ingin diubah sudah menjawab atau blm
                if ($this->Mworksem_feedback_answer->get_num_rows_by_id($id) >= 1) {
                    // Kondisi jika pertanyaan yang sudah ada jawabanya ada perubahan
                    if (
                        $val_question != $data_id[$type_question_index]->wsfque_question ||
                        $type_question[$type_question_index] != $data_id[$type_question_index]->wsfque_type
                    ) {
                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/workshop_seminar/" . $workshop_seminar_id);
                    }
                } else /* 
                * Kondisi untuk jika sebelumnya pertanyaan bersifat opsi lalu diganti no opsi
                * Jadi untuk menghapus opsi yang ada
                */
                    if ($type_question[$type_question_index] != $data_id[$type_question_index]->wsfque_type) {
                        if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                            $data_id[$type_question_index]->wsfque_type == "checkbox" or
                            $data_id[$type_question_index]->wsfque_type == "dropdown" or
                            $data_id[$type_question_index]->wsfque_type == "radio"
                        ) {
                            if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                                $type_question[$type_question_index] == "text" or
                                $type_question[$type_question_index] == "textarea" or
                                $type_question[$type_question_index] == "number"
                            ) {
                                $this->Mworksem_feedback_selection->delete_by_id_question($id);
                            }
                        }
                    }

                $this->Mworksem_feedback_question->update($data_question, $id); // Mengupdate pertanyaan sesuai $id

                if (
                    $type_question[$type_question_index] == 'checkbox' or
                    $type_question[$type_question_index] == 'dropdown' or
                    $type_question[$type_question_index] == 'radio'
                ) {
                    // membagi memecah opsi jawaban
                    $option = explode(";", $question_option[$question_option_index]);
                    $amount_option = count($option); // untuk mendapatkan jumlah opsi yang baru
                    $amount = $this->Mworksem_feedback_selection->get_amt_selection($id); // Untuk mendapatkan jumlah opsi pada database berdasarkan id pertanyaan
                    if ($amount_option > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                        $rest_option = $amount_option - $amount->amount;
                        for ($i = 1; $i <= $rest_option; $i++) {
                            $data_option = array(
                                'wsfselect_wsfque_fk' => $id,
                                'user_create'         => $this->session->userdata('id'),
                                'user_update'         => $this->session->userdata('id')
                            );
                            $this->Mworksem_feedback_selection->insert($data_option);
                        }
                    } else if ($amount_option < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                        $rest = $amount->amount - $amount_option;
                        $data_option = $this->Mworksem_feedback_selection->get_by_id_question($id);
                        for ($i = 1; $i <= $rest; $i++) {
                            $id_option = $data_option[$i - 1]->tfselect_id;
                            $this->Mworksem_feedback_selection->delete($id_option);
                        }
                    }

                    $option_id = $this->Mworksem_feedback_selection->get_by_id_question($id); // Untuk mendapatkan id pada setiap opsi berdasarkan id pertanyaan
                    $option_index = 0;
                    foreach ($option as $val) {
                        $data_option = array(
                            'wsfselect_selection'  => ltrim($val),  // remove whitespace didepan
                            'user_update'          => $this->session->userdata('id')
                        );
                        $id_option = $option_id[$option_index]->wsfselect_id;
                        $this->Mworksem_feedback_selection->update($data_option, $id_option);
                        $option_index++;
                    }
                    $question_option_index++;
                }
                $type_question_index++;
            }
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            redirect("feedback_management");
        } else {
            $data['ws_id'] = $workshop_seminar_id;
            $data['questions'] = $this->Mworksem_feedback_question->get_question($workshop_seminar_id);
            $data['titlebreadcrumb'] = "Workshop & Seminar";
            $data['breadcrumb'] = 'feedback/vfeedback_form_breadcrumb';
            $data['management'] = "management";
            $data['content'] = 'feedback/vfeedback_form_worksem.php';
            $data['css'] = 'feedback/vfeedback_form_css';
            $data['js'] = 'feedback/vfeedback_form_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    public function training()
    {
        $amount = $this->Mtraining_feedback_question->get_amt_question();
        if ($this->input->post('process')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            /**
             * data untuk informasi pertanyaan serta opsi apabila tipe pertanyaannya membutuhkan opsi
             */
            $amount_question = count($question); // untuk mendapatkan jumlah pertanyaan setelah disimpan
            if ($amount_question > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                $rest_question = $amount_question - $amount->amount;
                for ($i = 1; $i <= $rest_question; $i++) {
                    $data_question = array(
                        'tfque_question'    => "",
                        'user_create'       => $this->session->userdata('id'),
                        'user_update'       => $this->session->userdata('id')
                    );
                    $this->Mtraining_feedback_question->insert($data_question); // Input pertanyaan tetapi data kosong
                }
            } else if ($amount_question < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                $rest = $amount->amount - $amount_question;
                $data_que = $this->Mtraining_feedback_question->get_list_question_desc();
                for ($i = 1; $i <= $rest; $i++) {
                    $id_que = $data_que[$i - 1]->tfque_id;
                    // Kondisi jika pertanyaan yang ingin dihapus sudah menjawab atau blm
                    if ($this->Mtraining_feedback_answer->get_num_rows_by_id($id_que) >= 1) {

                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/training");
                    } else {
                        // Jika false maka akan dihapus pertanyaannya
                        $this->Mtraining_feedback_question->delete($id_que);
                    }
                }
            }
            $data_id = $this->Mtraining_feedback_question->get_list_training_que(); // Untuk mengambil id pada setiap pertanyaan yang ada
            $type_question_index    = 0;
            $question_option_index    = 0;
            foreach ($question as $val_question) {
                $data_question = array(
                    'tfque_question'    => $val_question,
                    'tfque_type'        => $type_question[$type_question_index],
                    'user_update'       => $this->session->userdata('id')
                );
                $id = $data_id[$type_question_index]->tfque_id; // Memasukkan id pertanyaan pada $id

                // Kondisi jika pertanyaan yang ingin diubah sudah menjawab atau blm
                if ($this->Mtraining_feedback_answer->get_num_rows_by_id($id) >= 1) {
                    // Kondisi jika pertanyaan yang sudah ada jawabanya ada perubahan
                    if (
                        $val_question != $data_id[$type_question_index]->tfque_question ||
                        $type_question[$type_question_index] != $data_id[$type_question_index]->tfque_type
                    ) {
                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/training");
                    }
                } else /* 
                * Kondisi untuk jika sebelumnya pertanyaan bersifat opsi lalu diganti no opsi
                * Jadi untuk menghapus opsi yang ada
                */
                    if ($type_question[$type_question_index] != $data_id[$type_question_index]->tfque_type) {
                        if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                            $data_id[$type_question_index]->tfque_type == "checkbox" or
                            $data_id[$type_question_index]->tfque_type == "dropdown" or
                            $data_id[$type_question_index]->tfque_type == "radio"
                        ) {
                            if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                                $type_question[$type_question_index] == "text" or
                                $type_question[$type_question_index] == "textarea" or
                                $type_question[$type_question_index] == "number"
                            ) {
                                $this->Mtraining_feedback_selection->delete_by_id_question($id);
                            }
                        }
                    }
                $this->Mtraining_feedback_question->update($data_question, $id); // Mengupdate pertanyaan sesuai $id

                if (
                    $type_question[$type_question_index] == 'checkbox' or
                    $type_question[$type_question_index] == 'dropdown' or
                    $type_question[$type_question_index] == 'radio'
                ) {
                    // membagi memecah opsi jawaban
                    $option = explode(";", $question_option[$question_option_index]);
                    $amount_option = count($option); // untuk mendapatkan jumlah opsi yang baru
                    $amount = $this->Mtraining_feedback_selection->get_amt_selection($id); // Untuk mendapatkan jumlah opsi pada database berdasarkan id pertanyaan
                    if ($amount_option > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                        $rest_option = $amount_option - $amount->amount;
                        for ($i = 1; $i <= $rest_option; $i++) {
                            $data_option = array(
                                'tfselect_tfque_fk'  => $id,
                                'user_create'        => $this->session->userdata('id'),
                                'user_update'        => $this->session->userdata('id')
                            );
                            $this->Mtraining_feedback_selection->insert($data_option);
                        }
                    } else if ($amount_option < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                        $rest = $amount->amount - $amount_option;
                        $data_option = $this->Mtraining_feedback_selection->get_by_id_question($id);
                        for ($i = 1; $i <= $rest; $i++) {
                            $id_option = $data_option[$i - 1]->tfselect_id;
                            $this->Mtraining_feedback_selection->delete($id_option);
                        }
                    }

                    $option_id = $this->Mtraining_feedback_selection->get_by_id_question($id); // Untuk mendapatkan id pada setiap opsi berdasarkan id pertanyaan
                    $option_index = 0;
                    foreach ($option as $val) {
                        $data_option = array(
                            'tfselect_selection' => ltrim($val),  // remove whitespace didepan
                            'user_update'        => $this->session->userdata('id')
                        );
                        $id_option = $option_id[$option_index]->tfselect_id;
                        $this->Mtraining_feedback_selection->update($data_option, $id_option);
                        $option_index++;
                    }
                    $question_option_index++;
                }
                $type_question_index++;
            }
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            redirect("feedback_management/training");
        } else {
            // $data['amt_question'] = $amount;
            $data['questions']    = $this->Mtraining_feedback_question->get_question();
            $data['titlebreadcrumb'] = "Pelatihan";
            $data['breadcrumb'] = 'feedback/vfeedback_form_breadcrumb';
            $data['content'] = 'feedback/vfeedback_form_training.php';
            $data['css'] = 'feedback/vfeedback_form_css';
            $data['js'] = 'feedback/vfeedback_form_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    public function consult()
    {
        $amount = $this->Mconsult_feedback_question->get_amt_question();
        if ($this->input->post('process')) {
            $input = $this->input->post(NULL, TRUE);
            extract($input);

            /**
             * data untuk informasi pertanyaan serta opsi apabila tipe pertanyaannya membutuhkan opsi
             */
            $amount_question = count($question); // untuk mendapatkan jumlah pertanyaan setelah disimpan
            if ($amount_question > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                $rest_question = $amount_question - $amount->amount;
                for ($i = 1; $i <= $rest_question; $i++) {
                    $data_question = array(
                        'scfque_question'    => "",
                        'user_create'        => $this->session->userdata('id'),
                        'user_update'        => $this->session->userdata('id')
                    );
                    $this->Mconsult_feedback_question->insert($data_question); // Input pertanyaan tetapi data kosong
                }
            } else if ($amount_question < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                $rest = $amount->amount - $amount_question;
                $data_que = $this->Mconsult_feedback_question->get_list_question_desc();
                for ($i = 1; $i <= $rest; $i++) {
                    $id_que = $data_que[$i - 1]->scfque_id;
                    // Kondisi jika pertanyaan yang ingin dihapus sudah menjawab atau blm
                    if ($this->Mconsult_feedback_answer->get_num_rows_by_id($id_que) >= 1) {
                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/consult");
                    } else {
                        // Jika false maka akan dihapus pertanyaannya
                        $this->Mconsult_feedback_question->delete($id_que);
                    }
                }
            }
            $data_id = $this->Mconsult_feedback_question->get_list_consult_que(); // Untuk mengambil id pada setiap pertanyaan yang ada
            $type_question_index   = 0;
            $question_option_index = 0;
            foreach ($question as $val_question) {

                $data_question = array(
                    'scfque_question' => $val_question,
                    'scfque_type'     => $type_question[$type_question_index],
                    'user_update'     => $this->session->userdata('id')
                );
                $id = $data_id[$type_question_index]->scfque_id; // Memasukkan id pertanyaan pada $id

                // Kondisi jika pertanyaan yang ingin diubah sudah menjawab atau blm
                if ($this->Mconsult_feedback_answer->get_num_rows_by_id($id) >= 1) {
                    // Kondisi jika pertanyaan yang sudah ada jawabanya ada perubahan
                    if (
                        $val_question != $data_id[$type_question_index]->scfque_question ||
                        $type_question[$type_question_index] != $data_id[$type_question_index]->scfque_type
                    ) {
                        // Jika true maka tidak akan dihapus dan akan mengembalikan pesan error
                        $this->session->set_userdata('typeNotif', 'errorEditFeedback');
                        redirect("feedback_management/consult");
                    }
                } else /* 
                        * Kondisi untuk jika sebelumnya pertanyaan bersifat opsi lalu diganti no opsi
                        * Jadi untuk menghapus opsi yang ada
                        */
                    if ($type_question[$type_question_index] != $data_id[$type_question_index]->scfque_type) {
                        if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                            $data_id[$type_question_index]->scfque_type == "checkbox" or
                            $data_id[$type_question_index]->scfque_type == "dropdown" or
                            $data_id[$type_question_index]->scfque_type == "radio"
                        ) {
                            if ( // Kondisi jika id pertanyaan pada database pertanyaan = chekbox,dropdown,radio
                                $type_question[$type_question_index] == "text" or
                                $type_question[$type_question_index] == "textarea" or
                                $type_question[$type_question_index] == "number"
                            ) {
                                $this->Mconsult_feedback_selection->delete_by_id_question($id);
                            }
                        }
                    }
                $this->Mconsult_feedback_question->update($data_question, $id); // Mengupdate pertanyaan sesuai $id

                if (
                    $type_question[$type_question_index] == 'checkbox' or
                    $type_question[$type_question_index] == 'dropdown' or
                    $type_question[$type_question_index] == 'radio'
                ) {
                    // membagi memecah opsi jawaban
                    $option = explode(";", $question_option[$question_option_index]);
                    $amount_option = count($option); // untuk mendapatkan jumlah opsi yang baru
                    $amount = $this->Mconsult_feedback_selection->get_amt_selection($id); // Untuk mendapatkan jumlah opsi pada database berdasarkan id pertanyaan

                    if ($amount_option > $amount->amount) { // Kondisi jika jumlah pertanyaan baru > jumlah pertanyaan sebelum
                        $rest_option = $amount_option - $amount->amount;
                        for ($i = 1; $i <= $rest_option; $i++) {
                            $data_option = array(
                                'scfselect_scfque_fk' => $id,
                                'user_create'         => $this->session->userdata('id'),
                                'user_update'         => $this->session->userdata('id')
                            );
                            $this->Mconsult_feedback_selection->insert($data_option);
                        }
                    } else if ($amount_option < $amount->amount) { // Kondisi jika jumlah pertanyaan baru < jumlah pertanyaan sebelum
                        $rest = $amount->amount - $amount_opteon;
                        $data_option = $this->Mconsult_feedback_selection->get_by_id_question($id);
                        for ($i = 1; $i <= $rest; $i++) {
                            $id_option = $data_option[$i - 1]->scfselect_id;
                            $this->Mconsult_feedback_selection->delete($id_option);
                        }
                    }

                    $option_id = $this->Mconsult_feedback_selection->get_by_id_question($id); // Untuk mendapatkan id pada setiap opsi berdasarkan id pertanyaan
                    $option_index = 0;
                    foreach ($option as $val) {
                        $data_option = array(
                            'scfselect_selection' => ltrim($val),  // remove whitespace didepan
                            'user_update'         => $this->session->userdata('id')
                        );
                        $id_option = $option_id[$option_index]->scfselect_id;
                        $this->Mconsult_feedback_selection->update($data_option, $id_option);
                        $option_index++;
                    }
                    $question_option_index++;
                }
                $type_question_index++;
            }
            $this->session->set_userdata('typeNotif', 'successEditFeedback');
            redirect("feedback_management/consult");
        } else {
            // $data['amt_question'] = $amount;
            $data['questions']    = $this->Mconsult_feedback_question->get_question();
            $data['titlebreadcrumb'] = "Konsultasi";
            $data['breadcrumb'] = 'feedback/vfeedback_form_breadcrumb';
            $data['content'] = 'feedback/vfeedback_form_consult.php';
            $data['css'] = 'feedback/vfeedback_form_css';
            $data['js'] = 'feedback/vfeedback_form_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    function data_worksem($id = 0)
    {
        $data['title'] = $this->Mworkshop_seminar->get_workshop_seminars_desc();
        $data['titlebreadcrumb'] = "Workshop & Seminar";
        $data['breadcrumb'] = 'feedback/vfeedback_data_breadcrumb';
        $data['lists']   = $this->Mworksem_feedback_answer->get_data_answer($id);
        $data['content'] = 'feedback/vfeedback_data_worksem.php';
        $data['id_select'] = $id;
        $data['js']      = 'feedback/vcustom_script_js';
        $data['css']     = 'feedback/vdata_css';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function detail_worksem($id)
    {
        $data['details']   = $this->Mworksem_feedback_answer->get_detail_answer($id);
        $data['titlebreadcrumb'] = "Workshop & Seminar";
        $data['breadcrumb'] = 'feedback/vfeedback_detail_breadcrumb';
        $data['content'] = 'feedback/vfeedback_detail_worksem.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function data_training($id = 0)
    {
        $data['titlebreadcrumb'] = "Pelatihan";
        $data['breadcrumb'] = 'feedback/vfeedback_data_breadcrumb';
        $data['lists']   = $this->Mtraining_feedback_answer->get_data_answer($id);
        $data['content'] = 'feedback/vfeedback_data_training.php';
        $data['js']      = 'feedback/vcustom_script_js';
        $data['css']     = 'template/vdatatable_css';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function detail_training($id)
    {
        $data['details']   = $this->Mtraining_feedback_answer->get_detail_answer($id);
        $data['titlebreadcrumb'] = "Pelatihan";
        $data['breadcrumb'] = 'feedback/vfeedback_detail_breadcrumb';
        $data['content'] = 'feedback/vfeedback_detail_training.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function data_consult($id = 0)
    {
        $data['titlebreadcrumb'] = "Konsultasi";
        $data['breadcrumb'] = 'feedback/vfeedback_data_breadcrumb';
        $data['lists']   = $this->Mconsult_feedback_answer->get_data_answer($id);
        $data['content'] = 'feedback/vfeedback_data_consult.php';
        $data['js']      = 'feedback/vcustom_script_js';
        $data['css']     = 'template/vdatatable_css';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function detail_consult($id)
    {
        $data['details']   = $this->Mconsult_feedback_answer->get_detail_answer($id);
        $data['titlebreadcrumb'] = "Konsultasi";
        $data['breadcrumb'] = 'feedback/vfeedback_detail_breadcrumb';
        $data['content'] = 'feedback/vfeedback_detail_consult.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    function delete_answer($type, $id)
    {
        if ($type == "worksem") {
            $this->Mworksem_feedback_answer->delete_submit($id);
            redirect('feedback_management/data_worksem');
        } else if ($type == "training") {
            $this->Mtraining_feedback_answer->delete_submit($id);
            redirect('feedback_management/data_training');
        } else if ($type == "consult") {
            $this->Mconsult_feedback_answer->delete_submit($id);
            redirect('feedback_management/data_consult');
        }
    }
}
