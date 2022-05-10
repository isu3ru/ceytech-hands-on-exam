<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;
use App\Models\Page;
use App\Validators\Resolution;
use Rakit\Validation\Validator;

class PageController
{
    public function __construct()
    {
        if (!SessionHelper::has('admin')) {
            SessionHelper::clean();
            UrlHelper::redirect('/admin/login');
        }
    }

    public function index()
    {
        $title = 'Website Pages';

        $pagesModel = new Page;
        $pages = $pagesModel->all();

        ViewHelper::render('admin/pages/index', compact('title', 'pages'));
    }

    public function create()
    {
        $title = 'Create New Website Page';

        $pagesModel = new Page;
        $pages = $pagesModel->all();

        ViewHelper::render('admin/pages/create', compact('title', 'pages'));
    }

    public function createPage()
    {
        // get all post data
        $data = filter_var_array($_POST);
        $files = filter_var_array($_FILES);

        // validate
        $validator = new Validator();
        $validator->addValidator('resolution', new Resolution());

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'image' => 'uploaded_file|mimes:jpeg,jpg|resolution:1920,245',
        ]);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            dd($errors->toArray());
            SessionHelper::populateErrors($errors);
            SessionHelper::populateOldInput($data);
            UrlHelper::redirect('/admin/pages/create');
        }

        // upload file
        $file = $files['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedFileExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowedFileExtensions)) {
            if ($fileError === "0") {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                    $fileDestination = 'storage/pages/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // set image to page
                    $data['featured_image'] = $fileDestination;
                } else {
                    echo 'Your file is too big!';
                }
            } else {
                echo 'There was an error uploading your file!<br />Error is: ' . $fileError;
            }
        } else {
            echo 'You cannot upload files of this type!';
        }

        $data['published_at'] = isset($data['is_published']) ? date('Y-m-d H:i:s') : '';
        $data['user_id'] = 1;
        $data['is_published'] = isset($data['is_published']) ? 1 : 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['slug'] = UrlHelper::slugify($data['title']);

        // dd($data);

        // create new page
        $page = new Page($data);
        $page = $page->save();

        // redirect to page
        SessionHelper::setFlashData('success', 'Page created successfully!');
        UrlHelper::redirect('/admin/pages');
    }

    /**
     * Edit page
     *
     * @return void
     */
    public function edit()
    {
        $title = 'Edit Website Page';

        $pagesModel = new Page;
        $pages = $pagesModel->all();

        $pageId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $page = $pagesModel->getPageById($pageId);

        ViewHelper::render('admin/pages/edit', compact('title', 'pages', 'page'));
    }

    public function updatePage()
    {
        // get all post data
        $data = filter_var_array($_POST);
        $files = filter_var_array($_FILES);

        // validate
        $validator = new Validator();
        $validator->addValidator('resolution', new Resolution());

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'image' => 'uploaded_file|mimes:jpeg,jpg|resolution:1920,245',
        ]);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            SessionHelper::populateErrors($errors);
            SessionHelper::populateOldInput($data);
            UrlHelper::redirect('/admin/pages/create');
        }

        // upload file
        $file = $files['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowedFileExtensions = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowedFileExtensions)) {
            if ($fileError === "0") {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                    $fileDestination = 'storage/pages/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // delete already uploaded image
                    if (file_exists($data['featured_image'])) {
                        unlink($data['featured_image']);
                    }
 
                    // set image to page
                    $data['featured_image'] = $fileDestination;
                } else {
                    echo 'Your file is too big!';
                }
            } else {
                echo 'There was an error uploading your file!<br />Error is: ' . $fileError;
            }
        } else {
            echo 'You cannot upload files of this type!';
        }

        $data['published_at'] = isset($data['is_published']) ? date('Y-m-d H:i:s') : '';
        $data['user_id'] = 1;
        $data['is_published'] = isset($data['is_published']) ? 1 : 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['slug'] = UrlHelper::slugify($data['title']);

        // dd($data);

        // create new page
        $pageModel = new Page();
        $page = $pageModel->getPageById($data['id']);
        $page = $page->update();

        // redirect to page
        SessionHelper::setFlashData('success', 'Page updated successfully!');
        UrlHelper::redirect('/admin/pages');
    }

    public function deletePage()
    {
        $data = filter_var_array($_POST);

        // create new page
        $pageModel = new Page();
        $page = $pageModel->getPageById($data['id']);

        if ($page) {
            if (file_exists($page->featured_image)) {
                unlink($page->featured_image);
            }
            $page = $page->delete();
        }


        // redirect to page
        SessionHelper::setFlashData('success', 'Page deleted successfully!');
        UrlHelper::redirect('/admin/pages');
    }
}
