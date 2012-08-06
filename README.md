Update the absolute path to your digest password file

	grep AuthUserFile .htaccess

Create a digest file like so:

	sudo htdigest -c .digest-password upload username

# Features

* uploads organised by ISO 8601 date
* curlable uploads
* redirection on uploaded file for a "copy link" action
* simple
