<?php declare(strict_types=1);

namespace common;

class PostRepo {

	private $db;

	public function __construct(\PDO $db) {
		$this->db = $db;
	}

	public function all(int $limit): array {
		$sth = $this->db->prepare('select * from posts order by id limit :limit');
		$sth->bindValue(':limit', $limit, \PDO::PARAM_INT);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_CLASS, Post::class);
	}

	public function getTop(int $limit): array {
		$sth = $this->db->prepare('select * from posts order by views desc limit :limit');
		$sth->bindValue(':limit', $limit, \PDO::PARAM_INT);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_CLASS, Post::class);
	}

	public function save(Post $post) {
		if ($post->id !== null) {
			$sth = $this->db->prepare('
				update posts
				set
					title = :title,
					summary = :summary,
					md = :md,
					html = :html,
					tc = :tc,
					views = :views
				where id = :id
			');
			$sth->bindValue(':id', $post->id, \PDO::PARAM_INT);
		} else {
			$sth = $this->db->prepare('
				insert into posts (
					title,
					summary,
					md,
					html,
					tc,
					views
				)
				values (
					:title,
					:summary,
					:md,
					:html,
					:tc,
					:views
				)
			');
		}
		$sth->bindValue(':title', $post->title, \PDO::PARAM_STR);
		$sth->bindValue(':sumary', $post->summary, \PDO::PARAM_STR);
		$sth->bindValue(':md', $post->md, \PDO::PARAM_STR);
		$sth->bindValue(':html', $post->html, \PDO::PARAM_STR);
		$sth->bindValue(':tc', $post->tc, \PDO::PARAM_INT);
		$sth->bindValue(':views', $post->views, \PDO::PARAM_INT);
		$sth->execute();

		return $this->db->lastInsertId();
	}

}