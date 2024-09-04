<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'note';
    protected $primaryKey = 'id';
    protected $allowedFields = ['note_title', 'note_text', 'tag_color', 'favorite', 'id_user', 'favorite_time', 'font_family'];

    public function createNote($title, $noteText, $id_user, $font_family, $tag_color)
    {
        $encrypter = \Config\Services::encrypter();

        $data = [
            'note_title' => $title,
            'note_text' => bin2hex($encrypter->encrypt($noteText)),
            'id_user' => $id_user,
            'font_family' => $font_family,
            'tag_color' => $tag_color
        ];

        $this->insert($data);
        return $this->getInsertID();
    }

    public function getNoteById($idNote) 
    {
        return $this->where('id', $idNote)->first();
    }

    public function getNotesUser($userId, $favorite=false) 
    {
        if($favorite) {
            return $this->where('id_user', $userId)
                ->where('favorite', $favorite)
                ->orderBy('modify_note', 'DESC')
                ->findAll();
        }

        return $this->where('id_user', $userId)
            ->orderBy('modify_note', 'DESC')
            ->findAll();
    }

    public function saveNote($id, $title, $noteText, $font_family, $tag_color) {
        $encrypter = \Config\Services::encrypter();

        $data = [
            'note_title' => $title,
            'note_text' => bin2hex($encrypter->encrypt($noteText)),
            'font_family' => $font_family,
            'tag_color' => $tag_color
        ];
    
        $this->set($data)->where('id', $id)->update();
        
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateFavorite($idNote, $value) {
        $data = [
            'favorite' => $value
        ];
    
        $this->set($data)->where('id', $idNote)->update();
    
        return $this->db->affectedRows() > 0;
    }

    public function deleteNote($idNote) {
        return $this->delete($idNote);
    }

    public function searchNotes($keyword)
    {
        $builder = $this->db->table($this->table)->like('note_title', $keyword);

        return $builder->get()->getResult();
    }
}
