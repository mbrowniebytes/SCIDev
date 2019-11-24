#!/usr/bin/env bash

exit

# these have not been tested with a new vagrant init
# just copying what i (mostly) ran in bash on the centos vm



# pre setup 
sudo yum update
sudo dnf config-manager --set-enabled PowerTools
sudo yum install epel-release
sudo yum update

sudo yum install php php-curl php-gd php-json php-mbstring 
sudo yum install nginx

sudo systemctl enable nginx

sudo mkdir /etc/nginx/sites-enabled
sudo vi /etc/nginx/nginx.conf # needs to be sed
include /etc/nginx/sites-enabled/*.conf;
server_names_hash_bucket_size 64;
sudo vi /etc/nginx/sites-enabled/ibex.localhost.conf
server {
   listen 80;
   server_name ibex.localhost www.ibex.localhost;

   root /var/www/ibex.localhost/public;
   index index.php;

   location / {
      # try_files $uri $uri/ =404;
      try_files $uri /index.php$is_args$args;
   }

   error_page 404 /404.html;
   error_page 500 502 503 504 /50x.html;
   location = /50x.html {
      root /var/www/ibex.localhost/public;
   }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php-fpm/www.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}


sudo yum install mariadb-server mariadb
# pwd dev

sudo systemctl enable mariadb

/etc/php-php.d/www.conf 
user = nginx
group = nginx
sudo systemctl start php-fpm
sudo systemctl enable php-fpm

sudo curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# for Slim
sudo yum install git
sudo yum install zip php-dom
sudo yum install php-dbg php-soap php-posix php-pdo

http://ibex.localhost:8080/hello/test

# vm guest tools so can mount another dir
yum install dkms
yum groupinstall "Development Tools"
yum install kernel-devel
sudo mount /dev/sr0 /media/cdrom
sudo ./VBoxLinuxAdditions.run

# wow
sudo yum install vim

# perms after sharing folder
sudo usermod -a -G vagrant nginx
sudo vi /etc/selinux/config







exit
# example
apt-get update
apt-get install -y apache2
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi
