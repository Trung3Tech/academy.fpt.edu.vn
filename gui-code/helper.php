<?php
class customRewrite {
	public static function get_instance() {
		static $instance = null;
		if ( $instance === null ) {
			$instance = new self();
		}
		return $instance;
	}
	
	private function redirect($slug) {
		add_action('template_redirect', function() use ($slug) {
			$requested_url = $_SERVER['REQUEST_URI'];

			if (preg_match("#^/{$slug}/([^/]+)/?$#", $requested_url, $matches)) {
				$term_slug = $matches[1];

				$new_url = home_url("/{$term_slug}/");

				wp_redirect($new_url, 301);
				exit;
			}
		});
	}

	private function change_term_link($taxonomy_slug) {
		add_filter('term_link', function ($url, $term, $taxonomy) use ($taxonomy_slug) {
			if ($taxonomy === $taxonomy_slug) {
				$url = str_replace("/$taxonomy_slug", '', $url);
			}
			return $url;
		}, 10, 3);
	}
	
	private function change_term_request($taxonomy_slug){
		add_filter('request', function($query) use ($taxonomy_slug) {
			$tax_name = $taxonomy_slug; 
			if( $query[ 'attachment' ] ) {
				$include_children = true;
				$name = isset( $query[ 'attachment' ] ) ? $query[ 'attachment' ] : '';
			} else {
				$include_children = false;
				$name = isset( $query[ 'name' ] ) ? $query[ 'name' ] : '';
			}

			$term = get_term_by( 'slug', $name, $tax_name );

			if( ! is_wp_error( $term ) && $term ) {
				if( $include_children ) {
					unset( $query[ 'attachment' ] );
					$parent = $term->parent;
					while( $parent ) {
						$parent_term = get_term( $parent, $tax_name );
						$name = "{$parent_term->slug}/{$name}";
						$parent = $parent_term->parent;
					}
				} else {
					unset( $query[ 'name' ] );
				}

				switch( $tax_name ) {
					case 'category' : {
						$query[ 'category_name' ] = $name; 
						break;
					}
					case 'post_tag' : {
						$query[ 'tag' ] = $name; 
						break;
					}
					default : {
						$query[ $tax_name ] = $name;
						break;
					}
				}
			}
			return $query;
		});
	}
	
	private function change_cpt_request($cpt_name){
		add_filter('request', function($query) use ($cpt_name) {
			if (empty($query['name'])) {
				return $query;
			}
			global $wpdb;
			$post_id = $wpdb->get_var(
				$wpdb->prepare(
					"
                    SELECT ID
                    FROM $wpdb->posts
                    WHERE post_name = '%s'
                    AND post_type = '%s'
                    ",
					array(
						$query['name'],
						$cpt_name
					)
				)
			);
			if ($post_id) {
				$query[$cpt_name] = $query['name'];
				$query['post_type'] = $cpt_name;
			}
			return $query;
		}, 1);
	}
		
	private function change_cpt_with_hierachy_request($cpt_slug, $taxonomy_slug) {
		add_filter('request', function($query_vars) use ($cpt_slug, $taxonomy_slug) {
			$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
			$segments = explode('/', $uri);

			if (count($segments) < 2) return $query_vars;

			$post_slug = array_pop($segments);
			$term_path = implode('/', $segments);

			global $wpdb;

			$post_id = $wpdb->get_var($wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s AND post_status = 'publish'",
				$post_slug,
				$cpt_slug
			));

			if (!$post_id) {
				return $query_vars;
			}

			$query_vars = array();
			$query_vars['post_type'] = $cpt_slug;
			$query_vars['name'] = $post_slug;

			return $query_vars;
		});
	}


	private function change_cpt_link($cpt_slug) {
		add_filter('post_type_link', function($permalink, $post_id, $leavename) use ($cpt_slug) {
			if (strpos($permalink, "/{$cpt_slug}/") !== false) {
				$permalink = str_replace("/{$cpt_slug}/", '/', $permalink);
			}
			return $permalink;
		}, 10, 3);
		
	}
	
	private function change_cpt_link_with_hierachy($cpt_slug, $taxonomy_slug){
		add_filter('post_type_link', function($permalink, $post_id, $leavename) use ($cpt_slug, $taxonomy_slug) {
			$post = get_post($post_id);
			if (is_object($post) && $post->post_type === $cpt_slug) {
				$terms = wp_get_object_terms($post->ID, $taxonomy_slug);
				if (!empty($terms) && !is_wp_error($terms)) {
					$term = $terms[0];
					$term_hierarchy = [$term->slug];
					while ($term->parent != 0) {
						$term = get_term($term->parent, $taxonomy_slug);
						array_unshift($term_hierarchy, $term->slug);
					}

					$term_path = implode('/', $term_hierarchy);
					return home_url(user_trailingslashit("$term_path/{$post->post_name}"));
				}
			}
			return $permalink;
		}, 10, 3);
	}
	

	public function remove_post_type_slug($cpt_names) {
		foreach ($cpt_names as $cpt_name) {
			$this->change_cpt_link($cpt_name);
			$this->change_cpt_request($cpt_name);
			$this->redirect($cpt_name);
		}
	}
	
	public function remove_cpt_slug_with_hierchary($cpt_infos) {
		foreach ($cpt_infos as $cpt_info) {
			$this->change_cpt_link_with_hierachy($cpt_info['cpt_slug'], $cpt_info['tax_slug']);
			$this->change_cpt_with_hierachy_request($cpt_info['cpt_slug'], $cpt_info['tax_slug']);
			$this->redirect($cpt_info['cpt_slug']);
		}
	}

	public function remove_taxonomy_slug($taxonomies_slug){
		foreach($taxonomies_slug as $taxonomy_slug) {
			$this->change_term_link($taxonomy_slug);
			$this->change_term_request($taxonomy_slug);
			$this->redirect($taxonomy_slug);
		}
	}
}


