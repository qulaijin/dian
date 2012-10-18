#!/bin/bash
clear

setenforce 0 >> /dev/null 2>&1

# Flush the IP Tables
iptables -F >> /dev/null 2>&1
iptables -P INPUT ACCEPT >> /dev/null 2>&1

SOFTACULOUS_FILREPO=http://www.softaculous.com
VIRTUALIZOR_FILEREPO=http://files.virtualizor.com
FILEREPO=http://files.webuzo.com
LOG=/root/webuzo-install.log
SOFT_CONTACT_FILE=/var/webuzo/users/soft/contact

# Download Webuzo repo
wget http://mirror.softaculous.com/webuzo/webuzo.repo -O /etc/yum.repos.d/webuzo.repo >> $LOG 2>&1

#----------------------------------
# Detecting the Architecture
#----------------------------------
if [ `uname -i` == x86_64 ]; then
	ARCH=64
else
	ARCH=32
fi

echo "-----------------------------------------------"
echo " Welcome to Webuzo Installer"
echo "-----------------------------------------------"
echo " "

#----------------------------------
# Some checks before we proceed
#----------------------------------
theos=`cat /etc/redhat-release | egrep -i '(cent|Scie|Red)' `

if [ "$?" -ne "0" ]; then
	echo "Webuzo can be installed only on CentOS, Redhat OR Scientific Linux"
	echo "Exiting installer"
	exit 1;
fi

# Is yum there ?
if ! [ -f /usr/bin/yum ] ; then
	echo "YUM wasnt found on the system. Please install YUM !"
	echo "Exiting installer"
	exit 1;
fi

user="soft"
adduser $user >> $LOG 2>&1
chmod 755 /home/soft >> $LOG 2>&1
/bin/ln -s /sbin/chkconfig /usr/sbin/chkconfig >> $LOG 2>&1
#----------------------------------
# Install PHP, MySQL, Apache, 
# OpenSSL, ModSSL and other stuff
#----------------------------------
echo "1) Installing PHP, MySQL and Apache"

echo "1) Installing PHP, MySQL and Apache" >> $LOG 2>&1
yum -y install sendmail gcc gcc-c++ openssl mod_ssl mysql-server httpd-devel unzip apr make vixie-cron libcap-devel >> $LOG 2>&1

theos=`cat /etc/redhat-release | grep -i 'release 6'`

# Check for centos version 
if [ "$?" -ne "0" ]; then
	osversion=5;
else
 	osversion=6;
fi

if [ $osversion == '5' ] ; then
	rpm -ivh http://repo.webtatic.com/yum/centos/5/`uname  -i`/webtatic-release-5-0.noarch.rpm >> $LOG 2>&1	
	yum --enablerepo=webtatic --exclude=php*5.3* -y install php php-common php-cli php-process php-pdo php-mysql php-mcrypt php-mbstring php-gd php-xml >> $LOG 2>&1
else
	rpm -Uvh http://download.fedoraproject.org/pub/epel/6/`uname  -i`/epel-release-6-7.noarch.rpm >> $LOG 2>&1
	yum --nogpgcheck -y install php php-common php-cli php-process php-pdo php-mysql php-mcrypt php-mbstring php-gd php-xml >> $LOG 2>&1
	rpm -e --nodeps epel-release >> $LOG 2>&1
fi


# Download the httpd.conf
wget $FILEREPO/httpd.conf >> $LOG 2>&1
mv httpd.conf /etc/httpd/conf/httpd.conf >> $LOG 2>&1
wget -O /var/www/error/noindex.html $FILEREPO/noindex.html >> $LOG 2>&1

# Download the php.conf
wget $FILEREPO/php.conf >> $LOG 2>&1
mv php.conf /etc/httpd/conf.d/php.conf >> $LOG 2>&1

# Download the php.ini we need
wget -O /etc/php.ini $FILEREPO/php.ini >> $LOG 2>&1

# Download the python.conf
#wget -O /etc/httpd/conf.d/python.conf $FILEREPO/python.conf >> $LOG 2>&1

# Creating sites directory 
mkdir /etc/httpd/sites >> $LOG 2>&1 

# Download the webuzo.conf
wget $FILEREPO/webuzo.conf >> $LOG 2>&1
mv webuzo.conf /etc/httpd/conf.d/webuzo.conf >> $LOG 2>&1 

