<?php

declare(strict_types=1);


namespace Blogs\Controllers;


use Blogs\Entities\Post;
//use App\Models\PollingModel;
use App\Models\ProductModel;
use App\Models\AdvModel;
use Blogs\Models\BlogModel;
use Blogs\Models\BlogRatingModel;
use Blogs\Models\BlogTagModel;
use App\Models\CategoryModel;
use App\Models\DownloadModel;
use App\Models\TagModel;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;

/**
 * Summary of Blogs
 * @author 808 Business Solutions
 * @copyright (c) 2024 808biz
 * @link https://808.biz/
 */
class Blogs extends BaseController {
  /**
   * @var Blogs
   */
  protected $pM;
  protected $adV;
  protected $bRM;
  protected $bTM;
  protected $cM;
  protected $dL;
  protected $tM;

  public function __construct()
  {
    //$adV = model(AdvModel::class);  
    //  $session    = session();
  }



  /**
   * Summary of index
   * Lists all posts in the system for the front end.
   * @return string
   */
  public function index()
  {
    $pM   = model(BlogModel::class);
    $adV  = model(AdvModel::class);
    $data = [
      'title' => 'Hawaii Business News',
      'pageTitle' => '808biz blog',
      'desc' => '808 Business Solutions focuses on helping your small business succeed and grow. We work one-on-one with our clients taking them from concept and idea to a mid-size growth.',
      'posts' => $pM->getNews()->paginate(15, 'news-group'),
      'pager' => $pM->pager,
      'featured' => $pM->getFeaturedNews(),
      'popular' => $pM->getPopularNews(),
      'Ad728' => $adV->get728Ad(),
      'tallAd' => $adV->getTallSidebarAd(),
      'squareAd' => $adV->getSqSidebarAd()
    ];
    return view('Blogs\Views\index', $data);
  }

  /**
   * displays the search results from the blog search.
   */
  public function search()
  {
    $type     = $this->request->getVar('typ') ?? '';
    $keyword  = $this->request->getVar('keyword') ?? '';
    $pM       = model(BlogModel::class);
    $adV      = model(AdvModel::class);
    $products = model(ProductModel::class);
    $data     = [
      'title' => 'Hawaii Business News',
      'pageTitle' => '808biz blog',
      'desc' => 'My Blog, registered agent, sales marketing, membership portal, page builder',
      'popular' => $pM->getPopularNews(),
      'posts' => $pM->search($keyword)->getPagination(12, 'news-group', null, 3),
      'pager' => $pM->pager,
      'search' => $keyword,
      'fps' => $products->getPopularProducts(6),
      'Ad728' => $adV->get728Ad(),
      'squareAd' => $adV->getSqSidebarAd()
    ];
    return view('blog/search_list', $data);
  }

  /**
   * displays the blog posts by Category
   */
  public function by_cat($cat)
  {
    $cM       = model(CategoryModel::class);
    $category = $cM->where('cat_slug', $cat)->first();
    $pM       = model(BlogModel::class);
    $adV      = model(AdvModel::class);
    $data     = [
      'title' => 'Hawaii Business News',
      'pageTitle' => '808biz blog',
      'desc' => 'My Blog, registered agent, sales marketing, membership portal, page builder',
      'popular' => $pM->getPopularNews(),
      'featured' => $pM->getFeaturedNews($category->id),
      'top3' => $pM->getTop3ByCatNews($category->id),
      'cat' => $category,
      'Ad728' => $adV->get728Ad(),
      'squareAd' => $adV->getSqSidebarAd(),
      'posts' => $pM->where('id_category', $category->id)->getPagination2(12, 'news-group', null, 3),
      'pager' => $pM->pager,
    ];
    return view('blog/catindex', $data);
  }

  /**
   *   Displays a Single Blog Post for the front end.
   */
  public function view($slug = null)
  {
    $pM   = model(BlogModel::class);
    $adV  = model(AdvModel::class);
    $post = $pM->getNews($slug);
    if (empty($post)) {
      return redirect()->back()->with('error', 'Unable to locate the post: ' . $slug);
    }
    $data              = [
      'title' => $post->post_title . ' | ' . $post->cat_name,
      'pageTitle' => '808 Business Solutions News Blog',
      'desc' => $post->md,
      'post' => $post,
      'Ad728' => $adV->get728Ad(),
      'tallAd' => $adV->getTallSidebarAd(),
      'squareAd' => $adV->getSqSidebarAd(),
      'popular' => $pM->getPopularNews()
    ];
    $post->reader_hits = $post->reader_hits + 1;
    //$post->id = $post->id;
    $pM->save($post);
    if (auth()->loggedIn()) {
      $bRM                    = model(BlogRatingModel::class);
      $data['userBlogRating'] = $bRM->findPostRating($post->id);
    }
    return view('blog/view', $data);
  }

