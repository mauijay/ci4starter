<?php namespace Blogs\Database\Seeds;


use CodeIgniter\Database\Seeder;
use Blogs\Models\BlogModel;
use App\Models\CategoryModel;
use Faker\Factory;
use Exception;

class NewsFeaturedSeeder extends Seeder
{
	public function run()
	{
		$bm = model(BlogModel::class);

    $categoryModel = new CategoryModel();
    $categories = $categoryModel->select('id, cat_name')->where('cat_type', 'blog')->findAll();
    $categoryNames = array_column($categories, 'cat_name');
    
    
    $faker = Factory::create();
    $date = $faker->dateTimeBetween('-2 years', 'now');
    $postContent = "<p>Raising money for a business is not as difficult as most people think. This is especially true when you have an idea that can make you and your investors rich. There is more money available for new business ventures than there are good business ideas. An essential rule of the game to learn: any time you want to raise money, your first move should be to assemble a proper prospectus. This prospectus should include a resume of your background, education, training, experience, and any other personal qualities that might be counted as an asset to your potential success. It's also a good idea to list the various loans you've had, what they were for, and your history in paying them off. You'll have to explain how the money you want will be used. If it's for an existing business, you'll need a profit and loss record for at least the preceding six months and a plan showing how this additional money will produce greater profits. If it's a new business, you'll have to show your proposed business plan, your marketing research, and projected costs, as well as anticipated income figures, with a summary for each year over at least three years. It will benefit you to base your cost estimates high and your income projections on minimal returns. This will enable you to \"ride through\" those extreme \"ups and downs\" inherent in any beginning   <a href=\"https://808.biz\"target=\"_blank\" >business</a>.</p>
      <p>It would be best to describe what makes your business unique---how it differs from your competition and the opportunities for expansion or secondary products. This prospectus will have to state precisely what you're offering the investor in return for using his money. He'll want to know the percentage of interest you're willing to pay, whether monthly, quarterly, or annually. Are you offering a certain percentage of the profits? A percentage of the business? A seat on your board of directors? An investor uses his money to make more money. He wants to make as much as possible, regardless of whether it's a short-term or long-term deal. To attract him, interest him, and persuade him to \"put up\" the money you need, you'll not only have to offer him an opportunity for big profits, but you'll have to spell it out in detail and further, back up your claims with proof from your marketing research. </p>
      <p>Venture investors are usually quite familiar with \"high-risk\" proposals, yet they all want to minimize that risk as much as possible. Therefore, your prospectus should include a listing of your business and personal assets with documentation---usually copies of your tax returns for the past three years or more. Your prospective investor may not know anything about you or your business, but if he wants to know, he can pick up his telephone and know everything there is to know within 24 hours. The point is, don't ever try to \"con\" a potential investor. Be honest with him. Lay all the facts on the table for him. In most cases, if you've got a good idea and done your homework properly, an \"interested investor\" will understand your position and offer more help than you dared to ask. </p>
      <p>When you have your prospectus prepared and know how much money you want, exactly how it will be used, and how you intend to repay it, you're ready to start looking for investors. As simple as it seems, one of the easiest ways of raising money is by advertising in a newspaper or a national publication featuring such ads. Your ad should state the amount of money you want--always ask for more money than you have room for negotiating. Your ad should also state the type of business involved (to separate the curious from the truly interested), and the kind of return you're promising on the investment. </p>
      <p>Take a page from the party plan merchandisers. Set up a party and invite your friends over. Explain your business plan, the profit potential, and how much you need. Give them each a copy of your prospectus and ask that they pledge a thousand dollars as a non-participating partner in your business. Check with the current tax regulations. You may be allowed up to 25 partners in subchapter enterprises, opening the door for anyone to gather a group of friends around himself with something to offer them in return for their assistance in capitalizing his business. You can also issue and sell up to $300,000 worth of stock in your company without going through the Federal Trade Commission. You'll need the help of an attorney to do this, however, and of course, a good tax accountant wouldn't hurt. It's always a good idea to have an attorney and an accountant help you make up your business prospectus. As you explain your plan to them and ask for their advice, casually ask them if they'd mind letting you know of or steer your way to any potential investors they might happen to meet. Do the same with your banker. Give him a copy of your prospectus and ask him if he'd look it over and offer any suggestions for improving it, and of course, let you know of any potential investors.</p>
      <p>In either case, it's always a good idea to let them know you're willing to pay a \"finder's fee\" if you can be directed to the right investor. Professional people such as doctors and dentists are known to tend to join occupational investment groups. The next time you talk with your doctor or dentist, give him a prospectus and explain your plan. He may want to invest on his own or perhaps set up an appointment for you to talk with the manager of his investment group. Either way, you win because when you're looking for money, you must get the word out to as many potential investors as possible. Don't overlook the possibilities of the small business investment companies in your area. Look them up in your telephone book under \"investment services.\" These companies exist for the sole purpose of lending money to businesses that they feel have a good chance of making money. They often trade their help for a small interest in your company. </p>
      <p>Many states have business development commissions whose goal is to assist in the establishment and growth of new businesses. Not only do they offer favorable taxes and business expertise, but most also offer money or facilities to help a new company get started. Your chamber of commerce is where to check for further information on this idea. Industrial banks are usually much more amenable to making business loans than regular banks, so check out these institutions in your area. Insurance companies are prime sources of long-term business capital, but each company varies its policies regarding the type of business it will consider. Check your local agent for the name and address of the person to contact. It's also quite possible to get the directories of another company to invest in your business. Look for a company that can benefit from your product or service. Also, check at your public library for available foundation grants. These can be the final answer to all your money needs if your business is perceived to be related to the objectives and activities of the foundation. </p>
      <p>Finally, there's the money broker or finder. These people take your prospectus and circulate it with various known lenders or investors. They always require an up-front or retainer fee, and there's no way they can guarantee to get you the loan or the money you want. There are many outstanding money brokers, and some are not so good. They all take a percentage of the gross amount procured for your needs. The important thing is to check them out thoroughly; find out about the successful loans or investment plans they've arranged and what kind of investor contacts they have---all of this before you put up any front money or pay any retainer fees. </p>
      <p>There are many ways to raise money---from staging garage sales to selling stocks. Don't make the mistake of thinking that the only place you can find the money you need is through the bank or finance company. Start thinking about inviting investors to share in your business as silent partners. Think about obtaining financing for a primary business by arranging financing for another business that will support the start-up, establishment, and development of the primary industry. Consider the feasibility of merging with a company that's already organized and with facilities compatible with or related to your needs. Consider the possibilities of getting the people supplying your production equipment to co-sign the loan you need for start-up capital. </p>
      <p>Remember, there are thousands of ways to obtain business start-up capital. This is truly the age of creative financing. Disregard the stories you hear of \"tight money\" and start making phone calls, talking to people, and making appointments to discuss your plans with those who have money invested. There's more money now than ever for a new business investment. The problem is that most beginning \"business builders\" don't know what to believe or which way to turn for help. They tend to think the stories of \"tight money,\" and they set aside their plans for a business of their own until a time when start-up money might be easier to find. The truth is this: now is the time to make your move. Now is the time to act. A person with a genuinely viable business plan and determination to succeed will use every possible idea that can be imagined. And the pictures I've suggested here should serve as just a few of the unlimited sources of monetary help available and waiting for you!</p> ";

    foreach ($categoryNames as $typ) {
      $catId = $categoryModel->select('id')->where('cat_name', $typ)->first();
      $data = [			
        'post_title'      => "Featured $typ Article",
        'short_title'     => "$typ Article",
        'slug'            => 'featured-'.strtolower($typ).'-article',
        'lead'            => $faker->realText(250),
        'body'            => $postContent,
        'id_author'       => 1,
        'id_category'     => $catId->id,
        'id_comments'     => 1,
        'id_ebook'        => 1,
        'post_img'        => 'img1.jpg',
        'post_img_alt'    => $faker->realText(15),
        'post_img_credit' => '808pic.com',      
        'related_vid'     => 'https://youtu.be/iI-i6RyDe-8',
        'md'              => 'write a better meta description',
        'post_status'     => 'featured',
        'reader_hits'     => rand(99, 2500),
        'stars'           => rand(4, 5),
        'like'            => rand(101, 155),
        'unlike'          => rand(1, 12),
        'publish_at'      => $date->format('Y-m-d H:i:s'),
      ];  
      $bm->save($data);
    }		
    		
	}  
	
}
