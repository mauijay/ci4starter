<?php
namespace Blogs\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use Exception;
use Blogs\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\UserModel;

class NewsSeeder extends Seeder
{
	public function run()
	{
    helper('basic');
    $userModel = new UserModel();
    $userIds = $userModel->select('id')->findAll();
    $userIds = array_column($userIds, 'id');
    $categoryModel = new CategoryModel();
    $categories = $categoryModel->select('id, cat_name')->where('cat_type', 'blog')->findAll();
    $categoryIds = array_column($categories, 'id');
    $categoryNames = array_column($categories, 'cat_name');

    //dd($categoryNames); //test this



		$model = new BlogModel();
		for ($i = 0; $i < 25; $i++) {
			$model->insert($this->generatePost($userIds, $categoryIds, $categoryNames));
		}
	}
  
  private function generatePost($userIds, $categoryIds, $categoryNames): array
  {
    $faker = Factory::create();
    $randomIndex = rand(0, count($categoryIds) - 1);
    $categoryId = $categoryIds[$randomIndex];
    $categoryName = strtolower($categoryNames[$randomIndex]);
    $title = $this->generateTitleRelatedToCategory($categoryName);
    $date = $faker->dateTimeBetween('-2 years', 'now');
    $books = [null, null, [rand(1, 7)]];
    $postStatus = ['shown','shown','shown','shown','archived'];

    $postContent = "<p>Raising money for a business is not as difficult as most people think. This is especially true when you have an idea that can make you and your investors rich. There is more money available for new business ventures than there are good business ideas. An essential rule of the game to learn: any time you want to raise money, your first move should be to assemble a proper prospectus. This prospectus should include a resume of your background, education, training, experience, and any other personal qualities that might be counted as an asset to your potential success. It's also a good idea to list the various loans you've had, what they were for, and your history in paying them off. You'll have to explain how the money you want will be used. If it's for an existing business, you'll need a profit and loss record for at least the preceding six months and a plan showing how this additional money will produce greater profits. If it's a new business, you'll have to show your proposed business plan, your marketing research, and projected costs, as well as anticipated income figures, with a summary for each year over at least three years. It will benefit you to base your cost estimates high and your income projections on minimal returns. This will enable you to \"ride through\" those extreme \"ups and downs\" inherent in any beginning <a href=\"https://808.biz\"target=\"_blank\" >business</a>.</p>
    <p>It would be best to describe what makes your business unique---how it differs from your competition and the opportunities for expansion or secondary products. This prospectus will have to state precisely what you're offering the investor in return for using his money. He'll want to know the percentage of interest you're willing to pay, whether monthly, quarterly, or annually. Are you offering a certain percentage of the profits? A percentage of the business? A seat on your board of directors? An investor uses his money to make more money. He wants to make as much as possible, regardless of whether it's a short-term or long-term deal. To attract him, interest him, and persuade him to \"put up\" the money you need, you'll not only have to offer him an opportunity for big profits, but you'll have to spell it out in detail and further, back up your claims with proof from your marketing research. </p>
    <p>Venture investors are usually quite familiar with \"high-risk\" proposals, yet they all want to minimize that risk as much as possible. Therefore, your prospectus should include a listing of your business and personal assets with documentation---usually copies of your tax returns for the past three years or more. Your prospective investor may not know anything about you or your business, but if he wants to know, he can pick up his telephone and know everything there is to know within 24 hours. The point is, don't ever try to \"con\" a potential investor. Be honest with him. Lay all the facts on the table for him. In most cases, if you've got a good idea and done your homework properly, an \"interested investor\" will understand your position and offer more help than you dared to ask. </p>
    <p>When you have your prospectus prepared and know how much money you want, exactly how it will be used, and how you intend to repay it, you're ready to start looking for investors. As simple as it seems, one of the easiest ways of raising money is by advertising in a newspaper or a national publication featuring such ads. Your ad should state the amount of money you want--always ask for more money than you have room for negotiating. Your ad should also state the type of business involved (to separate the curious from the truly interested), and the kind of return you're promising on the investment. </p>
    <p>Take a page from the party plan merchandisers. Set up a party and invite your friends over. Explain your business plan, the profit potential, and how much you need. Give them each a copy of your prospectus and ask that they pledge a thousand dollars as a non-participating partner in your business. Check with the current tax regulations. You may be allowed up to 25 partners in subchapter enterprises, opening the door for anyone to gather a group of friends around himself with something to offer them in return for their assistance in capitalizing his business. You can also issue and sell up to $300,000 worth of stock in your company without going through the Federal Trade Commission. You'll need the help of an attorney to do this, however, and of course, a good tax accountant wouldn't hurt. It's always a good idea to have an attorney and an accountant help you make up your business prospectus. As you explain your plan to them and ask for their advice, casually ask them if they'd mind letting you know of or steer your way to any potential investors they might happen to meet. Do the same with your banker. Give him a copy of your prospectus and ask him if he'd look it over and offer any suggestions for improving it, and of course, let you know of any potential investors.</p>
    <p>In either case, it's always a good idea to let them know you're willing to pay a \"finder's fee\" if you can be directed to the right investor. Professional people such as doctors and dentists are known to tend to join occupational investment groups. The next time you talk with your doctor or dentist, give him a prospectus and explain your plan. He may want to invest on his own or perhaps set up an appointment for you to talk with the manager of his investment group. Either way, you win because when you're looking for money, you must get the word out to as many potential investors as possible. Don't overlook the possibilities of the small business investment companies in your area. Look them up in your telephone book under \"investment services.\" These companies exist for the sole purpose of lending money to businesses that they feel have a good chance of making money. They often trade their help for a small interest in your company. </p>
    <p>Many states have business development commissions whose goal is to assist in the establishment and growth of new businesses. Not only do they offer favorable taxes and business expertise, but most also offer money or facilities to help a new company get started. Your chamber of commerce is where to check for further information on this idea. Industrial banks are usually much more amenable to making business loans than regular banks, so check out these institutions in your area. Insurance companies are prime sources of long-term business capital, but each company varies its policies regarding the type of business it will consider. Check your local agent for the name and address of the person to contact. It's also quite possible to get the directories of another company to invest in your business. Look for a company that can benefit from your product or service. Also, check at your public library for available foundation grants. These can be the final answer to all your money needs if your business is perceived to be related to the objectives and activities of the foundation. </p>
    <p>Finally, there's the money broker or finder. These people take your prospectus and circulate it with various known lenders or investors. They always require an up-front or retainer fee, and there's no way they can guarantee to get you the loan or the money you want. There are many outstanding money brokers, and some are not so good. They all take a percentage of the gross amount procured for your needs. The important thing is to check them out thoroughly; find out about the successful loans or investment plans they've arranged and what kind of investor contacts they have---all of this before you put up any front money or pay any retainer fees. </p>
    <p>There are many ways to raise money---from staging garage sales to selling stocks. Don't make the mistake of thinking that the only place you can find the money you need is through the bank or finance company. Start thinking about inviting investors to share in your business as silent partners. Think about obtaining financing for a primary business by arranging financing for another business that will support the start-up, establishment, and development of the primary industry. Consider the feasibility of merging with a company that's already organized and with facilities compatible with or related to your needs. Consider the possibilities of getting the people supplying your production equipment to co-sign the loan you need for start-up capital. </p>
    <p>Remember, there are thousands of ways to obtain business start-up capital. This is truly the age of creative financing. Disregard the stories you hear of \"tight money\" and start making phone calls, talking to people, and making appointments to discuss your plans with those who have money invested. There's more money now than ever for a new business investment. The problem is that most beginning \"business builders\" don't know what to believe or which way to turn for help. They tend to think the stories of \"tight money,\" and they set aside their plans for a business of their own until a time when start-up money might be easier to find. The truth is this: now is the time to make your move. Now is the time to act. A person with a genuinely viable business plan and determination to succeed will use every possible idea that can be imagined. And the pictures I've suggested here should serve as just a few of the unlimited sources of monetary help available and waiting for you!</p> ";
    
    

    $record = [
      'post_title'      => $title,
      'short_title'     => 'Short Title | '.ucfirst($categoryName),
      'slug'            => slug($title),
      'lead'            => 'lead text -' .$faker->realText(250),
      'body'            => $postContent,
      'id_author'       => $userIds[rand(0, count($userIds) - 1)],
      'id_category'     => $categoryId,
      'id_comments'     =>  '1',
      'id_ebook'        => $books[rand(0, 2)],
      'post_img'        => $this->getImageRelatedToCategory($categoryName),
      'post_img_alt'    => $faker->realText(25),
      'post_img_credit' => '808pic.com',      
      'related_vid'     => 'https://youtu.be/iI-i6RyDe-8',
      'md'              => 'meta description',
      'keyword'         => strtolower($title),
      'post_status'     => $postStatus[rand(0, 4)],
      'reader_hits'     => rand(99, 2500),
      'stars'           => rand(3, 5),
      'like'            => rand(55, 155),
      'unlike'          => rand(1, 12),
      'publish_at'      => $date->format('Y-m-d H:i:s'),
    ];

    return $record;
  }

	

