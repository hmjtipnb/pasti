<?php

namespace App\Controllers;

class FileController extends BaseController
{
    public function show($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound($filename);
        }

        // Ambil ekstensi file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $mime = mime_content_type($path);

        return $this->response->setHeader('Content-Type', $mime)
                              ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                              ->setBody(file_get_contents($path));
    }
}