  public function addRating($id)
  {
    $pM   = model(BlogModel::class);
    $post = $pM->find($id);
    if (!$post) {
      return redirect()->back()->with('error', 'Post is not found');
    }
    $bRM        = model(BlogRatingModel::class);
    $postRating = [
      'user_id' => auth()->id(),
      'news_id' => $id,
      'stars' => $this->request->getPost('stars'),
      'comment' => $this->request->getPost('comment'),
    ];
    if (!$bRM->save($postRating)) {
      return redirect()->back()->with('error', 'Failed to save rating and review.');
    }
    return redirect()->back()->with('message', 'Success.');
  }

  public function changeRating($id)
  {
    $pM   = model(BlogModel::class);
    $post = $pM->find($id);
    if (!$post) {
      return redirect()->back()->with('error', 'Comic not found.');
    }
    $bRM        = model(BlogRatingModel::class);
    $postRating = $bRM->findPostRating($id);
    if (!$postRating) {
      return redirect()->back()->with('error', 'Rating Comic not found.');
    }
    $postRating->stars   = $this->request->getPost('stars');
    $postRating->comment = $this->request->getPost('comment');
    if (!$bRM->save($postRating)) {
      return redirect()->back()->with('error', 'Failed to change comic rating.');
    }
    return redirect()->back()->with('message', 'Comic rating successfully changed.');
  }

  /**
   * Lists all posts in the system for the Admin.
   * @return string
   */
  public function manage() //Admin index *******************************************
  {
    $pM   = model(BlogModel::class);
    $data = [
      'title' => 'News Admin for 808 Business Solutions',
      'heading' => 'News Admin',
      'desc' => '808 Business Solutions focuses on helping your small business succeed and grow. We work one-on-one with our clients taking them from concept and idea to a mid-size growth.',
      'news' => $pM->getAdminList(),
    ];
    return view('blog/admin/index', $data);
  }



  /**
   *   Displays the form to create a new Post.
   */
  public function create() // ***************************************************/ Admin Create Post 
  {
    $pM = model(BlogModel::class);
    if (!$this->request->is('post')) {
      if (!auth()->user()->can('posts.create')) {
        //  dd('Unauthorized');  // this is temp, create a redirect for the unauthorized     
        return redirect()->to(route_to('news.manage'))->with('error', 'not yet, buddy! You are not authorized to Create a Post.');
      }
      $rules = $pM->getValidationRules();
      if ($this->validate($rules)) {
        // **********************************print r test*************** */
        /*    echo '<pre>';
              print_r($_POST); 
              echo '<pre>';
              die();
        */
        // do the add
        helper('image');
        $post              = new Post($this->validator->getValidated());
        $post->id_author   = user_id();
        $post->reader_hits = 0;
        $post->like        = 0;
        $post->unlike      = 0;
        $post->stars       = 5;
        $post->publish_at  = Time::now('UTC');
        // echo '<pre>';print_r($post);echo '<pre>';exit();  //**********************************print r test*************** */
        $path = './uploads/blog';
        $img  = $this->request->getFile('image');
        //  $imageService = service('image');
        $imageService = \Config\Services::image();
        if ($img->isValid() && !$img->hasMoved()) {
          $img->move($path);
          $fileName       = strtolower($img->getName()); // moved filename in case there are duplicates
          $post->post_img = $fileName;
          // echo '<pre>';print_r($post);echo '<pre>';exit();  //**********************************print r test*************** */

          $this->imageManipulation($path, 'postImg', $fileName, $imageService);
          $data['folders'][] = 'postImg';

          $this->imageManipulation($path, 'postImgSm', $fileName, $imageService);
          $data['folders'][] = 'postImgSm';

          $this->imageManipulation($path, 'ogImg', $fileName, $imageService);
          $data['folders'][] = 'ogImg';

          $this->imageManipulation($path, 'twImg', $fileName, $imageService);
          $data['folders'][] = 'twImg';

          $this->imageManipulation($path, 'thumbs', $fileName, $imageService);
          $data['folders'][] = 'thumbs';

          // echo '<pre>';print_r($post);echo '<pre>';exit();  //**********************************print r test*************** */

          if ($news_id = $pM->insert($post)) {
            // ********first  save to model and get news_id to insert tags   *************** //          
            $tags      = $this->request->getPost('post_tags');
            $bTM       = model(BlogTagModel::class);
            $news_tags = [];
            foreach ($tags as $tag_id) {
              $news_tags[] = compact('news_id', 'tag_id');
            }
            $bTM->insertBatch($news_tags);
            // ******  end insert tags  ****************************//
            return redirect()->to('/admin/manage-blog')->with('success', 'Blog Post added successfully');
          } else {
            return redirect()->back()->with('error', 'Unable to save');
          }
        }
      }
    }
    // otherwise just display the form
    $cM   = model(CategoryModel::class);
    $dL   = model(DownloadModel::class);
    $tM   = model(TagModel::class);
    $data = [
      'title' => 'Create a News Article | 808 BUS SOL',
      'pageTitle' => 'Create a New Post',
      'heading' => 'Create a News Post for 808 Business Solutions Blog',
      'desc' => '808 Business Solutions focuses on helping your small business succeed and grow. We work one-on-one with our clients taking them from concept and idea to a mid-size growth.',
      'validator' => $this->validator ?? service('validation'),
      'catz' => $cM->findAll(),
      'ebooks' => $dL->findAll(),
      'tags' => $tM->findAll()
    ];
    return view('blog/admin/add', $data); // add, crud or crud_form
  }






