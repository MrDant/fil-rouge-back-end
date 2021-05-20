if [ -z $1 ]
then
        echo "aucun service selectionné"
        exit 1
fi
docker exec -it $1-db pg_dumpall -U postgres > /home/$1/$(date "+%Y-%m-%d").sql
