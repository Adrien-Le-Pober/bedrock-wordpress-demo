.PHONY: tests

tests:
	@mysql -uroot -proot -hlocalhost -e "DROP DATABASE IF EXISTS wordpress_test;" 2> NUL
	@mysql -uroot -proot -hlocalhost -e "CREATE DATABASE wordpress_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2> NUL
	@php ./vendor/bin/phpunit --testdox