  // idea from hari K, stored in 442

  private function generateTitleRelatedToCategory($categoryName): string
  {
    $titleList = array(
      'sales' => array(
          '14 Questions You Might Be Afraid to Ask About Sales',
          '10 Situations When You\'ll Need to Know About Sales',
          'How to Outsmart Your Peers on Sales',
          'A Trip Back in Time: How People Talked About Sales 20 Years Ago',
          '10 Best Facebook Pages of All Time About Sales',
          'How to Outsmart Your Boss on Technology',
          'This Is Your Brain on Sales',
          'Sales: Expectations vs. Reality',
          '7 Horrible Mistakes You\'re Making With Sales',
          '7 Little Changes That\'ll Make a Big Difference With Your Sales','15 People You Oughta Know in the Sales Industry',
          '10 Quick Tips About Sales',
          'Is Tech Making Sales Better or Worse?',
          'The Most Common Complaints About Sales, and Why They\'re Bunk',
          'How to Explain Sales to Your Boss',
          'How Much Should You Be Spending on Sales?',
          'Sales: It\'s Not as Difficult as You Think',
          '20 Fun Facts About Sales',
          '15 Best Twitter Accounts to Learn About Sales',
          'How to Get Hired in the Sales Industry',
      ),
      'marketing' => array(
          '4 Dirty Little Secrets About the Marketing Industry',
          'The Best Advice You Could Ever Get About Marketing',
          '20 Reasons You Need to Stop Stressing About Marketing',
          'Marketing Explained in Instagram Photos',
          'Enough Already! 15 Things About Marketing We\'re Tired of Hearing',
          '11 Embarrassing Marketing Faux Pas You Better Not Make',
          'The Most Underrated Companies to Follow in the Marketing Industry',
          'What I Wish I Knew a Year Ago About Marketing',
          'How Much Should You Be Spending on Marketing?',
          '20 Resources That\'ll Make You Better at Marketing',
          'The Most Common Mistakes People Make With Marketing',
          'The Most Pervasive Problems in Marketing',
          '25 Surprising Facts About Marketing',
          'Why People Love to Hate Marketing',
          'The 3 Biggest Disasters in Marketing History',
          'A Productive Rant About Marketing',
          '10 Things Most People Don\'t Know About Marketing',
          '15 Secretly Funny People Working in Marketing',
          'What\'s Holding Back the Marketing Industry?',
          '7 Little Changes That\'ll Make a Big Difference With Your Marketing',
          '10 Best Facebook Pages of All Time About Marketing',
          '3 Reasons Your Marketing Is Broken (And How to Fix It)',
          'The Marketing Awards: The Best, Worst, and Weirdest Things We\'ve Seen',
          'Forget Marketing: 10 Reasons Why You No Longer Need It',
          'A Productive Rant About Marketing',
          'Getting Tired of Marketing? 10 Sources of Inspiration That\'ll Rekindle Your Love',
          'How to Explain Marketing to Your Mom',
          'How Technology Is Changing How We Treat Marketing',
          'The Next Big Thing in Marketing',
          '15 Hilarious Videos About Marketing',
      ),
      'service' => array(
          '8 Effective Service Elevator Pitches',
          'The Evolution of Service',
          'The Best Advice You Could Ever Get About Service',
          '10 Things You Learned in Preschool That\'ll Help You With Service',
          'What the Oxford English Dictionary Doesn\'t Tell You About Service',
          '15 Best Pinterest Boards of All Time About Service',
          'Don\'t Make This Silly Mistake With Your Service',
          '10 Signs You Should Invest in Service',
          '5 Real-Life Lessons About Service',
          'The Biggest Problem With Service, And How You Can Fix It',
          'The Ultimate Guide to Service',
          '15 Most Underrated Skills That\'ll Make You a Rockstar in the Service Industry',
          '15 Up-and-Coming Service Bloggers You Need to Watch',
          'What I Wish I Knew a Year Ago About Service',
          'The Most Influential People in the Service Industry and Their Celebrity Dopplegangers',
          '10 Things Most People Don\'t Know About Service',
          '10 Pinterest Accounts to Follow About Service',
          '20 Resources That\'ll Make You Better at Service',
          'Meet the Steve Jobs of the Service Industry',
          '13 Things About Service You May Not Have Known',
      ),
      'business' => array(
          'Sage Advice About Business From a Five-Year-Old',
          'What\'s the Current Job Market for Business Professionals Like?',
          'Responsible for a Business Budget? 10 Terrible Ways to Spend Your Money',
          'The 12 Best Business Accounts to Follow on Twitter',
          'A Look Into the Future: What Will the Business Industry Look Like in 10 Years?',
          'Business: 11 Thing You\'re Forgetting to Do',
          '15 Hilarious Videos About Business',
          'Business: What No One Is Talking About',
          'Responsible for a Business Budget? 12 Top Notch Ways to Spend Your Money',
          'Why Nobody Cares About Business',
          '10 Meetups About Business You Should Attend',
          'What I Wish I Knew a Year Ago About Business',
          'Business: All the Stats, Facts, and Data You\'ll Ever Need to Know',
          '12 Stats About Business to Make You Look Smart Around the Water Cooler',
          'The Advanced Guide to Business',
          '20 Things You Should Know About Business',
          '17 Superstars We\'d Love to Recruit for Our Business Team',
          '15 Reasons Why You Shouldn\'t Ignore Business',
          '5 Laws Anyone Working in Business Should Know',
          '10 Things We All Hate About Business',
          'The Most Pervasive Problems in Business',
          '5 Killer Quora Answers on Business',
          'The Ultimate Glossary of Terms About Business',
          'The Ugly Truth About Business',
          '10 Inspirational Graphics About Business',
          'Undeniable Proof That You Need Business',
          'Business: 11 Thing You\'re Forgetting to Do',
          '10 Things You Learned in Kindergarden That\'ll Help You With Business',
          'How to Solve Issues With Business',
          '24 Hours to Improving Business',
      ),
      'website' => array(
          '20 Questions You Should Always Ask About Website Before Buying It',
          'How the 10 Worst Website Fails of All Time Could Have Been Prevented',
          'Why People Love to Hate Website',
          'The 12 Best Website Accounts to Follow on Twitter',
          '10 Apps to Help You Manage Your Website',
          'Website: 11 Thing You\'re Forgetting to Do',
          'Miley Cyrus and Website: 10 Surprising Things They Have in Common',
          'Don\'t Make This Silly Mistake With Your Website',
          '8 Go-To Resources About Website',
          '11 Ways to Completely Revamp Your Website',
          '14 Cartoons About Website That\'ll Brighten Your Day',
          'How to Outsmart Your Boss on Website',
          '10 Quick Tips About Website',
          '15 Up-and-Coming Website Bloggers You Need to Watch',
          'How to Explain Website to Your Grandparents',
          '5 Lessons About Website You Can Learn From Superheroes',
          'Website: Expectations vs. Reality',
          'Don\'t Make This Silly Mistake With Your Website',
          '10 Compelling Reasons Why You Need Website',
          '12 Reasons You Shouldn\'t Invest in Website',
          'Forget Website: 10 Reasons Why You No Longer Need It',
          '12 Stats About Website to Make You Look Smart Around the Water Cooler',
          'Why the Biggest "Myths" About Website May Actually Be Right',
          '10 Things Steve Jobs Can Teach Us About Website',
          'The Worst Advice We\'ve Ever Heard About Website',
          'The Most Innovative Things Happening With Website',
          'No Time? No Money? No Problem! How You Can Get Website With a Zero-Dollar Budget',
          '10 Principles of Psychology You Can Use to Improve Your Website',
          'The 17 Most Misunderstood Facts About Website',
          '15 Things Your Boss Wishes You Knew About Website',
      ),
    );

  $title = $titleList[$categoryName][rand(0, count($titleList[$categoryName]) - 1)];
  return $title;
  }

