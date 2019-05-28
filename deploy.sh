#!/bin/sh

# constantes
HOST=ftp.beezyweb.net
LOGIN=beezyweb.net
PASSWORD=delphine12
PORT=22

echo "Connection FTP"
ftp -in $HOST << EOF
user $LOGIN $PASSWORD
mdelete app/*
rmdir app
bye
EOF