class NnDB {
    private static $instance = null;
    private $table;
    private $columns = ['*'];
    private $where = [];
    private $joins = [];
    private $order = '';
    private $limit = '';
    private $last_query = '';

    public static function table($table_name) {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        global $wpdb;
        self::$instance->reset();
        self::$instance->table = $wpdb->prefix . $table_name;
        return self::$instance;
    }

    private function reset() {
        $this->columns = ['*'];
        $this->where = [];
        $this->joins = [];
        $this->order = '';
        $this->limit = '';
        $this->last_query = '';
    }

    public function select($columns = ['*']) {
        $this->columns = $columns;
        return $this;
    }

    public function where($column, $value) {
        $this->where[] = ['column' => $column, 'value' => $value];
        return $this;
    }

    public function join($join_table, $left_column, $operator, $right_column, $type = 'INNER') {
        global $wpdb;
        $join_table_full = $wpdb->prefix . $join_table;
        $type = strtoupper(trim($type));
        $operator = in_array($operator, ['=', '>', '<', '>=', '<=', '<>', '!=']) ? $operator : '=';
        $this->joins[] = "{$type} JOIN {$join_table_full} ON {$left_column} {$operator} {$right_column}";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $column = esc_sql($column);
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        $this->order = " ORDER BY {$column} {$direction}";
        return $this;
    }

    public function limit($count) {
        $count = intval($count);
        $this->limit = " LIMIT {$count}";
        return $this;
    }