# Disable selinux
if [ -f /etc/selinux/config ] ; then 
	mv /etc/selinux/config /etc/selinux/config_  
	echo "SELINUX=disabled" >> /etc/selinux/config 
	echo "SELINUXTYPE=targeted" >> /etc/selinux/config 
	echo "SETLOCALDEFS=0" >> /etc/selinux/config 
fi

#----------------------------------
# Installing suPHP
#----------------------------------
echo "2) Installing suPHP"
echo "2) Installing suPHP" >> $LOG 2>&1
if [ -f /etc/httpd/modules/mod_suphp.so ]; then
	echo "/etc/httpd/modules/mod_suphp.so already exists" >> $LOG 2>&1
else	
	wget $FILEREPO/suphp-0.7.1.tar.gz >> $LOG 2>&1
	tar -xzf suphp-0.7.1.tar.gz >> $LOG 2>&1
	cd suphp-0.7.1
	
	./configure --quiet --prefix=/usr --sysconfdir=/etc --with-apr=/usr/bin/apr-1-config --with-apxs=/usr/sbin/apxs --with-apache-user=apache --with-setid-mode=paranoid --with-php=/usr/bin/php-cgi --with-logfile=/var/log/httpd/suphp_log --enable-SUPHP_USE_USERGROUP=yes >> $LOG 2>&1
	
	sleep 3
	make >> $LOG 2>&1
	make install >> $LOG 2>&1
	cd - >> /dev/null 2>&1
	rm -rf /root/suphp-0.7.1.tar.gz
	rm -rf /root/suphp-0.7.1
fi

# Download the /etc/suphp.conf
wget $FILEREPO/etc_suphp.conf >> $LOG 2>&1
mv etc_suphp.conf /etc/suphp.conf >> $LOG 2>&1

# Download the suphp.conf
wget $FILEREPO/suphp.conf >> $LOG 2>&1
mv suphp.conf /etc/httpd/conf.d/suphp.conf >> $LOG 2>&1

# Download the mod_ruid2
wget $FILEREPO/mod_ruid2-0.9.4.tar.gz >> $LOG 2>&1 
tar -xzvf mod_ruid2-0.9.4.tar.gz >> $LOG 2>&1
cd mod_ruid2-0.9.4 >> $LOG 2>&1

# Installing mod_ruid2
apxs -a -i -l cap -c mod_ruid2.c >> $LOG 2>&1

# creating ruid2.conf
echo '<IfModule mod_ruid2.c>
    RMode config   
    RUidGid apache apache    
</IfModule>' >> /etc/httpd/conf.d/ruid2.conf

# Removing files
cd - >> /dev/null 2>&1
rm -rf /root/mod_ruid2-0.9.4.tar.gz >> $LOG 2>&1
rm -rf /root/mod_ruid2-0.9.4 >> $LOG 2>&1


#----------------------------------
# Installing ionCube
#----------------------------------
echo "3) Installing ionCube"
echo "3) Installing ionCube" >> $LOG 2>&1

ioncube=`php -v | grep -i ioncube`
if [ "$?" -eq "0" ]; then
	echo "IonCube already installed in PHP" >> $LOG 2>&1
else	
	phpversion=`php -r 'echo PHP_VERSION;'`
	phpversion=${phpversion:0:3}
	
	# Download the Module
	wget $VIRTUALIZOR_FILEREPO/ioncube/$ARCH/ioncube_loader_lin_$phpversion.so >> $LOG 2>&1
	
	# Shift it to the module folder
	if [ $ARCH == "64" ]; then
		moddir=/usr/lib64/php/modules
	else
		moddir=/usr/lib/php/modules
	fi
	mv ioncube_loader_lin_$phpversion.so $moddir/
	
	# Add it to /etc/php.ini
	echo "zend_extension=$moddir/ioncube_loader_lin_$phpversion.so" >> /etc/php.ini
fi

#----------------------------------
# Starting MySQL for the first time
#----------------------------------
echo "Starting MySQL for the first time" >> $LOG 2>&1
/usr/sbin/chkconfig mysqld on
/etc/init.d/mysqld restart >> $LOG 2>&1
#/etc/init.d/mysqld stop >> $LOG 2>&1
#mysqld_safe --skip-grant-tables &> /dev/null &

