FROM ubuntu

RUN apt-get update && apt-get upgrade && apt-get install curl -y && curl -sSL https://get.docker.com/ | sh && apt-get install -y cron

COPY crontask /etc/cron.d/
COPY dump.sh /

RUN crontab /etc/cron.d/crontask

CMD cron -f