  private function getImageRelatedToCategory($categoryName): string
  {
    $imageList = array(
      'business' => array(
      //  'news-6.webp',
      //  'news-5.webp'
      'img1.jpg',
      'img1.jpg'
      ),
      'marketing' => array(
      //  'news-2.webp',
      //  'news-4.webp'
      'img1.jpg',
      'img1.jpg'
      ),
      'sales' => array(
      //  'jay2.webp',
      //  'hero_bg_1_4.jpg'
      'img1.jpg',
      'img1.jpg'
      ),
      'website' => array(
      //  'bmw001.jpg',
      //  'Post_30.jpg'
      'img1.jpg',
      'img1.jpg'
      ),
      'service' => array(
      //  'marvin2.webp',
      //  'captainamerica.jpg'
      'img1.jpg',
      'img1.jpg'
      )
  );
  $imgPath = $imageList[$categoryName][rand(0, count($imageList[$categoryName]) - 1)];
  return $imgPath;
  }

  // old stuff
  private function generateNews(): array
	{
    $deletedAt = [null, null, null, null, date('Y-m-d H:i:s')];
    $books = [null, null, null, null, null, [rand(1, 6)]];
    $postStatus = ['shown', 'archived'];
		$faker = Factory::create();
		return [
			
    /*x*/  'post_title'      => $faker->words(4, true),
    /*x*/  'short_title'     => 'Short Title Text',
    /*x*/  'slug'            => $faker->slug(4),
    /*x*/  'lead'            => 'lead text -' .$faker->realText(50),
    /*x*/  'body'            => $faker->realText(100), //."\n\n". $faker->realText(300),
    /*x*/  'id_author'       => '1',        //$faker->randomElement(['2','2']),
    /*x*/  'id_category'     => rand(1, 8), // $faker->randomElement(['1','2']),
    /*x*/  'id_comments'     =>  '1',
    /*x*/  'id_ebook'        => $books[rand(0, 5)],
    /*x*/  'post_img'        => 'jay2.webp', // $faker->imageUrl($width = 640, $height = 480),
    /*x*/  'post_img_alt'    => $faker->realText(15),
    /*x*/  'post_img_credit' => '808pic.com',      
    /*x*/  'related_vid'     => 'you tube link goes here',
    /*x*/  'md'              => 'meta description',
    /*x*/  'keyword'         => 'keyword',
    /*x*/  'post_status'     => $postStatus[rand(0, 1)],
    /*x*/  'reader_hits'     => rand(99, 2500),
    /*x*/  'stars'           => rand(3, 5),
    /*x*/  'like'            => rand(55, 155),
    /*x*/  'unlike'          => rand(1, 12),
    /*x*/  'publish_at'      => date('Y-m-d H:i:s'), //'2022-02-06 09:57:41',            
      'deleted_at'      => $deletedAt[rand(0, 4)]
		];
	}
}
