<?php

namespace Blogs\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration {
  public function up()
  {
    $this->db->disableForeignKeyChecks();

    /*  1. News Blog Table -------------------------------------------------------------------------------- */

    $fields = [
      'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
      'post_title' => ['type' => 'VARCHAR', 'constraint' => 255],
      'short_title' => ['type' => 'VARCHAR', 'constraint' => 255, null => true],
      'slug' => ['type' => 'VARCHAR', 'constraint' => 255],
      'lead' => ['type' => 'mediumtext'],
      'body' => ['type' => 'text'],

      'id_author' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
      'id_category' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
      'id_comments' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
      'id_ebook' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],

      'post_img' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => ''],
      'post_img_alt' => ['type' => 'text'],
      'post_img_credit' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => '808pic.com'],

      'related_vid' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => ''],

      'md' => ['type' => 'tinytext'],
      'keyword' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => '808biz'],
      'reader_hits' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
      'post_status' => ['type' => 'ENUM', 'constraint' => ['shown', 'featured', 'archived']],
      'like' => ['type' => 'INT', 'constraint' => 20, 'null' => true],
      'unlike' => ['type' => 'INT', 'constraint' => 20, 'null' => true],
      'stars' => ['type' => 'tinyint', 'constraint' => 4, 'null' => true],
      'publish_at' => ['type' => 'datetime', 'null' => true],
      'created_at' => ['type' => 'datetime', 'null' => true],
      'updated_at' => ['type' => 'datetime', 'null' => true],
      'deleted_at' => ['type' => 'datetime', 'null' => true],
    ];
    $this->forge->addField($fields);
    $this->forge->addKey('id', true);
    $this->forge->addKey('created_at');
    $this->forge->addKey('updated_at');


    $this->forge->addForeignKey('id_category', 'categories', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('id_author', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('id_ebook', 'downloads', 'id', 'CASCADE', 'CASCADE');

    $this->forge->createTable('news');

    /* 2. Comments Table ------------------------------------------------------------------------------------ */
    $fields = [
      'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
      'id_author' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
      'id_post' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'client_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'product_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'subscription_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'invoice_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'website_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => TRUE],
      'comment_type' => ['type' => 'int', 'constraint' => 2],
      'comment' => ['type' => 'text'],
      'created_at' => ['type' => 'datetime', 'null' => true],
      'updated_at' => ['type' => 'datetime', 'null' => true],
      'deleted_at' => ['type' => 'datetime', 'null' => true],
    ];
    $this->forge->addField($fields);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('id_post', 'news', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('id_author', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('comments');

    /* 3. News Ratings ------------------------------------------------------ */
    $this->forge->addField([
      'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true, 'null' => false,],
      'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false,],
      'news_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false,],
      'stars' => ['type' => 'INT', 'unsigned' => true, 'null' => false,],
      'comment' => ['type' => 'TEXT', 'null' => true,],
      'created_at' => ['type' => 'datetime', 'null' => true],
      'updated_at' => ['type' => 'datetime', 'null' => true],
      'deleted_at' => ['type' => 'datetime', 'null' => true],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('news_id', 'news', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('news_ratings');

    /* 4. News Tags Table ---------------------------------------------------- */
    $fields = [
      'tag_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
      'news_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
    ];
    $this->forge->addField($fields);
    $this->forge->addForeignKey('news_id', 'news', 'id', '', 'CASCADE');
    $this->forge->addForeignKey('tag_id', 'tags', 'id', '', 'CASCADE');
    $this->forge->createTable('news_tags');

    // we must enable the checks now    
    $this->db->enableForeignKeyChecks();
  }

  public function down()
  {
    $this->db->disableForeignKeyChecks();

    $this->forge->dropTable('news', true);          //1
    $this->forge->dropTable('comments', true);      //2
    $this->forge->dropTable('news_ratings', true);//3
    $this->forge->dropTable('news_tags', true);//7


    // we must enable the checks now    
    $this->db->enableForeignKeyChecks();
  }
}
