#!/bin/sh

TIMESTAMP=$(date +"%Y%m%d_%H%M")
BACKUP_DIR=/backups
FILENAME=db_backup_$TIMESTAMP.sql

mkdir -p $BACKUP_DIR

mysqldump \
  -h $DB_HOST \
  -u $DB_USERNAME \
  -p$DB_PASSWORD \
  $DB_DATABASE > $BACKUP_DIR/$FILENAME
