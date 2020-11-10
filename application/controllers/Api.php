<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    /**
     * Api constructor.
     */
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mahasiswa');
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];
        $id = $this->get( 'id' );
        if ( $id === null ) {
            // Check if the users data store contains users
            if ( $users ) {
                // Set the response and exit
                $this->response( $users, 200 );
            } else {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        } else if ( array_key_exists( $id, $users ) ) {
            $this->response( $users[$id], 200 );
        } else {
            $this->response( [
                'status' => false,
                'message' => 'No such user found'
            ], 404 );
        }
    }

    /**
     *
     */
    public function students_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->Mahasiswa->get();
        } else {
            $mahasiswa = $this->Mahasiswa->get($id);
        }
        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such user found'
            ], 404);
        }
    }

    public function students_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'nim' => $this->post('nim'),
            'jurusan' => $this->post('jurusan'),
            'angkatan' => $this->post('angkatan'),
            'foto' => $this->post('foto')
        ];

        if ($this->Mahasiswa->create($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'New mahasiwa has been created'
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to created data'
            ], 400);
        }
    }

    public function students_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'nim' => $this->put('nim'),
            'jurusan' => $this->put('jurusan'),
            'angkatan' => $this->put('angkatan'),
            'foto' => $this->put('foto')
        ];

        if ($this->Mahasiswa->update($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'New mahassiwa has been updated.'
            ], 204);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed to update data!',
            ], 400);
        }
    }

    public function students_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!',
            ], 400);
        } else {
            if ($this->Mahasiswa->delete($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], 204);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], 400);
            }
        }
    }
}