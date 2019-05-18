<?php
class Players extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('players_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['players'] = $this->players_model->get_players();
        $data['title'] = 'players archive';

        $this->load->view('players/index', $data);
    }

    public function view($id = NULL)
    {
        $data['players_item'] = $this->players_model->get_players($id);

        if (empty($data['players_item'])) {
            show_404();
        }

        $this->load->view('players/view', $data);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a player item';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('players/create',$data);
        } else {
            $this->players_model->set_player();
            $this->load->view('players/success');
        }
    }
}
