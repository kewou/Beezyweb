#!/bin/sh

# constantes
HOST=ftp.beezyweb.net
LOGIN=beezyweb.net
PASSWORD=delphine12
PORT=22

echo "Connection FTP"
ftp -i -n $HOST $PORT << END_SCRIPT
quote USER $LOGIN
quote PASS $PASSWORD
END_SCRIPT

echo "Connection ok"