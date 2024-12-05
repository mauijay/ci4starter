<?php namespace Blogs\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Class Post
 *
 * Represents a single blog post.
 */
class Post extends Entity
{
    // Added 'publish_at' so we get a Time instance
    // to make it simpler to work with.
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at'
    ];

    /**
     * Return the URL to this post.
     *
     * @return string
     */
    public function link()
    {
        return site_url('/news/'. $this->id);
    }

    public function getBody()
    {
        return nl2br(esc($this->attributes['body']));
    }
}