    public function get() {
        global $wpdb;

        $columns = implode(', ', array_map('esc_sql', $this->columns));
        $sql = "SELECT {$columns} FROM {$this->table}";

        // Add JOINs
        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        $values = [];
        if (!empty($this->where)) {
            $conditions = [];
            foreach ($this->where as $w) {
                $col = esc_sql($w['column']);
                $conditions[] = "{$col} = %s";
                $values[] = $w['value'];
            }
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $sql .= $this->order . $this->limit;

        $this->last_query = $wpdb->prepare($sql, ...$values);
        return $wpdb->get_results($this->last_query, ARRAY_A);
    }

    public function first() {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function insert($data) {
        global $wpdb;
        $result = $wpdb->insert($this->table, $data);
        if ($wpdb->last_error) {
            echo $wpdb->last_error;
        }
        return $wpdb->insert_id;
    }

    public function update($id_column, $id, $data) {
        global $wpdb;
        $result = $wpdb->update($this->table, $data, [$id_column => $id]);
        return $result !== false;
    }

    public function delete() {
        global $wpdb;

        if (empty($this->where)) return false;

        $sql = "DELETE FROM {$this->table}";
        $values = [];
        $conditions = [];

        foreach ($this->where as $w) {
            $col = esc_sql($w['column']);
            $conditions[] = "{$col} = %s";
            $values[] = $w['value'];
        }

        $sql .= ' WHERE ' . implode(' AND ', $conditions);
        $this->last_query = $wpdb->prepare($sql, ...$values);

        return $wpdb->query($this->last_query);
    }

    public function get_last_query() {
        return $this->last_query;
    }
}


class NnQuery {
    protected $args = [];
    protected $wp_query = null; 

    public static function query($post_type = 'post') {
        $instance = new self();
        $instance->args['post_type'] = $post_type;
        $instance->args['post_status'] = 'publish';
        $instance->args['paged'] = max(1, get_query_var('paged') ?: get_query_var('page')); 
        return $instance;
    }

    public function whereMeta($key, $value, $compare = '=') {
        $this->args['meta_query'][] = [
            'key'     => $key,
            'value'   => $value,
            'compare' => $compare,
        ];
        return $this;
    }

    public function whereTax($taxonomy, $terms, $field = 'slug') {
        $this->args['tax_query'][] = [
            'taxonomy' => $taxonomy,
            'field'    => $field,
            'terms'    => $terms,
        ];
        return $this;
    }

    public function whereTitleLike($keyword) {
        $this->args['s'] = $keyword;
        $this->args['search_title_only'] = true;
        return $this;
    }

    public function orderBy($field, $order = 'DESC') {
        $this->args['orderby'] = $field;
        $this->args['order'] = $order;
        return $this;
    }

    public function limit($number) {
        $this->args['posts_per_page'] = $number;
        return $this;
    }

    public function paginate($paged = null) {
        if ($paged === null) {
            $paged = max(1, get_query_var('paged') ?: get_query_var('page'));
        }
        $this->args['paged'] = (int)$paged;
        return $this;
    }

    public function get() {
        $this->wp_query = new WP_Query($this->args);
        return $this->wp_query->have_posts() ? $this->wp_query->posts : [];
    }

    public function first() {
        $this->args['posts_per_page'] = 1;
        $query = new WP_Query($this->args);
        return $query->have_posts() ? $query->posts[0] : null;
    }

    public function getQueryArgs() {
        return $this->args;
    }

    public function getWpQuery() {
        return $this->wp_query;
    }
}

// hỗ trợ search ko phân biệt hoa thường
add_filter('posts_search', 'search_by_title', 10, 2);
function search_by_title($search, $query) {
    global $wpdb;

    if (!is_admin() && $query->is_search && $query->get('s') && $query->get('search_title_only')) {
        $search = '';
        $terms = explode(' ', $query->get('s'));

        foreach ($terms as $term) {
            $term = esc_sql($wpdb->esc_like($term));
            $search .= " AND ({$wpdb->posts}.post_title LIKE '%{$term}%')";
        }
    }

    return $search;
}

class PostTypeBuilder {
    protected $post_type;
    protected $singular;
    protected $args = [];
    protected $taxonomies = [];

    public static function make($post_type, $singular) {
        $instance = new self();
        $instance->post_type = $post_type;
        $instance->singular = $singular;

        // Default args
        $instance->args = [
			'labels' => [
				'name'               => $singular,
				'singular_name'      => $singular,
				'add_new'            => 'Thêm mới',
				'add_new_item'       => 'Thêm mới ' . $singular,
				'edit_item'          => 'Chỉnh sửa ' . $singular,
				'new_item'           =>  $singular . ' mới' ,
				'view_item'          => 'Xem ' . $singular,
				'search_items'       => 'Tìm kiếm' . $singular,
				'not_found'          => 'Không tìm thấy ' . strtolower($singular),
				'not_found_in_trash' => 'Không tìm thấy ' . strtolower($singular) . ' trong thùng rác',
			],
            'public' => true,
            'show_in_menu' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => true,
			'show_in_rest' => true,
			'exclude_from_search' => false,
    		'publicly_queryable' => true,   
        ];

        return $instance;
    }

    public function setArgs(array $args) {
        $this->args = array_merge($this->args, $args);
        return $this;
    }

    public function addTaxonomy($taxonomy, $label, $args = []) {
        $defaults = [
            'labels' => [
                'name' => $label,
                'singular_name' => $label,
            ],
            'public' => true,
            'hierarchical' => true,
        ];

        $this->taxonomies[] = [
            'taxonomy' => $taxonomy,
            'args' => array_merge($defaults, $args),
        ];

        return $this;
    }

    public function register() {
        add_action('init', function () {
            register_post_type($this->post_type, $this->args);

            foreach ($this->taxonomies as $tax) {
                register_taxonomy(
                    $tax['taxonomy'],
                    $this->post_type,
                    $tax['args']
                );
            }
        });
    }
}

