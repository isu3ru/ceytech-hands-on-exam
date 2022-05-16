<?php

namespace App\Models;

use App\Model;
use PDO;

class Page extends Model
{
    public int $id;
    public string $title;
    public string $description;
    public string $featured_image;
    public ?string $published_at;
    public int $user_id;
    public string $is_published;
    public string $created_at;
    public string $slug;

    public function __construct(
        array $data = []
    ) {
        parent::__construct();

        if (!empty($data)) {
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->featured_image = $data['featured_image'];
            $this->slug = $data['slug'];
            $this->published_at = $data['published_at'];
            $this->user_id = $data['user_id'];
            $this->is_published = $data['is_published'];
            $this->created_at = $data['created_at'];
        }
    }

    public function getPageById(int $id)
    {
        $sql = 'SELECT * FROM pages WHERE id = :id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch();

        if (!$result) {
            return  null;
        }

        $page = new Page(
            [
                'title' => $result['title'],
                'description' => $result['description'],
                'featured_image' => $result['featured_image'],
                'published_at' => $result['published_at'],
                'user_id' => $result['user_id'],
                'is_published' => $result['is_published'],
                'created_at' => $result['created_at'],
                'slug' => $result['slug']
            ]
        );
        $page->id = $result['id'];
        return $page;
    }

    public function getPageBySlug(string $slug)
    {
        $sql = 'SELECT * FROM pages WHERE slug = :slug LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();

        $result = $stmt->fetch();

        if (!$result) {
            return  null;
        }

        $page = new Page(
            [
                'title' => $result['title'],
                'description' => $result['description'],
                'featured_image' => $result['featured_image'],
                'published_at' => $result['published_at'],
                'user_id' => $result['user_id'],
                'is_published' => $result['is_published'],
                'created_at' => $result['created_at'],
                'slug' => $result['slug']
            ]
        );
        $page->id = $result['id'];
        return $page;
    }

    public function all($is_published_only = false)
    {
        $sql = 'SELECT * FROM pages';
        if ($is_published_only) {
            $sql .= ' WHERE is_published = 1';
        }
        $sql .= ' ORDER BY title';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (!$result) {
            return  null;
        }

        $pages = [];

        foreach ($result as $row) {
            $page = new Page(
                [
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'featured_image' => $row['featured_image'],
                    'published_at' => $row['published_at'],
                    'user_id' => $row['user_id'],
                    'is_published' => $row['is_published'],
                    'created_at' => $row['created_at'],
                    'slug' => $row['slug']
                ]
            );
            $page->id = $row['id'];
            $pages[] = $page;
        }

        return $pages;
    }

    public function save()
    {
        $published_at = ($this->published_at == '') ? null : $this->published_at;
        $sql = 'INSERT INTO pages (title, description, featured_image, published_at, 
        user_id, is_published, created_at, slug)
        VALUES (:title, :description, :featured_image, :published_at, :user_id,
        :is_published, :created_at, :slug)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':featured_image', $this->featured_image);
        $stmt->bindParam(':published_at', $published_at);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':is_published', $this->is_published);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':slug', $this->slug);
        $stmt->execute();

        $this->id = $this->connection->lastInsertId();

        return $this;
    }

    public function create(array $data)
    {
        $page = new Page(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'featured_image' => $data['featured_image'],
                'published_at' => $data['published_at'],
                'user_id' => $data['user_id'],
                'is_published' => $data['is_published'],
                'created_at' => $data['created_at'],
                'slug' => $data['slug']
            ]
        );
        $page = $page->save();
        return $page;
    }

    public function update()
    {
        $published_at = ($this->published_at == '') ? null : $this->published_at;
        $sql = 'UPDATE pages SET title = :title, description = :description, featured_image = :featured_image, 
        published_at = :published_at, user_id = :user_id, is_published = :is_published, 
        created_at = :created_at, slug = :slug WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':featured_image', $this->featured_image);
        $stmt->bindParam(':published_at', $published_at);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':is_published', $this->is_published);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':slug', $this->slug);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $this;
    }

    public function delete()
    {
        $sql = 'DELETE FROM pages WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $this;
    }
}
