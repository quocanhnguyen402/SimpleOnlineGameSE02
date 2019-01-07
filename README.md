# SimpleOnlineGameSE02

###Mục đích
> SimpleOnlineGame là một trang web chơi game online cho phép mọi người có thể chơi 1 game với nhau thông qua Internet.

> Mục tiêu dự án hướng tới việc tạo một cộng đồng giao lưu kết bạn. Mọi người có thể chơi trò chơi, giao lưu cùng với những người bạn của mình để tăng tình bạn bè, cũng có thể chơi và kết bạn, giao lưu với những người bạn mới.

###Điều kiện 
1. Nodejs 10.15.0 
    - https://nodejs.org/dist/v10.15.0/node-v10.15.0-x64.msi
    
2. LAMP 
    - Hiện cả nhóm thống nhất dùng WAMPSERVER:
    http://www.wampserver.com/#wampserver-64-bits-php-5-6-25-php-7
    
3. Composer
    - https://getcomposer.org/download/1.8.0/composer.phar   

###Hướng dẫn cài đặt
1. Clone project về máy
```$xslt
git clone https://github.com/Natashi402/SimpleOnlineGameSE02.git
```
2. Chạy command
```$xslt
composer install
php yii migrate
cd nodejs
npm install --save express socket.io
```
3. Configure cho Apache 
    - Thêm vào httpd-vhost.conf, với <Đường dẫn> thay bằng đường dẫn thực tế tới project
    ```$xslt
        <VirtualHost *:80>
                ServerName dev.mygame.com
                DocumentRoot "<Đường dẫn>/SimpleOnlineGameSE02/frontend/web"
                   
                <Directory "<Đường dẫn>/SimpleOnlineGameSE02/frontend/web">
        			# use mod_rewrite for pretty URL support
                    RewriteEngine on
                    # If a directory or a file exists, use the request directly
                    RewriteCond %{REQUEST_FILENAME} !-f
                    RewriteCond %{REQUEST_FILENAME} !-d
                    # Otherwise forward the request to index.php
                    RewriteRule . index.php
        			 
                    # use index.php as index file
                    DirectoryIndex index.php
        
                    # ...other settings...
        			Require all granted
        			
                </Directory>
            </VirtualHost>
    ```

    - Thêm vào file hosts
    ```$xslt
    127.0.0.1 dev.mygame.com
    ```

###Khởi chạy websocket client server 
```$xslt
cd nodejs
node server.js
```

