FROM tutum/lamp
ADD . /app
ADD mysql-setup.sh /mysql-setup.sh
RUN apt-get update && apt-get install -y libcurl3 php5-curl
EXPOSE 80 3306
CMD ["/run.sh"]