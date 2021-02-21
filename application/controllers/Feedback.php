<?php

class Feedback extends CI_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mworkshop_seminar');
        $this->load->model('Mworksem_feedback_question');
        $this->load->model('Mworksem_feedback_answer');
        $this->load->model('Mworksem_feedback');
        $this->load->model('Mtraining_feedback_question');
        $this->load->model('Mtraining_feedback_answer');
        $this->load->model('Mtraining_feedback');
        $this->load->model('Mconsult_feedback_question');
        $this->load->model('Mconsult_feedback_answer');
        $this->load->model('Mconsult_feedback');
    }

    public function workshop_seminar($workshop_seminar_id = 0)
    {
        if ($this->input->post('process')) {
            // Tambah id baru yang mengisi feedback dikembalikan berupa id
            $id = $this->Mworksem_feedback->insert(array('user_update' => 0));
            $amt = $this->input->post('amt'); // Var jumlah pertanyaan
            for ($i = 1; $i <= $amt; $i++) {
                // Kondisi jika jawaban berupa checkbox
                if ($this->input->post('id_check_' . $i)) {
                    $next = '';
                    foreach ($this->input->post('ans_' . $i) as $value) {
                        $next .= $value . ', ';
                    }
                    $answer = $next;
                } else {
                    $answer = $this->input->post('ans_' . $i);
                }
                $dataAnswer = array(
                    'wsfans_wsfque_fk' => $this->input->post('id_' . $i),
                    'wsfans_wsfeed_fk' => $id,
                    'wsfans_answer'    => $answer
                );
                if (!$this->Mworksem_feedback_answer->insert($dataAnswer)) {
                    $this->session->set_flashdata('message', 'Gagal Mengirim Saran');
                    redirect('feedback/workshop_seminar');
                }
            }

            $this->session->set_flashdata('message', 'Terima Kasih atas Sarannya!');
            redirect('feedback/workshop_seminar');
        } else {
            $data['title'] = $this->Mworkshop_seminar->get_worksem_active();
            $data['questions']    = $this->Mworksem_feedback_question->get_question($workshop_seminar_id);
            $data['amt_question'] = $this->Mworksem_feedback_question->get_amt_question($workshop_seminar_id);
        }
        $data['workshop_seminar_id'] = $workshop_seminar_id;
        $data['content']      = "feedback/vfeedback_worksem.php";
        $this->load->view('template/vtemplate_feedback.php', $data);
    }

    public function training()
    {
        if ($this->input->post('process')) {
            // Tambah id baru yang mengisi feedback dikembailkan berupa id
            $id = $this->Mtraining_feedback->insert(array('user_update' => 0));
            $amt = $this->input->post('amt'); // Var jumlah pertanyaan
            for ($i = 1; $i <= $amt; $i++) {
                // Kondisi jika jawaban berupa checkbox
                if ($this->input->post('id_check_' . $i)) {
                    $next = '';
                    foreach ($this->input->post('ans_' . $i) as $value) {
                        $next .= $value . ', ';
                    }
                    $answer = $next;
                } else {
                    $answer = $this->input->post('ans_' . $i);
                }
                $dataAnswer = array(
                    'tfans_tfque_fk' => $this->input->post('id_' . $i),
                    'tfans_tfeed_fk' => $id,
                    'tfans_answer'   => $answer
                );
                if (!$this->Mtraining_feedback_answer->insert($dataAnswer)) {
                    $this->session->set_flashdata('message', 'Gagal Mengirim Saran');
                    redirect('feedback/training');
                }
            }
            $this->session->set_flashdata('message', 'Terima Kasih atas Sarannya!');
            redirect('feedback/training');
        } else {
            $data['questions']    = $this->Mtraining_feedback_question->get_question();
            $data['amt_question'] = $this->Mtraining_feedback_question->get_amt_question();
            $data['content']      = "feedback/vfeedback_training.php";
            $this->load->view('template/vtemplate_feedback.php', $data);
        }
    }

    public function consult()
    {
        if ($this->input->post('process')) {
            // Tambah id baru yang mengisi feedback dikembalikan dengan id
            $id = $this->Mconsult_feedback->insert(array('user_update' => 0));
            $amt = $this->input->post('amt'); // Var jumlah pertanyaan
            for ($i = 1; $i <= $amt; $i++) {
                // Kondisi jika jawaban berupa checkbox
                if ($this->input->post('id_check_' . $i)) {
                    $next = '';
                    foreach ($this->input->post('ans_' . $i) as $value) {
                        $next .= $value . ', ';
                    }
                    $answer = $next;
                } else {
                    $answer = $this->input->post('ans_' . $i);
                }
                $dataAnswer = array(
                    'scfans_scfque_fk' => $this->input->post('id_' . $i),
                    'scfans_scfeed_fk' => $id,
                    'scfans_answer'    => $answer
                );
                if (!$this->Mconsult_feedback_answer->insert($dataAnswer)) {
                    $this->session->set_flashdata('message', 'Gagal Mengirim Saran');
                    redirect('feedback/consult');
                }
            }
            $this->session->set_flashdata('message', 'Terima Kasih atas Sarannya!');
            redirect('feedback/consult');
        } else {
            $data['questions']    = $this->Mconsult_feedback_question->get_question();
            $data['amt_question'] = $this->Mconsult_feedback_question->get_amt_question();
            $data['content']      = "feedback/vfeedback_consult.php";
            $this->load->view('template/vtemplate_feedback.php', $data);
        }
    }
}
