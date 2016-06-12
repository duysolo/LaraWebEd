Welcome to LaraWebEd! - A CMS build on Laravel
===================

###A starter CMS for Laravel
I have write a CMS for this framework, Support multi language.
I'm writing some other feature: ecommerce, manage orders, checkout...
I hope it can helps you more for start a new project.
If you need more support, please feel free to contact me via:
- Facebook: [https://www.facebook.com/duyphan.developer](https://www.facebook.com/duyphan.developer)
- Skype: tedozi.manson
- Email: duyphan.developer@gmail.com

###Some features of this CMS:
- Manage page, post, product, category, product category.
- Manage file by el-finder.
- Manage page template.
- Handle custom fields (demo: https://www.youtube.com/watch?v=8ku2yaByYMI)
- User management.
- User roles: webmaster, admin, staff in backend.
- Menu management with drag & drop.
- Options.
- Multi language.
- Manage user feedbacks.

----------


Documents
-------------

On this projects, I use the latest Laravel version (currently 5.2). Please go to [laravel documentation page](https://laravel.com/docs/5.2#installation) to check your system requirements.


#### Checkout project

> git clone **git@github.com:duyphan2502/LaraWebEd.git**

#### Run composer

> composer install

#### Import the database

> You can see the database file in **resources/db/mine_laracms.sql**

#### Create **.env** file

> APP_ENV=local

> APP_DEBUG=true

> APP_KEY=base64:qB5Ok2LCGmNvaAHF4OofNIC04/Kz4c497qxSWojN3tg=

> APP_ADMINCPACCESS=admincp

> DB_CONNECTION=mysql

> DB_HOST=localhost

> DB_DATABASE=**your_database_name**

> DB_USERNAME=**your_database_user**

> DB_PASSWORD=**your_database_password**

> DB_PORT=**your_database_port**

> MAIL_GLOBAL_FROM_ADDRESS=admin@larawebed.com

> MAIL_GLOBAL_FROM_NAME=LaraWebEd

> MAIL_DRIVER=smtp

> MAIL_HOST=smtp.gmail.com

> MAIL_PORT=465

> MAIL_USERNAME=**your_email**

> MAIL_PASSWORD=**your_email_password**

> MAIL_ENCRYPTION=ssl

####Note
- This site can only be run at domain name, not folder link.
- On your localhost, setting virtual host. Something like 

> larawebed.mydev.local

is ok. Cannot use as

> localhost/larawebed/...

Follow these steps to see how to config virtual host: [Virtual host](./documentation/VirtualHost.md)

> For the best, you should set your domain in local as sub-domain of **mydev.local**,
> because you dont need to change the secret key and site key for GoogleCaptcha in settings.


Well done! Now, you can login to the dashboard by access to [your_domain_site/admincp](your_domain_site/admincp)
> Username: **webmaster**

> Password: **PassCuaDev@2015**


### Demo site
Checkout branch **demo-blog** for a demo blog site.
But the version of LaraWebEd of this branch is too old. You can just see how to build a site with LaraWebEd with this branch.

Enjoy!

#####Please star for me to make me happy and continue to develop this cms <3. I always try my best!

####About the future
I'm creating a ecommerce site with this cms. I will release that site for all of you when done.

###Table of contents

- [Custom fields](./documentation/CustomFields.md)
- [Page template](./documentation/PageTemplate.md)
- [Models](./documentation/Models.md)