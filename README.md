# bankMeVideo
#Creator: Jemz Zheel 08-Dec-2018

To view vlogs without interruptions

This project is initially created using ElementaryOS(LTS) linux distro.

Packages to install:
1) The new XAMP - Elementary OS, Apache2, MariaDB, Python3/PHP
	Make sure to install mysql.connector drivers to connect python & the DB

2) Ensure that the DB has an admin user & a test DB, table, atleast one field.

3) HTML template will help the process move along quicker.

4) Main workstation is setup.

5) Installation list: sudo apt install -y
	php git vim apache2
	mysql-server rabbitmq-server libapache2-mod-php7.2
	php-amqp python3-pip php-mysql

6) sudo rabbitmq-plugins enable rabbitmq_management
	sudo service rabbitmq (status | stop | start)

7) sudo service mysql (status | stop | start)
	in root: mysql -u root -p
	Enter your OS login passwd
	CREATE USER 'adminName'@'localhost' IDENTIFIED BY 'adminPasswd';
	GRANT ALL ON *.* TO 'adminName'@'localhost' IDENTIFIED BY 'adminPasswd';
	exit
	** login as the new admin: mysql -u adminName -p
	CREATE DATABASE dbName;
	use dbName;
	CREATE TABLE tableName (id int(8) unsigned auto_increment primary key,
				name_1 varchar(30) not null,
				name_2 varchar(30) not null);
	
8) Using the directory you want to share in gitHub:
	git init
	touch .gitignore
	git config --global user.name "yourName"
	git config --global user.email "yourEmail"
	git remote add origin "gitHub repository link"
	git pull origin master
	ssh-keygen --> cat & copy the ssh key in the path where the .pub is saved & send to repository owner
	ssh -T git@gitHub.com
	git status
	git add .
	git commit -m "Commit message"
	git push -f origin master --> Only for the first push: git push origin master --> For every push after

	
	

