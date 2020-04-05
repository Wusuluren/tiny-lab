FROM tutum/lamp
ADD . /app
ADD mysql-setup.sh /mysql-setup.sh
EXPOSE 80 3306
CMD ["/run.sh"]