  /**
   *   Displays the form to create a new Post.  **USE THIS AS A SAMPLE **
   */
  public function create_XSampleX()
  {
    $pM = model(BlogModel::class);
    if (!auth()->user()->can('posts.create')) {
      //  dd('Unauthorized');   
      return redirect()->to(route_to('news.manage'))->with('error', 'not yet, buddy! You are not authorized to Create a Post.');
    }
    $rules = $pM->getValidationRules();

    if ($this->request->is('post') && $this->validate($rules)) {
      // ******************print r test********************* */
      /* echo '<pre>'; print_r($_POST); echo '<pre>'; die(); */
      // do the add
      helper('image');
      $post              = new Post($this->validator->getValidated());
      $post->id_author   = user_id();
      $post->reader_hits = 0;
      $post->like        = 0;
      $post->unlike      = 0;
      $post->stars       = 5;
      $post->publish_at  = Time::now('UTC');
      /* echo '<pre>';print_r($post);echo '<pre>'; exit();  ******print r test****** */
      $path         = './uploads/blog';
      $img          = $this->request->getFile('image');
      $imageService = \Config\Services::image();
      if ($img->isValid() && !$img->hasMoved()) {
        $img->move($path);
        $fileName       = strtolower($img->getName()); // moved filename in case there are duplicates
        $post->post_img = $fileName;
        /* echo '<pre>';print_r($post);echo '<pre>';exit();  ********print r test****** */

        $this->imageManipulation($path, 'postImg', $fileName, $imageService);
        $data['folders'][] = 'postImg';

        $this->imageManipulation($path, 'postImgSm', $fileName, $imageService);
        $data['folders'][] = 'postImgSm';

        $this->imageManipulation($path, 'ogImg', $fileName, $imageService);
        $data['folders'][] = 'ogImg';

        $this->imageManipulation($path, 'twImg', $fileName, $imageService);
        $data['folders'][] = 'twImg';

        $this->imageManipulation($path, 'thumbs', $fileName, $imageService);
        $data['folders'][] = 'thumbs';

        /* echo '<pre>';print_r($post);echo '<pre>';exit();  ********print r test**** */

        if ($news_id = $pM->insert($post)) {
          // ********first  save to model and get news_id to insert tags   *************** //          
          $tags      = $this->request->getPost('post_tags');
          $bTM       = model(BlogTagModel::class);
          $news_tags = [];
          foreach ($tags as $tag_id) {
            $news_tags[] = compact('news_id', 'tag_id');
          }
          $bTM->insertBatch($news_tags);
          // ******  end insert tags  ****************************//
          return redirect()->to('/admin/manage-blog')->with('success', 'Blog Post added successfully');
        } else {
          return redirect()->back()->with('error', 'Unable to save');
        }
      }
    }
    // otherwise just display the form
    $cM   = model(CategoryModel::class);
    $dL   = model(DownloadModel::class);
    $tM   = model(TagModel::class);
    $data = [
      'title' => 'Create a News Article | 808 BUS SOL',
      'pageTitle' => 'Create a New Post',
      'heading' => 'Create a News Post for 808 Business Solutions Blog',
      'desc' => '808 Business Solutions News Admin.',
      'validator' => $this->validator ?? service('validation'),
      'catz' => $cM->findAll(),
      'ebooks' => $dL->findAll(),
      'tags' => $tM->findAll()
    ];
    return view('blog/admin/add', $data); // add, crud or crud_form
  }






