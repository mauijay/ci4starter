<?php namespace Jay\Modules\Blog\Controllers; 

// This is the ADMIN AREA
use App\Controllers\AdminController;
use Jay\Blog\Entities\Post;
use Jay\Blog\Models\NewsModel;


class BlogController extends AdminController
{
  protected $theme      = 'Admin';
  protected $viewPrefix = 'MyCode/Blog/Views\\';
	/**
	 * @var NewsModel
	 */
	protected $posts;

	public function __construct()
	{
		$this->posts = model(NewsModel::class);
	}

  public function index()
    {
        // test only
        //echo "Blog Index Test Page";
        /** @var UserFilter $userModel */
        //$userModel = model(UserFilter::class);

        //$userModel->filter($this->request->getPost('filters'));
        $bm = model(NewsModel::class)->join('categories', 'news.id_category=categories.id', 'left')->join('users', 'news.id_author=users.id', 'left');
		    $posts = $bm->findAll();

        $view = $this->request->getMethod() === 'post'
            ? $this->viewPrefix . '_table'
            : $this->viewPrefix . 'index';

        return $this->render($view, [
            'headers' => [
                'email'       => 'Email',
                'username'    => 'Username',
                'groups'      => 'Groups',
                'last_active' => 'Last Active',
            ],
            'showSelectAll' => true,
            'posts'         => $posts,
            //'pager'         => $userModel->pager,
        ]);
    }

	/**
	 * Lists all posts in the system.
	 */
	public function manage()
	{
    $bm = model(NewsModel::class)->join('categories', 'news.category_id=categories.cat_id', 'left')->join('users', 'news.author_id=users.users_id', 'left');
		$posts = $bm->findAll();

		echo view('admin/blog/index', [
			'posts' => $posts,			
		]);
	}

	public function createView()
	{
		echo view('admin/blog/form', [
			'formType' => 'create'
		]);
	}

  public function editView(int $id)
  {
      $bm = model(NewsModel::class)->join('categories', 'news.category_id=categories.cat_id', 'left')->join('users', 'news.author_id=users.users_id', 'left');
      $post = $bm->find($id);

      if ($post === null) {
          return redirect()->back()->with('error', 'Unable to locate the post.');
      }

      echo view('admin/blog/form', [
        'formType' => 'edit',          
        'post' => $post,
        
      ]);
  }

	/**
	 * Saves/Creates a post.
	 *
	 * @param int $id
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function save(int $id=null)
	{
		if (! $this->validate([
			'post_title' => 'required|string',
			'body' => 'required|string',
			'published_at' => 'required|valid_date',
		])) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$post = $id === null
			? new Post($this->request->getPost())
			: $this->posts->find($id);

		if ($post === null) {
			return redirect()->back()->with('error', 'Unable to find that post.');
		}

		$post->fill($this->request->getPost());
		$this->posts->save($post);

		return redirect()->to('/admin/posts')->with('message', 'Your post has been saved.');
	}

	/**
	 * Deletes a single post.
	 *
	 * @param int $id
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 */
	public function delete(int $id)
	{
		$post = $this->posts->find($id);

		if ($post === null) {
			return redirect()->back()->with('error', 'Unable to find that post.');
		}

		$post->delete();

		return redirect()->to('/admin/posts')->with('message', 'Your post has been deleted.');
	}
}
