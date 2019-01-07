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
1. Clone project về thông qua link: git@github.com:Natashi402/SimpleOnlineGameSE02.git
2. Chạy command
```$xslt
composer install
php yii migrate
cd nodejs
npm install --save express socket.io
```

###Khởi chạy websocket client server 
```$xslt
cd nodejs
node server.js
```