  /**
   * 
   * new 4.40 by the book along with the spanish you tube dude
   * 
   * The $this->request->is() method can be used since v4.3.0. In previous versions, you need to use if (strtolower($this->request->getMethod()) !== 'post').
   * 
   * The $this->validator->getValidated() method can be used since v4.4.0.
   * 
   */

  public function guarda()
  {
    if (!$this->request->is('post')) {
      return view('signup');
    }

    $rules = [];

    if (!$this->validate($rules)) {
      //return view('signup');
      return redirect()->back()->withInput();
    }

    // If you want to get the validated data.
    $validData = $this->validator->getValidated();

    return view('success');
  }




  /**
   * Displays the edit post form
   *
   * @param int $postId
   *
   * @return \CodeIgniter\HTTP\RedirectResponse
   */
  public function edit(int $postId)
  {
    $pM   = model(BlogModel::class);
    $post = $pM->find($postId);
    if ($post === null) {
      return redirect()->back()->with('error', 'Unable to find that post.');
    }
    /*

    if (! $this->policy->can('posts.edit', $post)) {
      return $this->policy->deny('You are not allowed to edit this post.');
    }

    */
    if (!auth()->user()->can('posts.edit')) {
      dd('Unauthorized');  // this is temp, create a redirect for the unauthorized
    }
    if (
      $this->request->is('post') && $this->validate([
        'body' => ['required', 'string', 'max_length[165000]'],
        'likes' => 'required'
      ])
    ) {

      // do update

      $post->fill($this->validator->getValidated());

      dd($post);

      if ($pM->update($postId, $post)) {

        // ********** insert tags   *************** //
        $bTM       = model(BlogTagModel::class);
        $news_id   = $postId;
        $tags      = $this->request->getPost('post_tags');
        $news_tags = [];
        foreach ($tags as $tag_id) {
          $news_tags[] = compact('news_id', 'tag_id');
        }
        /*  echo '<pre>';
        print_r($news_tags); 
        echo '<pre>';
        die();
        */
        $bTM->insertBatch($news_tags);
        // ******  end insert tags  ***************//

        return redirect()->to('/admin/manage-blog')->with('success', 'Blog Post added successfully');
      } else {
        return redirect()->back()->with('error', 'Unable to save');
      }

    }
    $cM   = model(CategoryModel::class);
    $dL   = model(DownloadModel::class);
    $tM   = model(TagModel::class);
    $data = [
      'title' => 'Admin - 808 Business Solutions Edit News Post',
      'pageTitle' => 'Edit Post',
      'heading' => 'News Edit Page for 808 Business Solutions',
      'desc' => '808 Business Solutions focuses on helping your small business succeed and grow. We work one-on-one with our clients taking them from concept and idea to a mid-size growth.',
      'validator' => $this->validator ?? service('validation'),
      'post' => $post,
      'catz' => $cM->findAll(),
      'ebooks' => $dL->findAll(),
      'tags' => $tM->findAll()
    ];
    return view('blog/admin/crud', $data);
  }

  //  *******************************************************************************

  function image($key)
  {
    $pM     = model(BlogModel::class);
    $data[] = null;
    $data   = [
      'blog' => $pM->find($key)
    ];
    if (!empty($data['blog'])) {
      session()->set('blog', $data['blog']);
      echo view('blogs/admin/image', $data);
    } else {
      return redirect()->back();
    }
  }

  function saveImage()
  {
    $pM           = model(BlogModel::class);
    $blog         = session()->get('blog');
    $oldfile      = $blog['picture'];
    $path         = './resources/images/blogs';
    $id           = $blog['id'];
    $data['blog'] = $blog;

    if ($this->request->getMethod() == 'post') {
      $rules = $pM->getValidationRules(['only' => ['image']]);
      if ($this->validate($rules)) {

        $img = $this->request->getFile('image');

        if ($img->isValid() && !$img->hasMoved()) {
          $imageName = $img->getRandomName();
          $data      = ['picture' => $imageName];

          $pM->update($id, $data);
          if (file_exists($path . '/' . $oldfile) && $oldfile !== null) {
            unlink($path . '/' . $oldfile);
          }
          $img->move('./resources/images/blogs', $imageName);
          session()->remove('blog');
          return redirect()->to('/blogs');
        }
      } else {
        $data['validation'] = $validation->getErrors();
      }
    }
    echo view('blogs/admin/image', $data);
  }


