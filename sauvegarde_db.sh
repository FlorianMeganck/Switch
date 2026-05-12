#!/bin/bash

USER="hh76ic64hcii"
PASS="t7=h1h#4hh"
DB="ebus2_projet05_siii57"
# On crée un dossier 'backups' s'il n'existe pas
DEST="/home/projet05/backups"

mkdir -p $DEST

# --- LA COMMANDE ---
# On crée le fichier avec la date et on le compresse (.gz)
mysqldump -u $USER -p$PASS $DB | gzip > $DEST/sauvegarde_$(date +%Y%m%d_%H%M).sql.gz

# Supprimer les sauvegardes de plus d'1 jour pour pas saturer
find $DEST -type f -mtime +1 -delete