#!/bin/sh

# constantes
HOST=ftp.beezyweb.net
LOGIN=beezyweb.net
PASSWORD=delphine12
PORT=22

echo "Connection FTP"
ftp -inv $HOST $PORT << EOF
user $LOGIN $PASSWORD
ls
bye
EOF