  /**
   * Deletes a single post.
   *
   * @param int $postId
   *
   * @return \CodeIgniter\HTTP\RedirectResponse
   */
  function delete(int $postId)
  {
    $pM      = model(BlogModel::class);
    $post    = $pM->find($postId);
    $oldfile = $post->post_img;
    $path    = './uploads/blog/postImg';

    if (!empty($post)) {
      $pM->where('id', $postId)->delete();

      if (file_exists($path . '/' . $oldfile)) {
        unlink($path . '/' . $oldfile);
      }
      return redirect()->to('/admin/manage-blog')->with("success", "Your post has been deleted.");
    } else {
      return redirect()->back()->with("error", "Unable to find that post.");
    }
  }

  /**
   * Return the HTML for our Recent Posts view cell.
   *
   * @param array $params
   *
   * @return string
   */
  public function recentPostsCell(array $params = [])
  {
    $pM = model(BlogModel::class);

    return view('partials/front/_recent', [
      'posts' => $pM->orderBy('id', 'asc')->findAll($params['limit'] ?? 6),
    ]);
  }

  /**
   * Return the HTML for our Recent Posts view cell.
   *
   * @param array $params
   *
   * @return string
   */
  public function recentPostsOnlyCell(array $params = [])
  {
    $pM = model(BlogModel::class);

    return view('partials/front/_recent2', [
      'posts' => $pM->orderBy('id', 'asc')->paginate($params['limit'] ?? 7),
    ]);
  }

  /**
   * Displays the 5 most recent posts in their entirety.
   */
  public function newest(array $params = [])
  {
    $pM = model(BlogModel::class);
    echo view('posts/list', [
      'posts' => $pM
        ->published()
        ->orderBy('post_title', 'asc')
        ->paginate($params['limit'] ?? 8),
      'pager' => $pM->pager,
    ]);
  }


  public function rss()
  {
    $pM   = model(BlogModel::class);
    $data = [
      'title' => 'Hawaii Business RSS Newsfeed',
      'pageTitle' => 'rss newsfeed for 808biz blog',
      'desc' => 'This is the rss feed page that will show every news item in a sorted list',
    ];

    return $this->render('front/news/rss', $data);
    //echo view('front/news/jay');
  }

  /*
    echo '<pre>';
    print_r($blog); die();
    // print_r($current_user['id']);
    echo '<pre>';
  */

  private function imageManipulation($path, $folder, $fileName, $imageService)
  {
    $savePath = $path . '/' . $folder;
    if (!file_exists($savePath))
      mkdir($savePath, 755);
    $imageService->withFile(src($fileName));
    switch ($folder) {
      case 'postImg':
        $imageService->fit(660, 360); //680x370  index page
        $imageService->text('Copyright 2022 808PIC.COM', [
          'color' => '#e83e8c',
          'opacity' => 0.5,
          'withShadow' => false,
          'shadowColor' => '#e83e8c',
          'hAlign' => 'center',
          'vAlign' => 'bottom',
          'fontSize' => 12
        ]);
        break;

      case 'postImgSm':
        $imageService->fit(395, 216); //680x370  view page
        $imageService->text('Copyright 2022 808PIC.COM', [
          'color' => '#e83e8c',
          'opacity' => 0.5,
          'withShadow' => false,
          'shadowColor' => '#e83e8c',
          'hAlign' => 'center',
          'vAlign' => 'bottom',
          'fontSize' => 12
        ]);
        break;

      case 'thumbs':
        $imageService->fit(150, 150);
        $imageService->text('Copyright 2022 808PIC.COM', [
          'color' => '#e83e8c',
          'opacity' => 0.5,
          'withShadow' => false,
          'shadowColor' => '#e83e8c',
          'hAlign' => 'center',
          'vAlign' => 'bottom',
          'fontSize' => 12
        ]);
        break;

      case 'ogImg':
        $imageService->fit(1200, 628); //1200x628
        $imageService->text('Copyright 2022 808PIC.COM', [
          'color' => '#e83e8c',
          'opacity' => 0.5,
          'withShadow' => false,
          'shadowColor' => '#e83e8c',
          'hAlign' => 'center',
          'vAlign' => 'bottom',
          'fontSize' => 12
        ]);
        break;

      case 'twImg':
        $imageService->fit(2048, 2048); //4096x4096  2048 for now until i upload some bigger originals
        $imageService->text('Copyright 2022 808PIC.COM', [
          'color' => '#e83e8c',
          'opacity' => 0.5,
          'withShadow' => false,
          'shadowColor' => '#e83e8c',
          'hAlign' => 'center',
          'vAlign' => 'bottom',
          'fontSize' => 12
        ]);
        $imageService->flip('horizontal');
        break;
    }
    return $imageService->save($savePath . '/' . $fileName);
  }

}