#----------------------------------
# Installing Bind for DNS
#----------------------------------
echo "4) Installing DNS server (BIND)"
echo "4) Installing DNS server (BIND)" >> $LOG 2>&1 
yum -y install bind bind-devel bind-utils >> $LOG 2>&1

wget -O /var/named/named.rfc1912.zones $FILEREPO/named.rfc1912.zones >> $LOG 2>&1
wget -O /var/named/named.zero $FILEREPO/named.zero >> $LOG 2>&1
wget -O /var/named/named.ip6.local $FILEREPO/named.ip6.local >> $LOG 2>&1
wget -O /var/named/named.local $FILEREPO/named.local >> $LOG 2>&1
wget -O /var/named/named.ca $FILEREPO/named.ca >> $LOG 2>&1
wget -O /var/named/named.broadcast $FILEREPO/named.broadcast >> $LOG 2>&1
wget -O /var/named/localdomain.zone $FILEREPO/localdomain.zone >> $LOG 2>&1
wget -O /var/named/localhost.zone $FILEREPO/localhost.zone >> $LOG 2>&1
/usr/sbin/chkconfig named on

#----------------------------------
# Installing PUREFTPD FTP Server
#----------------------------------
echo "5) Installing FTP Server"
echo "5) Installing FTP Server" >> $LOG 2>&1 

yum install -y postgresql-libs usermode >> $LOG 2>&1

yum install -y pure-ftpd mod_wsgi >> $LOG 2>&1

# Check for centos version 
if [ $osversion != '5' ]; then	

	# due to bug in bind for centos 6
	/usr/sbin/rndc-confgen -a >> $LOG 2>&1
	chmod 666 /etc/rndc.key >> $LOG 2>&1
	
fi



# Bring the Configs
wget -O /etc/pure-ftpd/pure-ftpd.conf $FILEREPO/pure-ftpd.conf >> $LOG 2>&1
wget -O /etc/httpd/conf.d/wsgi.conf  $FILEREPO/wsgi.conf >> $LOG 2>&1

# Start pure-ftpd for the first time
service pure-ftpd start >> $LOG 2>&1

# Save Pureftpd for starting it everytime
/usr/sbin/chkconfig pure-ftpd on >> $LOG 2>&1

#----------------------------------
# Installing EMAIL Server
#----------------------------------
echo "6) Installing EMAIL Server"
echo "6) Installing EMAIL Server" >> $LOG 2>&1 

# Installing dovecot and Exim

yum install -y dovecot exim >> $LOG 2>&1

# Check for centos version 
if [ $osversion == '5' ]; then
	
	wget -O /etc/dovecot.conf $FILEREPO/dovecot/5/dovecot.conf >> $LOG 2>&1
	wget -O /etc/exim/exim.conf $FILEREPO/exim/5/exim.conf >> $LOG 2>&1
else		
	wget -O /etc/exim/exim.conf $FILEREPO/exim/6/exim.conf >> $LOG 2>&1
	wget -O /etc/dovecot/conf.d/10-auth.conf $FILEREPO/dovecot/6/10-auth.conf >> $LOG 2>&1
	wget -O /etc/dovecot/conf.d/10-logging.conf $FILEREPO/dovecot/6/10-logging.conf >> $LOG 2>&1
	wget -O /etc/dovecot/conf.d/10-mail.conf $FILEREPO/dovecot/6/10-mail.conf >> $LOG 2>&1
	wget -O /etc/dovecot/conf.d/auth-passwdfile.conf.ext $FILEREPO/dovecot/6/auth-passwdfile.conf.ext >> $LOG 2>&1
	wget -O /etc/dovecot/conf.d/auth-static.conf.ext $FILEREPO/dovecot/6/auth-static.conf.ext >> $LOG 2>&1
	wget -O /etc/dovecot/dovecot.conf $FILEREPO/dovecot/6/dovecot.conf >> $LOG 2>&1
fi

groupadd -g 5000 vmail >> $LOG 2>&1
useradd -g vmail -u 5000 vmail -d /var/local/vmail -m >> $LOG 2>&1

