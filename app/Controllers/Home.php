<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NoteModel;

use CodeIgniter\Controller;

class Home extends BaseController
{
    protected $encrypter;
    protected $session;
    protected $request;
    protected $userModel;
    protected $noteModel;

    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->userModel = new UserModel();
        $this->noteModel = new NoteModel();
    }

    public function index(): string
    {
        if ($this->session->has('id')) {
            $data['name'] = $this->session->get('name');
            $data['email'] = $this->session->get('email');
            $data['id'] = $this->session->get('id');

            $data['notes'] = $this->noteModel->getNotesUser($data['id']);
            $data['favorite_notes'] = $this->noteModel->getNotesUser($data['id'], true);

            foreach($data['notes'] as &$i) {
                $i['note_text'] = $this->encrypter->decrypt(hex2bin($i['note_text']));  
            }

            foreach($data['favorite_notes'] as &$i) {
                $i['note_text'] = $this->encrypter->decrypt(hex2bin($i['note_text']));  
            }

            $data['content'] = view('home/index', $data);
            $data['footer'] = view('footer', [
                'scripts' => [
                    base_url("assets/js/home.js"),
                    base_url("assets/js/mobileResponsive.js")
                ],
                'styles' => [
                    base_url("assets/css/homeMediaQueries.css")
                ]
            ]);
        } else {
            $data['content'] = view('index');
            $data['footer'] = view('footer', [
                'scripts' => [
                    base_url("assets/js/note.js"),
                    base_url("assets/js/quillNote.js"),
                    base_url("assets/js/index.js")
                ],
                'styles' => [
                    base_url("assets/css/indexMediaQueries.css")
                ]
            ]);
        }

        $data['header'] = view('header');

        return $data['header'] . $data['content'] . $data['footer'];
    }

    public function note($noteId = null) 
    {
        if (!empty($noteId)) {
            $data['noteContent'] = $this->noteModel->getNoteById($noteId);

            if($data['noteContent']['id_user'] != $this->session->get('id')) {
                return redirect()->to(base_url());
            }

            if ($data['noteContent']) {
                $data['noteContent']['note_text'] = $this->encrypter->decrypt(hex2bin($data['noteContent']['note_text']));

                switch ($data['noteContent']['font_family']) {
                    case '"Playwrite DE Grund", cursive':
                        $data['noteContent']['font_family'] = "Playwrite D. G.";
                        break;
                    
                    case '"Roboto", sans-serif':
                        $data['noteContent']['font_family'] = "Roboto";
                        break;

                    case '"Open Sans", sans-serif':
                        $data['noteContent']['font_family'] = "Open Sans";
                        break;

                    case '"Playwrite AR", cursive':
                        $data['noteContent']['font_family'] = "Playwrite A.";
                        break;

                    case 'Arial, Helvetica, sans-serif':
                        $data['noteContent']['font_family'] = "Arial";
                        break;

                    case '"Times New Roman", Times, serif':
                        $data['noteContent']['font_family'] = "Times New Roman";
                        break;

                    default:
                        $data['noteContent']['font_family'] = "Playwrite D. G.";
                        break;
                }

                if (!isset($data['noteContent']['tag_color'])) {
                    $data['noteContent']['tag_color'] = '#ebebeb';
                }
            }
        } else {
            $data['noteContent'] = [
                'font_family' => '"Playwrite D. G.',
                'tag_color' => '#ebebeb'
            ];
        }

        if ($this->session->has('id')) {
            $data['name'] = $this->session->get('name');
            $data['email'] = $this->session->get('email');
            $data['id'] = $this->session->get('id');

            $data['content'] = view('note/index', $data);
        } else {
            return redirect()->to(base_url());
        }

        $data['header'] = view('header');
        $data['footer'] = view('footer', [
            'scripts' => [
                base_url("assets/js/note.js"),
                base_url("assets/js/quillNote.js"),
                base_url("assets/js/mobileResponsive.js")
            ],
            'styles' => [
                base_url("assets/css/homeMediaQueries.css"),
            ]
        ]);

        return $data['header'] . $data['content'] . $data['footer'];
    }

    public function signUp()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        if (empty($this->userModel->getUserByEmail($email))) {
            if ($this->userModel->addUser($name, $email, $password)) {
                $userData = $this->userModel->getUserByEmailAndPassword($email, $password);

                $this->session->set([
                    'name' => $name,
                    'id' => $userData['id'],
                    'email' => $email
                ]);

                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Failed to add user']);
            }
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'email error', 'message' => 'Email already exists']);
        }
    }

    public function logIn()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userData = $this->userModel->getUserByEmailAndPassword($email, $password);

        if (!empty($userData)) {
            $this->session->set([
               'name' => $userData['name'],
               'id' => $userData['id'],
                'email' => $email
            ]);

            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'user error', 'message' => 'Failed to get user']);
        }
    }

    public function logout()
    {
        $this->session->destroy();
    }

    public function deleteAccount()
    {
        $this->userModel->deleteUser($this->session->get('id'));
        $this->session->destroy();
    }

    public function saveNote()
    {
        $id = $this->request->getPost('noteId');
        $title = $this->request->getPost('noteTitle');
        $noteText = $this->request->getPost('noteText');
        $font_family = $this->request->getPost('fontFamily');
        $tag_color = $this->request->getPost('tagColor');
        $id_user = $this->session->get('id');

        switch ($font_family) {
            case "Playwrite D. G.":
                $font_family = '"Playwrite DE Grund", cursive';
                break;
            
            case "Roboto":
                $font_family = '"Roboto", sans-serif';
                break;

            case "Open Sans":
                $font_family = '"Open Sans", sans-serif';
                break;

            case "Playwrite A.":
                $font_family = '"Playwrite AR", cursive';
                break;
            
            case "Arial":
                $font_family = 'Arial, Helvetica, sans-serif';
                break;

            case "Times New Roman":
                $font_family = '"Times New Roman", Times, serif';
                break;
            
            default:
            $font_family = '"Playwrite DE Grund", cursive';
                break;
        }

        if($id === 'note') {
            $noteId = $this->noteModel->createNote($title, $noteText, $id_user, $font_family, $tag_color);

            return "$noteId";
        } else {
            $this->noteModel->saveNote($id, $title, $noteText, $font_family, $tag_color);
        }
    }

    public function deleteNote() {
        $id = $this->request->getPost('noteId');

        $this->noteModel->deleteNote($id);
    }

    public function searchNote()
    {
        $keyword = $this->request->getPost('searchNote');
        if (!empty($keyword)) {
            $results = $this->noteModel->searchNotes($keyword);

            if (!empty($results)) {
                return $this->response->setJSON($results);
            } else {
                return $this->response->setJSON(['message' => 'No notes found.']);
            }
        } else {
            return $this->response->setJSON(['message' => 'Keyword is empty.']);
        }
    }

    public function toggleFavorite() {
        $id = $this->request->getPost('noteId');
        $favorite = $this->request->getPost('favorite');

        $this->noteModel->updateFavorite($id, $favorite);
    }

    public function checkDatabaseConnection()
    {
        $db = \Config\Database::connect();

        try {
            // Tentativa de conexão com o banco de dados
            if ($db->connect()) {
                return $this->response->setStatusCode(200)->setBody('A conexão com o banco de dados foi bem-sucedida.');
            } else {
                return $this->response->setStatusCode(500)->setBody('Falha ao conectar ao banco de dados.');
            }
        } catch (DatabaseException $e) {
            // Captura qualquer exceção relacionada ao banco de dados
            return $this->response->setStatusCode(500)->setBody('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }
}
