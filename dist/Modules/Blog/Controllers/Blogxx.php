<?php

namespace Blogs\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Blogxx extends ResourceController
{
    protected $modelName = 'App\Models\BlogModel';
    protected $format = 'json';

    public function index()
    {
       // $posts = $this->model->findAll();
       // return $this->respond($posts);

        $data = [];
        helper(['form']);
        
        return view('Blogs\Views\index', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        helper(['form']);

        $rules = [
            'title' => 'required|min_length[6]',
            'description' => 'required',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            // Get the file
            $file = $this->request->getFile('image');
            if (!$file->isValid()) {
                return $this->fail($file->getErrorString());
            }

            $file->move('./assets/uploads');

            $data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'image' => $file->getName()
            ];
            $id = $this->model->insert($data);
            $data['id'] = $id;
            return $this->respondCreated($data);
        }
    }

    //--------------------------------------------------------------------

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $this->respond($data);
    }

    //--------------------------------------------------------------------

    public function update($id = null)
    {
        helper(['form', 'array']);

        $rules = [
            'title' => 'required|min_length[6]',
            'description' => 'required'
        ];

        $fileName = dot_array_search('image.name', $_FILES);

        // if there is a selected source
        if ($fileName != '') {
            // added rules for img
            $rules['image'] = 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            // $input = $this->request->getRawInput();
            $data = [
                'id' => $id,
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description')
            ];

            // if there is a selected source
            if ($fileName != '') {
                // Get the file
                $file = $this->request->getFile('image');
                if (!$file->isValid()) {
                    return $this->fail($file->getErrorString());
                }
                $file->move('./assets/uploads');

                // delete old source
                $post = $this->model->find($id);
                unlink('./assets/uploads/' . $post['image']);

                $data['image'] = $file->getName();
            }

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    //--------------------------------------------------------------------

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Item not found.');
        }
    }
}
