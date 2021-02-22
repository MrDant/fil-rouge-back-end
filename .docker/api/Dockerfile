FROM nginx

ARG name

COPY ./default.conf /etc/nginx/conf.d/default.conf

RUN sed -i -e "s/\${name}/$name/" "/etc/nginx/conf.d/default.conf"