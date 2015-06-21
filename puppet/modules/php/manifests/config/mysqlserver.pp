class php::config::mysqlserver($password = 'root', $sqlfile = '/vagrant/public/db.sql' ) {

  exec { 'Set MySQL server root password':
      subscribe   => [ Package['mysql-server'], Package['mysql-client'] ],
      refreshonly => true,
      unless      => "mysqladmin -uroot -p$password status",
      path        => '/bin:/usr/bin',
      command     => "mysqladmin -uroot password $password",
  }

  file { '/tmp/localhost.sql':
    source  => $sqlfile,
    replace => true,
  }

  exec { 'create-db-schema-and-user':
    command => "/usr/bin/mysql -u root -p$password < /tmp/localhost.sql",
    require => [ File['/tmp/localhost.sql'], Exec['Set MySQL server root password'] ],
  }

}