mkdir /etc/vmail >> $LOG 2>&1
chown -R vmail:vmail /var/local/vmail >> $LOG 2>&1

# Make Exim the default MTA
alternatives --set mta /usr/sbin/sendmail.exim >> $LOG 2>&1

service sendmail stop >> $LOG 2>&1
chkconfig sendmail off >> $LOG 2>&1
chkconfig exim on >> $LOG 2>&1
chkconfig dovecot on >> $LOG 2>&1

# Is postfix there ?
if [ -f /etc/init.d/postfix ] ; then
	service postfix stop >> $LOG 2>&1
	chkconfig postfix off >> $LOG 2>&1
fi

# Start the services 
service dovecot start >> $LOG 2>&1
service exim restart >> $LOG 2>&1


#----------------------------------
# Download and Install Webuzo
#----------------------------------
echo "7) Downloading and Installing Webuzo"
echo "7) Downloading and Installing Webuzo" >> $LOG 2>&1
mkdir /usr/local/webuzo >> $LOG 2>&1
mkdir /usr/local/webuzo/enduser >> $LOG 2>&1
mkdir /var/webuzo >> $LOG 2>&1
mkdir /var/webuzo/sessions >> $LOG 2>&1
mkdir /var/webuzo/certs >> $LOG 2>&1 
mkdir /var/webuzo/users >> $LOG 2>&1
mkdir /var/webuzo/users/soft >> $LOG 2>&1

wget $FILEREPO/sample.named.conf >> $LOG 2>&1
mv sample.named.conf /var/webuzo/sample.named.conf >> $LOG 2>&1
wget $FILEREPO/sample.domain.zone >> $LOG 2>&1
mv sample.domain.zone /var/webuzo/sample.domain.zone >> $LOG 2>&1

hostname=$(hostname);
/usr/bin/openssl genrsa -out /var/webuzo/certs/webuzo.key 1024 >> $LOG 2>&1
/usr/bin/openssl req -subj /C=US/ST=Berkshire/L=Newbury/O='My Company'/CN='$hostname'/emailAddress='test@test.com' -new -key /var/webuzo/certs/webuzo.key -out /var/webuzo/certs/webuzo.csr >> $LOG 2>&1
/usr/bin/openssl x509 -req -days 365 -in /var/webuzo/certs/webuzo.csr -signkey /var/webuzo/certs/webuzo.key -out /var/webuzo/certs/webuzo.crt >> $LOG 2>&1
echo "" >> /var/webuzo/certs/webuzo-bundle.crt

# Get our installer
wget -O /usr/local/webuzo/install.php $FILEREPO/install.inc >> $LOG 2>&1

# Run our installer
php /usr/local/webuzo/install.php $*
phpret=$?
rm -rf /usr/local/webuzo/install.php >> $LOG 2>&1

# Was there an error
if ! [ $phpret == "8" ]; then
	echo " "
	echo "Please check $LOG for errors"
	echo "Exiting Installer"
 	exit 1;
fi

# Get our initial setup tool
wget -O /usr/local/webuzo/install.php $FILEREPO/initial.inc >> $LOG 2>&1

#----------------------------------
# Starting HTTPD for the first time
#----------------------------------
echo "Starting HTTPD / Apache" >> $LOG 2>&1
/etc/init.d/httpd restart >> $LOG 2>&1
/usr/sbin/chkconfig httpd on

wget $FILEREPO/ip.php >> $LOG 2>&1 
ip=$(cat ip.php) 

wget -O /usr/local/webuzo/enduser/universal.php $FILEREPO/universal.inc >> $LOG 2>&1

#----------------------------------
# FLUSH and SAVE IPTABLES
#----------------------------------
/sbin/iptables -F >> $LOG 2>&1
/etc/init.d/iptables save >> $LOG 2>&1

#----------------------------------
# Start the CRON and also start 
# on OS Restart
#----------------------------------
service crond restart >> $LOG 2>&1
/usr/sbin/chkconfig crond on

echo " "
echo "-------------------------------------"
echo " Installation Completed "
echo "-------------------------------------"
echo "Congratulations, Webuzo has been successfully installed"
echo " "
echo "You can now configure Softaculous Webuzo at the following URL :"
echo "http://$ip:2004/"
echo " "
echo "Thank you for choosing Webuzo !"
echo " "