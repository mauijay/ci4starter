# CodeIgniter4 Starter Kit

[![Official Website](https://img.shields.io/badge/Official_Website-Visit-107516)](https://808.biz)  
[![YouTube Channel](https://img.shields.io/badge/YouTube_Channel-Subscribe-CC0000)](https://youtube.com/@808biz4?si=kBqv93xorggCujLu)

## Overview ***WORK IN PROGRESS**

This repository provides a starter template for **CodeIgniter 4**, configured to get your application up and running quickly. Follow the instructions below to set up and start developing with CodeIgniter 4.

This repository includes:

- CodeIgniter v4.4.5
- CodeIgniter Shield v1.1.0

## Features

back end
tailwind css (*comming soon)
Font Awesome
Access control by Shield
Dynamic Menu
Language Support

## Requirements

Ensure you have the following installed before starting:

- **PHP 8.3** or later
- **Composer** command (See [Composer Installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos))
- **CodeIgniter 4.5.5**
- **Git**

## Install Guide

### 1. Clone the Project

Choose one of the following methods to clone the project into your desired folder:

**Using Composer:**

```bash
composer create-project mauijay/ci4-starter starter --stability=dev
```

**Or using Git:**

```bash
git clone https://github.com/mauijay/ci4-starter.git starter
```

**Navigate to the project folder:**

```bash
cd starter
```

### 2. Update Dependencies

Run the following commands to update dependencies and copy required files:

```bash
composer update
cp vendor/codeigniter4/framework/public/index.php public/index.php
cp vendor/codeigniter4/framework/spark spark
```

### 3. Set Up Environment File

Copy the .env file to the root directory:

```bash
cp env .env
```

### 4. Start the Application

Run the app using the built-in server. If you want to use a custom port (e.g., 8081), specify it using the --port option:

```php
php spark serve --port 8081
```

The application should now be accessible at <http://localhost:8081>

## Code Standards and Fixing

This project follows PHP coding standards. To automatically fix coding standard issues, run the following command:

```php
composer run fix
```

## Troubleshooting

If you encounter any issues during installation, feel free to open a discussion in the community.

### Install

```console
git clone https://github.com/mauijay/ci4-starter.git
cd ci4-starter/
composer install
```

### Create Database

```mysql
CREATE DATABASE `ci4_starter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER dbuser@localhost IDENTIFIED WITH mysql_native_password BY 'dbpasswd';
GRANT ALL PRIVILEGES ON ci4_starter.* TO dbuser@localhost;
```

### Configure

```console
cp env.sample .env
```

### Run Database Migration

```console
php spark migrate --all
```

### Run Development Server

```console
php spark serve
```

### How to Test JSON Web Token (JWT) Authentication

#### 1. Register a User

Navigate to <http://localhost:8080/register>.

#### 2. Get a JWT

```console
$ curl --location 'http://localhost:8080/auth/jwt' \
--header 'Content-Type: application/json' \
--data-raw '{"email" : "dbuser@808biz.com" , "password" : "dbpasswd"}'
```

```console
{
    "message": "User authenticated successfully",
    "user": {
        "id": 1,
        "username": "user1",
        "first_name": "Brad",
        "last_name": "Pitt",
        "dob": "2000-01-01",
        "city": "Honolulu",
        "state": "HI",
        "zip": "96814",
        "company": "808 BIZ, Inc.",
        "description": "no desc yet",
        "avatar": "01.png",
        "image": null,
        "client_id": "1",
        "phone": "8085551212",
        "alternative_phone": "8005551212",
        "address": "123 Main ST",
        "alternative_address": null,
        "message_checked_at": null,
        "notification_checked_at": null,
        "is_primary_contact": "0",
        "job_title": "President",
        "note": "add a better note here",
        "sticky_note": "add a better sticky note here",
        "enable_web_notification": "1",
        "enable_email_notification": "1",
        "requested_account_removal": "0",
        "whatsapp": "@808biz",
        "instagram": "@808biz",
        "facebook": "@808biz",
        "twitter": "@808biz",
        "linked_in": "@808biz",
        "skype": "@808biz",
        "last_online": null,
        "status": "random status",
        "status_message": "Random message text goes here",
        "active": true,
        "last_active": null,
        "created_at": {
            "date": "2023-11-03 07:33:51.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2023-11-03 07:33:51.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "deleted_at": null,
        "gender": "male",
        "user_type": "client"
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4"
}
```

#### 3. Access with the JWT

```console
$ curl --location --request GET 'http://localhost:8080/api/users' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4'

$ curl --location --request GET 'http://localhost:8080/api/0/websites' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4'

$ curl --location --request GET 'http://localhost:8080/api/users' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4'

$ curl --location --request GET 'http://localhost:8080/api/users' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4'

$ curl --location --request GET 'http://localhost:8080/api/users' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJTaGllbGQgVGVzdCBBcHAiLCJzdWIiOiIxIiwiaWF0IjoxNjk5Njc0NjI1LCJleHAiOjE2OTk2NzgyMjV9.nFeZBqov-R8IerGnslTDnQ1Uaf7riReIEOegegwybf4'
```

### Defined Routes

```console
+--------+----------------------------------------+---------------------------+--------------------------------------------------------------------+-------------------------
-------+--------------------------+
| Method | Route                                  | Name                      | Handler                                                            | Before Filters
       | After Filters            |
+--------+----------------------------------------+---------------------------+--------------------------------------------------------------------+-------------------------
-------+--------------------------+
| GET    | /                                      | home                      | \App\Controllers\Home::index                                       | online-filter
       | toolbar                  |
| GET    | categories                             | categories.index          | \App\Controllers\Categories::index                                 | online-filter
       | toolbar                  |
| GET    | events                                 | events.index              | \App\Controllers\Events::index                                     | online-filter
       | toolbar                  |
| GET    | docs                                   | docs.index                | \App\Controllers\Docs::index                                       | online-filter
       | toolbar                  |
| GET    | docs/(.*)                              | docs.test                 | \App\Controllers\Docs::test/$1                                     | online-filter
       | toolbar                  |
| GET    | job-board                              | jobs.index                | \App\Controllers\Jobs::index                                       | online-filter
       | toolbar                  |
| GET    | services                               | services.start            | \App\Controllers\Services::start                                   | online-filter
       | toolbar                  |
| GET    | design                                 | services.design           | \App\Controllers\Services::design                                  | online-filter
       | toolbar                  |
| GET    | makeover                               | services.makeover         | \App\Controllers\Services::makeover                                | online-filter
       | toolbar                  |
| GET    | marketing                              | services.marketing        | \App\Controllers\Services::marketing                               | online-filter
       | toolbar                  |
| GET    | advertising                            | services.advertising      | \App\Controllers\Services::advertising                             | online-filter
       | toolbar                  |
| GET    | seo                                    | services.seo              | \App\Controllers\Services::seo                                     | online-filter
       | toolbar                  |
| GET    | portfolio                              | services.portfolio        | \App\Controllers\Services::portfolio                               | online-filter
       | toolbar                  |
| GET    | business-events                        | services.events           | \App\Controllers\Services::events                                  | online-filter
       | toolbar                  |
| GET    | social-media                           | services.sm               | \App\Controllers\Services::sm                                      | online-filter
       | toolbar                  |
| GET    | youtube                                | services.youtube          | \App\Controllers\Services::youtube                                 | online-filter
       | toolbar                  |
| GET    | freebies                               | services.freebies         | \App\Controllers\Services::freebies                                | online-filter
       | toolbar                  |
| GET    | free-consultation                      | services.freeConsultation | \App\Controllers\Services::freeConsultation                        | online-filter
       | toolbar                  |
| GET    | faq                                    | services.faq              | \App\Controllers\Services::faq                                     | online-filter
       | toolbar                  |
| GET    | hosting                                | hosting.index             | \App\Controllers\Hosting::index                                    | online-filter
       | toolbar                  |
| GET    | promotions                             | lp.homefront              | \App\Controllers\LandingPages::index                               | online-filter
       | toolbar                  |
| GET    | promotions/([^/]+)                     | lp.show                   | \App\Controllers\LandingPages::view/$1                             | online-filter
       | toolbar                  |
| GET    | promotions/free/([^/]+)                | lp.free_dl                | \App\Controllers\LandingPages::download/$1                         | online-filter
       | toolbar                  |
| GET    | subscriber                             | subs.new                  | \App\Controllers\Subscribers::new                                  | online-filter
       | toolbar                  |
| GET    | subscriber/success                     | subs.success              | \App\Controllers\Subscribers::success                              | online-filter
       | toolbar                  |
| GET    | subscriber/activate/(.*)               | subs.activate             | \App\Controllers\Subscribers::activate/$1                          | online-filter
       | toolbar                  |
| GET    | net30                                  | »                         | \App\Controllers\Net30::index                                      | online-filter
       | toolbar                  |
| GET    | net30/application                      | net30.app                 | \App\Controllers\Net30::application                                | online-filter
       | toolbar                  |
| GET    | news/search                            | blog.search               | \App\Controllers\Blogs::search                                     | online-filter
       | toolbar                  |
| GET    | news/([^/]+)                           | blog.view                 | \App\Controllers\Blogs::view/$1                                    | online-filter
       | toolbar                  |
| GET    | news                                   | blog.index                | \App\Controllers\Blogs::index                                      | online-filter
       | toolbar                  |
| GET    | news/category/([^/]+)                  | blog.bycat                | \App\Controllers\Blogs::by_cat/$1                                  | online-filter
       | toolbar                  |
| GET    | polling                                | »                         | \App\Controllers\Polls::index                                      | online-filter
       | toolbar                  |
| GET    | polling/record/([0-9]+)/(.*)           | »                         | \App\Controllers\Polls::record/$1/$2                               | online-filter
       | toolbar                  |
| GET    | privacy                                | privacy.policy            | \App\Controllers\Home::privacy                                     | online-filter
       | toolbar                  |
| GET    | terms-of-service                       | terms.service             | \App\Controllers\Home::terms                                       | online-filter
       | toolbar                  |
| GET    | cookie-ploicy                          | cookie.policy             | \App\Controllers\Home::cookie                                      | online-filter
       | toolbar                  |
| GET    | pricing-policy                         | pricing.policy            | \App\Controllers\Home::pricing                                     | online-filter
       | toolbar                  |
| GET    | contact-us                             | contact_us                | \App\Controllers\Home::contact                                     | online-filter
       | toolbar                  |
| GET    | about-808-business-solutions           | about.us                  | \App\Controllers\Home::aboutUs                                     | online-filter
       | toolbar                  |
| GET    | testimonials                           | »                         | \App\Controllers\Home::testimonials                                | online-filter
       | toolbar                  |
| GET    | client/([0-9]+)/testimonial            | »                         | \App\Controllers\Home::boking_testimoni_new/$1                     | online-filter
       | toolbar                  |
| GET    | help                                   | »                         | \App\Controllers\Home::help                                        | online-filter
       | toolbar                  |
| GET    | shop                                   | myShop                    | \App\Controllers\Shop::index                                       | online-filter
       | toolbar                  |
| GET    | shop/list/([0-9]+)                     | »                         | \App\Controllers\Shop::list/$1                                     | online-filter
       | toolbar                  |
| GET    | shop/cart                              | showCart                  | \App\Controllers\Shop::showCart                                    | online-filter
       | toolbar                  |
| GET    | shop/search                            | shop.search               | \App\Controllers\Shop::search                                      | online-filter
       | toolbar                  |
| GET    | shop/([^/]+)                           | shop.show                 | \App\Controllers\Shop::view/$1                                     | online-filter
       | toolbar                  |
| GET    | shop/([0-9]+)                          | shop.showId               | \App\Controllers\Shop::viewId/$1                                   | online-filter
       | toolbar                  |
| GET    | shop/filtered-products                 | shop.filter               | \App\Controllers\AjaxController::filterProducts                    | online-filter
       | toolbar                  |
| GET    | orders/checkout                        | orders.index              | \App\Controllers\Orders::index                                     | online-filter
       | toolbar                  |
| GET    | orders/thanks/([0-9]+)                 | orders.thanks             | \App\Controllers\Orders::thanks/$1                                 | online-filter
       | toolbar                  |
| GET    | orders/receipt/([0-9]+)                | orders.receipt            | \App\Controllers\Orders::receipt/$1                                | online-filter
       | toolbar                  |
| GET    | orders/receipt-pdf/([0-9]+)            | orders.receipt.pdf        | \App\Controllers\Orders::receiptPDF/$1                             | online-filter
       | toolbar                  |
| GET    | client                                 | client.account            | \App\Controllers\Clients::account                                  | group online-filter     
       | group toolbar            |
| GET    | client/billing                         | client.billing            | \App\Controllers\Clients::billing                                  | group online-filter     
       | group toolbar            |
| GET    | client/notifications                   | client.notifications      | \App\Controllers\Clients::notifications                            | group online-filter     
       | group toolbar            |
| GET    | client/mydownloads                     | client.downloads          | \App\Controllers\Clients::mydownloads                              | group online-filter     
       | group toolbar            |
| GET    | client/security                        | client.security           | \App\Controllers\Clients::security                                 | group online-filter     
       | group toolbar            |
| GET    | user-account/profile                   | user.account              | \App\Controllers\UserAccount::index                                | group online-filter     
       | group toolbar            |
| GET    | user-account/billing                   | user.billing              | \App\Controllers\UserAccount::billing                              | group online-filter     
       | group toolbar            |
| GET    | user-account/security                  | user.security             | \App\Controllers\UserAccount::security                             | group online-filter     
       | group toolbar            |
| GET    | user-account/history                   | user.history              | \App\Controllers\UserAccount::history                              | group online-filter     
       | group toolbar            |
| GET    | user-account/favorites                 | user.favorites            | \App\Controllers\UserAccount::favorites                            | group online-filter     
       | group toolbar            |
| GET    | user-account/my-orders                 | user.orders               | \App\Controllers\UserAccount::my_orders                            | group online-filter     
       | group toolbar            |
| GET    | user-account/my-downloads              | user.downloads            | \App\Controllers\UserAccount::my_downloads                         | group online-filter     
       | group toolbar            |
| GET    | user-account/notifications             | user.notifications        | \App\Controllers\UserAccount::notifications                        | group online-filter     
       | group toolbar            |
| GET    | users123/profile                       | »                         | \App\Controllers\UserAccount::profile                              | permission online-filter
       | permission toolbar       |
| GET    | admin                                  | »                         | \App\Controllers\Dashboard::index                                  | group online-filter     
       | group toolbar            |
| GET    | admin/settings                         | admin.settings            | \App\Controllers\Settings::index                                   | permission online-filter
       | permission toolbar       |
| GET    | admin/changelog                        | admin.changelog           | \App\Controllers\Dashboard::changelog                              | group online-filter     
       | group toolbar            |
| GET    | admin/users                            | admin.users               | \App\Controllers\UserAccount::admin_index                          | group online-filter     
       | group toolbar            |
| GET    | admin/users/([0-9]+)                   | »                         | \App\Controllers\UserAccount::show/$1                              | group online-filter     
       | group toolbar            |
| GET    | admin/users/profile                    | profile                   | \App\Controllers\Users::profile                                    | group online-filter     
       | group toolbar            |
| GET    | admin/users/([0-9]+)/groups            | »                         | \App\Controllers\UserAccount::groups/$1                            | group online-filter     
       | group toolbar            |
| GET    | admin/users/([0-9]+)/permissions       | »                         | \App\Controllers\UserAccount::permissions/$1                       | group online-filter     
       | group toolbar            |
| GET    | admin/employees                        | employees.index           | \App\Controllers\Employees::index                                  | group online-filter     
       | group toolbar            |
| GET    | admin/employees-add                    | employee.add              | \App\Controllers\Employees::add                                    | group online-filter     
       | group toolbar            |
| GET    | admin/employees-show/([0-9]+)          | employee.show             | \App\Controllers\Employees::show/$1                                | group online-filter     
       | group toolbar            |
| GET    | admin/employees-edit/([0-9]+)          | employee.edit             | \App\Controllers\Employees::edit/$1                                | group online-filter     
       | group toolbar            |
| GET    | admin/leads                            | leads.index               | \App\Controllers\Leads::index                                      | group online-filter     
       | group toolbar            |
| GET    | admin/leads-add                        | lead.add                  | \App\Controllers\Leads::add                                        | group online-filter     
       | group toolbar            |
| GET    | admin/leads/show/([0-9]+)              | lead.show                 | \App\Controllers\Leads::show/$1                                    | group online-filter     
       | group toolbar            |
| GET    | admin/leads-edit/([0-9]+)              | lead.edit                 | \App\Controllers\Leads::edit/$1                                    | group online-filter     
       | group toolbar            |
| GET    | admin/clients                          | clients.index             | \App\Controllers\Clients::index                                    | group online-filter     
       | group toolbar            |
| GET    | admin/clients-add                      | client.add                | \App\Controllers\Clients::add                                      | group online-filter     
       | group toolbar            |
| GET    | admin/clients-show/([0-9]+)            | client.show               | \App\Controllers\Clients::show/$1                                  | group online-filter     
       | group toolbar            |
| GET    | admin/clients-edit/([0-9]+)            | client.edit               | \App\Controllers\Clients::edit/$1                                  | group online-filter     
       | group toolbar            |
| GET    | admin/comments/add                     | comment.add               | \App\Controllers\Comments::add                                     | group online-filter     
       | group toolbar            |
| GET    | admin/comments/edit/([0-9]+)           | comment.edit              | \App\Controllers\Comments::edit/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/manage-blog                      | news.manage               | \App\Controllers\Blogs::manage                                     | group online-filter     
       | group toolbar            |
| GET    | admin/news-create                      | news.create               | \App\Controllers\Blogs::create                                     | group online-filter     
       | group toolbar            |
| GET    | admin/news-edit/([0-9]+)               | news.edit                 | \App\Controllers\Blogs::edit/$1                                    | group online-filter     
       | group toolbar            |
| GET    | admin/shop                             | shop.dashboard            | \App\Controllers\Shop::manage                                      | group permission online-
filter | group permission toolbar |
| GET    | admin/manage-products                  | products.manage           | \App\Controllers\Products::manage                                  | group permission online-
filter | group permission toolbar |
| GET    | admin/products/add                     | product.add               | \App\Controllers\Products::add                                     | group permission online-
filter | group permission toolbar |
| GET    | admin/products/edit/([0-9]+)           | product.edit              | \App\Controllers\Products::edit/$1                                 | group permission online-
filter | group permission toolbar |
| GET    | admin/products/show/([0-9]+)           | product.show              | \App\Controllers\Products::show/$1                                 | group permission online-
filter | group permission toolbar |
| GET    | admin/products-image/([0-9]+)          | productimage.edit         | \App\Controllers\Products::Image/$1                                | group permission online-
filter | group permission toolbar |
| GET    | admin/manage-suppliers                 | manage.suppliers          | \App\Controllers\Suppliers::manage                                 | group permission online-
filter | group permission toolbar |
| GET    | admin/manage-brands                    | manage.brands             | \App\Controllers\Brands::manage                                    | group permission online-
filter | group permission toolbar |
| GET    | admin/brands-edit/([0-9]+)             | »                         | \App\Controllers\Brands::edit/$1                                   | group permission online-
filter | group permission toolbar |
| GET    | admin/users1                           | »                         | \App\Controllers\Users1::index                                     | group permission online-
filter | group permission toolbar |
| GET    | admin/users1/new                       | »                         | \App\Controllers\Users1::new                                       | group permission online-
filter | group permission toolbar |
| GET    | admin/users1/(.*)/edit                 | »                         | \App\Controllers\Users1::edit/$1                                   | group permission online-
filter | group permission toolbar |
| GET    | admin/users1/(.*)                      | »                         | \App\Controllers\Users1::show/$1                                   | group permission online-
filter | group permission toolbar |
| GET    | admin/settings/consent                 | consent-settings          | \App\Controllers\ConsentSettings::index                            | group online-filter     
       | group toolbar            |
| GET    | admin/account                          | »                         | \App\Controllers\Account::profile                                  | group online-filter     
       | group toolbar            |
| GET    | admin/billing                          | »                         | \App\Controllers\Account::billing                                  | group online-filter     
       | group toolbar            |
| GET    | admin/notifications                    | »                         | \App\Controllers\Account::notifications                            | group online-filter     
       | group toolbar            |
| GET    | admin/mydownloads                      | »                         | \App\Controllers\Account::mydownloads                              | group online-filter     
       | group toolbar            |
| GET    | admin/security                         | »                         | \App\Controllers\Account::security                                 | group online-filter     
       | group toolbar            |
| GET    | admin/manage-categories                | manage.categories         | \App\Controllers\Categories::manage                                | group online-filter     
       | group toolbar            |
| GET    | admin/category-add                     | »                         | \App\Controllers\Categories::add                                   | group online-filter     
       | group toolbar            |
| GET    | admin/categories/edit/([0-9]+)         | »                         | \App\Controllers\Categories::edit/$1                               | group online-filter     
       | group toolbar            |
| GET    | admin/categories-image/([0-9]+)        | »                         | \App\Controllers\Categories::addImage/$1                           | group online-filter     
       | group toolbar            |
| GET    | admin/lp-manage                        | lp.manage                 | \App\Controllers\LandingPages::manage                              | group online-filter     
       | group toolbar            |
| GET    | admin/lp-create                        | lp.add                    | \App\Controllers\LandingPages::add                                 | group online-filter     
       | group toolbar            |
| GET    | admin/lp-edit/([0-9]+)                 | lp.edit                   | \App\Controllers\LandingPages::edit/$1                             | group online-filter     
       | group toolbar            |
| GET    | admin/lp-image/([0-9]+)                | lp.image                  | \App\Controllers\LandingPages::Image/$1                            | group online-filter     
       | group toolbar            |
| GET    | admin/lp-delete/([0-9]+)               | lp.delete                 | \App\Controllers\LandingPages::delete/$1                           | group online-filter     
       | group toolbar            |
| GET    | admin/manage-kb                        | »                         | \App\Controllers\Kbs::manage                                       | group online-filter     
       | group toolbar            |
| GET    | admin/kb-create                        | »                         | \App\Controllers\Kbs::add                                          | group online-filter     
       | group toolbar            |
| GET    | admin/kb-edit/([0-9]+)                 | »                         | \App\Controllers\Kbs::edit/$1                                      | group online-filter     
       | group toolbar            |
| GET    | admin/kb-image/([0-9]+)                | »                         | \App\Controllers\Kbs::Image/$1                                     | group online-filter     
       | group toolbar            |
| GET    | admin/manage-faqs                      | »                         | \App\Controllers\Supports::manage                                  | group online-filter     
       | group toolbar            |
| GET    | admin/faqs-create                      | »                         | \App\Controllers\Supports::add                                     | group online-filter     
       | group toolbar            |
| GET    | admin/faqs-edit/([0-9]+)               | »                         | \App\Controllers\Supports::edit/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/faqs-image/([0-9]+)              | »                         | \App\Controllers\Supports::Image/$1                                | group online-filter     
       | group toolbar            |
| GET    | admin/manage-polls                     | »                         | \App\Controllers\Polls::manage                                     | group online-filter     
       | group toolbar            |
| GET    | admin/poll-create                      | »                         | \App\Controllers\Polls::add                                        | group online-filter     
       | group toolbar            |
| GET    | admin/poll-edit/([0-9]+)               | »                         | \App\Controllers\Polls::edit/$1                                    | group online-filter     
       | group toolbar            |
| GET    | admin/poll-image/([0-9]+)              | »                         | \App\Controllers\Polls::Image/$1                                   | group online-filter     
       | group toolbar            |
| GET    | admin/faqs                             | »                         | \App\Controllers\Supports::manage                                  | group online-filter     
       | group toolbar            |
| GET    | admin/manage-advertizements            | manage.adverts            | \App\Controllers\AdvS::manage                                      | group online-filter     
       | group toolbar            |
| GET    | admin/ads-create                       | ads.create                | \App\Controllers\AdvS::add                                         | group online-filter     
       | group toolbar            |
| GET    | admin/ads-edit/([0-9]+)                | »                         | \App\Controllers\Advs::edit/$1                                     | group online-filter     
       | group toolbar            |
| GET    | admin/ads-image/([0-9]+)               | »                         | \App\Controllers\AdvS::Image/$1                                    | group online-filter     
       | group toolbar            |
| GET    | admin/manage-documents                 | manage.docs               | \App\Controllers\Docs::manage                                      | group online-filter     
       | group toolbar            |
| GET    | admin/manage-jobs                      | manage.jobs               | \App\Controllers\Jobs::manage                                      | group online-filter     
       | group toolbar            |
| GET    | admin/manage-newsletters               | manage.newsletters        | \App\Controllers\Newsletters::manage                               | group online-filter     
       | group toolbar            |
| GET    | admin/websites                         | websites.manage           | \App\Controllers\Websites::index                                   | group online-filter     
       | group toolbar            |
| GET    | admin/websites/add                     | website.add               | \App\Controllers\Websites::add                                     | group online-filter     
       | group toolbar            |
| GET    | admin/websites/edit/([0-9]+)           | website.edit              | \App\Controllers\Websites::edit/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/websites/show/([0-9]+)           | website.show              | \App\Controllers\Websites::show/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/projects                         | projects.manage           | \App\Controllers\Projects::index                                   | group online-filter     
       | group toolbar            |
| GET    | admin/projects/add                     | project.add               | \App\Controllers\Projects::add                                     | group online-filter     
       | group toolbar            |
| GET    | admin/projects/edit/([0-9]+)           | project.edit              | \App\Controllers\Projects::edit/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/projects/show/([0-9]+)           | project.show              | \App\Controllers\Projects::show/$1                                 | group online-filter     
       | group toolbar            |
| GET    | admin/user2/home                       | user.home                 | \App\Controllers\UserController::index                             | group online-filter     
       | group toolbar            |
| GET    | admin/user2/profile                    | user.profile              | \App\Controllers\UserController::profile                           | group online-filter     
       | group toolbar            |
| GET    | admin/user2/countries                  | countries                 | \App\Controllers\UserController::countries                         | group online-filter     
       | group toolbar            |
| GET    | admin/user2/getAllCountries            | get.all.countries         | \App\Controllers\UserController::getAllCountries                   | group online-filter     
       | group toolbar            |
| GET    | admin/student                          | »                         | \App\Controllers\Student::index                                    | group online-filter     
       | group toolbar            |
| GET    | admin/student/edit/([0-9]+)            | »                         | \App\Controllers\Student::edit/$1                                  | group online-filter     
       | group toolbar            |
| GET    | admin/student/delete/([0-9]+)          | »                         | \App\Controllers\Student::delete/$1                                | group online-filter     
       | group toolbar            |
| GET    | site-offline                           | »                         | (Closure)                                                          |
       | toolbar                  |
| GET    | cron                                   | »                         | \App\Controllers\Invoices::cron                                    | online-filter
       | toolbar                  |
| GET    | api/0/websites                         | »                         | \App\Controllers\apiWebsitesController::getWebsites                | online-filter
       | toolbar                  |
| GET    | api/0/projects                         | »                         | \App\Controllers\apiProjectsController::getProjects                | online-filter
       | toolbar                  |
| GET    | api/0/profile/createToken              | »                         | \App\Controllers\apiProfileController::createToken                 | online-filter
       | toolbar                  |
| GET    | api/0/profile/deleteToken              | »                         | \App\Controllers\apiProfileController::deleteToken                 | online-filter
       | toolbar                  |
| GET    | api/v1/websites                        | »                         | \App\Controllers\apiWebsitesController::getWebsites                | online-filter
       | toolbar                  |
| GET    | api/v1/projects                        | »                         | \App\Controllers\apiProjectsController::getProjects                | online-filter
       | toolbar                  |
| GET    | register                               | »                         | \CodeIgniter\Shield\Controllers\RegisterController::registerView   | online-filter auth-rates
       | toolbar                  |
| GET    | login                                  | »                         | \CodeIgniter\Shield\Controllers\LoginController::loginView         | online-filter auth-rates
       | toolbar                  |
| GET    | login/magic-link                       | magic-link                | \CodeIgniter\Shield\Controllers\MagicLinkController::loginView     | online-filter auth-rates
       | toolbar                  |
| GET    | login/verify-magic-link                | verify-magic-link         | \CodeIgniter\Shield\Controllers\MagicLinkController::verify        | online-filter auth-rates
       | toolbar                  |
| GET    | logout                                 | »                         | \CodeIgniter\Shield\Controllers\LoginController::logoutAction      | online-filter
       | toolbar                  |
| GET    | auth/a/show                            | auth-action-show          | \CodeIgniter\Shield\Controllers\ActionController::show             | online-filter auth-rates
       | toolbar                  |
| GET    | api/users                              | »                         | \App\Controllers\Api\User::index                                   | jwt online-filter       
       | jwt toolbar              |
| POST   | subscriber/signup                      | subs.signup               | \App\Controllers\Subscribers::create                               | online-filter
       | toolbar                  |
| POST   | net30-app                              | net30.app_submit          | \App\Controllers\Net30::app                                        | online-filter
       | toolbar                  |
| POST   | news/([0-9]+)/add-favorite             | blog.addFavorite          | \App\Controllers\Blogs::addFavorite/$1                             | group online-filter     
       | group toolbar            |
| POST   | news/([0-9]+)/add-rating               | blog.addRating            | \App\Controllers\Blogs::addRating/$1                               | group online-filter     
       | group toolbar            |
| POST   | client/([0-9]+)/testimonial            | »                         | \App\Controllers\Home::boking_testimoni_create/$1                  | online-filter
       | toolbar                  |
| POST   | paypal-callback                        | »                         | \App\Controllers\Payments::paypalCallback                          | online-filter
       | toolbar                  |
| POST   | shop/store                             | shop.store                | \App\Controllers\Shop::store                                       | online-filter
       | toolbar                  |
| POST   | shop/([0-9]+)/add-favorite             | »                         | \App\Controllers\Products::addFavorite/$1                          | group online-filter     
       | group toolbar            |
| POST   | shop/([0-9]+)/add-rating               | »                         | \App\Controllers\Products::addRating/$1                            | group online-filter     
       | group toolbar            |
| POST   | orders/test                            | orders.test               | \App\Controllers\Orders::create                                    | online-filter
       | toolbar                  |
| POST   | orders/order                           | orders.store              | \App\Controllers\Orders::store                                     | online-filter
       | toolbar                  |
| POST   | client/wallet                          | client.wallet             | \App\Controllers\Clients::loadWallet                               | group online-filter     
       | group toolbar            |
| POST   | user-account/update-profile/([0-9]+)   | user.profile.update       | \App\Controllers\UserAccount::updateProfile/$1                     | group online-filter     
       | group toolbar            |
| POST   | admin/settings                         | admin.settings            | \App\Controllers\Settings::index                                   | permission online-filter
       | permission toolbar       |
| POST   | admin/users/([0-9]+)/toggle-ban        | »                         | \App\Controllers\UserAccount::toggleBan/$1                         | group online-filter     
       | group toolbar            |
| POST   | admin/users/([0-9]+)/groups            | »                         | \App\Controllers\UserAccount::groups/$1                            | group online-filter     
       | group toolbar            |
| POST   | admin/users/([0-9]+)/permissions       | »                         | \App\Controllers\UserAccount::permissions/$1                       | group online-filter     
       | group toolbar            |
| POST   | admin/employees-add                    | employee.add              | \App\Controllers\Employees::add                                    | group online-filter     
       | group toolbar            |
| POST   | admin/employees-edit/([0-9]+)          | employee.edit             | \App\Controllers\Employees::edit/$1                                | group online-filter     
       | group toolbar            |
| POST   | admin/employees-delete/([0-9]+)        | employee.delete           | \App\Controllers\Employees::delete/$1                              | group online-filter     
       | group toolbar            |
| POST   | admin/leads-add                        | lead.add                  | \App\Controllers\Leads::add                                        | group online-filter     
       | group toolbar            |
| POST   | admin/leads-edit/([0-9]+)              | lead.edit                 | \App\Controllers\Leads::edit/$1                                    | group online-filter     
       | group toolbar            |
| POST   | admin/leads-delete/([0-9]+)            | lead.delete               | \App\Controllers\Leads::delete/$1                                  | group online-filter     
       | group toolbar            |
| POST   | admin/clients-add                      | client.add                | \App\Controllers\Clients::add                                      | group online-filter     
       | group toolbar            |
| POST   | admin/clients-edit/([0-9]+)            | client.edit               | \App\Controllers\Clients::edit/$1                                  | group online-filter     
       | group toolbar            |
| POST   | admin/clients-delete/([0-9]+)          | client.delete             | \App\Controllers\Clients::delete/$1                                | group online-filter     
       | group toolbar            |
| POST   | admin/comments/add                     | comment.add               | \App\Controllers\Comments::add                                     | group online-filter     
       | group toolbar            |
| POST   | admin/comments/edit/([0-9]+)           | comment.edit              | \App\Controllers\Comments::edit/$1                                 | group online-filter     
       | group toolbar            |
| POST   | admin/news-create                      | news.create               | \App\Controllers\Blogs::create                                     | group online-filter     
       | group toolbar            |
| POST   | admin/news-edit/([0-9]+)               | news.edit                 | \App\Controllers\Blogs::edit/$1                                    | group online-filter     
       | group toolbar            |
| POST   | admin/news-update-image                | news.update-image         | \App\Controllers\Blogs::saveImage                                  | group online-filter     
       | group toolbar            |
| POST   | admin/news-delete/([^/]+)              | news.delete               | \App\Controllers\Blogs::delete/$1                                  | group online-filter     
       | group toolbar            |
| POST   | admin/posts                            | »                         | \App\Controllers\Blogs::save                                       | group online-filter     
       | group toolbar            |
| POST   | admin/posts/([0-9]+)                   | »                         | \App\Controllers\Blogs::save/$1                                    | group online-filter     
       | group toolbar            |
| POST   | admin/products/add                     | product.add               | \App\Controllers\Products::add                                     | group permission online-
filter | group permission toolbar |
| POST   | admin/products/edit/([0-9]+)           | product.edit              | \App\Controllers\Products::edit/$1                                 | group permission online-
filter | group permission toolbar |
| POST   | admin/products-image/([0-9]+)          | productimage.edit         | \App\Controllers\Products::Image/$1                                | group permission online-
filter | group permission toolbar |
| POST   | admin/products-delete/([^/]+)          | product.delete            | \App\Controllers\Products::delete/$1                               | group permission online-
filter | group permission toolbar |
| POST   | admin/brands-store                     | brands.store              | \App\Controllers\Brands::store                                     | group permission online-
filter | group permission toolbar |
| POST   | admin/brands-update                    | »                         | \App\Controllers\Brands::update                                    | group permission online-
filter | group permission toolbar |
| POST   | admin/brands-delete/([^/]+)            | »                         | \App\Controllers\Brands::delete/$1                                 | group permission online-
filter | group permission toolbar |
| POST   | admin/users1                           | »                         | \App\Controllers\Users1::create                                    | group permission online-
filter | group permission toolbar |
| POST   | admin/settings/consent                 | »                         | \App\Controllers\ConsentSettings::save                             | group online-filter     
       | group toolbar            |
| POST   | admin/search                           | search                    | \App\Controllers\SearchController::overview                        | group online-filter     
       | group toolbar            |
| POST   | admin/category-add                     | »                         | \App\Controllers\Categories::add                                   | group online-filter     
       | group toolbar            |
| POST   | admin/categories-update                | »                         | \App\Controllers\Categories::update                                | group online-filter     
       | group toolbar            |
| POST   | admin/categories-update-image          | »                         | \App\Controllers\Categories::saveImage                             | group online-filter     
       | group toolbar            |
| POST   | admin/categories-delete/([^/]+)        | »                         | \App\Controllers\Categories::delete/$1                             | group online-filter     
       | group toolbar            |
| POST   | admin/lp-create                        | lp.add                    | \App\Controllers\LandingPages::add                                 | group online-filter     
       | group toolbar            |
| POST   | admin/lp-edit/([0-9]+)                 | lp.edit                   | \App\Controllers\LandingPages::edit/$1                             | group online-filter     
       | group toolbar            |
| POST   | admin/lp-update-image                  | lp.image-save             | \App\Controllers\LandingPages::saveImage                           | group online-filter     
       | group toolbar            |
| POST   | admin/kb-create                        | »                         | \App\Controllers\Kbs::add                                          | group online-filter     
       | group toolbar            |
| POST   | admin/kb-update                        | »                         | \App\Controllers\Kbs::update                                       | group online-filter     
       | group toolbar            |
| POST   | admin/kb-update-image                  | »                         | \App\Controllers\Kbs::saveImage                                    | group online-filter     
       | group toolbar            |
| POST   | admin/kb-delete/([^/]+)                | »                         | \App\Controllers\Kbs::delete/$1                                    | group online-filter     
       | group toolbar            |
| POST   | admin/faqs-create                      | »                         | \App\Controllers\Supports::add                                     | group online-filter     
       | group toolbar            |
| POST   | admin/faqs-update                      | »                         | \App\Controllers\Supports::update                                  | group online-filter     
       | group toolbar            |
| POST   | admin/faqs-update-image                | »                         | \App\Controllers\Supports::saveImage                               | group online-filter     
       | group toolbar            |
| POST   | admin/faqs-delete/([^/]+)              | »                         | \App\Controllers\Supports::delete/$1                               | group online-filter     
       | group toolbar            |
| POST   | admin/poll-create                      | »                         | \App\Controllers\Polls::add                                        | group online-filter     
       | group toolbar            |
| POST   | admin/poll-update                      | »                         | \App\Controllers\Polls::update                                     | group online-filter     
       | group toolbar            |
| POST   | admin/poll-update-image                | »                         | \App\Controllers\Polls::saveImage                                  | group online-filter     
       | group toolbar            |
| POST   | admin/poll-delete/([^/]+)              | »                         | \App\Controllers\Polls::delete/$1                                  | group online-filter     
       | group toolbar            |
| POST   | admin/polls                            | »                         | \App\Controllers\Polls:save                                        | group online-filter     
       | group toolbar            |
| POST   | admin/polls/([0-9]+)                   | »                         | \App\Controllers\Polls::save/$1                                    | group online-filter     
       | group toolbar            |
| POST   | admin/ads-create                       | ads.create                | \App\Controllers\AdvS::add                                         | group online-filter     
       | group toolbar            |
| POST   | admin/ads-update                       | »                         | \App\Controllers\AdvS::update                                      | group online-filter     
       | group toolbar            |
| POST   | admin/ads-update-image                 | »                         | \App\Controllers\AdvS::saveImage                                   | group online-filter     
       | group toolbar            |
| POST   | admin/ads-delete/([^/]+)               | »                         | \App\Controllers\AdvS::delete/$1                                   | group online-filter     
       | group toolbar            |
| POST   | admin/advs                             | »                         | \App\Controllers\AdvS:save                                         | group online-filter     
       | group toolbar            |
| POST   | admin/advs/([0-9]+)                    | »                         | \App\Controllers\AdvS::save/$1                                     | group online-filter     
       | group toolbar            |
| POST   | admin/websites/add                     | website.add               | \App\Controllers\Websites::add                                     | group online-filter     
       | group toolbar            |
| POST   | admin/websites/edit/([0-9]+)           | website.edit              | \App\Controllers\Websites::edit/$1                                 | group online-filter     
       | group toolbar            |
| POST   | admin/projects/add                     | project.add               | \App\Controllers\Projects::add                                     | group online-filter     
       | group toolbar            |
| POST   | admin/projects/edit/([0-9]+)           | project.edit              | \App\Controllers\Projects::edit/$1                                 | group online-filter     
       | group toolbar            |
| POST   | admin/user2/addCountry                 | add.country               | \App\Controllers\UserController::addCountry                        | group online-filter     
       | group toolbar            |
| POST   | admin/user2/getCountryInfo             | get.country.info          | \App\Controllers\UserController::getCountryInfo                    | group online-filter     
       | group toolbar            |
| POST   | admin/user2/updateCountry              | update.country            | \App\Controllers\UserController::updateCountry                     | group online-filter     
       | group toolbar            |
| POST   | admin/user2/deleteCountry              | delete.country            | \App\Controllers\UserController::deleteCountry                     | group online-filter     
       | group toolbar            |
       | group toolbar            |
| POST   | register                               | »                         | \CodeIgniter\Shield\Controllers\RegisterController::registerAction | online-filter auth-rates       | toolbar                  |      
| POST   | login                                  | »                         | \CodeIgniter\Shield\Controllers\LoginController::loginAction       | online-filter auth-rates       | toolbar                  |      
| POST   | login/magic-link                       | »                         | \CodeIgniter\Shield\Controllers\MagicLinkController::loginAction   | online-filter auth-rates       | toolbar                  |      
| POST   | auth/a/handle                          | auth-action-handle        | \CodeIgniter\Shield\Controllers\ActionController::handle           | online-filter auth-rates       | toolbar                  |      
| POST   | auth/a/verify                          | auth-action-verify        | \CodeIgniter\Shield\Controllers\ActionController::verify           | online-filter auth-rates       | toolbar                  |      
       | group toolbar            |
| POST   | register                               | »                         | \CodeIgniter\Shield\Controllers\RegisterController::registerAction | online-filter auth-rates       | toolbar                  |
| POST   | login                                  | »                         | \CodeIgniter\Shield\Controllers\LoginController::loginAction       | online-filter auth-rates       | toolbar                  |
| POST   | login/magic-link                       | »                         | \CodeIgniter\Shield\Controllers\MagicLinkController::loginAction   | online-filter auth-rates       | toolbar                  |
| POST   | auth/a/handle                          | auth-action-handle        | \CodeIgniter\Shield\Controllers\ActionController::handle           | online-filter auth-rates       | toolbar                  |
| POST   | auth/a/verify                          | auth-action-verify        | \CodeIgniter\Shield\Controllers\ActionController::verify           | online-filter auth-rates       | toolbar                  |
| POST   | auth/jwt                               | »                         | \App\Controllers\Auth\LoginController::jwtLogin                    | online-filter auth-rates       | toolbar                  |
| PATCH  | shop/update                            | shop.update               | \App\Controllers\Shop::update                                      | online-filter
       | toolbar                  |
| PATCH  | admin/users1/(.*)                      | »                         | \App\Controllers\Users1::update/$1                                 | group permission online-filter | group permission toolbar |
| PUT    | news/([0-9]+)/change-rating            | blog.changeRating         | \App\Controllers\Blogs::changeRating/$1                            | group online-filter
       | group toolbar            |
| PUT    | shop/([0-9]+)/change-rating            | »                         | \App\Controllers\Products::changeRating/$1                         | group online-filter
       | group toolbar            |
| PUT    | user-account/profil/email              | user.email.update         | \App\Controllers\UserAccount::updateEmail                          | group online-filter
       | group toolbar            |
| PUT    | user-account/profil/username           | user.username.update      | \App\Controllers\UserAccount::updateUsername                       | group online-filter
       | group toolbar            |
| PUT    | admin/users1/(.*)                      | »                         | \App\Controllers\Users1::update/$1                                 | group permission online-filter | group permission toolbar |
| DELETE | news/([0-9]+)/delete-favorite          | blog.deleteFavorite       | \App\Controllers\Blogs::deleteFavorite/$1                          | group online-filter
       | group toolbar            |
| DELETE | shop/destroy                           | shop.destroy              | \App\Controllers\Shop::destroy                                     | online-filter
       | toolbar                  |
| DELETE | shop/([0-9]+)/delete-favorite          | »                         | \App\Controllers\Products::deleteFavorite/$1                       | group online-filter
       | group toolbar            |
| DELETE | user-account/favorites-remove/([0-9]+) | user.favorites.remove     | \App\Controllers\UserAccount::hapusFavorit/$1                      | group online-filter
       | group toolbar            |
| DELETE | admin/users1/(.*)                      | »                         | \App\Controllers\Users1::delete/$1                                 | group permission online-filter | group permission toolbar |
| DELETE | api/0/website/delete/([0-9]+)          | »                         | \App\Controllers\Websites::apiDelete/$1                            | online-filter
       | toolbar                  |
| DELETE | api/0/customer/delete/([0-9]+)         | »                         | \App\Controllers\Customers::apiDelete/$1                           | online-filter
       | toolbar                  |
| DELETE | api/0/project/delete/([0-9]+)          | »                         | \App\Controllers\Projects::apiDelete/$1                            | online-filter
       | toolbar                  |
| DELETE | api/0/invoice/delete/([0-9]+)          | »                         | \App\Controllers\Invoices::apiDelete/$1                            | online-filter
       | toolbar                  |
| DELETE | api/0/invoice/position/([0-9]+)/delete | »                         | \App\Controllers\InvoicesPositionController::apiDelete/$1          | online-filter
       | toolbar                  |
| DELETE | api/0/comment/delete/([0-9]+)          | »                         | \App\Controllers\Comments::apiDelete/$1                            | online-filter
       | toolbar                  |
| DELETE | api/0/tag/delete/([0-9]+)              | »                         | \App\Controllers\TagsController::apiDelete/$1                      | online-filter
       | toolbar                  |
| DELETE | api/0/user/delete/([0-9]+)             | »                         | \App\Controllers\UserController::apiDelete/$1                      | permission online-filter       | permission toolbar       |
| CLI    | cron                                   | »                         | \App\Controllers\Invoices::cron                                    |
       |                          |
+--------+----------------------------------------+---------------------------+--------------------------------------------------------------------+--------------------------------+--------------------------+
```

## References

- <https://github.com/codeigniter4/CodeIgniter4>
- <https://github.com/codeigniter4/shield>
