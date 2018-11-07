<?php

use Illuminate\Database\Seeder;

class OAuthTableSeeder extends Seeder
{
    /**
     * @var \Illuminate\Database\DatabaseManager
     */
    private $db;

    /**
     * OAuthTableSeeder constructor.
     * @param \Illuminate\Database\DatabaseManager $db
     */
    public function __construct(\Illuminate\Database\DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->db->unprepared(
            <<<SQL
SET NAMES utf8mb4;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'Tron Game WIP Personal Access Client',	'nis75b4lXHQVUb9HAa9OYLDPyW5hNUxh8WzUxxll',	'http://localhost',	1,	0,	0,	'2018-11-07 17:59:17',	'2018-11-07 17:59:17'),
(2,	NULL,	'Tron Game WIP Password Grant Client',	'jarw0jo2Kgf4E8DnpG4AZCsgC6B8guu0y3TO41kJ',	'http://localhost',	0,	1,	0,	'2018-11-07 17:59:17',	'2018-11-07 17:59:17');

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2018-11-07 17:59:17',	'2018-11-07 17:59:17');
SQL
        );
    }
}
